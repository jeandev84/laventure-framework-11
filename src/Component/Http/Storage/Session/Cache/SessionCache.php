<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Cache;

/**
 * SessionCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\Session\Cache
*/
class SessionCache implements SessionCacheInterface
{
    /**
     * @inheritDoc
    */
    public function limiter($value = null): false|string
    {
        return session_cache_limiter($value);
    }



    /**
     * @inheritDoc
    */
    public function expire($value = null): false|int
    {
        return session_cache_expire($value);
    }
}
