<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Factory;

use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Factory
*/
class RouteFactory implements RouteFactoryInterface
{
    /**
     * @inheritdoc
    */
    public function createRoute(
        array $methods,
        string $path,
        mixed $action,
        string $name = ''
    ): RouteInterface {
        return new Route($methods, $path, $action, $name);
    }
}
