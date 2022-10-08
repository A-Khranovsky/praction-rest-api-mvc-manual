<?php

namespace App\Controllers;

use App\Interfaces\RestApi;
use App\Models\Model;

abstract class Controller implements RestApi
{
    public static function run($responser, $resource, $id, $action, $queryParams)
    {
        $controllerName = $resource . 'Controller';
        $controllerClass = __NAMESPACE__ . '\\' . ucfirst($controllerName);
        $model = Model::run($resource);

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass($responser, $model);
            $params = (is_null($id) && $queryParams) ? [$queryParams] : [$id, $queryParams];
            //exit(var_dump($params));
            return call_user_func_array([$controller, $action], $params);
        } else {
            throw new \Exception('Not found', 404);
        }
    }
}
