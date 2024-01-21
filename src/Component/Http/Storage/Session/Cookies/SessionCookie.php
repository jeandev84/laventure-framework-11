<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Cookies;

use Laventure\Component\Http\Storage\Session\Cookies\DTO\SessionCookieParams;

/**
 * SessionCookie
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\ClientCookie
 */
class SessionCookie implements SessionCookieInterface
{
    /**
     * @inheritDoc
    */
    public function setParams(SessionCookieParams $dto): bool
    {
        return session_set_cookie_params(
            $dto->lifetimes,
            $dto->path,
            $dto->domain,
            $dto->secure,
            $dto->httponly
        );
    }



    /**
     * @param array $options
     * @return bool
    */
    public function setParamsFromArray(array $options): bool
    {
        return session_set_cookie_params($options);
    }



    /**
     * @inheritDoc
    */
    public function getParams(): array
    {
        return session_get_cookie_params();
    }
}
