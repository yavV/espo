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

namespace Espo\Core\Utils;

class DateTime
{
    protected $dateFormat;

    protected $timeFormat;

    protected $timezone;

    protected $internalDateTimeFormat = 'Y-m-d H:i:s';

    protected $internalDateFormat = 'Y-m-d';

    protected $dateFormats = array(
        'MM/DD/YYYY' => 'm/d/Y',
        'YYYY-MM-DD' => 'Y-m-d',
        'DD.MM.YYYY' => 'd.m.Y',
        'DD/MM/YYYY' => 'd/m/Y',
    );

    protected $timeFormats = array(
        'HH:mm' => 'H:i',
        'hh:mm A' => 'h:i A',
        'hh:mm a' => 'h:ia',
        'hh:mmA' => 'h:iA',
    );

    public function __construct($dateFormat = 'YYYY-MM-DD', $timeFormat = 'HH:mm', $timeZone = 'UTC')
    {
        $this->dateFormat = $dateFormat;
        $this->timeFormat = $timeFormat;

        $this->timezone = new \DateTimeZone($timeZone);
    }

    public function getInternalDateTimeFormat()
    {
        return $this->internalDateTimeFormat;
    }

    public function getInternalDateFormat()
    {
        return $this->internalDateFormat;
    }

    protected function getPhpDateFormat()
    {
        return $this->dateFormats[$this->dateFormat];
    }

    protected function getPhpDateTimeFormat()
    {
        return $this->dateFormats[$this->dateFormat] . ' ' . $this->timeFormats[$this->timeFormat];
    }

    public function convertSystemDateToGlobal($string)
    {
        return $this->convertSystemDate($string);
    }

    public function convertSystemDateTimeToGlobal($string)
    {
        return $this->convertSystemDateTime($string);
    }

    public function convertSystemDate($string)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d', $string);
        if ($dateTime) {
            return $dateTime->format($this->getPhpDateFormat());
        }
        return null;
    }

    public function convertSystemDateTime($string, $timezone = null)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $string);
        if (empty($timezone)) {
            $timezone = $this->timezone;
        } else {
            $timezone = new \DateTimeZone($timezone);
        }
        if ($dateTime) {
            return $dateTime->setTimezone($timezone)->format($this->getPhpDateTimeFormat());
        }
        return null;
    }

    public function setTimezone($timezone)
    {
        $this->timezone = new \DateTimeZone($timezone);
    }

    public function getInternalNowString()
    {
        return date($this->getInternalDateTimeFormat());
    }

    public function getInternalTodayString()
    {
        return date($this->getInternalDateFormat());
    }
}
