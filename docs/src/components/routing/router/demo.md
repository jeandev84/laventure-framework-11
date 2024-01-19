### Routing 


1. Mapping routes 
```php 
$router = new Router("App\\Http\\Controllers");

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

$router->get('/profile/{username?}', [], 'profile')
       ->wheres(['username' => '\w+'])


dump($router->getRoutes());
dump($router->match('DELETE', '/admin/users/salut-les-amis/3'));
echo $router->generate('admin.users.delete', ['id' => 3, 'slug' => 'salut-les-amis']);

dump($route->matchPath('/profile/'));
dump($router->match('GET', '/profile/brown'));
echo $router->generate('profile', ['username' => 'john']);
echo $router->generate('profile', ['username' => null]);
```