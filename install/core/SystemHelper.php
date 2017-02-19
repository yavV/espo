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

class SystemHelper extends \Espo\Core\Utils\System
{
	protected $config;

	protected $requirements;

	protected $apiPath;

	protected $modRewriteUrl = '/Metadata';

	protected $writableDir = 'data';

	protected $combineOperator = '&&';

	public function __construct()
	{
		$this->config = include('config.php');

		$this->requirements = $this->config['requirements'];
		$this->apiPath = $this->config['apiPath'];
	}

	public function initWritable()
	{
		if (is_writable($this->writableDir)) {
			return true;
		}

		return false;
	}

	public function getWritableDir()
	{
		return $this->writableDir;
	}

	public function checkRequirements()
	{
		$result['success'] = true;
		if (!empty($this->requirements)) {
			if (!empty($this->requirements['phpVersion']) && version_compare(PHP_VERSION, $this->requirements['phpVersion']) == -1) {
				$result['errors']['phpVersion'] = $this->requirements['phpVersion'];
				$result['success'] = false;
			}
			if (!empty($this->requirements['phpRequires'])) {
				foreach ($this->requirements['phpRequires'] as $extName) {
					if (!extension_loaded($extName)) {
						$result['errors']['phpRequires'][] = $extName;
						$result['success'] = false;
					}
				}
			}
		}

		return $result;
	}

	public function getRecommendationList($type = 'php', $data = null)
	{
		$list = array();

		if ($type == 'mysql') {
			$pdoConn = $this->getPdoConnection($data['dbHostName'], $data['dbPort'], $data['dbUserName'], $data['dbUserPass'], $data['dbName']);
		}

		$currentVersion = ($type == 'php') ? PHP_VERSION : $this->getMysqlSetting('version', $pdoConn);
		$list[$type . 'Version'] = array(
			'current' => $currentVersion,
			'required' => $this->requirements[$type . 'Version'],
			'acceptable' => true,
		);

		$recommendations = array_merge($this->requirements[$type . 'Requires'], $this->requirements[$type . 'Recommendations']);

		foreach ($recommendations as $name => $requiredValue) {

			$isExtension = false;

			if (is_int($name)) {
				$name = $requiredValue;
				$acceptable = extension_loaded($name);
				$currentValue = $acceptable ? 'On' : 'Off';
				$isExtension = true;

			} else {
				$currentValue = ($type == 'php') ? ini_get($name) : $this->getMysqlSetting($name, $pdoConn);
				$acceptable = ( isset($currentValue) && $this->convertToBytes($currentValue) >= $this->convertToBytes($requiredValue) ) ? true : false;
			}

			$list[$name] = array(
				'current' => $currentValue,
				'required' => $requiredValue,
				'acceptable' => $acceptable,
				'isExtension' => $isExtension,
			);
		}

		return $list;
	}

	protected function getMysqlSetting($name, \PDO $pdoConnection)
	{
		if (!method_exists($pdoConnection, 'prepare')) {
			return null;
		}

		$sth = $pdoConnection->prepare("SHOW VARIABLES LIKE '" . $name . "'");
		$sth->execute();
		$res = $sth->fetch(PDO::FETCH_NUM);

		$version = empty($res[1]) ? null : $res[1];

		return $version;
	}

	public function checkDbConnection($hostName, $port, $dbUserName, $dbUserPass, $dbName, $isCreateDatabase = true)
	{
		$result['success'] = true;

		$dbh = $this->getPdoConnection($hostName, $port, $dbUserName, $dbUserPass, $dbName);

		if ($dbh instanceof \PDOException) {
			$result['errors']['dbConnect']['errorCode'] = $dbh->getCode();
			$result['errors']['dbConnect']['errorMsg'] = $dbh->getMessage();
			$result['success'] = false;
		}

		/** Check MySQL settings */
		if ($result['success']) {
			$currentMysqlVersion = $this->getMysqlSetting('version', $dbh);
			if (isset($currentMysqlVersion) && version_compare($currentMysqlVersion, $this->requirements['mysqlVersion']) == -1) {
				$result['errors']['mysqlVersion'] = $this->requirements['mysqlVersion'];
				$result['success'] = false;
			}

			/** Check required MySQL settings */
			foreach ($this->requirements['mysqlRequires'] as $name => $requiredValue) {
				$currentValue = $this->getMysqlSetting($name, $dbh);
				$acceptable = ( isset($currentValue) && $this->convertToBytes($currentValue) >= $this->convertToBytes($requiredValue) ) ? true : false;
				if (!$acceptable) {
					$result['errors']['mysqlSetting'] = array(
						'errorCode' => 'mysqlSettingError',
						'name' => $name,
						'value' => $requiredValue,
					);
					$result['success'] = false;
				}
			}
		}

		/** try to create a database */
		if ($isCreateDatabase && !$result['success'] && $result['errors']['dbConnect']['errorCode'] == '1049')
		{
			$dsn = "mysql:host={$hostName};" . ((!empty($port)) ? "port={$port}" : '');
			$pdo = new PDO($dsn, $dbUserName, $dbUserPass);

			$isCreated = true;
			try {
				$pdo->query("CREATE DATABASE IF NOT EXISTS `$dbName`");
			} catch (PDOException $e) {
				$isCreated = false;
			}

			if ($isCreated) {
				return $this->checkDbConnection($hostName, $port, $dbUserName, $dbUserPass, $dbName, false);
			}
		}
		/** END: try to create a database */

		return $result;
	}

	public function getPdoConnection($hostName, $port, $dbUserName, $dbUserPass, $dbName)
	{
		try {
			$dsn = "mysql:host={$hostName};" . ((!empty($port)) ? "port={$port};" : '') . "dbname={$dbName}";
			$dbh = new PDO($dsn, $dbUserName, $dbUserPass);
		} catch (PDOException $e) {
			return $e;
		}

		return $dbh;
	}

	public function getBaseUrl()
	{
		$pageUrl = ($_SERVER["HTTPS"] == 'on') ? 'https://' : 'http://';

		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageUrl .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageUrl .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}

		$baseUrl = str_ireplace('/install/index.php', '', $pageUrl);

		return $baseUrl;
	}

	public function getApiPath()
	{
		return $this->apiPath;
	}

	public function getModRewriteUrl()
	{
		return $this->apiPath . $this->modRewriteUrl;
	}

	public function getChownCommand($path, $isSudo = false, $isCd = true)
	{
		$path = empty($path) ? '.' : $path;
		if (is_array($path)) {
			$path = implode(' ', $path);
		}

		$owner = function_exists('posix_getuid') ? posix_getuid() : null;
		$group = function_exists('posix_getegid') ? posix_getegid() : null;

		$sudoStr = $isSudo ? 'sudo ' : '';

		if (empty($owner) || empty($group)) {
			return null;
		}

		$cd = '';
		if ($isCd) {
			$cd = $this->getCd(true);
		}

		//$path = $this->getFullPath($path;
		return $cd.$sudoStr.'chown -R '.$owner.':'.$group.' '.$path;
	}


	public function getChmodCommand($path, $permissions = array('755'), $isSudo = false, $isFile = null, $isCd = true)
	{
		//$path = $this->getFullPath($path);

		$path = empty($path) ? '.' : $path;
		if (is_array($path)) {
			$path = implode(' ', $path);
		}

		$sudoStr = $isSudo ? 'sudo ' : '';

		$cd = $isCd ? $this->getCd(true) : '';

		if (is_string($permissions)) {
			$permissions = (array) $permissions;
		}

		if (!isset($isFile) && count($permissions) == 1) {
			return $cd.'find '.$path.' -type d -exec ' . $sudoStr . 'chmod '.$permissions[0].' {} +';
		}

		$bufPerm = (count($permissions) == 1) ?  array_fill(0, 2, $permissions[0]) : $permissions;

		$commands = array();

		if ($isCd) {
			$commands[] = $this->getCd();
		}

		$commands[] = 'find '.$path.' -type f -exec ' .$sudoStr.'chmod '.$bufPerm[0].' {} +';//.'chmod '.$bufPerm[0].' $(find '.$path.' -type f)';
		$commands[] = 'find '.$path.' -type d -exec ' .$sudoStr. 'chmod '.$bufPerm[1].' {} +';//.'chmod '.$bufPerm[1].' $(find '.$path.' -type d)';

		if (count($permissions) >= 2) {
			return implode(' ' . $this->combineOperator . ' ', $commands);
		}

		return $isFile ? $commands[0] : $commands[1];
	}

	public function getFullPath($path)
	{
		if (is_array($path)) {
			$pathList = array();
			foreach ($path as $pathItem) {
				$pathList[] = $this->getFullPath($pathItem);
			}
			return $pathList;
		}

		if (!empty($path)) {
			$path = DIRECTORY_SEPARATOR . $path;
		}

		return $this->getRootDir() . $path;
	}

	/**
	 * Get permission commands
	 *
	 * @param  string | array  $path
	 * @param  string | array  $permissions
	 * @param  boolean $isSudo
	 * @param  bool  $isFile
	 * @return string
	 */
	public function getPermissionCommands($path, $permissions = array('644', '755'), $isSudo = false, $isFile = null, $changeOwner = true)
	{
		if (is_string($path)) {
			$path = array_fill(0, 2, $path);
		}
		list($chmodPath, $chownPath) = $path;

		$commands = array();
		$commands[] = $this->getChmodCommand($chmodPath, $permissions, $isSudo, $isFile);

		if ($changeOwner) {
			$chown = $this->getChownCommand($chownPath, $isSudo, false);
			if (isset($chown)) {
				$commands[] = $chown;
			}
		}
		return implode(' ' . $this->combineOperator . ' ', $commands).';';
	}

	protected function getCd($isCombineOperator = false)
	{
		$cd = 'cd '.$this->getRootDir();

		if ($isCombineOperator) {
			$cd .= ' '.$this->combineOperator.' ';
		}

		return $cd;
	}

	public function getRewriteRules()
	{
		return $this->config['rewriteRules'];
	}

	public function convertToBytes($value)
	{
		$value = trim($value);
		$last = strtoupper(substr($value, -1));

		switch ( $last )
		{
			case 'G':
			$value = (int) $value * 1024;
			case 'M':
			$value = (int) $value * 1024;
			case 'K':
			$value = (int) $value * 1024;
		}

		return $value;
	}
}
