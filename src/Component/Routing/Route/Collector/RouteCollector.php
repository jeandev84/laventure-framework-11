<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collector;


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

         dd($reflection);
    }
}
