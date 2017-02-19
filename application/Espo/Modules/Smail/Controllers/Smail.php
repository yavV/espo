<?php

/**
 * Created by PhpStorm.
 * User: yav
 * Date: 18.02.17
 * Time: 22:03
 */


namespace Espo\Modules\Smail\Controllers;

use Espo\Core\Container;
use Espo\Entities\Email;

class Smail extends \Espo\Core\Controllers\Record
{

    public function actionCreate($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        if (!$this->getAcl()->check($this->name, 'create')) {
            throw new Forbidden();
        }

        $service = $this->getRecordService();

        if ($entity = $service->createEntity($data)) {
            $serviceData['password'] = $this->getConfig()->get('smtpPassword');
            $serviceData['server'] = $this->getConfig()->get('smtpServer');
            $serviceData['port'] = $this->getConfig()->get('smtpPort');
            $serviceData['auth'] = $this->getConfig()->get('smtpAuth');
            $serviceData['security'] = $this->getConfig()->get('smtpSecurity');
            $serviceData['username'] = $this->getConfig()->get('smtpUsername');
            $serviceData['password'] = $this->getConfig()->get('smtpPassword');
            $serviceData['fromName'] = $data['fromName'];//$this->getConfig()->get('outboundEmailFromName'); //
            $serviceData['fromAddress'] = $this->getConfig()->get('outboundEmailFromAddress');
            $serviceData['emailAddress'] = $data['toAddress'];
            $serviceData['type'] = $this->getConfig()->get('outboundEmasil');

           // $emailService = $this->getServiceFactory()->create('Email');
            $email = $this->getEntityManager()->getEntity('Email');

            if (null === $data['text'] or $data['text'] == ''){
                $data['text'] = 'Привет для Skyeng!';
            }

            $email->set(array(
                'subject' => $data['subject'],
                'isHtml' => false,
                'to' => $data['toAddress'],//$data['emailAddress']
                'body' => $data['text'],
                'fromName' => $data['fromName']//$data['emailAddress']
                //'from' => $serviceData['fromAddress']
            ));

            $emailSender =$this->getContainer()->get('mailSender');
            $emailSender->useSmtp($serviceData)->send($email);


            return $entity->toArray();
        }

        throw new Error();
    }

}