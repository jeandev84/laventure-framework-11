<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collector;

use Closure;
use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Factory\RouteFactoryInterface;
use Laventure\Component\Routing\Route\Group\RouteGroupInterface;
use Laventure\Component\Routing\Route\Resolver\RouteResolverFactoryInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteCollectorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collector
 */
interface RouteCollectorInterface
{
    /**
     *  Collect route called by each kind methods
     *  Example : $this->map('GET|POST|PUT|DELETE', '/any', [], 'any');
     *
     * @param $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function map($methods, string $path, mixed $action, string $name = ''): RouteInterface;




    /**
     * Collect route called by method GET
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function get(string $path, mixed $action, string $name = ''): RouteInterface;





    /**
     * Collect route called by method POST
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function post(string $path, mixed $action, string $name = ''): RouteInterface;






    /**
     * Collect route called by method PUT
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function put(string $path, mixed $action, string $name = ''): RouteInterface;






    /**
     * Collect route called by method PATH
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function patch(string $path, mixed $action, string $name = ''): RouteInterface;





    /**
     * Collect route called by method DELETE
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function delete(string $path, mixed $action, string $name = ''): RouteInterface;






    /**
     * Collect web resources
     *
     * @param string $name
     *
     * @param string $controller
     *
     * @return $this
    */
    public function resource(string $name, string $controller): static;






    /**
     * Collect web resources
     *
     * @param array $resources
     *
     * @return $this
    */
    public function resources(array $resources): static;





    /**
     * Collect api resource
     *
     * @param string $name
     *
     * @param string $controller
     *
     * @return $this
    */
    public function apiResource(string $name, string $controller): static;






    /**
     * Collect api resources
     *
     * @param array $resources
     *
     * @return $this
    */
    public function apiResources(array $resources): static;








    /**
     * Map routes group
     *
     * @param array $attributes
     *
     * @param Closure $routes
     *
     * @return mixed
    */
    public function group(array $attributes, Closure $routes): mixed;






    /**
     * Collect routes
     *
     * @param RouteInterface $route
     *
     * @return RouteInterface
    */
    public function addRoute(RouteInterface $route): RouteInterface;






    /**
     * Add route from controller attributes for example
     *
     * @param array $controllers
     *
     * @return $this
    */
    public function registerControllers(array $controllers): static;





    /**
     * Collect resources
     *
     * @return $this
    */
    public function addResource(ResourceInterface $resource): static;






    /**
     *  Determine if given name exist in web resources
     *
     * @param string $name
     *
     * @return bool
    */
    public function hasResource(string $name): bool;







    /**
     * Returns web resource
     *
     * @param string $name
     *
     * @return ResourceInterface|null
    */
    public function getResource(string $name): ?ResourceInterface;






    /**
     * Determine if given name exist in api resources
     *
     * @param string $name
     *
     * @return bool
    */
    public function hasApiResource(string $name): bool;





    /**
     * @param string $name
     *
     * @return ResourceInterface|null
    */
    public function getApiResource(string $name): ?ResourceInterface;






    /**
     * Returns routes
     *
     * @return RouteInterface[]
    */
    public function getRoutes(): array;







    /**
     * @return ResourceInterface[]
    */
    public function getResources(): array;







    /**
     * Returns route collection
     *
     * @return RouteCollectionInterface
    */
    public function getCollection(): RouteCollectionInterface;





    /**
     * @return RouteGroupInterface
    */
    public function getGroup(): RouteGroupInterface;
}
