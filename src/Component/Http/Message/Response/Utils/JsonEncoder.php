<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Utils;

use Laventure\Component\Http\Message\Response\Exception\JsonResponseException;

/**
 * JsonEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Utils
 */
class JsonEncoder
{
    /**
     * @param object|array $data
     * @return string
    */
    public static function encode(object|array $data): string
    {
        $content = json_encode($data, static::getJsonFlags());

        if (json_last_error()) {
            throw new JsonResponseException(json_last_error_msg());
        }

        return $content;
    }




    /**
     * @return int
    */
    private static function getJsonFlags(): int
    {
        return JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    }
}
