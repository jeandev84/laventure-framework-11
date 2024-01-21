<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use Laventure\Component\Http\Message\Message;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;


/**
 * CurlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
class CurlRequest extends Message implements RequestInterface
{

    /**
     * @inheritDoc
    */
    public function getTarget(): string
    {
        // TODO: Implement getTarget() method.
    }





    /**
     * @inheritDoc
    */
    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        // TODO: Implement withRequestTarget() method.
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        // TODO: Implement getMethod() method.
    }

    /**
     * @inheritDoc
     */
    public function withMethod(string $method): RequestInterface
    {
        // TODO: Implement withMethod() method.
    }

    /**
     * @inheritDoc
     */
    public function getUri(): UriInterface
    {
        // TODO: Implement getUri() method.
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        // TODO: Implement withUri() method.
    }
}