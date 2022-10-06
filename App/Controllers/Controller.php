<?php

namespace App\Controllers;

use App\Interfaces\RestApi;

abstract class Controller implements RestApi
{
    public static function run($methodType, $controllerName, $id, $action, $queryParams)
    {
        $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
        if(class_exists($class)){
            $controller = new $class();
        } else {
            throw new \Exception('Not found', 404);
        }

        if ($methodType == 'GET' && !is_null($controllerName) && is_null($id) && is_null($action)) {
            return $controller->index();
        }
        if ($methodType == 'GET' && !is_null($controllerName) && is_null($id) && $action === 'create') {
            return $controller->create();
        }
        if ($methodType == 'POST' && !is_null($controllerName) && is_null($id) && is_null($action)) {
            return $controller->store($queryParams);
        }
        if ($methodType == 'GET' && !is_null($controllerName) && !is_null($id) && $action === 'edit') {
            return $controller->edit($id);
        }
        if ($methodType == 'PATCH' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            return $controller->update($id, $queryParams);
        }
        if ($methodType == 'DELETE' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            return $controller->destroy($id);
        }
    }
}
