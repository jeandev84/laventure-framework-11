<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Utils;

use Laventure\Component\Http\Utils\Params\Parameter;

/**
 * ResponseHeaders
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Utils
*/
class ResponseHeaders
{
    /**
     * @param array $headers
     *
     * @return array
    */
    public static function list(array $headers = []): array
    {
        if (!function_exists('headers_list')) {
            return $headers;
        }

        return array_merge(headers_list(), $headers);
    }
}
