<?php

namespace App\Controllers;

abstract class Controller
{
    static public function run($methodType, $controllerName, $id, $action)
    {
        if ($methodType == 'GET' && !is_null($controllerName) && is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->index();
        }

    }

    abstract public function index();

    abstract public function create();

    abstract public function store();

    abstract public function show();

    abstract public function edit();

    abstract public function update();

    abstract public function destroy();
}