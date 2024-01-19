<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Attributes;

use Laventure\Component\Routing\Route\Methods\Enums\HttpMethod;

/**
 * Patch
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Attributes
 */
class Patch extends Route
{
    public function __construct(string $path, string $name = '')
    {
        parent::__construct($path, [HttpMethod::PATCH], $name);
    }
}
