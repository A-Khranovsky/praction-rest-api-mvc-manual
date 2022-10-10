<?php

namespace App\Routes;

use App\Controllers\Controller;

class Route
{
    private $resource, $router;
    static private $instance = null;
    static private $routes;
    static private $GET = [];
    static private $POST = [];
    static private $PATCH = [];
    static private $DELETE = [];

    static public function get($resource, $action, $controllerAction)
    {
        self::$GET[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self;
        }
    }

    static public function post($resource, $action, $controllerAction)
    {
        self::$POST[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self;
        }
    }

    static public function patch($resource, $action, $controllerAction)
    {
        self::$PATCH[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self;
        }
    }

    static public function delete($resource, $action, $controllerAction)
    {
        self::$DELETE[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self;
        }
    }

    static public function take()
    {
        return self::$instance;
    }

    public function run($resource, $router)
    {
        $this->router = $router;
        $this->resource = $resource;

        $routes = self::${$this->router->queryType};
        foreach ($routes as $route) {
            if(
                $route[0] == $resource
                &&
                $route[1] == $this->router->action
            ){
                $controllerAction = $route[2];
            }
        }

        $this->router->controllerAction = Controller::run(
            $router->responser,
            $router->resource,
            $router->id,
            $controllerAction,
            $router->queryParams
        );
    }

    private function __construct()
    {
        self::$instance = $this;
    }

//    static public function get($resource, $router)
//    {
//        self::$routes = [
//            'tasks' => [
//                '' => 'index',
//                'create' => 'create',
//                'edit' => 'edit'
//            ],
//            'auth' => [
//                '' => 'index'
//            ]
//        ];
//        return new self($resource, $router);
//    }
//    static public function post($resource, $router)
//    {
//        self::$routes = [
//            'tasks' => [
//                ''=>'store'
//            ]
//        ];
//        return new self($resource, $router);
//    }
//
//    static public function patch($resource, $router)
//    {
//        self::$routes = [
//            'tasks' => [
//                '' => 'update'
//            ]
//        ];
//        return new self($resource, $router);
//    }
//    static public function delete($resource, $router)
//    {
//        self::$routes = [
//            'tasks' => [
//                '' =>'destroy'
//            ]
//        ];
//        return new self($resource, $router);
//    }
}