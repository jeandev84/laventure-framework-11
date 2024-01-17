<?php

use Laventure\Component\Routing\Route\Route;

require 'vendor/autoload.php';

$route = new Route(['GET'], '/', function () {
    return "Hello world!";
}, 'home');

$routes[] = $route;

$route->name('renamed.home.to.contact.us');

dump($routes);