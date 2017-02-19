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

namespace Espo\Services;

use \Espo\Core\Exceptions\Forbidden;
use \Espo\Core\Exceptions\NotFound;

use Espo\ORM\Entity;

class EmailNotification extends \Espo\Core\Services\Base
{
    const HOURS_THERSHOLD = 5;

    protected function init()
    {
        $this->addDependencyList([
            'metadata',
            'mailSender',
            'language',
            'dateTime',
            'number',
            'fileManager',
            'selectManagerFactory',
            'templateFileManager'
        ]);
    }

    protected $noteNotificationTypeList = ['Post', 'Status', 'EmailReceived'];

    protected function getMailSender()
    {
        return $this->getInjection('mailSender');
    }

    protected function getMetadata()
    {
        return $this->getInjection('metadata');
    }

    protected function getLanguage()
    {
        return $this->getInjection('language');
    }

    protected function getDateTime()
    {
        return $this->getInjection('dateTime');
    }

    protected function getTemplateFileManager()
    {
        return $this->getInjection('templateFileManager');
    }
    protected function getHtmlizer()
    {
        if (empty($this->htmlizer)) {
            $this->htmlizer = new \Espo\Core\Htmlizer\Htmlizer($this->getInjection('fileManager'), $this->getInjection('dateTime'), $this->getInjection('number'), null);
        }
        return $this->htmlizer;
    }

    public function notifyAboutAssignmentJob($data)
    {
        if (empty($data['userId'])) return;
        if (empty($data['assignerUserId'])) return;
        if (empty($data['entityId'])) return;
        if (empty($data['entityType'])) return;

        $userId = $data['userId'];
        $assignerUserId = $data['assignerUserId'];
        $entityId = $data['entityId'];
        $entityType = $data['entityType'];

        $user = $this->getEntityManager()->getEntity('User', $userId);

        if (!$user) return;

        if ($user->get('isPortalUser')) return;

        $preferences = $this->getEntityManager()->getEntity('Preferences', $userId);
        if (!$preferences) return;
        if (!$preferences->get('receiveAssignmentEmailNotifications')) return;

        $assignerUser = $this->getEntityManager()->getEntity('User', $assignerUserId);
        $entity = $this->getEntityManager()->getEntity($entityType, $entityId);

        if ($entity && $assignerUser && $entity->get('assignedUserId') == $userId) {
            $emailAddress = $user->get('emailAddress');
            if (!empty($emailAddress)) {
                $email = $this->getEntityManager()->getEntity('Email');

                $subjectTpl = $this->getTemplateFileManager()->getTemplate('assignment', 'subject', $entity->getEntityType());
                $bodyTpl = $this->getTemplateFileManager()->getTemplate('assignment', 'body', $entity->getEntityType());

                $subjectTpl = str_replace(array("\n", "\r"), '', $subjectTpl);

                $recordUrl = rtrim($this->getConfig()->get('siteUrl'), '/') . '/#' . $entity->getEntityType() . '/view/' . $entity->id;

                $data = array(
                    'userName' => $user->get('name'),
                    'assignerUserName' => $assignerUser->get('name'),
                    'recordUrl' => $recordUrl,
                    'entityType' => $this->getLanguage()->translate($entity->getEntityType(), 'scopeNames')
                );
                $data['entityTypeLowerFirst'] = lcfirst($data['entityType']);

                $subject = $this->getHtmlizer()->render($entity, $subjectTpl, 'assignment-email-subject-' . $entity->getEntityType(), $data, true);
                $body = $this->getHtmlizer()->render($entity, $bodyTpl, 'assignment-email-body-' . $entity->getEntityType(), $data, true);

                $email->set(array(
                    'subject' => $subject,
                    'body' => $body,
                    'isHtml' => true,
                    'to' => $emailAddress,
                    'isSystem' => true,
                    'parentId' => $entity->id,
                    'parentType' => $entity->getEntityType()
                ));
                try {
                    $this->getMailSender()->send($email);
                } catch (\Exception $e) {
                    $GLOBALS['log']->error('EmailNotification: [' . $e->getCode() . '] ' .$e->getMessage());
                }
            }
        }

        return true;
    }

    public function process()
    {
        $dateTime = new \DateTime();
        $dateTime->modify('-' . self::HOURS_THERSHOLD . ' hours');

        $mentionEmailNotifications = $this->getConfig()->get('mentionEmailNotifications');

        $streamEmailNotifications = $this->getConfig()->get('streamEmailNotifications');
        $portalStreamEmailNotifications = $this->getConfig()->get('portalStreamEmailNotifications');

        $typeList = [];
        if ($mentionEmailNotifications) {
            $typeList[] = 'MentionInPost';
        }

        if ($streamEmailNotifications || $portalStreamEmailNotifications) {
            $typeList[] = 'Note';
        }

        if (empty($typeList)) return;

        $where = array(
            'createdAt>' => $dateTime->format('Y-m-d H:i:s'),
            'read' => false,
            'emailIsProcessed' => false
        );

        $sqlArr = [];
        foreach ($typeList as $type) {
            $methodName = 'getNotificationSelectParams' . $type;
            $selectParams = $this->$methodName();
            $selectParams['whereClause'][] = $where;

            $sqlArr[] = $this->getEntityManager()->getQuery()->createSelectQuery('Notification', $selectParams);
        }

        $sql = '' . implode(' UNION ', $sqlArr) . ' ORDER BY number';

        $notificationList = $this->getEntityManager()->getRepository('Notification')->findByQuery($sql);

        foreach ($notificationList as $notification) {
            $notification->set('emailIsProcessed', true);

            $type = $notification->get('type');

            $methodName = 'processNotification' . ucfirst($type);
            if (method_exists($this, $methodName)) {
                $this->$methodName($notification);
            }

            $this->getEntityManager()->saveEntity($notification);
        }
    }

    protected function getNotificationSelectParamsMentionInPost()
    {
        $selectManager = $this->getInjection('selectManagerFactory')->create('Notification');

        $selectParams = $selectManager->getEmptySelectParams();

        $selectParams['whereClause']['type'] = 'MentionInPost';

        return $selectParams;
    }

    protected function getNotificationSelectParamsNote()
    {
        $selectManager = $this->getInjection('selectManagerFactory')->create('Notification');

        $selectParams = $selectManager->getEmptySelectParams();

        $selectParams['whereClause']['type'] = 'Note';
        $selectParams['whereClause']['relatedType'] = 'Note';

        $selectParams['customJoin'] .= ' JOIN note ON notification.related_id = note.id';

        $selectParams['whereClause']['note.type'] = $this->noteNotificationTypeList;

        $entityList = $this->getConfig()->get('streamEmailNotificationsEntityList');

        if (empty($entityList)) {
            $selectParams['whereClause']['relatedParentType'] = null;
        } else {
            $selectParams['whereClause'][] = array(
                'OR' => array(
                    array(
                        'relatedParentType' => $entityList
                    ),
                    array(
                        'relatedParentType' => null
                    )
                )
            );
        }

        $forInternal = $this->getConfig()->get('streamEmailNotifications');
        $forPortal = $this->getConfig()->get('portalStreamEmailNotifications');

        if ($forInternal && !$forPortal) {
            $selectParams['whereClause']['user.isPortalUser'] = false;
        } else if (!$forInternal && $forPortal) {
            $selectParams['whereClause']['user.isPortalUser'] = true;
        }

        return $selectParams;
    }

    protected function processNotificationMentionInPost(Entity $notification)
    {
        if (!$notification->get('userId')) return;
        $userId = $notification->get('userId');
        $user = $this->getEntityManager()->getEntity('User', $userId);

        $emailAddress = $user->get('emailAddress');
        if (!$emailAddress) return;

        $preferences = $this->getEntityManager()->getEntity('Preferences', $userId);
        if (!$preferences) return;

        if (!$preferences->get('receiveMentionEmailNotifications')) return;

        if ($notification->get('relatedType') !== 'Note' || !$notification->get('relatedId')) return;
        $note = $this->getEntityManager()->getEntity('Note', $notification->get('relatedId'));
        if (!$note) return;

        $parentId = $note->get('parentId');
        $parentType = $note->get('parentType');

        $data = array();

        if ($parentId && $parentType) {
            $parent = $this->getEntityManager()->getEntity($parentType, $parentId);
            if (!$parent) return;

            $data['url'] = $this->getConfig()->getSiteUrl() . '/#' . $parentType . '/view/' . $parentId;
            $data['parentName'] = $parent->get('name');
            $data['parentType'] = $parentType;
            $data['parentId'] = $parentId;
        } else {
            $data['url'] = $this->getConfig()->getSiteUrl() . '/#Notification';
        }

        $data['userName'] = $note->get('createdByName');

        $data['post'] = nl2br($note->get('post'));

        $subjectTpl = $this->getTemplateFileManager()->getTemplate('mention', 'subject');
        $bodyTpl = $this->getTemplateFileManager()->getTemplate('mention', 'body');

        $subjectTpl = str_replace(array("\n", "\r"), '', $subjectTpl);

        $subject = $this->getHtmlizer()->render($note, $subjectTpl, 'mention-email-subject', $data, true);
        $body = $this->getHtmlizer()->render($note, $bodyTpl, 'mention-email-body', $data, true);

        $email = $this->getEntityManager()->getEntity('Email');

        $email->set(array(
            'subject' => $subject,
            'body' => $body,
            'isHtml' => true,
            'to' => $emailAddress,
            'isSystem' => true
        ));
        if ($parentId && $parentType) {
            $email->set(array(
                'parentId' => $parentId,
                'parentType' => $parentType
            ));
        }

        try {
            $this->getMailSender()->send($email);
        } catch (\Exception $e) {
            $GLOBALS['log']->error('EmailNotification: [' . $e->getCode() . '] ' .$e->getMessage());
        }
    }

    protected function processNotificationNote(Entity $notification)
    {
        if ($notification->get('relatedType') !== 'Note') return;
        if (!$notification->get('relatedId')) return;

        $note = $this->getEntityManager()->getEntity('Note', $notification->get('relatedId'));
        if (!$note) return;
        if (!in_array($note->get('type'), $this->noteNotificationTypeList)) return;

        if (!$notification->get('userId')) return;
        $userId = $notification->get('userId');
        $user = $this->getEntityManager()->getEntity('User', $userId);

        $emailAddress = $user->get('emailAddress');
        if (!$emailAddress) return;

        $preferences = $this->getEntityManager()->getEntity('Preferences', $userId);
        if (!$preferences) return;
        if (!$preferences->get('receiveStreamEmailNotifications')) return;

        $methodName = 'processNotificationNote' . $note->get('type');

        if (!method_exists($this, $methodName)) return;

        $this->$methodName($note, $user);
    }

    protected function processNotificationNotePost($note, $user)
    {
        $parentId = $note->get('parentId');
        $parentType = $note->get('parentType');

        $emailAddress = $user->get('emailAddress');
        if (!$emailAddress) return;

        $data = array();

        $data['userName'] = $note->get('createdByName');
        $data['post'] = nl2br($note->get('post'));

        if ($parentId && $parentType) {
            $parent = $this->getEntityManager()->getEntity($parentType, $parentId);
            if (!$parent) return;

            $data['url'] = $this->getConfig()->getSiteUrl() . '/#' . $parentType . '/view/' . $parentId;
            $data['parentName'] = $parent->get('name');
            $data['parentType'] = $parentType;
            $data['parentId'] = $parentId;

            $data['name'] = $data['parentName'];

            $data['entityType'] = $this->getLanguage()->translate($data['parentType'], 'scopeNames');
            $data['entityTypeLowerFirst'] = lcfirst($data['entityType']);

            $subjectTpl = $this->getTemplateFileManager()->getTemplate('notePost', 'subject', $parentType);
            $bodyTpl = $this->getTemplateFileManager()->getTemplate('notePost', 'body', $parentType);

            $subjectTpl = str_replace(array("\n", "\r"), '', $subjectTpl);

            $subject = $this->getHtmlizer()->render($note, $subjectTpl, 'note-post-email-subject-' . $parentType, $data, true);
            $body = $this->getHtmlizer()->render($note, $bodyTpl, 'note-post-email-body-' . $parentType, $data, true);
        } else {
            $data['url'] = $this->getConfig()->getSiteUrl() . '/#Notification';

            $subjectTpl = $this->getTemplateFileManager()->getTemplate('notePostNoParent', 'subject');
            $bodyTpl = $this->getTemplateFileManager()->getTemplate('notePostNoParent', 'body');

            $subjectTpl = str_replace(array("\n", "\r"), '', $subjectTpl);

            $subject = $this->getHtmlizer()->render($note, $subjectTpl, 'note-post-email-subject', $data, true);
            $body = $this->getHtmlizer()->render($note, $bodyTpl, 'note-post-email-body', $data, true);
        }

        $email = $this->getEntityManager()->getEntity('Email');

        $email->set(array(
            'subject' => $subject,
            'body' => $body,
            'isHtml' => true,
            'to' => $emailAddress,
            'isSystem' => true
        ));
        if ($parentId && $parentType) {
            $email->set(array(
                'parentId' => $parentId,
                'parentType' => $parentType
            ));
        }
        try {
            $this->getMailSender()->send($email);
        } catch (\Exception $e) {
            $GLOBALS['log']->error('EmailNotification: [' . $e->getCode() . '] ' .$e->getMessage());
        }
    }

    protected function processNotificationNoteStatus($note, $user)
    {
        $parentId = $note->get('parentId');
        $parentType = $note->get('parentType');

        $emailAddress = $user->get('emailAddress');
        if (!$emailAddress) return;

        $data = array();

        if (!$parentId || !$parentType) return;

        $parent = $this->getEntityManager()->getEntity($parentType, $parentId);
        if (!$parent) return;

        $data['url'] = $this->getConfig()->getSiteUrl() . '/#' . $parentType . '/view/' . $parentId;
        $data['parentName'] = $parent->get('name');
        $data['parentType'] = $parentType;
        $data['parentId'] = $parentId;

        $data['name'] = $data['parentName'];

        $data['entityType'] = $this->getLanguage()->translate($data['parentType'], 'scopeNames');
        $data['entityTypeLowerFirst'] = lcfirst($data['entityType']);

        $noteData = $note->get('data');
        if (empty($noteData)) return;


        $data['value'] = $noteData->value;
        $data['field'] = $noteData->field;
        $data['valueTranslated'] = $this->getLanguage()->translateOption($data['value'], $data['field'], $parentType);
        $data['fieldTranslated'] = $this->getLanguage()->translate($data['field'], 'fields', $parentType);
        $data['fieldTranslatedLowerCase'] = lcfirst($data['fieldTranslated']);

        $data['userName'] = $note->get('createdByName');

        $subjectTpl = $this->getTemplateFileManager()->getTemplate('noteStatus', 'subject', $parentType);
        $bodyTpl = $this->getTemplateFileManager()->getTemplate('noteStatus', 'body', $parentType);
        $subjectTpl = str_replace(array("\n", "\r"), '', $subjectTpl);

        $subject = $this->getHtmlizer()->render($note, $subjectTpl, 'note-status-email-subject', $data, true);
        $body = $this->getHtmlizer()->render($note, $bodyTpl, 'note-status-email-body', $data, true);

        $email = $this->getEntityManager()->getEntity('Email');

        $email->set(array(
            'subject' => $subject,
            'body' => $body,
            'isHtml' => true,
            'to' => $emailAddress,
            'isSystem' => true,
            'parentId' => $parentId,
            'parentType' => $parentType
        ));

        try {
            $this->getMailSender()->send($email);
        } catch (\Exception $e) {
            $GLOBALS['log']->error('EmailNotification: [' . $e->getCode() . '] ' .$e->getMessage());
        }
    }

    protected function processNotificationNoteEmailReceived($note, $user)
    {
        $parentId = $note->get('parentId');
        $parentType = $note->get('parentType');

        $emailAddress = $user->get('emailAddress');
        if (!$emailAddress) return;

        $noteData = $note->get('data');

        if (!($noteData instanceof \StdClass)) return;

        if (!isset($noteData->emailId)) return;
        $email = $this->getEntityManager()->getEntity('Email', $noteData->emailId);
        if (!$email) return;
        if ($email->hasLinkMultipleId('users', $user->id)) return;

        $data = array();

        $data['fromName'] = '';
        if (isset($noteData->personEntityName)) {
            $data['fromName'] = $noteData->personEntityName;
        } else if (isset($noteData->fromString)) {
            $data['fromName'] = $noteData->fromString;
        }

        $data['subject'] = '';
        if (isset($noteData->emailName)) {
            $data['subject'] = $noteData->emailName;
        }

        $data['post'] = nl2br($note->get('post'));

        if (!$parentId || !$parentType) return;

        $parent = $this->getEntityManager()->getEntity($parentType, $parentId);
        if (!$parent) return;

        $data['url'] = $this->getConfig()->getSiteUrl() . '/#' . $parentType . '/view/' . $parentId;
        $data['parentName'] = $parent->get('name');
        $data['parentType'] = $parentType;
        $data['parentId'] = $parentId;

        $data['name'] = $data['parentName'];

        $data['entityType'] = $this->getLanguage()->translate($data['parentType'], 'scopeNames');
        $data['entityTypeLowerFirst'] = lcfirst($data['entityType']);

        $subjectTpl = $this->getTemplateFileManager()->getTemplate('noteEmailRecieved', 'subject', $parentType);
        $bodyTpl = $this->getTemplateFileManager()->getTemplate('noteEmailRecieved', 'body', $parentType);

        $subjectTpl = str_replace(array("\n", "\r"), '', $subjectTpl);

        $subject = $this->getHtmlizer()->render($note, $subjectTpl, 'note-email-recieved-email-subject-' . $parentType, $data, true);
        $body = $this->getHtmlizer()->render($note, $bodyTpl, 'note-email-recieved-email-body-' . $parentType, $data, true);

        $email = $this->getEntityManager()->getEntity('Email');

        $email->set(array(
            'subject' => $subject,
            'body' => $body,
            'isHtml' => true,
            'to' => $emailAddress,
            'isSystem' => true
        ));

        $email->set(array(
            'parentId' => $parentId,
            'parentType' => $parentType
        ));

        try {
            $this->getMailSender()->send($email);
        } catch (\Exception $e) {
            $GLOBALS['log']->error('EmailNotification: [' . $e->getCode() . '] ' .$e->getMessage());
        }
    }
}