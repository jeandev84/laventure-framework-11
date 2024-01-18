<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing;

use Laventure\Component\Routing\Route\RouteInterface;
use Laventure\Component\Routing\Router\Router;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Http\Controllers\Admin\BookController;
use PHPUnitTest\App\Http\Controllers\SiteController;
use PHPUnitTest\App\Http\Middlewares\AuthenticatedMiddleware;
use PHPUnitTest\App\Http\Middlewares\IsAdminMiddleware;
use PHPUnitTest\Component\Routing\Factory\RouterTestFactory;

/**
 * RouterTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Routing
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
        $routes[] = $router->delete('/admin/books/{id}', [BookController::class, 'delete'], 'admin.books.delete')
                           ->where('id', '\d+')
                           ->middlewares([IsAdminMiddleware::class]);

        $this->assertSame($routes, $router->getRoutes());
    }
}
