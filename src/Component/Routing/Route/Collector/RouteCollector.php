<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collector;


use Closure;
use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Factory\RouteFactory;
use Laventure\Component\Routing\Route\Factory\RouteFactoryInterface;
use Laventure\Component\Routing\Route\Group\RouteGroup;
use Laventure\Component\Routing\Route\Group\RouteGroupInterface;
use Laventure\Component\Routing\Route\Methods\Enums\HttpMethod;
use Laventure\Component\Routing\Route\Resolver\RouteResolverFactory;
use Laventure\Component\Routing\Route\Resolver\RouteResolverFactoryInterface;
use Laventure\Component\Routing\Route\Resolver\RouteResolverInterface;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteCollector
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collector
*/
class RouteCollector extends AbstractRouteCollector
{


    /**
     * @var string
    */
    protected string $namespace;


    /**
     * @var RouteResolverFactoryInterface
    */
    protected RouteResolverFactoryInterface $routeResolverFactory;


    /**
     * @var RouteFactoryInterface
    */
    protected RouteFactoryInterface $routeFactory;



    /**
     * @var array
    */
    protected array $routeMiddlewares = [];


    /**
     * @var array
    */
    protected array $patterns = [];



    /**
     * @param string $namespace
    */
    public function __construct(string $namespace)
    {
        parent::__construct();
        $this->namespace            = $namespace;
        $this->routeFactory         = new RouteFactory();
        $this->routeResolverFactory = new RouteResolverFactory();
    }




    /**
     * @param RouteFactoryInterface $routeFactory
     *
     * @return $this
    */
    public function withRouteFactory(RouteFactoryInterface $routeFactory): static
    {
        $this->routeFactory = $routeFactory;

        return $this;
    }






    /**
     * @param RouteResolverFactoryInterface $routeResolverFactory
     * @return $this
    */
    public function withRouteResolverFactory(RouteResolverFactoryInterface $routeResolverFactory): static
    {
        $this->routeResolverFactory = $routeResolverFactory;

        return $this;
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
     * @param $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function makeRoute($methods, string $path, mixed $action, string $name = ''): RouteInterface
    {
        $resolver    = $this->makeRouteResolver();
        $methods     = $resolver->resolveMethods($methods);
        $path        = $resolver->resolvePath($path);
        $action      = $resolver->resolveAction($action);
        $name        = $resolver->resolveName($name);
        $middlewares = $resolver->resolveMiddlewares($this->routeMiddlewares);

        $route = $this->routeFactory->createRoute($methods, $path, $action, $name);

        return $route->wheres($this->patterns)->middlewares($middlewares);
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
        return $this->map(HttpMethod::GET, $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function post(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::POST, $path, $action, $name);
    }



    /**
     * @inheritDoc
    */
    public function put(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::PUT, $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function patch(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::PATCH, $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function delete(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::DELETE, $path, $action, $name);
    }




    /**
     * @inheritDoc
    */
    public function resource(string $name, string $controller): static
    {

    }




    /**
     * @inheritDoc
    */
    public function apiResource(string $name, string $controller): static
    {

    }




    /**
     * @inheritDoc
    */
    public function group(array $attributes, Closure $routes): mixed
    {

    }




    /**
     * @return RouteResolverInterface
    */
    private function makeRouteResolver(): RouteResolverInterface
    {
        return $this->routeResolverFactory->createRouteResolver($this->group, $this->namespace);
    }
}