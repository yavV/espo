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

namespace Espo\Modules\Crm\Business\Event;

use \Espo\ORM\Entity;

class Invitations
{
    protected $entityManager;

    protected $smtpParams;

    protected $mailSender;

    protected $config;

    protected $dateTime;

    protected $language;

    protected $ics;

    public function __construct($entityManager, $smtpParams, $mailSender, $config, $fileManager, $dateTime, $number, $language)
    {
        $this->entityManager = $entityManager;
        $this->smtpParams = $smtpParams;
        $this->mailSender = $mailSender;
        $this->config = $config;
        $this->dateTime = $dateTime;
        $this->language = $language;
        $this->number = $number;
        $this->fileManager = $fileManager;
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function getConfig()
    {
        return $this->config;
    }

    protected function getTemplate($name)
    {
        $systemLanguage = $this->config->get('language');

        $fileName = "custom/Espo/Custom/Resources/templates/invitation/{$systemLanguage}/{$name}.tpl";
        if (!file_exists($fileName)) {
            $fileName = "application/Espo/Modules/Crm/Resources/templates/invitation/{$systemLanguage}/{$name}.tpl";
        }
        if (!file_exists($fileName)) {
            $fileName = "custom/Espo/Custom/Resources/templates/invitation/en_US/{$name}.tpl";
        }
        if (!file_exists($fileName)) {
            $fileName = "application/Espo/Modules/Crm/Resources/templates/invitation/en_US/{$name}.tpl";
        }

        return file_get_contents($fileName);
    }

    public function sendInvitation(Entity $entity, Entity $invitee, $link)
    {
        $uid = $this->getEntityManager()->getEntity('UniqueId');
        $uid->set('data', array(
            'eventType' => $entity->getEntityType(),
            'eventId' => $entity->id,
            'inviteeId' => $invitee->id,
            'inviteeType' => $invitee->getEntityType(),
            'link' => $link
        ));
        $this->getEntityManager()->saveEntity($uid);

        $emailAddress = $invitee->get('emailAddress');
        if (empty($emailAddress)) {
            return;
        }

        $email = $this->getEntityManager()->getEntity('Email');
        $email->set('to', $emailAddress);

        $subjectTpl = $this->getTemplate('subject');
        $bodyTpl = $this->getTemplate('body');
        $subjectTpl = str_replace(array("\n", "\r"), '', $subjectTpl);

        $data = array();

        $siteUrl = rtrim($this->getConfig()->get('siteUrl'), '/');
        $recordUrl = $siteUrl . '/#' . $entity->getEntityType() . '/view/' . $entity->id;
        $data['recordUrl'] = $recordUrl;

        $data['acceptLink'] = $siteUrl . '?entryPoint=eventConfirmation&action=accept&uid=' . $uid->get('name');
        $data['declineLink'] = $siteUrl . '?entryPoint=eventConfirmation&action=decline&uid=' . $uid->get('name');
        $data['tentativeLink'] = $siteUrl . '?entryPoint=eventConfirmation&action=tentative&uid=' . $uid->get('name');

        if ($invitee && $invitee->getEntityType() === 'User') {
            $data['isUser'] = true;

            $preferences = $this->getEntityManager()->getEntity('Preferences', $invitee->id);
            $timezone = $preferences->get('timeZone');
            $dateTime = clone($this->dateTime);
            if ($timezone) {
                $dateTime->setTimezone($timezone);
            }
        } else {
            $dateTime = $this->dateTime;
        }

        if ($invitee) {
            $data['inviteeName'] = $invitee->get('name');
        }

        $data['entityType'] = $this->language->translate($entity->getEntityType(), 'scopeNames');
        $data['entityTypeLowerFirst'] = lcfirst($data['entityType']);

        $htmlizer = new \Espo\Core\Htmlizer\Htmlizer($this->fileManager, $dateTime, $this->number, null);

        $subject = $htmlizer->render($entity, $subjectTpl, 'invitation-email-subject-' . $entity->getEntityType(), $data, true);
        $body = $htmlizer->render($entity, $bodyTpl, 'invitation-email-body-' . $entity->getEntityType(), $data, true);

        $email->set('subject', $subject);
        $email->set('body', $body);
        $email->set('isHtml', true);
        $this->getEntityManager()->saveEntity($email);

        $attachmentName = ucwords($this->language->translate($entity->getEntityType(), 'scopeNames')).'.ics';
        $attachment = $this->getEntityManager()->getEntity('Attachment');
        $attachment->set(array(
            'name' => $attachmentName,
            'type' => 'text/calendar',
            'contents' => $this->getIscContents($entity),
        ));

        $email->addAttachment($attachment);

        $emailSender = $this->mailSender;

        if ($this->smtpParams) {
            $emailSender->useSmtp($this->smtpParams);
        }
        $emailSender->send($email);

        $this->getEntityManager()->removeEntity($email);
    }

    protected function getIscContents(Entity $entity)
    {
        $user = $entity->get('assignedUser');

        $who = '';
        $email = '';
        if ($user) {
            $who = $user->get('name');
            $email = $user->get('emailAddress');
        }

        $ics = new Ics('//EspoCRM//EspoCRM Calendar//EN', array(
            'startDate' => strtotime($entity->get('dateStart')),
            'endDate' => strtotime($entity->get('dateEnd')),
            'uid' => $entity->id,
            'summary' => $entity->get('name'),
            'who' => $who,
            'email' => $email,
            'description' => $entity->get('description'),
        ));

        return $ics->get();
    }

}

