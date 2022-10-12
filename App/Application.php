<?php

namespace App;

use App\Controllers\Controller;
use App\Router\Route;
use App\Router\Router;
use App\Views\Responser;

class Application
{
    private string|array|null $result;

    public static function run(string $uri): Application|Router
    {
        $responser = new Responser();
        try {
            $router = Router::run($uri, $responser);
            Route::take()->run($router);
            $router->controllerAction = Controller::run(
                $router->responser,
                $router->resource,
                $router->id,
                $router->controllerAction,
                $router->queryParams
            );
            return new self($router);
        } catch (\Exception $exception) {
            $responser->set([
                'error' => $exception->getMessage()
            ], $exception->getCode());
            $router = new self();
            $router->result = $responser->response();
            return $router;
        }
    }

    private function __construct(Router|null $router = null)
    {
        if (!is_null($router)) {
            $this->result = $router->controllerAction;
        }
    }

    public function result(): array|string|null
    {
        return $this->result;
    }
}
