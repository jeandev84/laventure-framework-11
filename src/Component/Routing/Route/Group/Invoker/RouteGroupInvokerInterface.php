<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group\Invoker;


use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Group\DTO\RouteGroupAttributesInterface;

/**
 * RouteGroupInvokerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group\Invoker
*/
interface RouteGroupInvokerInterface
{

      /**
       * @return RouteGroupAttributesInterface
      */
      public function getAttributes(): RouteGroupAttributesInterface;




      /**
       * @return callable
      */
      public function getRoutesInvoker(): callable;





      /**
       * Returns route collector
       *
       * @return RouteCollectorInterface
      */
      public function getRouteCollector(): RouteCollectorInterface;





      /**
       * Call routes (calling routes invoker)
       *
       * @return mixed
      */
      public function invoke(): mixed;
}