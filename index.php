<?php

spl_autoload_register();

use App\Router\Router;

$obj = Router::parse($_SERVER['REQUEST_URI']);
//echo $_SERVER['QUERY_STRING'];
echo '<pre>';
var_dump($obj);
echo '</pre>';

