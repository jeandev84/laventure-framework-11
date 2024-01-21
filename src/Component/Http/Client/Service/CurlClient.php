<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;

use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Client\Request\Exception\CurlException;
use Laventure\Component\Http\Client\Utils\HttpClientOptions;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * CurlClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service
*/
class CurlClient implements ClientInterface
{
    /**
     * @var array
    */
    protected array $options = [];


    /**
     * @param array $options
    */
    public function __construct(array $options)
    {
        $this->options = $options;
    }



    /**
     * @inheritDoc
     * @throws CurlException
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $curlRequest = new CurlRequest($request->getMethod(), $request->getUri());
        $curlRequest->withOptions($this->options);
        return $curlRequest->send();
    }
}
