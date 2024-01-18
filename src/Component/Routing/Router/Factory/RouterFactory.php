<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Router\Factory;

use Laventure\Component\Routing\Router\Router;
use Laventure\Component\Routing\Router\RouterInterface;

/**
 * RouterFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Router\Factory
*/
class RouterFactory implements RouterFactoryInterface
{
    /**
     * @param string $namespace
    */
    public function __construct(protected string $namespace)
    {
    }




    /**
     * @inheritDoc
    */
    public function createRouter(): RouterInterface
    {
        return new Router($this->namespace);
    }
}
