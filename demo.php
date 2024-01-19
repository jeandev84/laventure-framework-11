<?php

use Laventure\Component\Routing\Router\Router;
use PHPUnitTest\App\Http\Controllers\Api\OrderController;

require 'vendor/autoload.php';


$router = new Router("App\\Http\\Controllers");
$router->patterns(['id' => '\d+']);

$router->registerControllers([
  OrderController::class
]);

