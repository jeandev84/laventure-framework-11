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
     * @inheritDoc
    */
    public function addRoute(RouteInterface $route): RouteInterface
    {
        if ($name = $route->getName()) {
            $this->namedRoutes[$name] = $route;
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
}
