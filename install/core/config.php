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

	'apiPath' => '/api/v1',

	'requirements' => array(
		'phpVersion' => '5.5',

		'phpRequires' => array(
			'JSON',
			'openssl',
			'pdo_mysql'
		),

		'phpRecommendations' => array(
			'zip',
			'gd',
			'mbstring',
			'imap',
			'curl',
			'max_execution_time' => 180,
			'max_input_time' => 180,
			'memory_limit' => '256M',
			'post_max_size' => '20M',
			'upload_max_filesize' => '20M',
		),

		'mysqlVersion' => '5.1',
		'mysqlRequires' => array(

		),

		'mysqlRecommendations' => array(

		),
	),

	'rewriteRules' => array(
		'APACHE1' => 'a2enmod rewrite
service apache2 restart',
		'APACHE2' => '&#60;Directory /PATH_TO_ESPO/&#62;
 AllowOverride <b>All</b>
&#60;/Directory&#62;',
		'APACHE3' => 'service apache2 restart',
		'APACHE4' => '# RewriteBase /',
		'APACHE5' => 'RewriteBase {ESPO_PATH}{API_PATH}',
		'NGINX' => 'location /api/v1/ {
    if (!-e $request_filename){
        rewrite ^/api/v1/(.*)$ /api/v1/index.php last; break;
    }
}

location ~ /reset/?$ {
    try_files /reset.html =404;
}

location ^~ (data|api)/ {
    if (-e $request_filename){
        return 403;
    }
}
location ^~ /data/logs/ {
    deny all;
}
location ^~ /data/config.php {
    deny all;
}
location ^~ /data/cache/ {
    deny all;
}
location ^~ /data/upload/ {
    deny all;
}
location ^~ /application/ {
    deny all;
}
location ^~ /custom/ {
    deny all;
}
location ^~ /vendor/ {
    deny all;
}
location ~ /\.ht {
    deny all;
}',
	),

	'blog' => 'http://blog.espocrm.com',
	'twitter' => 'https://twitter.com/espocrm',
	'forum' => 'http://forum.espocrm.com',

);