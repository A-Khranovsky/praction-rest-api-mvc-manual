<?php

require_once(__DIR__ . '/vendor/autoload.php');

use App\Application;

$obj = Application::run($_SERVER['REQUEST_URI']);

echo $obj->response();

