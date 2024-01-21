<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\DTO;

use Laventure\Component\Http\Utils\Params\Parameter;

/**
 * HttpClientOptions
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\DTO
*/
class HttpClientOptions extends Parameter
{
    /**
     * @var array
    */
    protected array $options = [
        'query'              => [],           // type string[]
        'body'               => '',           // type array|string
        'json'               => null,         // type array|string
        'headers'            => [],           // type string[]
        'proxy'              => '',           // type string[]
        'auth_basic'         => null,         // type AuthBasic('YOUR_LOGIN', 'YOUR_PASSWORD')
        'auth_token'         => '',           // type AuthToken('YOUR_ACCESS_TOKEN')
        'upload'             => null,         // type string
        'download'           => null,         // type string
        'files'              => [],           // type ClientFileInterface[]
        'cookies'            => [],           // type ClientCookieInterface[]
    ];


    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }
}
