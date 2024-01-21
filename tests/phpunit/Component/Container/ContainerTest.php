<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Container;

use Laventure\Component\Container\Container;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Router\Router;
use Laventure\Component\Routing\Router\RouterInterface;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Config\ConfigService;
use PHPUnitTest\App\Config\ConfigServiceInterface;
use PHPUnitTest\App\Services\BarService;
use PHPUnitTest\App\Services\FooService;
use PHPUnitTest\App\Services\MailerService;
use PHPUnitTest\Component\Container\Utils\FakeContainer;
use Psr\Container\ContainerInterface;

/**
 * ContainerTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Container
*/
class ContainerTest extends TestCase
{
       public function testInstance(): void
       {
           $fake       = new FakeContainer();
           $instance1  = new Container();
           $instance2  = new Container();
           $container1 = Container::getInstance();
           $container2 = Container::getInstance();

           $this->assertInstanceOf(ContainerInterface::class, $container1);
           $this->assertInstanceOf(ContainerInterface::class, $container2);
           $this->assertSame($container1, $container2);
           $this->assertNotSame($instance1, $container1);
           $this->assertNotSame($instance2, $container2);
           $this->assertNotSame($instance1, $instance2);
           $this->assertNotInstanceOf(ContainerInterface::class, $fake);
       }



       public function testBindings(): void
       {

           $container = Container::getInstance();
           $container->clear();
           $baseUrl   = 'http://localhost:8000';

           $container->bind('baseUrl', $baseUrl);
           $container->bind(FooService::class, $foo = new FooService());
           $container->bind(BarService::class, new BarService($foo, new MailerService(), $baseUrl));
           $container->bind(ConfigService::class, new ConfigService(require __DIR__.'/config/app.php'));

           $this->assertSame($baseUrl, $container->get('baseUrl'));
           $this->assertInstanceOf(FooService::class, $container->get(FooService::class));
           # $this->assertNull($container->get('blabla'));
       }




    public function testResolve()
    {
        $container = Container::getInstance();
        $container->bind('name', 'jean');
        $container->bind('namespace', "App\\Http\\Controllers");
        $container->aliases(Container::class, ['app']);
        $container->singleton(Container::class, $container);
        $container->singleton(RouterInterface::class, Router::class);
        $container->singleton(Router::class, Router::class);
        $container->instance(Route::class, new Route(['GET'], '/', 'HomeConroller@index', 'home'));
        $container->bind('foo', function (Container $c) {
            return $c->get('name') . '-claude';
        });

        $this->assertSame('jean', $container->get('name'));
        $this->assertSame('jean-claude', $container->get('foo'));
        $this->assertInstanceOf(Container::class, $container->get(Container::class));
        $this->assertInstanceOf(ContainerInterface::class, $container->get(Container::class));

        $this->assertInstanceOf(Container::class, $container->get('app'));
        $this->assertInstanceOf(ContainerInterface::class, $container->get('app'));

        $this->assertInstanceOf(Router::class, $container->get(RouterInterface::class));
        $this->assertInstanceOf(Router::class, $container->get(Router::class));
    }





        public function testConcrete(): void
        {
            $container = Container::getInstance();
            $container->clear();

            $container->instance(Container::class, $container);
            $container->bind('config.php', require __DIR__.'/config/app.php');
            $container->bind(FooService::class, FooService::class);
            $container->bind(ContainerInterface::class, Container::class);
            $container->bind(ConfigService::class, function (Container $app) {
                return $app->make(ConfigService::class, ['env' => $app->get('config.php')]);
            });

            #dd($container->make(ConfigService::class, ['env' => $container->get('config.php')]));

            $this->assertInstanceOf(FooService::class, $container->get(FooService::class));
            $this->assertInstanceOf(Container::class, $container->get(ContainerInterface::class));
            $this->assertInstanceOf(ContainerInterface::class, $container->get(ContainerInterface::class));
            $this->assertInstanceOf(ConfigService::class, $container->get(ConfigService::class));
        }



          public function testMake(): void
          {
             $container = Container::getInstance();
             $container->clear();

             $baseUrl = 'http://localhost:8000';
             $this->assertInstanceOf(FooService::class, $container->make(FooService::class));
             $this->assertInstanceOf(BarService::class, $container->make(BarService::class, compact('baseUrl')));

             $container->bind('baseUrl', $baseUrl);
             $this->assertInstanceOf(BarService::class, $container->make(BarService::class));

             $instance1 = $container->make(FooService::class);
             $instance2 = $container->make(FooService::class);

             $this->assertNotSame($instance1, $instance2);
         }




         public function testFactory(): void
         {
            $container = Container::getInstance();
            $container->clear();

            $baseUrl = 'http://localhost:8000';
            $container->bind('baseUrl', $baseUrl);
            $this->assertInstanceOf(FooService::class, $container->factory(FooService::class));
            $this->assertInstanceOf(BarService::class, $container->factory(BarService::class));
            $this->assertInstanceOf(BarService::class, $container->factory(BarService::class));
        }





        public function testGet(): void
        {
            $container = Container::getInstance();
            $container->clear();

            $baseUrl = 'http://localhost:8000';
            $container->bind('baseUrl', $baseUrl);
            $this->assertInstanceOf(FooService::class, $container->get(FooService::class));
            $this->assertInstanceOf(BarService::class, $container->get(BarService::class));
            $this->assertInstanceOf(BarService::class, $container->get(BarService::class));
        }






        public function testSingleton(): void
        {
            $container = Container::getInstance();
            $container->clear();

            $container->bind('env', require __DIR__.'/config/app.php');
            $container->singleton(ConfigService::class, ConfigService::class);
            $container->aliases(ConfigService::class, [
                'config.php',
                'app.config.php',
                ConfigServiceInterface::class
            ]);


            $config1 = $container->get(ConfigService::class);
            $config2 = $container->get('config.php');
            $config3 = $container->get('app.config.php');
            $config4 = $container->get(ConfigServiceInterface::class);


            $this->assertSame($config1, $config2);
            $this->assertSame($config1, $config3);
            $this->assertSame($config1, $config4);

            $this->assertSame($config2, $config1);
            $this->assertSame($config2, $config3);
            $this->assertSame($config2, $config4);

            $this->assertSame($config3, $config1);
            $this->assertSame($config3, $config2);
            $this->assertSame($config3, $config4);
        }





        public function testProviders(): void
        {
            $container = Container::getInstance();
            $container->clear();

            $providers = [
                \PHPUnitTest\App\Provider\ConfigurationServiceProvider::class,
                \PHPUnitTest\App\Provider\FakeRouterServiceProvider::class,
                \PHPUnitTest\App\Provider\FooServiceProvider::class
            ];

            $container->addProviders($providers);

            foreach ($providers as $provider) {
                $this->assertArrayHasKey($provider, $container->getProviders());
            }

            $this->assertInstanceOf(ConfigService::class, $container->get(ConfigService::class));
            $this->assertInstanceOf(ConfigService::class, $container->get('config.php'));
            $this->assertInstanceOf(ConfigService::class, $container->get(ConfigServiceInterface::class));
        }


}
