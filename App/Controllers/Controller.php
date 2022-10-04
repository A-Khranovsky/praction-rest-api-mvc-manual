<?php

namespace App\Controllers;

use App\Interfaces\RestApi;

abstract class Controller implements RestApi
{
    public static function run($methodType, $controllerName, $id, $action, $queryParams)
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
            return (new $class())->store($queryParams);
        }
        if ($methodType == 'GET' && !is_null($controllerName) && !is_null($id) && $action === 'edit') {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->edit($id);
        }
        if ($methodType == 'PATCH' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->update($id, $queryParams);
        }
        if ($methodType == 'DELETE' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->destroy($id);
        }
    }
}
