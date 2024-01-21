<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options\Auth;

/**
 * AuthBearer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Options\Auth
 */
class AuthBearer extends AuthToken
{
    /**
     * @param string $accessToken
    */
    public function __construct(string $accessToken)
    {
        parent::__construct("Bearer $accessToken");
    }
}
