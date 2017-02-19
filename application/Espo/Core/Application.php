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

namespace Espo\Core;

class Application
{
    private $metadata;

    protected $container;

    private $slim;

    private $auth;

    public function __construct()
    {
        date_default_timezone_set('UTC');

        $this->initContainer();

        $GLOBALS['log'] = $this->getContainer()->get('log');

        $this->initAutoloads();
    }

    protected function initContainer()
    {
        $this->container = new Container();
    }

    public function getSlim()
    {
        if (empty($this->slim)) {
            $this->slim = $this->container->get('slim');
        }
        return $this->slim;
    }

    public function getMetadata()
    {
        if (empty($this->metadata)) {
            $this->metadata = $this->container->get('metadata');
        }
        return $this->metadata;
    }

    protected function createAuth()
    {
        return new \Espo\Core\Utils\Auth($this->container);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function run($name = 'default')
    {
        $this->routeHooks();
        $this->initRoutes();
        $this->getSlim()->run();
    }

    public function runClient()
    {
        $this->getContainer()->get('clientManager')->display();
    }

    public function runEntryPoint($entryPoint, $data = array(), $final = false)
    {
        if (empty($entryPoint)) {
            throw new \Error();
        }

        $slim = $this->getSlim();
        $container = $this->getContainer();

        $slim->any('.*', function() {});

        $entryPointManager = new \Espo\Core\EntryPointManager($container);

        try {
            $authRequired = $entryPointManager->checkAuthRequired($entryPoint);
            $authNotStrict = $entryPointManager->checkNotStrictAuth($entryPoint);
            if ($authRequired && !$authNotStrict) {
                if (!$final && $portalId = $this->detectedPortalId()) {
                    $app = new \Espo\Core\Portal\Application($portalId);
                    $app->setBasePath($this->getBasePath());
                    $app->runEntryPoint($entryPoint, $data, true);
                    exit;
                }
            }
            $auth = new \Espo\Core\Utils\Auth($this->container, $authNotStrict);
            $apiAuth = new \Espo\Core\Utils\Api\Auth($auth, $authRequired, true);
            $slim->add($apiAuth);

            $slim->hook('slim.before.dispatch', function () use ($entryPoint, $entryPointManager, $container, $data) {
                $entryPointManager->run($entryPoint, $data);
            });

            $slim->run();
        } catch (\Exception $e) {
            $container->get('output')->processError($e->getMessage(), $e->getCode(), true);
        }
    }

    public function runCron()
    {
        $auth = $this->createAuth();
        $auth->useNoAuth(true);

        $cronManager = new \Espo\Core\CronManager($this->container);
        $cronManager->run();
    }

    public function runRebuild()
    {
        $dataManager = $this->getContainer()->get('dataManager');
        $dataManager->rebuild();
    }

    public function runClearCache()
    {
        $dataManager = $this->getContainer()->get('dataManager');
        $dataManager->clearCache();
    }

    public function isInstalled()
    {
        $config = $this->getContainer()->get('config');

        if (file_exists($config->getConfigPath()) && $config->get('isInstalled')) {
            return true;
        }

        return false;
    }

    protected function createApiAuth($auth)
    {
        return new \Espo\Core\Utils\Api\Auth($auth);
    }

    protected function routeHooks()
    {
        $container = $this->getContainer();
        $slim = $this->getSlim();

        try {
            $auth = $this->createAuth();
        } catch (\Exception $e) {
            $container->get('output')->processError($e->getMessage(), $e->getCode());
        }

        $apiAuth = $this->createApiAuth($auth);

        $this->getSlim()->add($apiAuth);
        $this->getSlim()->hook('slim.before.dispatch', function () use ($slim, $container) {

            $route = $slim->router()->getCurrentRoute();
            $conditions = $route->getConditions();

            if (isset($conditions['useController']) && $conditions['useController'] == false) {
                return;
            }

            $routeOptions = call_user_func($route->getCallable());
            $routeKeys = is_array($routeOptions) ? array_keys($routeOptions) : array();

            if (!in_array('controller', $routeKeys, true)) {
                return $container->get('output')->render($routeOptions);
            }

            $params = $route->getParams();
            $data = $slim->request()->getBody();

            foreach ($routeOptions as $key => $value) {
                if (strstr($value, ':')) {
                    $paramName = str_replace(':', '', $value);
                    $value = $params[$paramName];
                }
                $controllerParams[$key] = $value;
            }

            $params = array_merge($params, $controllerParams);

            $controllerName = ucfirst($controllerParams['controller']);

            if (!empty($controllerParams['action'])) {
                $actionName = $controllerParams['action'];
            } else {
                $httpMethod = strtolower($slim->request()->getMethod());
                $crudList = $container->get('config')->get('crud');
                $actionName = $crudList[$httpMethod];
            }

            try {
                $controllerManager = $this->getContainer()->get('controllerManager');
                $result = $controllerManager->process($controllerName, $actionName, $params, $data, $slim->request());
                $container->get('output')->render($result);
            } catch (\Exception $e) {
                $container->get('output')->processError($e->getMessage(), $e->getCode());
            }
        });

        $this->getSlim()->hook('slim.after.router', function () use (&$slim) {
            $slim->contentType('application/json');

            $res = $slim->response();
            $res->header('Expires', '0');
            $res->header('Last-Modified', gmdate("D, d M Y H:i:s") . " GMT");
            $res->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $res->header('Pragma', 'no-cache');
        });
    }

    protected function getRouteList()
    {
        $routes = new \Espo\Core\Utils\Route($this->getContainer()->get('config'), $this->getMetadata(), $this->getContainer()->get('fileManager'));


        return $routes->getAll();
    }

    protected function initRoutes()
    {
        $crudList = array_keys($this->getContainer()->get('config')->get('crud'));

        foreach ($this->getRouteList() as $route) {
            $method = strtolower($route['method']);
            if (!in_array($method, $crudList)) {
                $GLOBALS['log']->error('Route: Method ['.$method.'] does not exist. Please check your route ['.$route['route'].']');
                continue;
            }

            $currentRoute = $this->getSlim()->$method($route['route'], function() use ($route) {   //todo change "use" for php 5.4
                return $route['params'];
            });

            if (isset($route['conditions'])) {
                $currentRoute->conditions($route['conditions']);
            }
        }
    }

    protected function initAutoloads()
    {
        $autoload = new \Espo\Core\Utils\Autoload($this->getContainer()->get('config'), $this->getMetadata(), $this->getContainer()->get('fileManager'));

        try {
            $autoloadList = $autoload->getAll();
        } catch (\Exception $e) {} //bad permissions

        if (empty($autoloadList)) {
            return;
        }

        $namespacesPath = 'vendor/composer/autoload_namespaces.php';
        $existingNamespaces = file_exists($namespacesPath) ? include($namespacesPath) : array();
        if (!empty($existingNamespaces) && is_array($existingNamespaces)) {
            $existingNamespaces = array_keys($existingNamespaces);
        }

        $classLoader = new \Composer\Autoload\ClassLoader();

        foreach ($autoloadList as $prefix => $path) {
            if (!in_array($prefix, $existingNamespaces)) {
                $classLoader->add($prefix, $path);
            }
        }

        $classLoader->register(true);
    }

    public function setBasePath($basePath)
    {
        $this->getContainer()->get('clientManager')->setBasePath($basePath);
    }

    public function getBasePath()
    {
        return $this->getContainer()->get('clientManager')->getBasePath();
    }

    public function detectedPortalId()
    {
        if (!empty($_GET['portalId'])) {
            return $_GET['portalId'];
        }
        if (!empty($_COOKIE['auth-token'])) {
            $token = $this->getContainer()->get('entityManager')->getRepository('AuthToken')->where(array('token' => $_COOKIE['auth-token']))->findOne();

            if ($token && $token->get('portalId')) {
                return $token->get('portalId');
            }
        }
        return null;
    }

    public function setupSystemUser()
    {
        $user = $this->getContainer()->get('entityManager')->getEntity('User', 'system');
        $this->getContainer()->setUser($user);
        $this->getContainer()->get('entityManager')->setUser($user);
    }
}

