<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client;

use Laventure\Component\Http\Client\Factory\HttpClientFactory;
use Laventure\Component\Http\Client\Factory\HttpClientFactoryInterface;
use Laventure\Component\Http\Message\Request\Factory\RequestFactory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * HttpClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client
*/
class HttpClient implements HttpClientInterface
{


    /**
     * @var RequestFactoryInterface
    */
    protected RequestFactoryInterface $requestFactory;
    protected HttpClientFactoryInterface $clientFactory;


    /**
     * @param RequestFactoryInterface|null $requestFactory
     * @param HttpClientFactoryInterface|null $clientFactory
    */
    public function __construct(
        RequestFactoryInterface $requestFactory = null,
        HttpClientFactoryInterface $clientFactory = null
    )
    {
        $this->requestFactory = $requestFactory ?: new RequestFactory();
        $this->clientFactory = $clientFactory ?: new HttpClientFactory();
    }




    /**
     * @return static
    */
    public static function create(): static
    {
        return new static();
    }




    /**
     * @inheritDoc
    */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
          $request = $this->requestFactory->createRequest($method, $url);
          $client  = $this->clientFactory->createClient($options);
          return $client->sendRequest($request);
    }


}