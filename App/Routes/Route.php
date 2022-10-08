<?php

namespace App\Routes;


use App\Controllers\Controller;

class Route
{
    private $resource, $router;
    static private $routes;

    static public function get($resource, $router)
    {
        self::$routes = [
            'tasks' => [
                '' => 'index',
                'create' => 'create',
                'edit' => 'edit'
            ],
            'auth' => [
                '' => 'index'
            ]
        ];
        return new self($resource, $router);
    }
    static public function post($resource, $router)
    {
        self::$routes = [
            'tasks' => [
                ''=>'store'
            ]
        ];
        return new self($resource, $router);
    }

    static public function patch($resource, $router)
    {
        self::$routes = [
            'tasks' => [
                '' => 'update'
            ]
        ];
        return new self($resource, $router);
    }
//    static public function put($resource, $router)
//    {
//    }
    static public function delete($resource, $router)
    {
        self::$routes = [
            'tasks' => [
                '' =>'destroy'
            ]
        ];
        return new self($resource, $router);
    }

    public function __construct($resource, $router)
    {
        $this->router = $router;
        $this->resource = $resource;
        $controllerAction = self::$routes[$resource][$router->action];
        $this->router->controllerAction = Controller::run(
            $router->responser,
            $router->resource,
            $router->id,
            $controllerAction,
            $router->queryParams
        );
    }
}