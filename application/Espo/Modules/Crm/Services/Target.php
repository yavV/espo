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

namespace Espo\Modules\Crm\Services;

use \Espo\Core\Exceptions\Error;
use \Espo\Core\Exceptions\Forbidden;
use \Espo\ORM\Entity;

class Target extends \Espo\Services\Record
{
    protected function getDuplicateWhereClause(Entity $entity, $data = array())
    {
        $data = array(
            'OR' => array(
                array(
                    'firstName' => $entity->get('firstName'),
                    'lastName' => $entity->get('lastName'),
                )
            )
        );
        if (
            ($entity->get('emailAddress') || $entity->get('emailAddressData'))
            &&
            ($entity->isNew() || $entity->isFieldChanged('emailAddress') || $entity->isFieldChanged('emailAddressData'))
        ) {
            if ($entity->get('emailAddress')) {
                $list = [$entity->get('emailAddress')];
            }
            if ($entity->get('emailAddressData')) {
                foreach ($entity->get('emailAddressData') as $row) {
                    if (!in_array($row->emailAddress, $list)) {
                        $list[] = $row->emailAddress;
                    }
                }
            }
            foreach ($list as $emailAddress) {
                $data['OR'][] = array(
                    'emailAddress' => $emailAddress
                );
            }
        }

        return $data;
    }

    public function convert($id)
    {
        $entityManager = $this->getEntityManager();
        $target = $this->getEntity($id);

        if (!$this->getAcl()->check($target, 'delete')) {
            throw new Forbidden();
        }
        if (!$this->getAcl()->check('Lead', 'read')) {
            throw new Forbidden();
        }

        $lead = $entityManager->getEntity('Lead');
        $lead->set($target->toArray());

        $entityManager->removeEntity($target);
        $entityManager->saveEntity($lead);

        return $lead;
    }
}

