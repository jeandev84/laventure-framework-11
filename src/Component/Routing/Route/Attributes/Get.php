<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Attributes;

use Attribute;
use Laventure\Component\Routing\Route\Methods\Enums\HttpMethod;

/**
 * Get
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Attributes
 */
#[Attribute]
class Get extends Route
{
    public function __construct(string $path, string $name = '')
    {
        parent::__construct($path, [HttpMethod::GET], $name);
    }
}
