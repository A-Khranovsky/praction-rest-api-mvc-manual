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
        if ($methodType == 'GET' && !is_null($controllerName) && is_null($id) && $action === 'create') {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->create();
        }
        if ($methodType == 'POST' && !is_null($controllerName) && is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->store();
        }
        if ($methodType == 'GET' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->show();
        }
        if ($methodType == 'GET' && !is_null($controllerName) && !is_null($id) && $action === 'edit') {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->edit();
        }
        if ($methodType == 'PATCH' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->update();
        }
        if ($methodType == 'DELETE' && !is_null($controllerName) && !is_null($id) && is_null($action)) {
            $class = __NAMESPACE__ . '\\' . ucfirst($controllerName);
            return (new $class())->destroy();
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