<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;

use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Message\Response\Response;
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
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
         $curlRequest = new CurlRequest($request->getMethod(), $request->getUri());
         $response = new Response(400);
         $response->getBody()->write('Salut les amis');
         return $response;
    }
}