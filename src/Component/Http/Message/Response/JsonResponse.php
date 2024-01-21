<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Response\Exception\JsonResponseException;
use Laventure\Component\Http\Message\Response\Utils\JsonEncoder;

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

        $this->setContent(JsonEncoder::encode($data));
    }
}
