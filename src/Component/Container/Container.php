<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use Laventure\Component\Container\DTO\BoundBoundConcrete;
use Laventure\Component\Container\DTO\BoundConcreteInterface;
use Laventure\Component\Container\Utils\Reflection\Reflection;
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
     * @var BoundConcreteInterface[]
    */
    protected array $bindings = [];


    /**
     * @var array
    */
    protected array $aliases = [];



    /**
     * @var array
    */
    protected array $instances = [];



    /**
     * @var array
    */
    protected array $resolved = [];



    /**
     * @var array
    */
    protected array $shared = [];




    /**
     * @param ContainerInterface $instance
     * @return static
    */
    public static function setInstance(ContainerInterface $instance): ContainerInterface
    {
        return static::$instance = $instance;
    }



    /**
     * @return Container
    */
    public static function getInstance(): static
    {
        if (!static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }




    /**
     * @param string $id
     * @param mixed $concrete
     * @return BoundConcreteInterface
    */
    public function bind(string $id, mixed $concrete): BoundConcreteInterface
    {
        return $this->bindings[$id] = new BoundBoundConcrete($id, $concrete);
    }




    /**
     * @param string $id
     * @param mixed $value
     * @return $this
    */
    public function singleton(string $id, mixed $value): static
    {
        $this->bind($id, $value)->share(true);

        return $this;
    }




    /**
     * @param string $id
     * @param mixed $value
     * @return $this
    */
    public function instance(string $id, mixed $value): static
    {
        $this->instances[$id] = $value;

        return $this;
    }




    /**
     * @param string $id
     * @return mixed
    */
    public function factory(string $id): mixed
    {
        return $this->make($id);
    }



    /**
     * @param string $id
     * @param mixed $value
     * @return mixed
    */
    public function share(string $id, mixed $value): mixed
    {
         if (!isset($this->shared[$id])) {
             $this->shared[$id] = $value;
         }

         return $this->shared[$id];
    }




    /**
     * @inheritDoc
    */
    public function get(string $id)
    {
        $id = $this->getAlias($id);

        if ($this->has($id)) {

            $concrete = $this->concrete($id);
            $value    = $concrete->value();

            if ($concrete->shared()) {
                return $this->share($id, $value);
            }

            return $value;
        }

        return $this->resolve($id);
    }




    /**
     * @param string $id
     * @param array $with
     * @return mixed
    */
    public function resolve(string $id, array $with = []): mixed
    {
         if ($this->resolved($id)) {
             return $this->resolved[$id];
         }

         if ($this->hasInstance($id)) {
             $instance = $this->instances[$id];
         } else {
             $instance = $this->make($id, $with);
         }

         return $this->resolved[$id] = $instance;
    }



    /**
     * @param string $id
     * @param array $with
     * @return mixed
    */
    public function make(string $id, array $with = []): mixed
    {
        $reflection = new Reflection($id);

        dd($reflection);
    }




    /**
     * @param string $id
     * @return bool
    */
    public function resolved(string $id): bool
    {
        return isset($this->resolved[$id]);
    }



    /**
     * @param string $id
     * @return bool
    */
    public function bound(string $id): bool
    {
        return isset($this->bindings[$id]);
    }



    /**
     * @inheritDoc
    */
    public function has(string $id): bool
    {
        return $this->bound($id);
    }





    /**
     * @param string $id
     * @return bool
    */
    public function hasInstance(string $id): bool
    {
        return isset($this->instances[$id]);
    }




    /**
     * @param string $id
     * @param array $aliases
     * @return $this
    */
    public function aliases(string $id, array $aliases): static
    {
        foreach ($aliases as $alias) {
            $this->aliases[$alias] = $id;
        }

        return $this;
    }




    /**
     * @param string $id
     * @return string
    */
    public function getAlias(string $id): string
    {
        return $this->aliases[$id] ?? $id;
    }




    /**
     * @param string $id
     * @return BoundConcreteInterface|null
    */
    public function concrete(string $id): ?BoundConcreteInterface
    {
        return $this->bindings[$id] ?? null;
    }





    /**
     * @return array
    */
    public function getAliases(): array
    {
        return $this->aliases;
    }





    /**
     * @return BoundConcreteInterface[]
    */
    public function getBindings(): array
    {
        return $this->bindings;
    }



    /**
     * @return array
    */
    public function getInstances(): array
    {
        return $this->instances;
    }




    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }



    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->bind($offset, $value);
    }



    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {

    }
}
