<?php

require_once(__DIR__ . '/vendor/autoload.php');

spl_autoload_register();

use App\Router\Router;

$obj = Router::parse($_SERVER['REQUEST_URI']);
//echo '<pre>';
//var_dump($obj);
//echo '</pre>';
echo $obj->result();

