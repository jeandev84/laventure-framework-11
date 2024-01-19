<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Attributes;

use Attribute;

/**
 * Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Attributes
*/
#[Attribute]
class Route
{
    public function __construct(
        public string $path,
        public array $methods,
        public string $name = ''
    ) {
    }
}
