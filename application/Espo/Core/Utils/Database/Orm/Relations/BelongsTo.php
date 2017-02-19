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

namespace Espo\Core\Utils\Database\Orm\Relations;

class BelongsTo extends Base
{
    protected function load($linkName, $entityName)
    {
        $linkParams = $this->getLinkParams();

        $foreignEntityName = $this->getForeignEntityName();
        $foreignLinkName = $this->getForeignLinkName();

        if (!empty($linkParams['noJoin'])) {
            $fieldNameDefs = array(
                'type' => 'varchar',
                'notStorable' => true,
                'relation' => $linkName,
                'foreign' => $this->getForeignField('name', $foreignEntityName),
            );
        } else {
            $fieldNameDefs = array(
                'type' => 'foreign',
                'relation' => $linkName,
                'foreign' => $this->getForeignField('name', $foreignEntityName),
                'notStorable' => false
            );
        }

        return array (
            $entityName => array (
                'fields' => array(
                    $linkName.'Name' => $fieldNameDefs,
                    $linkName.'Id' => array(
                        'type' => 'foreignId',
                        'index' => true
                    )
                ),
                'relations' => array(
                    $linkName => array(
                        'type' => 'belongsTo',
                        'entity' => $foreignEntityName,
                        'key' => $linkName.'Id',
                        'foreignKey' => 'id',
                        'foreign' => $foreignLinkName
                    )
                )
            )
        );
    }

}