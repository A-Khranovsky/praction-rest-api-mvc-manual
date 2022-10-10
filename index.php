<?php

require_once(__DIR__ . '/vendor/autoload.php');

use App\Application;
use App\Routes\Route;

Route::get('tasks',null, 'index');
Route::get('tasks','create', 'create');
Route::get('tasks','edit', 'edit');

$obj = Application::run($_SERVER['REQUEST_URI']);

echo $obj->response();

