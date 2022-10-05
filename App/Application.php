<?php


namespace App;


use App\Router\Router;
use App\Views\Responser;

class Application
{
    private $app;
    private $result;

    public static function run($uri)
    {
        try {
            $app = Router::parse($uri);
            return new self($app);
        } catch (\Exception $exception) {
            $responser = new Responser();
            $responser->set([
                'error' => $exception->getMessage()
            ], $exception->getCode());
            $app = new self();
            $app->result = $responser->response();
            return $app;
        }
    }

    private function __construct($app = null)
    {
        if(!is_null($app)) {
           $this->app = $app;
           $this->result = $app->result();
        }
    }

    public function response()
    {
        return $this->result;
    }
}