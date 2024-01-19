<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Factory;

use Laventure\Component\Routing\RouterInterface;

/**
 * RouterFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Factory
 */
interface RouterFactoryInterface
{
    /**
     * @return RouterInterface
    */
    public function createRouter(): RouterInterface;
}
