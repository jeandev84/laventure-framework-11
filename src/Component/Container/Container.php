<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Resolver\Dependency;
use Laventure\Component\Container\Resolver\DependencyInterface;
use Laventure\Component\Container\Utils\DTO\Bound;
use Laventure\Component\Container\Utils\DTO\BoundInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionFunctionAbstract;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use Throwable;

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
     * @var BoundInterface[]
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
     * @return BoundInterface
    */
    public function bind(string $id, mixed $concrete): BoundInterface
    {
        return $this->bindings[$id] = new Bound($id, $concrete);
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
        return (function () use ($id) {
            return $this->make($id);
        });
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
     * @throws ReflectionException
     */
    public function get(string $id)
    {
        $id = $this->alias($id);

        if ($this->has($id)) {

            $concrete = $this->getConcrete($id);
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
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
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
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function make(string $id, array $with = []): mixed
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflection = new ReflectionClass($id);

        if (!$reflection->isInstantiable()) {
            throw new ContainerException('class "'. $id . '" is not instantiable');
        }

        // 2. Inspect the constructor of the class
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return $reflection->newInstance();
        }


        // 3. Inspect the constructor parameters (dependencies)
        if (!$constructor->getParameters()) {
            return $reflection->newInstance();
        }

        $dependencies = $this->resolveDependencies($constructor, $with);

        return $reflection->newInstanceArgs($dependencies);
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
    public function alias(string $id): string
    {
        return $this->aliases[$id] ?? $id;
    }




    /**
     * @param string $id
     * @return BoundInterface|null
    */
    public function getConcrete(string $id): ?BoundInterface
    {
        return $this->bindings[$id] ?? null;
    }




    /**
     * @return DependencyInterface
    */
    public function getResolver(): DependencyInterface
    {
        return new Dependency($this);
    }



    /**
     * @return array
    */
    public function getAliases(): array
    {
        return $this->aliases;
    }





    /**
     * @return BoundInterface[]
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
        unset($this->bindings[$offset]);
    }



    /**
     * @param ReflectionFunctionAbstract $func
     *
     * @param array $with
     *
     * @return array
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    private function resolveDependencies(ReflectionFunctionAbstract $func, array $with = []): array
    {
        return $this->getResolver()->resolveDependencies($func, $with);
    }




    /**
     * @param ReflectionParameter $parameter
     *
     * @param array $with
     *
     * @return mixed
     *
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
     */
    private function resolveDependency(ReflectionParameter $parameter, array $with = []): mixed
    {
        $name = $parameter->getName();
        $type = $parameter->getType();

        if (array_key_exists($name, $with)) {
            return $with[$name];
        }

        if ($parameter->isOptional()) {
            return $parameter->getDefaultValue();
        }

        if (!$type) {
            throw new ContainerException('Failed to resolve parameter "'. $name . '" is missing a type hint.');
        }

        if ($type instanceof ReflectionUnionType) {
            throw new ContainerException('Failed to resolve parameter because of union type for param "'. $name . '"');
        }

        if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
            return $this->get($type->getName());
        }

        throw new ContainerException('Failed to resolve because invalid param "'. $name . '"');
    }
}
