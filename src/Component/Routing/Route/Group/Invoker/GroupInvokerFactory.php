<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group\Invoker;

use Closure;
use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;

/**
 * GroupInvokerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group\Invoker
 */
class GroupInvokerFactory implements GroupInvokerFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createInvoker(array $attributes, Closure $routes, RouteCollectorInterface $collector): GroupInvokerInterface
    {
        return new GroupInvoker($attributes, $routes, $collector);
    }
}
