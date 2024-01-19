<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collector;

use Laventure\Component\Routing\Route\Attributes\Route;
use ReflectionException;

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
     * @throws ReflectionException
    */
    public function registerController(string $controller): void
    {
        $reflection = new \ReflectionClass($controller);
        $routeAttributes = $reflection->getAttributes(Route::class);
        $prefix     = '';
        $namePrefix = '';

        if (!empty($routeAttributes)) {
            /** @var Route $route */
            $route       = $routeAttributes[0]->newInstance();
            $prefix      = $route->getPath();
            $namePrefix  = $route->getName();
        }

        foreach ($reflection->getMethods() as $method) {
            $methodName = $method->getName();
            $attributes = $method->getAttributes(Route::class);

            if (empty($attributes)) {
                continue;
            }

            foreach ($attributes as $attribute) {
                /** @var Route $route */
                $route    = $attribute->newInstance();
                $methods  = $route->getMethods();
                $path     = $route->getPath();
                $name     = $route->getName();
                $wheres   = $route->getRequirements();
                $route = $this->map(
                    $methods,
                    $prefix. $path,
                    [$controller, $methodName],
                    $namePrefix.$name
                )
                ->wheres($wheres);
                $this->collection->addController($controller, $route);
            }
        }

        /*
        dump($this->collection->getControllers());
        dump($this->getRoutes());
        */
    }
}
