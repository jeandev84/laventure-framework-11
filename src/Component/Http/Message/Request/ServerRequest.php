<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request;

use Laventure\Component\Http\Message\Request\Body\RequestBody;
use Laventure\Component\Http\Message\Request\Utils\Normalizer\FileNormalizer;
use Laventure\Component\Http\Message\Request\Utils\Params\ServerParams;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;

/**
 * ServerRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request
*/
class ServerRequest extends Request implements ServerRequestInterface
{
    /**
     * @var array
    */
    protected array $server = [];



    /**
     * @var array
    */
    protected array $cookies = [];



    /**
     * @var array
    */
    protected array $query = [];




    /**
     * @var UploadedFileInterface[]
    */
    protected array $uploadedFiles = [];




    /**
     * @var array|object|null
    */
    protected mixed $parsedBody = null;




    /**
     * @var array
    */
    protected array $attributes = [];




    /**
     * @param string $method
     * @param UriInterface|string $uri
     * @param array $server
    */
    public function __construct(string $method, UriInterface|string $uri, array $server = [])
    {
        parent::__construct($method, $uri);
        $this->server = $server;
    }




    /**
     * @inheritDoc
    */
    public function getServerParams(): array
    {
        return $this->server;
    }





    /**
     * @inheritDoc
    */
    public function getCookieParams(): array
    {
        return $this->cookies;
    }






    /**
     * @inheritDoc
    */
    public function withCookieParams(array $cookies): static
    {
        $this->cookies = $cookies;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getQueryParams(): array
    {
        return $this->query;
    }





    /**
     * @inheritDoc
    */
    public function withQueryParams(array $query): static
    {
        $this->query = $query;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getUploadedFiles(): array
    {
        return $this->uploadedFiles;
    }





    /**
     * @inheritDoc
    */
    public function withUploadedFiles(array $uploadedFiles): static
    {
        $this->uploadedFiles = array_merge(
            $this->uploadedFiles,
            $uploadedFiles
        );

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getParsedBody(): mixed
    {
        return $this->parsedBody;
    }




    /**
     * @inheritDoc
    */
    public function withParsedBody($data): static
    {
        $this->parsedBody = $data;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
        return $this->attributes;
    }





    /**
     * @inheritDoc
    */
    public function getAttribute(string $name, $default = null): mixed
    {
        return $this->attributes[$name] ?? $default;
    }





    /**
     * @inheritDoc
    */
    public function withAttribute(string $name, $value): static
    {
        $this->attributes[$name] = $value;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withoutAttribute(string $name): static
    {
        unset($this->attributes[$name]);

        return $this;
    }




    /**
     * @return static
    */
    public static function fromGlobals(): static
    {
        $server  = new ServerParams($_SERVER);
        $request = new self($server->getMethod(), $server->getUri(), $server->all());
        $request->withQueryParams($_GET)
                ->withParsedBody($_POST)
                ->withBody(new RequestBody())
                ->withHeaders($server->getHeaders())
                ->withCookieParams($_COOKIE)
                ->withUploadedFiles(FileNormalizer::normalize($_FILES))
                ->withProtocolVersion($server->getVersion());
        return $request;
    }
}
