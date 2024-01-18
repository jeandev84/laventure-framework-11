<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group;

use Laventure\Component\Routing\Route\Group\DTO\RouteGroupAttributesInterface;
use Laventure\Component\Routing\Route\Group\Invoker\GroupInvokerInterface;

/**
 * RouteGroup
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group
*/
class RouteGroup implements RouteGroupInterface
{
    /**
     * @var array
    */
    protected array $path = [];



    /**
     * @var array
    */
    protected array $namespaces = [];



    /**
     * @var array
    */
    protected array $name = [];



    /**
     * @var array
    */
    protected array $middlewares = [];



    /**
     * @inheritDoc
     */
    public function path(string $path): static
    {
        $this->path[] = trim($path, '/');

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function namespace(string $namespace): static
    {
        $this->namespaces[] = trim($namespace, '\\');

        return $this;
    }



    /**
     * @inheritDoc
     */
    public function name(string $name): static
    {
        $this->name[] = $name;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function middlewares(array $middlewares): static
    {
        $this->middlewares = array_merge(
            $this->middlewares,
            $middlewares
        );

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return join('/', $this->path);
    }



    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return join("\\", $this->namespaces);
    }



    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return join($this->name);
    }



    /**
     * @inheritDoc
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }



    /**
     * @inheritDoc
    */
    public function group(GroupInvokerInterface $invoker): mixed
    {
        $this->attributes($invoker->getAttributes());
        $invoker->invoke();
        $this->clear();
        return $this;
    }




    /**
     * @param RouteGroupAttributesInterface $dto
     *
     * @return $this
    */
    public function attributes(RouteGroupAttributesInterface $dto): static
    {
        $this->path($dto->getPath())
             ->namespace($dto->getNamespace())
             ->name($dto->getName())
             ->middlewares($dto->getMiddlewares());

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->path   = [];
        $this->namespaces = [];
        $this->middlewares = [];
        $this->name = [];
    }
}
