<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Response\Exception\JsonResponseException;

/**
 * JsonResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
*/
class JsonResponse extends Response
{
    /**
     * @var string[]
    */
    private static $defaultHeaders = [
        'Content-Type' => 'application/json; charset=UTF-8'
    ];


    /**
     * @param $data
     * @param int $status
     * @param array $headers
    */
    public function __construct($data, int $status = 200, array $headers = [])
    {
        $headers = array_merge(self::$defaultHeaders, $headers);

        parent::__construct($status, $headers);

        $this->setContent($this->encode($data));
    }




    /**
     * @param object|array $data
     * @return string
    */
    private function encode(object|array $data): string
    {
        $content = json_encode($data, $this->getJsonFlags());

        if (json_last_error()) {
            throw new JsonResponseException(json_last_error_msg());
        }

        return $content;
    }




    /**
     * @return int
    */
    private function getJsonFlags(): int
    {
        return JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    }
}
