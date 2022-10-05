<?php

require_once(__DIR__ . '/vendor/autoload.php');

spl_autoload_register();

use App\Application;

$obj = Application::run($_SERVER['REQUEST_URI']);

echo $obj->response();

