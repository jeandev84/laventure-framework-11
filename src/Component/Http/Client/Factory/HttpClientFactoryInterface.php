<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Factory;

use Psr\Http\Client\ClientInterface;

/**
 * HttpClientFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Factory
 */
interface HttpClientFactoryInterface
{
    /**
     * @param array $options
     *
     * @return ClientInterface
    */
    public function createClient(array $options = []): ClientInterface;
}
