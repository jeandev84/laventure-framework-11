<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing\Route;

use Laventure\Component\Routing\Route\Route;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Http\Controllers\HomeController;
use PHPUnitTest\Component\Routing\Factory\RouteTestFactory;

/**
 * RouteTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Routing\Route
 */
class RouteTest extends TestCase
{

      public function testMatchMethod(): void
      {
          $route1 = new Route(['GET'], '/', function () {
              return "Привет! друзья";
          }, 'home');

          $route2 = new Route(['GET', 'POST'], '/contact', [], 'contact');


          $this->assertTrue($route1->matchMethod('GET'));
          $this->assertTrue($route2->matchMethod('GET'));
          $this->assertTrue($route2->matchMethod('POST'));
      }



      public function testMatchPath(): void
      {
          $route1 = RouteTestFactory::create(['GET'], '/', [], 'home');
          $route2 = RouteTestFactory::create(['GET'], '/about', [], 'about');
          $route3 = RouteTestFactory::create(['GET'], '/foo', [], 'foo');
          $route4 = RouteTestFactory::create(['GET'], 'foo', [], 'foo');
          $route5 = RouteTestFactory::create(['GET'], '/admin-posts', [], 'admin.posts');
          $route6 = RouteTestFactory::create(['GET'], '/admin/posts', [], 'admin.posts');
          $route7 = RouteTestFactory::create(['GET'], '/admin/posts/{id}', [], 'admin.posts')
                                      ->where('id', '\d+');
          $route8 = RouteTestFactory::create(['PUT'], '/admin/posts/{slug}-{id}', [], 'admin.posts')
                                      ->wheres([
                                          'slug' => '[a-z\-0-9]+',
                                          'id' => '\d+'
                                      ]);


          $this->assertTrue($route1->matchPath('/'));
          $this->assertTrue($route2->matchPath('/about'));
          $this->assertFalse($route3->matchPath('foo'));
          $this->assertFalse($route4->matchPath('foo'));
          $this->assertFalse($route5->matchPath('/admin/posts'));
          $this->assertTrue($route6->matchPath('/admin/posts'));
          $this->assertTrue($route7->matchPath('/admin/posts/1'));
          $this->assertFalse($route7->matchPath('/admin/posts/1adss'));
          $this->assertTrue($route8->matchPath('/admin/posts/mon-slug-1'));
          $this->assertTrue($route8->matchPath('/admin/posts/un-autre-example-2-mon-slug-1'));
          $this->assertTrue($route8->matchPath('/admin/posts/33-un-autre-example-2-mon-slug-5'));
      }






//      public function testMatch(): void
//      {
//
//      }
//
//
//
//      public function testGeneratePath(): void
//      {
//
//      }
}
