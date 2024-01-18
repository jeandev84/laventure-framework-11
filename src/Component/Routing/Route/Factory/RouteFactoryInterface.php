<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Factory;

use Laventure\Component\Routing\Route\Resolver\RouteResolverInterface;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Factory
*/
interface RouteFactoryInterface
{
    /**
     * @param array $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function createRoute(
        array $methods,
        string $path,
        mixed  $action,
        string $name = ''
    ): RouteInterface;
}
