<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing\Factory;

use Laventure\Component\Routing\Route\Route;

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
      * @param $path
      * @param $action
      * @param $name
      * @return Route
     */
     public static function create($methods, $path, $action, $name): Route
     {
         return new Route($methods, $path, $action, $name);
     }
}