<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Router\Factory;

use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Router\RouterInterface;

/**
 * RouterFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Router\Factory
 */
interface RouterFactoryInterface
{
    /**
     * @param RouteCollection $collection
     *
     * @return RouterInterface
    */
    public function createRouter(RouteCollection $collection): RouterInterface;
}
