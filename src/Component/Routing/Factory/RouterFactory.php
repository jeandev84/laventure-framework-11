<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Factory;

use Laventure\Component\Routing\Router;
use Laventure\Component\Routing\RouterInterface;

/**
 * RouterFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Factory
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
