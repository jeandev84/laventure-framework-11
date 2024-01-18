<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resolver;

use Laventure\Component\Routing\Route\Group\RouteGroupInterface;

/**
 * RouteResolverFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resolver
 */
interface RouteResolverFactoryInterface
{
    /**
     * @param RouteGroupInterface $group
     * @param string $namespace
     * @return RouteResolverInterface
    */
    public function createRouteResolver(
        RouteGroupInterface $group,
        string $namespace
    ): RouteResolverInterface;
}
