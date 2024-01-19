<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing\Router;


use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Component\Routing\Route\Resource\Types\WebResource;
use Laventure\Component\Routing\Route\RouteInterface;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Factory\RouterTestFactory;
use PHPUnitTest\App\Http\Controllers\Admin\BookController;
use PHPUnitTest\App\Http\Controllers\Admin\UserController;
use PHPUnitTest\App\Http\Controllers\SiteController;
use PHPUnitTest\App\Http\Middlewares\AuthenticatedMiddleware;
use PHPUnitTest\App\Http\Middlewares\IsAdminMiddleware;

/**
 * RouterTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Routing\Router
*/
class RouterTest extends TestCase
{
    public function testThereAreNoRoutesWhenRouterIsCreated(): void
    {
        $this->assertEmpty(RouterTestFactory::create()->getRoutes());
    }


    public function testMapRoutes(): void
    {
        $router = RouterTestFactory::create();

        $routes = [];

        # controllers
        $routes[] = $router->get('/', [SiteController::class, 'home'], 'home');
        $routes[] = $router->get('/about', [SiteController::class, 'about'], 'about');
        $routes[] = $router->map('GET|POST', '/contact-us', [SiteController::class, 'contactUs'], 'contact.us');


        # closures
        $routes[] = $router->get('/welcome', function () {
            return "Welcome";
        }, 'welcome');

        # Resources
        $routes[] = $router->get('/admin/books', [BookController::class, 'index'], 'admin.books.index')
                          ->middlewares([IsAdminMiddleware::class]);
        $routes[] = $router->get('/admin/books/{id}', [BookController::class, 'show'], 'admin.books.show')
                           ->where('id', '\d+')
                           ->middlewares([IsAdminMiddleware::class]);
        $routes[] = $router->get('/admin/books', [BookController::class, 'create'], 'admin.books.create')
                           ->middlewares([IsAdminMiddleware::class]);
        $routes[] = $router->post('/admin/books', [BookController::class, 'store'], 'admin.books.store')
                           ->middlewares([IsAdminMiddleware::class]);
        $routes[] = $router->map('PUT|PATCH', '/admin/books/{id}', [BookController::class, 'update'], 'admin.books.update')
                           ->where('id', '\d+')
                           ->middlewares([IsAdminMiddleware::class]);
        $routes[] = $router->delete('/admin/books/{id}', [BookController::class, 'destroy'], 'admin.books.delete')
                           ->where('id', '\d+')
                           ->middlewares([IsAdminMiddleware::class]);

        $this->assertSame($routes, $router->getRoutes());
    }



    public function testMatchWithQueryString(): void
    {
            $router = RouterTestFactory::create();

            $func1 = function () { return "Get Book from storage";};
            $router->get('/admin/books/{slug}-{id}', $func1, 'books.show')
                   ->slug('slug')->id()->middlewares([AuthenticatedMiddleware::class]);

            $actual1 = $router->match('GET', '/admin/books/my-new-book-1?page=3&sort=users.id&direction=asc');
            $actual2 = $router->match('GET', '/admin/books/my-new-book-1');
            $actual3 = $router->match('POST', '/admin/books/my-new-book-1');
            $actual4 = $router->match('GET', '/sdfdsgshsdjd');

            $this->assertInstanceOf(RouteInterface::class, $actual1);
            $this->assertInstanceOf(RouteInterface::class, $actual2);
            $this->assertFalse($actual3);
            $this->assertFalse($actual4);
    }





    public function testResource(): void
    {
         $router = RouterTestFactory::create();
         $router->patterns(['id' => '\d+']);
         $router->resource('users', UserController::class);
         $router->apiResource('books', BookController::class);


         $this->assertTrue($router->hasResource('users'));
         $this->assertTrue($router->hasApiResource('books'));

         $this->assertInstanceOf(ResourceInterface::class, $router->getResource('users'));
         $this->assertInstanceOf(WebResource::class, $router->getResource('users'));

         $this->assertInstanceOf(ResourceInterface::class, $router->getApiResource('books'));
         $this->assertInstanceOf(ApiResource::class, $router->getApiResource('books'));
    }





}
