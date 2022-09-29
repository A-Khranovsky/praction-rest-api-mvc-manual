<?php

require_once(__DIR__ . '/vendor/autoload.php');


spl_autoload_register();

use MVC\Controllers\Controller;

$obj = new Controller($_SERVER['REQUEST_URI']);
echo $obj->render();
