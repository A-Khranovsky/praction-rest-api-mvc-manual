<?php

namespace App\Router;

use App\Controllers\Controller;
use App\Interfaces\ControllerActionRunner;
use Exception;

class Router
{
    public $queryType, $controllerName, $id, $queryParams, $action, $controllerAction;
    private const uriTemplate = [
        'api' => null,
        'controller' => null,
        'etc' => null
    ];

    public static function parse($uri)
    {
        $uri = array_slice(explode('/', $uri), 1);
        foreach (Router::uriTemplate as $key => $item) {
            $uriElements[$key] = current($uri) !== false ? current($uri) : null;
            next($uri);
        }
        switch (true) {
            case (int)$uriElements['etc'] :
                $id = (int)$uriElements['etc'];
                break;
            case (string)$uriElements['etc']:
                $action = (string)$uriElements['etc'];
                break;
            default:
                break;
        }
        return new self(
            $uriElements['controller'],
            $id,
            $action
        );
    }

    private function __construct($controllerName = null, $id = null, $action = null)
    {
        $this->queryParams = $_REQUEST;

        $this->queryType = $_SERVER['REQUEST_METHOD'];
        if ($this->queryType == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->queryType = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->queryType = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }

        $this->controllerName = $controllerName;
        $this->id = $id;
        $this->action = $action;

        $this->controllerAction = Controller::run($this->queryType, $controllerName, $id, $action);
    }

    public function result()
    {
        return $this->controllerAction;
    }
}