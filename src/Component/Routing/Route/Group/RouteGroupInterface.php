<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group;

use Laventure\Component\Routing\Route\Group\Invoker\GroupInvokerInterface;

/**
 * RouteGroupInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group
 */
interface RouteGroupInterface
{
    /**
     * Returns path
     *
     * @return string
    */
    public function getPath(): string;




    /**
     * Returns namespace
     *
     * @return string
    */
    public function getNamespace(): string;



    /**
     * Returns name
     *
     * @return string
    */
    public function getName(): string;




    /**
     * Returns middlewares
     *
     * @return array
    */
    public function getMiddlewares(): array;





    /**
     * @param string $path
     * @return $this
    */
    public function path(string $path): static;




    /**
     * @param string $namespace
     * @return $this
    */
    public function namespace(string $namespace): static;




    /**
     * @param string $name
     * @return $this
    */
    public function name(string $name): static;




    /**
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewares(array $middlewares): static;





    /**
     * @param GroupInvokerInterface $invoker
     *
     * @return mixed
    */
    public function group(GroupInvokerInterface $invoker): mixed;






    /**
     * Refresh attributes
     *
     * @return void
    */
    public function clear(): void;
}
