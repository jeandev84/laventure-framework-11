<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Cache;

/**
 * SessionCacheInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Cache
*/
interface SessionCacheInterface
{
    /**
     * @param null $value
     * @return mixed
    */
    public function limiter($value = null): mixed;



    /**
     * @param null $value
     * @return mixed
    */
    public function expire($value = null): mixed;
}
