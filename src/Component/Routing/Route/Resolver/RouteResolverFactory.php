<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resolver;

use Laventure\Component\Routing\Route\Group\RouteGroupInterface;

/**
 * RouteResolverFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resolver
 */
class RouteResolverFactory implements RouteResolverFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createRouteResolver(
        RouteGroupInterface $group,
        string $namespace
    ): RouteResolverInterface {
        return new RouteResolver($group, $namespace);
    }
}
