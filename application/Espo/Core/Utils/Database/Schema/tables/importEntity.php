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

return array(

    'ImportEntity' => array(
        'fields' => array(
            'id' => array(
                'type' => 'id',
                'dbType' => 'int',
                'len' => '11',
                'autoincrement' => true,
                'unique' => true
            ),
            'entityId' => array(
                'type' => 'varchar',
                'len' => '24',
                'index' => 'entity'
            ),
            'entityType' => array(
                'type' => 'varchar',
                'len' => '100',
                'index' => 'entity'
            ),
            'importId' => array(
                'type' => 'varchar',
                'len' => '24',
                'index' => true
            ),
            'isImported' => array(
                'type' => 'bool'
            ),
            'isUpdated' => array(
                'type' => 'bool'
            ),
            'isDuplicate' => array(
                'type' => 'bool'
            ),
        ),
        "indexes" => array(
            "entityImport" => array(
                "columns" => ["importId", "entityType"]
            )
        )
    ),

);

