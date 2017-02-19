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

namespace Espo\Modules\Crm\Controllers;

use \Espo\Core\Exceptions\Error,
    \Espo\Core\Exceptions\Forbidden,
    \Espo\Core\Exceptions\BadRequest;

class Activities extends \Espo\Core\Controllers\Base
{
    protected $maxCalendarRange = 123;

    protected $maxSizeLimit = 200;

    public function actionListCalendarEvents($params, $data, $request)
    {
        if (!$this->getAcl()->check('Calendar')) {
            throw new Forbidden();
        }

        $from = $request->get('from');
        $to = $request->get('to');

        if (empty($from) || empty($to)) {
            throw new BadRequest();
        }

        if (strtotime($to) - strtotime($from) > $this->maxCalendarRange * 24 * 3600) {
            throw new Forbidden('Too long range.');
        }

        $service = $this->getService('Activities');

        $scopeList = null;
        if ($request->get('scopeList') !== null) {
            $scopeList = explode(',', $request->get('scopeList'));
        }

        $userId = $request->get('userId');
        $userIdList = $request->get('userIdList');

        if ($userIdList) {
            $userIdList = explode(',', $userIdList);

            $resultList = [];
            foreach ($userIdList as $userId) {
                $userResultList = $service->getEvents($userId, $from, $to, $scopeList);
                foreach ($userResultList as $item) {
                    $item['userId'] = $userId;
                    $resultList[] = $item;
                }
            }
            return $resultList;
        } else {
            if (!$userId) {
                $userId = $this->getUser()->id;
            }
        }

        return $service->getEvents($userId, $from, $to, $scopeList);
    }

    public function actionListUpcoming($params, $data, $request)
    {
        $service = $this->getService('Activities');

        $userId = $request->get('userId');
        if (!$userId) {
            $userId = $this->getUser()->id;
        }

        $offset = intval($request->get('offset'));
        $maxSize = intval($request->get('maxSize'));

        $entityTypeList = $request->get('entityTypeList');

        if (empty($maxSize)) {
            $maxSize = $this->maxSizeLimit;
        }
        if ($maxSize > $this->maxSizeLimit) {
            throw new Forbidden("Max should should not exceed " . $this->maxSizeLimit . ". Use pagination (offset, limit).");
        }

        return $service->getUpcomingActivities($userId, array(
            'offset' => $offset,
            'maxSize' => $maxSize
        ), $entityTypeList);
    }

    public function actionPopupNotifications()
    {
        $userId = $this->getUser()->id;

        return $this->getService('Activities')->getPopupNotifications($userId);
    }

    public function actionRemovePopupNotification($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        if (empty($data['id'])) {
            throw new BadRequest();
        }
        $id = $data['id'];

        return $this->getService('Activities')->removeReminder($id);
    }

    public function actionList($params, $data, $request)
    {
        if (!$this->getAcl()->check('Activities')) {
            throw new Forbidden();
        }

        $name = $params['name'];

        if (!in_array($name, ['activities', 'history'])) {
            throw new BadRequest();
        }

        if (empty($params['scope'])) {
            throw new BadRequest();
        }
        if (empty($params['id'])) {
            throw new BadRequest();
        }

        $entityType = $params['scope'];
        $id = $params['id'];

        $offset = intval($request->get('offset'));
        $maxSize = intval($request->get('maxSize'));
        $asc = $request->get('asc') === 'true';
        $sortBy = $request->get('sortBy');
        $where = $request->get('where');

        if (empty($maxSize)) {
            $maxSize = $this->maxSizeLimit;
        }
        if ($maxSize > $this->maxSizeLimit) {
            throw new Forbidden("Max should should not exceed " . $this->maxSizeLimit . ". Use pagination (offset, limit).");
        }

        $scope = null;
        if (is_array($where) && !empty($where[0]) && $where[0] !== 'false') {
            $scope = $where[0];
        }

        $service = $this->getService('Activities');

        $methodName = 'get' . ucfirst($name);

        return $service->$methodName($entityType, $id, array(
            'scope' => $scope,
            'offset' => $offset,
            'maxSize' => $maxSize,
            'asc' => $asc,
            'sortBy' => $sortBy,
        ));
    }
}

