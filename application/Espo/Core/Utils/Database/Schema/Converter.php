<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2017 Yuri Kuznetsov, Taras Machyshyn, Oleksiy Avramenko
 * Website: http://www.espocrm.com
 *
 * EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

namespace Espo\Core\Utils\Database\Schema;
use Espo\Core\Utils\Util,
    Espo\ORM\Entity,
    Espo\Core\Exceptions\Error;


class Converter
{
    private $dbalSchema;
    private $fileManager;

    private $ormMeta = null;

    private $customTablePath = 'application/Espo/Core/Utils/Database/Schema/tables';

    protected $typeList;

    //pair ORM => doctrine
    protected $allowedDbFieldParams = array(
        'len' => 'length',
        'default' => 'default',
        'notNull' => 'notnull',
        'autoincrement' => 'autoincrement',
        'unique' => 'unique',
    );

    //todo: same array in Converters\Orm
    protected $idParams = array(
        'dbType' => 'varchar',
        'len' => 24,
    );

    //todo: same array in Converters\Orm
    protected $defaultLength = array(
        'varchar' => 255,
        'int' => 11,
    );

    protected $notStorableTypes = array(
        'foreign'
    );

    public function __construct(\Espo\Core\Utils\File\Manager $fileManager)
    {
        $this->fileManager = $fileManager;

        $this->typeList = array_keys(\Doctrine\DBAL\Types\Type::getTypesMap());
    }

    protected function getFileManager()
    {
        return $this->fileManager;
    }

    /**
     * Get schema
     *
     * @param  boolean $reload
     *
     * @return \Doctrine\DBAL\Schema\Schema
     */
    protected function getSchema($reload = false)
    {
        if (!isset($this->dbalSchema) || $reload) {
            $this->dbalSchema = new \Espo\Core\Utils\Database\DBAL\Schema\Schema();
        }

        return $this->dbalSchema;
    }

    /**
     * Schema convertation process
     *
     * @param  array  $ormMeta
     * @param  array|null $entityList
     *
     * @return \Doctrine\DBAL\Schema\Schema
     */
    public function process(array $ormMeta, $entityList = null)
    {
        $GLOBALS['log']->debug('Schema\Converter - Start: building schema');

        //check if exist files in "Tables" directory and merge with ormMetadata
        $ormMeta = Util::merge($ormMeta, $this->getCustomTables($ormMeta));

        //unset some keys in orm
        if (isset($ormMeta['unset'])) {
            $ormMeta = Util::unsetInArray($ormMeta, $ormMeta['unset']);
            unset($ormMeta['unset']);
        } //END: unset some keys in orm

        if (isset($entityList)) {
            $entityList = is_string($entityList) ? (array) $entityList : $entityList;

            $dependentEntities = $this->getDependentEntities($entityList, $ormMeta);
            $GLOBALS['log']->debug('Rebuild Database for entities: ['.implode(', ', $entityList).'] with dependent entities: ['.implode(', ', $dependentEntities).']');

            $ormMeta = array_intersect_key($ormMeta, array_flip($dependentEntities));
        }

        $schema = $this->getSchema(true);

        $tables = array();
        foreach ($ormMeta as $entityName => $entityParams) {

            $tableName = Util::toUnderScore($entityName);

            if ($schema->hasTable($tableName)) {
                if (!isset($tables[$entityName])) {
                    $tables[$entityName] = $schema->getTable($tableName);
                }
                $GLOBALS['log']->debug('DBAL: Table ['.$tableName.'] exists.');
                continue;
            }

            $tables[$entityName] = $schema->createTable($tableName);

            $primaryColumns = array();
            $uniqueColumns = array();
            $indexList = array(); //list of indexes like array( array(comlumn1, column2), array(column3))
            foreach ($entityParams['fields'] as $fieldName => $fieldParams) {

                if ((isset($fieldParams['notStorable']) && $fieldParams['notStorable']) || in_array($fieldParams['type'], $this->notStorableTypes)) {
                    continue;
                }

                switch ($fieldParams['type']) {
                    case 'id':
                        $primaryColumns[] = Util::toUnderScore($fieldName);
                        break;
                }

                $fieldType = isset($fieldParams['dbType']) ? $fieldParams['dbType'] : $fieldParams['type'];
                $fieldType = strtolower($fieldType); /** doctrine uses strtolower for all field types */
                if (!in_array($fieldType, $this->typeList)) {
                    $GLOBALS['log']->debug('Converters\Schema::process(): Field type ['.$fieldType.'] does not exist '.$entityName.':'.$fieldName);
                    continue;
                }

                $columnName = Util::toUnderScore($fieldName);
                if (!$tables[$entityName]->hasColumn($columnName)) {
                    $tables[$entityName]->addColumn($columnName, $fieldType, $this->getDbFieldParams($fieldParams));
                }

                //add unique
                if ($fieldParams['type']!= 'id' && isset($fieldParams['unique'])) {
                    $uniqueColumns = $this->getKeyList($columnName, $fieldParams['unique'], $uniqueColumns);
                } //END: add unique

                //add index. It can be defined in entityDefs as "index"
                if (isset($fieldParams['index'])) {
                    $indexList = $this->getKeyList($columnName, $fieldParams['index'], $indexList);
                } //END: add index
            }

            $tables[$entityName]->setPrimaryKey($primaryColumns);

            //add indexes
            if (isset($entityParams['indexes']) && is_array($entityParams['indexes'])) {
                foreach ($entityParams['indexes'] as $indexName => $indexParams) {
                    if (is_array($indexParams['columns'])) {
                        $tableIndexName = $this->generateIndexName($indexName, $entityName);
                        $indexList[$tableIndexName] = Util::toUnderScore($indexParams['columns']);
                    }
                }
            }
            if (!empty($indexList)) {
                foreach($indexList as $indexName => $indexItem) {
                    $tableIndexName = is_string($indexName) ? $indexName : null;
                    $tables[$entityName]->addIndex($indexItem, $tableIndexName);
                }
            }

            if (!empty($uniqueColumns)) {
                foreach($uniqueColumns as $uniqueItem) {
                    $tables[$entityName]->addUniqueIndex($uniqueItem);
                }
            }
        }

        //check and create columns/tables for relations
        foreach ($ormMeta as $entityName => $entityParams) {

            if (!isset($entityParams['relations'])) {
                continue;
            }

            foreach ($entityParams['relations'] as $relationName => $relationParams) {

                 switch ($relationParams['type']) {
                    case 'manyMany':
                        $tableName = $relationParams['relationName'];

                        //check for duplication tables
                        if (!isset($tables[$tableName])) { //no needs to create the table if it already exists
                            $tables[$tableName] = $this->prepareManyMany($entityName, $relationParams, $tables);
                        }
                        break;

                    case 'belongsTo':
                        $columnName = Util::toUnderScore($relationParams['key']);
                        $tables[$entityName]->addIndex(array($columnName));
                        break;
                }
            }
        }
        //END: check and create columns/tables for relations

        $GLOBALS['log']->debug('Schema\Converter - End: building schema');

        return $schema;
    }

    /**
     * Prepare a relation table for the manyMany relation
     *
     * @param string $entityName
     * @param array $relationParams
     * @param array $tables
     *
     * @return \Doctrine\DBAL\Schema\Table
     */
    protected function prepareManyMany($entityName, $relationParams, $tables)
    {
        $tableName = Util::toUnderScore($relationParams['relationName']);

        if ($this->getSchema()->hasTable($tableName)) {
            $GLOBALS['log']->debug('DBAL: Table ['.$tableName.'] exists.');
            return $this->getSchema()->getTable($tableName);
        }

        $table = $this->getSchema()->createTable($tableName);
        $table->addColumn('id', 'int', array('length'=>$this->defaultLength['int'], 'autoincrement' => true, 'notnull' => true,));  //'unique' => true,

        //add midKeys to a schema
        $uniqueIndex = array();
        foreach($relationParams['midKeys'] as $index => $midKey) {

            $columnName = Util::toUnderScore($midKey);
            $table->addColumn($columnName, $this->idParams['dbType'], array('length'=>$this->idParams['len']));
            $table->addIndex(array($columnName));

            $uniqueIndex[] = $columnName;
        }
        //END: add midKeys to a schema

        //add additionalColumns
        if (!empty($relationParams['additionalColumns'])) {
            foreach($relationParams['additionalColumns'] as $fieldName => $fieldParams) {

                if (!isset($fieldParams['type'])) {
                    $fieldParams = array_merge($fieldParams, array(
                        'type' => 'varchar',
                        'length' => $this->defaultLength['varchar'],
                    ));
                }

                $table->addColumn(Util::toUnderScore($fieldName), $fieldParams['type'], $this->getDbFieldParams($fieldParams));
            }
        } //END: add additionalColumns

        //add unique indexes
        if (!empty($relationParams['conditions'])) {
            foreach ($relationParams['conditions'] as $fieldName => $fieldParams) {
                $uniqueIndex[] = Util::toUnderScore($fieldName);
            }
        }

        if (!empty($uniqueIndex)) {
            $table->addUniqueIndex($uniqueIndex);
        }
        //END: add unique indexes

        $table->addColumn('deleted', 'bool', array('default' => 0));
        $table->setPrimaryKey(array("id"));

        return $table;
    }

    protected function getDbFieldParams($fieldParams)
    {
        $dbFieldParams = array();

        foreach($this->allowedDbFieldParams as $espoName => $dbalName) {

            if (isset($fieldParams[$espoName])) {
                $dbFieldParams[$dbalName] = $fieldParams[$espoName];
            }
        }

        switch ($fieldParams['type']) {
            case 'array':
            case 'jsonArray':
            case 'text':
            case 'longtext':
                unset($dbFieldParams['default']); //for db type TEXT can't be defined a default value
                break;

            case 'bool':
                $default = false;
                if (array_key_exists('default', $dbFieldParams)) {
                    $default = $dbFieldParams['default'];
                }
                $dbFieldParams['default'] = intval($default);
                break;
        }


        if ( isset($fieldParams['autoincrement']) && $fieldParams['autoincrement'] ) {
            $dbFieldParams['unique'] = true;
            $dbFieldParams['notnull'] = true;
        }

        return $dbFieldParams;
    }

    /**
     * Get key list (index, unique). Ex. index => true OR index => 'somename'
     * @param  string $columnName Column name (underscore field name)
     * @param  bool | string $keyValue
     * @return array
     */
    protected function getKeyList($columnName, $keyValue, array $keyList)
    {
        if ($keyValue === true) {
            $keyList[] = array($columnName);
        } else if (is_string($keyValue)) {
            $keyList[$keyValue][] = $columnName;
        }

        return $keyList;
    }

    /**
     * Get custom table defenition in "application/Espo/Core/Utils/Database/Schema/tables/" and in metadata 'additionalTables'
     *
     * @param  array  $ormMeta
     *
     * @return array
     */
    protected function getCustomTables(array $ormMeta)
    {
        $customTables = array();

        $fileList = $this->getFileManager()->getFileList($this->customTablePath, false, '\.php$', true);

        foreach($fileList as $fileName) {
            $fileData = $this->getFileManager()->getPhpContents( array($this->customTablePath, $fileName) );
            if (is_array($fileData)) {
                $customTables = Util::merge($customTables, $fileData);
            }
        }

        //get custom tables from metdata 'additionalTables'
        foreach ($ormMeta as $entityName => $entityParams) {
            if (isset($entityParams['additionalTables']) && is_array($entityParams['additionalTables'])) {
                $customTables = Util::merge($customTables, $entityParams['additionalTables']);
            }
        }

        return $customTables;
    }

    protected function getDependentEntities($entityList, $ormMeta, $dependentEntities = array())
    {
        if (is_string($entityList)) {
            $entityList = (array) $entityList;
        }

        foreach ($entityList as $entityName) {

            if (in_array($entityName, $dependentEntities)) {
                continue;
            }

            $dependentEntities[] = $entityName;

            foreach ($ormMeta[$entityName]['relations'] as $relationName => $relationParams) {

                if (isset($relationParams['entity'])) {
                    $relationEntity = $relationParams['entity'];

                    if (!in_array($relationEntity, $dependentEntities)) {
                        $dependentEntities = $this->getDependentEntities($relationEntity, $ormMeta, $dependentEntities);
                    }
                }
            }

        }

        return $dependentEntities;
    }

    /**
     * Generate index name
     *
     * @return string
     */
    protected function generateIndexName($name, $entityName)
    {
        $names = array(
            'IDX',
        );

        $names[] = strtoupper( Util::toUnderScore($entityName) );
        $names[] = strtoupper( Util::toUnderScore($name) );

        return implode('_', $names);
    }

}
