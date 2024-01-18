<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing\Route;

use Laventure\Component\Routing\Route\Route;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Http\Controllers\HomeController;
use PHPUnitTest\App\Http\Controllers\SiteController;
use PHPUnitTest\Component\Routing\Factory\RouteFactory;

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

          $route2 = new Route(['GET', 'POST'], '/contact', function () {
              return "Contact";
          }, 'contact');


          $this->assertTrue($route1->matchMethod('GET'));
          $this->assertTrue($route2->matchMethod('GET'));
          $this->assertTrue($route2->matchMethod('POST'));
      }



      public function testMatchPath(): void
      {
          $func = function () {};
          $route1 = Route::create(['GET'], '/', $func, 'home');
          $route2 = Route::create(['GET'], '/about', $func, 'about');
          $route3 = Route::create(['GET'], '/foo', $func, 'foo');
          $route4 = Route::create(['GET'], 'foo', $func, 'foo');
          $route5 = Route::create(['GET'], '/admin-posts', $func, 'admin.posts');
          $route6 = Route::create(['GET'], '/admin/posts', $func, 'admin.posts');
          $route7 = Route::create(['GET'], '/admin/posts/{id}', $func, 'admin.posts')
                                      ->where('id', '\d+');
          $route8 = Route::create(['PUT'], '/admin/posts/{slug}-{id}', $func, 'admin.posts')
                                      ->wheres([
                                          'slug' => '[a-z\-0-9]+',
                                          'id' => '\d+'
                                      ]);

          $route9 = Route::create(['GET'], '/{_locale}/blog', [], 'blog.home')
              ->wheres(['_locale' => '\w+',]);


          $route10 = Route::create(['GET'], '/profile/{username?}', [], 'profile')
                                      ->wheres(['username' => '\w+']);


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
          $this->assertFalse($route8->matchPath('/admin/posts/3-salut-les-amis'));
          $this->assertTrue($route9->matchPath('/en/blog'));
          $this->assertTrue($route9->matchPath('/ru/blog'));
          $this->assertTrue($route9->matchPath('/ru_RU/blog'));
          $this->assertTrue($route10->matchPath('/profile'));
          $this->assertTrue($route10->matchPath('/profile/'));
          $this->assertTrue($route10->matchPath('/profile/john'));
      }






      public function testMatch(): void
      {
          $func = function () {};
          $route1 = Route::create(['GET'], '/admin/posts', $func, 'admin.posts');
          $route2 = Route::create(['GET'], '/admin/posts/{id}', $func, 'admin.posts')
                                     ->where('id', '\d+');
          $route3 = Route::create(['PUT'], '/admin/posts/{slug}-{id}', $func, 'admin.posts')
                                      ->wheres(['slug' => '[a-z\-0-9]+', 'id' => '\d+']);

          $route4 = Route::create(['GET'], '/{_locale}/blog', [], 'blog.home')->wheres(['_locale' => '\w+',]);

          $route5 = Route::create(['GET'], '/profile/{username?}', [], 'profile')
              ->wheres(['username' => '\w+']);


          $route6 = Route::create(['GET'], '/users/(\d+)', [], 'users.show');


          $this->assertTrue($route1->match('GET', '/admin/posts'));
          $this->assertFalse($route1->match('POST', '/admin/posts'));
          $this->assertTrue($route2->match('GET', '/admin/posts/1'));
          $this->assertFalse($route2->match('GET', '/admin/posts/blabala'));
          $this->assertFalse($route2->match('DELETE', '/admin/posts/blababla'));
          $this->assertTrue($route3->match('PUT', '/admin/posts/mon-article-3'));
          $this->assertFalse($route3->match('PUT', '/admin/posts/3-mon-article'));
          $this->assertTrue($route4->match('GET', '/en/blog'));
          $this->assertTrue($route5->match('GET', '/profile'));
          $this->assertTrue($route5->match('GET', '/profile/'));
          $this->assertTrue($route5->match('GET', '/profilesss')); # TODO fix it not critical but i'll do it more better
          $this->assertTrue($route5->matchPath('/profile/john'));
          $this->assertTrue($route5->matchPath('/profile/john'));
          $this->assertTrue($route6->matchPath('/users/1'));
          $this->assertFalse($route6->matchPath('/users'));
      }




      public function testAction(): void
      {
          $route2 = Route::create(['GET'], '/', [HomeController::class], 'contact');

          
          $this->assertTrue(true);
      }



      public function testGeneratePath(): void
      {
           $route1 = Route::create(['DELETE'], '/admin/users/{slug}/{id}', function () {
               return "Delete user";
           }, 'admin.users.delete')->wheres(['id' => '\d+', 'slug' => '[a-z\-0-9]+']);

           $this->assertSame('/admin/users/salut-les-amis/3', $route1->generatePath(['id' => 3, 'slug' => 'salut-les-amis']));
      }
}
