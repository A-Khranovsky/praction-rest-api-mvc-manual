<?php

namespace App\Router;

class Route
{
    private static $instance = null;
    private static $routes;
    private static $GET = [];
    private static $POST = [];
    private static $PATCH = [];
    private static $DELETE = [];

    public static function get($resource, $action, $controllerAction)
    {
        self::$GET[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self();
        }
    }

    public static function post($resource, $action, $controllerAction)
    {
        self::$POST[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self();
        }
    }

    public static function patch($resource, $action, $controllerAction)
    {
        self::$PATCH[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self();
        }
    }

    public static function delete($resource, $action, $controllerAction)
    {
        self::$DELETE[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self();
        }
    }

    public static function take()
    {
        return self::$instance;
    }

    public function run($router)
    {
        $routes = self::${$router->queryType};
        foreach ($routes as $route) {
            if (
                $route[0] == $router->resource
                &&
                $route[1] == $router->action
            ) {
                $router->controllerAction = $route[2];
            }
        }
    }

    private function __construct()
    {
        self::$instance = $this;
    }
}
