<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once (__DIR__ . '/App/Config/Routes.php');

use App\Application;

$obj = Application::run($_SERVER['REQUEST_URI']);

echo $obj->result();

