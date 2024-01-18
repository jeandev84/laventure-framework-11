<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group\Invoker;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Group\DTO\RouteGroupAttributesInterface;

/**
 * GroupInvokerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group\Invoker
*/
interface GroupInvokerInterface
{
    /**
     * @return RouteGroupAttributesInterface
    */
    public function getAttributes(): RouteGroupAttributesInterface;




    /**
     * @return callable
    */
    public function getRoutes(): callable;





    /**
     * Returns route collector
     *
     * @return RouteCollectorInterface
    */
    public function getCollector(): RouteCollectorInterface;





    /**
     * Call routes (calling routes invoker)
     *
     * @return mixed
    */
    public function invoke(): mixed;
}
