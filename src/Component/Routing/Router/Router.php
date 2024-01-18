<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Router;

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
 * @package  Laventure\Component\Routing\Router
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
     * @var array
    */
    protected array $patterns = [];




    /**
     * @var Resource[]
    */
    public array $resources = [];




    /**
     * @var array
    */
    private array $routeMiddlewares = [];



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
     * @param array $middlewares
     * @return $this
    */
    public function middlewares(array $middlewares): static
    {
        $this->routeMiddlewares[] = $middlewares;

        return $this;
    }




    /**
     * @param array $patterns
     *
     * @return $this
    */
    public function patterns(array $patterns): static
    {
        foreach ($patterns as $name => $pattern) {
            $this->pattern($name, $pattern);
        }

        return $this;
    }




    /**
     * @param string $name
     *
     * @param string $pattern
     *
     * @return $this
    */
    public function pattern(string $name, string $pattern): static
    {
        $this->patterns[$name] = $pattern;

        return $this;
    }




    /**
     * @param string $path
     *
     * @return $this
     */
    public function path(string $path): static
    {
        $this->group->path($path);

        return $this;
    }





    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function namespace(string $namespace): static
    {
        $this->group->namespace($namespace);

        return $this;
    }




    /**
     * @param string $name
     *
     * @return $this
     */
    public function name(string $name): static
    {
        $this->group->name($name);

        return $this;
    }







    /**
     * @param array $middlewares
     *
     * @return $this
    */
    public function middleware(array $middlewares): static
    {
        $this->group->middlewares($middlewares);

        return $this;
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
        return $this->map('GET', $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function post(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map('POST', $path, $action, $name);
    }



    /**
     * @inheritDoc
    */
    public function put(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map('PUT', $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function patch(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map('PATCH', $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function delete(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map('DELETE', $path, $action, $name);
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
    ): RouteInterface {

        $methods     = $this->resolveMethods($methods);
        $path        = $this->resolvePath($path);
        $action      = $this->resolveAction($action);
        $name        = $this->resolveName($name);
        $middlewares = $this->resolveMiddlewares($this->routeMiddlewares);

        return $this->routeFactory->createRoute($methods, $path, $action, $name)
                                  ->wheres($this->patterns)
                                  ->middlewares($middlewares);
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
     * @param $methods
     * @return array
     */
    private function resolveMethods($methods): array
    {
        return $this->routeResolver->resolveMethods($methods);
    }




    /**
     * @param string $path
     * @return string
     */
    private function resolvePath(string $path): string
    {
        return $this->routeResolver->resolvePath($path);
    }



    /**
     * @param mixed $action
     * @return mixed
     */
    private function resolveAction(mixed $action): mixed
    {
        return $this->routeResolver->resolveAction($action);
    }




    /**
     * @param string $name
     * @return string
     */
    private function resolveName(string $name): string
    {
        return $this->routeResolver->resolveName($name);
    }




    /**
     * @param array $middlewares
     * @return array
    */
    private function resolveMiddlewares(array $middlewares): array
    {
        return $this->routeResolver->resolveMiddlewares($middlewares);
    }
}
