<?php
declare(strict_types=1);

namespace Laventure\Component\Routing;

use Laventure\Component\Routing\Route\Factory\RouteFactory;
use Laventure\Component\Routing\Route\Factory\RouteFactoryInterface;

/**
 * RoutingFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing
 */
class RoutingFactory
{

      /**
       * @return RouteFactoryInterface
      */
      public function createRouteFactory(): RouteFactoryInterface
      {
          return new RouteFactory();
      }
}