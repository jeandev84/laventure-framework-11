<?php

use Laventure\Component\Routing\Router\Router;
use PHPUnitTest\App\Http\Controllers\Api\OrderController;

require 'vendor/autoload.php';


$router = new Router("App\\Http\\Controllers");
$router->patterns(['id' => '\d+']);

$router->registerControllers([
  OrderController::class
]);


#dump($router->getRoutes());
#dump($router->match('GET', '/api/orders'));
#dump($router->match('GET', '/api/orders/show/1'));
#dump($router->match('GET', '/api/orders/show/azeaze'));
#dump($router->match('POST', '/api/orders/store'));
#dump($router->match('PUT', '/api/orders/update/5'));
#dump($router->match('DELETE', '/api/orders/destroy/6'));
dump($router->match('GET', '/api/orders/show/azeaze'));