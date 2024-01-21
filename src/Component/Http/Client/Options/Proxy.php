<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * Proxy
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\DTO
 */
class Proxy
{
    public function __construct(
        public string $value,
        public int    $timeout = 400
    ) {
    }
}
