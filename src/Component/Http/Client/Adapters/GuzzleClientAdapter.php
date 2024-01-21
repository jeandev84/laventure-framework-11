<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Adapters;

use Laventure\Component\Http\Client\HttpClientInterface;
use Laventure\Component\Http\Message\Response\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * GuzzleClientAdapter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Adapters
 */
class GuzzleClientAdapter implements HttpClientInterface
{
    /**
     * @inheritDoc
    */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        // TODO implements
        return new Response();
    }
}
