<?php

use Laventure\Component\Routing\Router\Router;

require 'vendor/autoload.php';


$router = new Router("App\\Http\\Controllers");
$router->patterns(['id' => '\d+']);

$router->registerControllers([

]);

