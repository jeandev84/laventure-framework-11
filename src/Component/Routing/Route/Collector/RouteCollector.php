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
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Factory\ResourceFactory;
use Laventure\Component\Routing\Route\Resource\Factory\ResourceFactoryInterface;
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
     * @inheritDoc
    */
    public function resource(string $name, string $controller): static
    {
          return $this->addResource($this->makeWebResource($name, $controller));
    }




    /**
     * @inheritDoc
    */
    public function apiResource(string $name, string $controller): static
    {
        return $this->addResource($this->makeApiResource($name, $controller));
    }




    /**
     * @inheritDoc
    */
    public function group(array $attributes, Closure $routes): static
    {
         $this->group->group(
             $this->groupInvokerFactory->createInvoker($attributes, $routes, $this)
         );

         return $this;
    }
}