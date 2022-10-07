<?php

namespace App\Controllers;

use App\Interfaces\RestApi;
use App\Models\Model;

abstract class Controller implements RestApi
{
    public static function run($responser, $methodType, $resource, $id, $action, $queryParams)
    {
        $controllerName = $resource . 'Controller';
        $controllerClass = __NAMESPACE__ . '\\' . ucfirst($controllerName);
        $model = Model::run($resource);

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass($responser, $model);
        } else {
            throw new \Exception('Not found', 404);
        }
        if ($methodType == 'GET' && is_null($id) && is_null($action)) {
            return $controller->index();
        }
        if ($methodType == 'GET' && is_null($id) && $action === 'create') {
            return $controller->create();
        }
        if ($methodType == 'POST' && is_null($id) && is_null($action)) {
            return $controller->store($queryParams);
        }
        if ($methodType == 'GET' && !is_null($id) && $action === 'edit') {
            return $controller->edit($id);
        }
        if ($methodType == 'PATCH' && !is_null($id) && is_null($action)) {
            return $controller->update($id, $queryParams);
        }
        if ($methodType == 'DELETE' && !is_null($id) && is_null($action)) {
            return $controller->destroy($id);
        }
        throw new \Exception('Not found', 404);
    }
}
