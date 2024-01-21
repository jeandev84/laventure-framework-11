<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Cookies;

use Laventure\Component\Http\Storage\Session\Cookies\DTO\SessionCookieParams;

/**
 * SessionCookieInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\ClientCookie
 */
interface SessionCookieInterface
{
    /**
     * @param SessionCookieParams $dto
     *
     * @return mixed
    */
    public function setParams(SessionCookieParams $dto): mixed;




    /**
     * @param array $options
     *
     * @return mixed
    */
    public function setParamsFromArray(array $options): mixed;





    /**
     * @return mixed
    */
    public function getParams(): mixed;
}
