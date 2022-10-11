<?php

namespace App\Controllers;

use App\Models\Model;
use App\Views\Responser;

abstract class Controller
{
    public static function run(
        Responser $responser,
        string $resource,
        int|null $id,
        string $action,
        array|null $queryParams
    )
    {
        $controllerName = $resource . 'Controller';
        $controllerClass = __NAMESPACE__ . '\\' . ucfirst($controllerName);
        $model = Model::run($resource);

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass($responser, $model);
            $params = (is_null($id) && $queryParams) ? [$queryParams] : [$id, $queryParams];
            return call_user_func_array([$controller, $action], $params);
        } else {
            throw new \Exception('Not found', 404);
        }
    }
}
