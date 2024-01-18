<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing\Factory;

use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteTestFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Routing\Factory
 */
class RouteTestFactory
{

        /**
         * @param $methods
         * @param string $path
         * @param mixed $action
         * @param string $name
         * @return RouteInterface
        */
         public static function create($methods, string $path, mixed $action, string $name = ''): RouteInterface
         {
             return new Route($methods, $path, $action, $name);
         }
}