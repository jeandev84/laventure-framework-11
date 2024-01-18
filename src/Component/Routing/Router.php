<?php
declare(strict_types=1);

namespace Laventure\Component\Routing;

use Laventure\Component\Routing\Configuration\RouterConfigurationInterface;
use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Factory\RouteFactoryInterface;
use Laventure\Component\Routing\Route\Group\RouteGroupInterface;
use Laventure\Component\Routing\Route\Resolver\RouteResolverInterface;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing
*/
class Router implements RouterInterface, RouteCollectorInterface
{

    /**
     * @var RouterConfigurationInterface
    */
    protected RouterConfigurationInterface $config;


    /**
     * @var RouteCollectionInterface
    */
    protected RouteCollectionInterface $collection;



    /**
     * @var RouteGroupInterface
    */
    protected RouteGroupInterface $group;


    /**
     * @var RouteFactoryInterface
    */
    protected RouteFactoryInterface $routeFactory;



    /**
     * @var RouteResolverInterface
    */
    protected RouteResolverInterface $routeResolver;



    /**
     * @param RouterConfigurationInterface $config
    */
    public function __construct(RouterConfigurationInterface $config)
    {
        $this->config        = $config;
        $this->collection    = $config->getRouteCollection();
        $this->group         = $config->getRouteGroup();
        $this->routeFactory  = $config->getRouteFactory();
        $this->routeResolver = $config->getRouteResolver();
    }




    /**
     * @param $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function makeRoute(
        $methods,
        string $path,
        mixed $action,
        string $name = ''
    ): RouteInterface
    {
         $methods = $this->routeResolver->resolveMethods($methods);
         $path    = $this->routeResolver->resolvePath($path);
         $action  = $this->routeResolver->resolveAction($action);
         $name    = $this->routeResolver->resolveName($name);

         return $this->routeFactory->createRoute(
             $methods, $path, $action, $name
         );
    }





    /**
     * @param RouteInterface $route
     *
     * @return RouteInterface
    */
    public function addRoute(RouteInterface $route): RouteInterface
    {
        return $this->collection->addRoute($route);
    }




    /**
     * @inheritdoc
    */
    public function hasRoute(string $name): bool
    {
        return $this->collection->hasNamedRoute($name);
    }





    /**
     * @inheritdoc
    */
    public function getRoute(string $name): ?RouteInterface
    {
        return $this->collection->getNamedRoute($name);
    }





    /**
     * @inheritDoc
    */
    public function map($methods, string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->addRoute($this->makeRoute($methods, $path, $action, $name));
    }





    /**
     * @inheritDoc
    */
    public function get(string $path, mixed $action, string $name = ''): RouteInterface
    {
          return $this->map(['GET'], $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function post(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(['POST'], $path, $action, $name);
    }



    /**
     * @inheritDoc
    */
    public function put(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(['PUT'], $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function patch(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(['PATCH'], $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function delete(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(['DELETE'], $path, $action, $name);
    }



    /**
     * @inheritDoc
    */
    public function getRoutes(): array
    {
        return $this->getCollection()->getRoutes();
    }



    /**
     * @inheritDoc
    */
    public function getCollection(): RouteCollectionInterface
    {
        return $this->collection;
    }




    /**
     * @inheritDoc
    */
    public function getConfiguration(): RouterConfigurationInterface
    {
        return $this->config;
    }




    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): RouteInterface|false
    {
         foreach ($this->getRoutes() as $route) {
             if ($route->match($method, $path)) {
                 return $route;
             }
         }

         return false;
    }




    /**
     * @inheritDoc
    */
    public function generate(string $name, array $params = []): ?string
    {
        if (!$this->hasRoute($name)) {
            return null;
        }

        return $this->getRoute($name)->generatePath($params);
    }
}