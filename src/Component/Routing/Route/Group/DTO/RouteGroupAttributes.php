<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group\DTO;

/**
 * RouteGroupAttributes
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group\DTO
*/
class RouteGroupAttributes implements RouteGroupAttributesInterface
{
    /**
     * @param string $path
     *
     * @param string $namespace
     *
     * @param string $name
     *
     * @param array $middlewares
    */
    public function __construct(
        private readonly string $path,
        private readonly string $namespace,
        private readonly string $name,
        private readonly array $middlewares
    ) {
    }


    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }



    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return $this->namespace;
    }



    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }



    /**
     * @inheritDoc
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
