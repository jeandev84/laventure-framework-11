<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * AuthToken
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\DTO
 */
class AuthToken
{
    /**
     * @param string $accessToken
     */
    public function __construct(public string $accessToken)
    {
    }
}
