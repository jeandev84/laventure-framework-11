<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * ClientCookie
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Options
 */
class ClientCookie
{
    /**
     * @param string $cookieFile
     * @param string $cookieJar
    */
    public function __construct(
        public string $cookieFile,
        public string $cookieJar
    )
    {
    }
}
