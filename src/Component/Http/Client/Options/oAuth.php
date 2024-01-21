<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * oAuth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\DTO
 */
class oAuth extends AuthToken
{
    public function __construct(string $accessToken)
    {
        parent::__construct("oAuth $accessToken");
    }
}
