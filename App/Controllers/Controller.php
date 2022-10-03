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
            return (new $class())->store(
                $queryParams['description'],
                $queryParams['file'],
                $queryParams['finishDate'],
                $queryParams['urgently'],
                $queryParams['type']
            );
        }
        if ($methodType == 'GET' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->show($id);
        }
        if ($methodType == 'GET' && !is_null($controllerName) && !is_null($id) && $action === 'edit') {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->edit();
        }
        if ($methodType == 'PATCH' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->update($id, $queryParams);
        }
        if ($methodType == 'DELETE' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->destroy($id);
        }
        //throw new \Exception('Wrong request');
    }
}