<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collection;

use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collection
 */
class RouteCollection implements RouteCollectionInterface
{
    /**
     * @var RouteInterface[]
    */
    protected array $routes = [];



    /**
     * @var RouteInterface[]
    */
    protected array $namedRoutes = [];



    /**
     * @var array
    */
    protected array $methods = [];




    /**
     * @var array
    */
    protected array $controllers = [];




    /**
     * @var array
    */
    protected array $paths = [];




    /**
     * @inheritDoc
    */
    public function addRoute(RouteInterface $route): RouteInterface
    {
        $this->addRouteByMethods($route->getMethodsAsString(), $route);
        $this->addRouteByPath($route->getPath(), $route);

        if ($controller = $route->getController()) {
            $this->addRouteByController($controller, $route);
        }

        if ($name = $route->getName()) {
            $this->addNamedRoute($name, $route);
        }

        return $this->routes[] = $route;
    }





    /**
     * @inheritDoc
    */
    public function getRoutes(): array
    {
        return $this->routes;
    }





    /**
     * @inheritDoc
    */
    public function getNamedRoutes(): array
    {
        return $this->namedRoutes;
    }






    /**
     * @inheritDoc
    */
    public function getNamedRoute(string $name): ?RouteInterface
    {
        return $this->namedRoutes[$name] ?? null;
    }






    /**
     * @inheritDoc
    */
    public function hasNamedRoute(string $name): bool
    {
        return isset($this->namedRoutes[$name]);
    }




    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {
        return $this->methods;
    }




    /**
     * @inheritDoc
    */
    public function getMethodRoutes(string $method): array
    {
        return $this->methods[$method] ?? [];
    }





    /**
     * @inheritDoc
    */
    public function getControllers(): array
    {
        return $this->controllers;
    }




    /**
     * @inheritDoc
    */
    public function getControllerRoutes(string $controller): array
    {
        return $this->controllers[$controller] ?? [];
    }




    /**
     * @inheritDoc
    */
    public function addRouteByController(string $controller, RouteInterface $route): RouteInterface
    {
        $this->controllers[$controller][$route->getPath()] = $route;

        return $route;
    }




    /**
     * @inheritDoc
    */
    public function addRouteByMethods(string $methods, RouteInterface $route): RouteInterface
    {
        $this->methods[$methods][$route->getPath()] = $route;

        return $route;
    }




    /**
     * @inheritDoc
    */
    public function addNamedRoute(string $name, RouteInterface $route): RouteInterface
    {
        $this->namedRoutes[$name] = $route;

        return $route;
    }



    /**
     * @inheritDoc
    */
    public function hasController(string $controller): bool
    {
        return isset($this->controllers[$controller]);
    }



    /**
     * @inheritDoc
    */
    public function hasMethods(string $methods): bool
    {
        return isset($this->methods[$methods]);
    }


    /**
     * @inheritDoc
    */
    public function addRouteByPath(string $path, RouteInterface $route): RouteInterface
    {
        $this->paths[$path] = $route;

        return $route;
    }



    /**
     * @inheritDoc
    */
    public function getRouteByPath(string $path): ?RouteInterface
    {
        return $this->paths[$path] ?? null;
    }




    /**
     * @return RouteInterface[]
    */
    public function getPaths(): array
    {
        return $this->paths;
    }
}
