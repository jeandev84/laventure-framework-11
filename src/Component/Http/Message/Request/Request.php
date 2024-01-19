<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request;

use Laventure\Component\Http\Message\Message;
use Laventure\Component\Http\Message\Request\Body\RequestBody;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Request
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request
*/
class Request extends Message implements RequestInterface
{

    /**
     * @var string
    */
    protected string $target;



    /**
     * @var string
    */
    protected string $method;




    /**
     * @var UriInterface
    */
    protected UriInterface $uri;



    /**
     * @param string $method
     *
     * @param UriInterface|string $uri
    */
    public function __construct(string $method, UriInterface|string $uri)
    {
        parent::__construct('', [], new RequestBody());

        if (!($uri instanceof UriInterface)) {
            $uri = new Uri($uri);
        }

        $this->uri    = $uri;
        $this->target = (string)$uri;
    }




    /**
     * @inheritDoc
    */
    public function getTarget(): string
    {
        return $this->target;
    }



    /**
     * @inheritDoc
    */
    public function withRequestTarget(string $requestTarget): static
    {
         $this->target = $requestTarget;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function getMethod(): string
    {
        return $this->method;
    }




    /**
     * @inheritDoc
    */
    public function withMethod(string $method): static
    {
         $this->method = $method;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }




    /**
     * @inheritDoc
    */
    public function withUri(UriInterface $uri, bool $preserveHost = false): static
    {
         $this->uri = $uri;

         return $this;
    }
}