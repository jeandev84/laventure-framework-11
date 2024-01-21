<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Cookies\DTO;

/**
 * SessionCookieParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\ClientCookie\DTO
*/
class SessionCookieParams
{
    /**
     * @param int $lifetimes
     * @param string|null $path
     * @param string|null $domain
     * @param bool|null $secure
     * @param bool|null $httponly
    */
    public function __construct(
        public  int    $lifetimes,
        public ?string $path = null,
        public ?string $domain = null,
        public ?bool   $secure = null,
        public ?bool   $httponly = null
    ) {
    }
}
