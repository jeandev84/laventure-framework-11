<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Factory;

use Laventure\Component\Http\Client\Service\CurlClient;
use Psr\Http\Client\ClientInterface;

/**
 * HttpClientFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Factory
 */
class HttpClientFactory implements HttpClientFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createClient(array $options = []): ClientInterface
    {
        return new CurlClient($options);
    }
}
