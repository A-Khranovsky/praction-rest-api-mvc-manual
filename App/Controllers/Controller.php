<?php

namespace App\Controllers;

use App\Interfaces\RestApi;

abstract class Controller implements RestApi
{
    static public function run($methodType, $controllerName, $id, $action, $queryParams)
    {
        if ($methodType == 'GET' && !is_null($controllerName) && is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->index();
        }
        if ($methodType == 'GET' && !is_null($controllerName) && is_null($id) && $action === 'create') {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->create();
        }
        if ($methodType == 'POST' && !is_null($controllerName) && is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->store();
        }
        if ($methodType == 'GET' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->show();
        }
        if ($methodType == 'GET' && !is_null($controllerName) && !is_null($id) && $action === 'edit') {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->edit();
        }
        if ($methodType == 'PATCH' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->update();
        }
        if ($methodType == 'DELETE' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->destroy();
        }
        throw new \Exception('Wrong request');
    }
}