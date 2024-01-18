<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group\Invoker;

use Closure;
use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Group\DTO\RouteGroupAttributes;
use Laventure\Component\Routing\Route\Group\DTO\RouteGroupAttributesInterface;

/**
 * GroupInvoker
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group\Invoker
 */
class GroupInvoker implements GroupInvokerInterface
{
    /**
     * @param array $attributes
     * @param Closure $routes
     * @param RouteCollectorInterface $collector
    */
    public function __construct(
        protected array $attributes,
        protected Closure $routes,
        protected RouteCollectorInterface $collector
    ) {
    }



    /**
     * @inheritDoc
    */
    public function getAttributes(): RouteGroupAttributesInterface
    {
        return new RouteGroupAttributes(
            $this->attributes['path'] ?? '',
            $this->attributes['namespace'] ?? '',
            $this->attributes['name'] ?? '',
            $this->attributes['middlewares'] ?? []
        );
    }




    /**
     * @inheritDoc
    */
    public function getRoutes(): callable
    {
        return $this->routes;
    }





    /**
     * @inheritDoc
    */
    public function getCollector(): RouteCollectorInterface
    {
        return $this->collector;
    }



    /**
     * @inheritDoc
    */
    public function invoke(): mixed
    {
        return call_user_func($this->routes, $this->collector);
    }
}
