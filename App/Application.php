<?php


namespace App;


use App\Router\Router;
use App\Views\Responser;

class Application
{
    private $app, $result;

    public static function run(string $uri)
    {
        try{
            $app = Router::parse($uri);
            return new self($app);
        } catch(\Exception $exception){
            $responser = new Responser();
            $responser->set([
                'error' => $exception->getMessage()
            ], $exception->getCode());
            $app = new Router;
            $app->controllerAction = $responser->response();
            return new self($app);
        }
    }

    private function __construct($app)
    {
       $this->app = $app;
    }

    public function response()
    {
        return $this->app->result();
    }
}