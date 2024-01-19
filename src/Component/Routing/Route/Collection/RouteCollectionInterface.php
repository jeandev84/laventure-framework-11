<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collection;

use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collection
*/
interface RouteCollectionInterface
{
    /**
     * @param RouteInterface $route
     *
     * @return RouteInterface
    */
    public function addRoute(RouteInterface $route): RouteInterface;



    /**
     * @param string $controller
     *
     * @param RouteInterface $route
     *
     * @return mixed
    */
    public function addRouteByController(string $controller, RouteInterface $route): RouteInterface;





    /**
     * @param string $methods
     *
     * @param RouteInterface $route
     *
     * @return mixed
    */
    public function addRouteByMethods(string $methods, RouteInterface $route): RouteInterface;




    /**
     * @param string $name
     * @param RouteInterface $route
     * @return RouteInterface
    */
    public function addNamedRoute(string $name, RouteInterface $route): RouteInterface;




    /**
     * @param string $path
     * @param RouteInterface $route
     * @return RouteInterface
    */
    public function addRouteByPath(string $path, RouteInterface $route): RouteInterface;





    /**
     * Returns all routes
     *
     * @return RouteInterface[]
    */
    public function getRoutes(): array;





    /**
     * Returns routes by given method
     *
     * @return RouteInterface[]
    */
    public function getMethodRoutes(string $method): array;






    /**
     * Returns route by methods
     *
     * @return array
    */
    public function getMethods(): array;






    /**
     * Returns routes by controllers
     *
     * @return RouteInterface[]
    */
    public function getControllers(): array;






    /**
     * @param string $controller
     *
     * @return RouteInterface[]
    */
    public function getControllerRoutes(string $controller): array;




    /**
     * @param string $path
     *
     * @return RouteInterface|null
    */
    public function getRouteByPath(string $path): ?RouteInterface;




    /**
     * @return RouteInterface[]
    */
    public function getNamedRoutes(): array;





    /**
      * @param string $name
      *
      * @return RouteInterface|null
     */
    public function getNamedRoute(string $name): ?RouteInterface;





    /**
     * @param string $name
     *
     * @return bool
    */
    public function hasNamedRoute(string $name): bool;




    /**
     * @param string $controller
     * @return bool
    */
    public function hasController(string $controller): bool;




    /**
     * @param string $methods
     * @return bool
    */
    public function hasMethods(string $methods): bool;
}
