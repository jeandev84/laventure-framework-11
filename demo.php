<?php

use Laventure\Component\Routing\Configuration\RouterConfiguration;
use Laventure\Component\Routing\Router\Router;

require 'vendor/autoload.php';

/*
$config = new RouterConfiguration("App\\Http\\Controllers");
$router = new Router($config);

$router->get('/admin', function () {
    return "Dashboard";
}, 'admin');


$router->get('/admin/users', function () {
    return "Users list";
}, 'admin.users.list');

$router->get('/admin/users/create', function () {
    return "Form create user";
}, 'admin.users.create');

$router->post('/admin/users/store', function () {
    return "Store user";
}, 'admin.users.store');


$router->get('/admin/users/{id}/edit', function () {
    return "Edit user";
}, 'admin.users.edit')
->where('id', '\d+');


$router->put('/admin/users/{id}', function () {
    return "Edit user";
}, 'admin.users.update')
->where('id', '\d+');

$router->delete('/admin/users/{slug}/{id}', function () {
    return "Delete user";
}, 'admin.users.delete')
->where('id', '\d+')
->where('slug', '[a-z\-0-9]+');


dump($router->getRoutes());
echo $router->generate('admin.users.delete', ['id' => 3, 'slug' => 'salut-les-amis']);
echo PHP_EOL;


dump($router->match('DELETE', '/admin/users/salut-les-amis/3'));
*/