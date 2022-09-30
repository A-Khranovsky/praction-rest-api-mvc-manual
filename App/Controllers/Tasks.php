<?php


namespace App\Controllers;


use App\Router\Router;

class Tasks
{
    public $path, $router, $controller;


    public function __construct($path)
    {
        $this->path = $path;
        $this->router = Router::parse($path);
//        $class = 'App\\Controllers\\' . ucfirst($this->router->controller);
//        $this->model = new $class();
//        if ($this->router->id) {
//            $this->model = $this->model->collection[$this->router->id];
//        }
    }
}