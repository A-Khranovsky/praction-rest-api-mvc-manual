<?php

namespace App\Router;

class Route
{
    private static ?Route $instance = null;
    private static $GET = [];
    private static $POST = [];
    private static $PATCH = [];
    private static $DELETE = [];

    public static function get(string $resource, string|null $action, string|null $controllerAction)
    {
        self::$GET[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self();
        }
    }

    public static function post(string $resource, string|null $action, string|null $controllerAction)
    {
        self::$POST[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self();
        }
    }

    public static function patch(string $resource, string|null $action, string|null $controllerAction)
    {
        self::$PATCH[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self();
        }
    }

    public static function delete(string $resource, string|null $action, string|null $controllerAction)
    {
        self::$DELETE[] = [$resource, $action, $controllerAction];
        if (is_null(self::$instance)) {
            new self();
        }
    }

    public static function take(): ?Route
    {
        return self::$instance;
    }

    public function run(Router $router): void
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
