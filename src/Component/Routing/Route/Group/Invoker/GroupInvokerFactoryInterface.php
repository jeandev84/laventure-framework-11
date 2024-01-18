<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group\Invoker;

use Closure;
use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;

/**
 * GroupInvokerFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group\Invoker
 */
interface GroupInvokerFactoryInterface
{
    /**
      * @param array $attributes
      * @param Closure $routes
      * @param RouteCollectorInterface $collector
      * @return GroupInvokerInterface
     */
    public function createInvoker(
        array $attributes,
        Closure $routes,
        RouteCollectorInterface $collector
    ): GroupInvokerInterface;
}
