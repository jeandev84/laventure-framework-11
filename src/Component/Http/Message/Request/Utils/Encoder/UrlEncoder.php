<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Utils\Encoder;

/**
 * UrlEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Utils\Encoder
*/
class UrlEncoder
{
    /**
     * @param string $path
     * @return string
    */
    public static function encode(string $path): string
    {
        return urlencode($path);
    }





    /**
     * @param string $path
     * @return string
    */
    public static function decode(string $path): string
    {
        return urldecode($path);
    }
}
