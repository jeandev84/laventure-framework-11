<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * Body
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\DTO
*/
class Body
{
    /**
     * @param array|string $data
    */
    public function __construct(public array|string $data)
    {
    }
}
