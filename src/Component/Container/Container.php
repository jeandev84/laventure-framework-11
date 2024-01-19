<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use Psr\Container\ContainerInterface;

/**
 * Container
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container
*/
class Container implements ContainerInterface, \ArrayAccess
{
    /**
     * @var static
    */
    protected static $instance;


    /**
     * @var array
    */
    protected array $bindings = [];




    /**
     * @param ContainerInterface $instance
     * @return static
    */
    public static function setInstance(ContainerInterface $instance): ContainerInterface
    {
        return static::$instance = $instance;
    }




    /**
     * @return ContainerInterface
    */
    public static function getInstance(): ContainerInterface
    {
        if (!static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }





    /**
     * @inheritDoc
    */
    public function get(string $id)
    {

    }



    /**
     * @inheritDoc
    */
    public function has(string $id): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {

    }



    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {

    }



    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {

    }
}
