<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Configuration;

use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Factory\RouteFactoryInterface;
use Laventure\Component\Routing\Route\Group\RouteGroupInterface;
use Laventure\Component\Routing\Route\Resolver\RouteResolverInterface;

/**
 * RouterConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Configuration
*/
interface RouterConfigurationInterface
{
    /**
     * Returns route factory
     *
     * @return RouteFactoryInterface
    */
    public function getRouteFactory(): RouteFactoryInterface;


    /**
     * Returns route collection
     *
     * @return RouteCollectionInterface
    */
    public function getRouteCollection(): RouteCollectionInterface;



    /**
     * Returns route group
     *
     * @return RouteGroupInterface
    */
    public function getRouteGroup(): RouteGroupInterface;




    /**
     * Route resolve
     *
     * @return RouteResolverInterface
    */
    public function getRouteResolver(): RouteResolverInterface;




    /**
     * Returns controller namespace
     *
     * @return string
    */
    public function getNamespace(): string;
}
