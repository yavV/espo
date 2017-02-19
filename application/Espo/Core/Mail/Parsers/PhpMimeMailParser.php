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

namespace Espo\Core\Mail\Parsers;

class PhpMimeMailParser
{
    private $entityManager;

    private $parserHash = array();

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function getParser($message)
    {
        $key = spl_object_hash($message);
        if (!array_key_exists($key, $this->parserHash)) {
            $this->parserHash[$key] = new PhpMimeMailParser\Parser();
            $raw = $message->getRawHeader();
            if (!$raw) {
                $raw = $message->getFullRawContent();
            }
            $this->parserHash[$key]->setText($raw);
        }

        return $this->parserHash[$key];
    }

    protected function loadContent($message)
    {
        $this->getParser($message);

        $raw = $message->getFullRawContent();
        $this->getParser($message)->setText($raw);
    }

    public function checkMessageAttribute($message, $attribute)
    {
        return $this->getParser($message)->getHeader($attribute) !== false;
    }

    public function getMessageAttribute($message, $attribute)
    {
        if (!$this->checkMessageAttribute($message, $attribute)) return null;

        return $this->getParser($message)->getHeader($attribute);
    }

    public function getMessageMessageId($message)
    {
        return $this->getMessageAttribute($message, 'Message-ID');
    }

    public function getAddressListFromMessage($message, $type)
    {
        $addressList = [];
        if ($this->checkMessageAttribute($message, $type)) {
            $list = $this->getParser($message)->getAddresses($type);
            foreach ($list as $address) {
                $addressList[] = $address['address'];
            }
        }
        return $addressList;
    }

    public function fetchContentParts(\Espo\Entities\Email $email, $message)
    {
        $this->loadContent($message);

        $bodyPlain = $this->getParser($message)->getMessageBody('text');
        $bodyHtml = $this->getParser($message)->getMessageBody('html');

        if ($bodyHtml) {
            $email->set('isHtml', true);
            $email->set('body', $bodyHtml);
            $email->set('bodyPlain', $bodyPlain);
        } else {
            $email->set('isHtml', false);
            $email->set('body', $bodyPlain);
        }

        if (!$email->get('body') && $email->get('bodyPlain')) {
            $email->set('body', $email->get('bodyPlain'));
        }

        $attachmentObjList = $this->getParser($message)->getAttachments();
        $inlineIds = array();

        foreach ($attachmentObjList as $attachmentObj) {
            $attachment = $this->getEntityManager()->getEntity('Attachment');

            $content = $attachmentObj->getContent();
            $disposition = $attachmentObj->getContentDisposition();

            $attachment = $this->getEntityManager()->getEntity('Attachment');
            $attachment->set('name', $attachmentObj->getFileName());
            $attachment->set('type', $attachmentObj->getContentType());

            if ($disposition == 'inline') {
                $attachment->set('role', 'Inline Attachment');
                $contentId = $attachmentObj->getContentID();
            } else {
                $attachment->set('role', 'Attachment');
            }

            $attachment->set('contents', $content);

            $this->getEntityManager()->saveEntity($attachment);

            if ($disposition == 'attachment') {
                $attachmentsIds = $email->get('attachmentsIds');
                $attachmentsIds[] = $attachment->id;
                $email->set('attachmentsIds', $attachmentsIds);
            } else if ($disposition == 'inline') {
                $inlineIds[$contentId] = $attachment->id;
            }
        }

        $body = $email->get('body');

        if (!empty($body)) {
            foreach ($inlineIds as $cid => $attachmentId) {
                if (strpos($body, 'cid:' . $cid) !== false) {
                    $body = str_replace('cid:' . $cid, '?entryPoint=attachment&amp;id=' . $attachmentId, $body);
                } else {
                    $email->addLinkMultipleId('attachments', $attachmentId);
                }
            }
            $email->set('body', $body);
        }
    }
}

