<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collector;

use Closure;
use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Factory\RouteFactoryInterface;
use Laventure\Component\Routing\Route\Group\RouteGroup;
use Laventure\Component\Routing\Route\Group\RouteGroupInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * AbstractRouteCollector
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collector
 */
abstract class AbstractRouteCollector implements RouteCollectorInterface
{
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
     * @var ResourceInterface[]
    */
    public array $resources = [];



    /**
     * @var array
    */
    protected array $controllers = [];




    public function __construct()
    {
        $this->collection = new RouteCollection();
        $this->group      = new RouteGroup();
    }



    /**
     * @param RouteCollectionInterface $collection
     *
     * @return $this
    */
    public function withCollection(RouteCollectionInterface $collection): static
    {
        $this->collection = $collection;

        return $this;
    }




    /**
     * @param RouteGroupInterface $group
     * @return $this
    */
    public function withGroup(RouteGroupInterface $group): static
    {
        $this->group = $group;

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
    public function addRoute(RouteInterface $route): RouteInterface
    {
        return $this->collection->addRoute($route);
    }





    /**
     * @inheritDoc
    */
    public function addResource(ResourceInterface $resource): static
    {
         $type = $resource->getType();
         $name = $resource->getName();

         $resource->map($this);
         $this->resources[$type][$name] = $resource;

         return $this;
    }






    /**
     * @inheritDoc
     */
    public function resources(array $resources): static
    {
        foreach ($resources as $name => $controller) {
            $this->resource($name, $controller);
        }

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function apiResources(array $resources): static
    {
         foreach ($resources as $name => $controller) {
             $this->apiResource($name, $controller);
         }

         return $this;
    }




    /**
     * @inheritDoc
     */
    public function controller(string $controller, RouteInterface $route): RouteInterface
    {
        $this->controllers[$controller][] = $route;

        return $route;
    }






    /**
     * @inheritDoc
     */
    public function hasResource(string $name): bool
    {
        return isset($this->resources[ResourceType::WEB][$name]);
    }





    /**
     * @inheritDoc
     */
    public function getResource(string $name): ?ResourceInterface
    {
        return $this->resources[ResourceType::WEB][$name] ?? null;
    }




    /**
     * @inheritDoc
     */
    public function hasApiResource(string $name): bool
    {
        return isset($this->resources[ResourceType::API][$name]);
    }



    /**
     * @inheritDoc
     */
    public function getApiResource(string $name): ?ResourceInterface
    {
        return $this->resources[ResourceType::API][$name] ?? null;
    }





    /**
     * @inheritDoc
     */
    public function getRoutes(): array
    {
        return $this->collection->getRoutes();
    }




    /**
     * @inheritDoc
     */
    public function getResources(): array
    {
        return $this->resources;
    }




    /**
     * @inheritDoc
    */
    public function getControllerRoutes(string $name): array
    {
        return $this->controllers[$name] ?? [];
    }




    /**
     * @inheritdoc
    */
    public function getCollection(): RouteCollectionInterface
    {
        return $this->collection;
    }
}