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
    public function getRoutesMethod(string $method): array;






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
    public function getRoutesController(string $controller): array;







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
}
