<?php

namespace App\Router;

use App\Controllers\Controller;
use Exception;

class Router
{
    public $queryType, $queryParams, $controllerAction;
    private const uriTemplate = [
        'api' => null,
        'controller' => null,
        'idOrAction' => null,
        'action' => null,
        'queryParams' => null
    ];

    public static function run($uri, $responser)
    {
        $id = null;
        $action = null;
        //$uriElements = [];
        $uri = array_slice(preg_split("/[\/?]/", $uri), 1);
        foreach (Router::uriTemplate as $key => $item) {
            $uriElements[$key] = current($uri) !== false ? current($uri) : null;
            next($uri);
        }
        if(is_null($uriElements['controller'])){
            throw new Exception('Not found', 404);
        }
        switch (true) {
            case (int)$uriElements['idOrAction']:
                $id = (int)$uriElements['idOrAction'];
                break;
            case (string)$uriElements['idOrAction']:
                $action = (string)$uriElements['idOrAction'];
                break;
            default:
                break;
        }
        if (is_null($action)) {
            $action = $uriElements['action'];
        }
        return new self(
            $responser,
            $uriElements['controller'] . 'Controller',
            $id,
            $action
        );
    }

    public function __construct($responser, $controllerName, $id = null, $action = null)
    {
        switch (true) {
            case !empty($_REQUEST):
                $this->queryParams = $_REQUEST; //GET Request
                break;
            case !empty(file_get_contents("php://input")):
                $this->queryParams = json_decode(file_get_contents("php://input"), true);
                break;
            default:
                $this->queryParams = null;
                break;
        }

        $this->queryType = $_SERVER['REQUEST_METHOD'];
        if ($this->queryType == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->queryType = 'DELETE';
            } elseif ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->queryType = 'PUT';
            } else {
                throw new Exception("Unexpected Header", 500);
            }
        }
        $this->controllerAction = Controller::run(
            $responser,
            $this->queryType,
            $controllerName,
            $id,
            $action,
            $this->queryParams
        );
    }

    public function result()
    {
        return $this->controllerAction;
    }
}
