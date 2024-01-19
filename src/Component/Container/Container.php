<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use Closure;
use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Facade\Facade;
use Laventure\Component\Container\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Provider\ServiceProvider;
use Laventure\Component\Container\Resolver\Dependency;
use Laventure\Component\Container\Resolver\DependencyInterface;
use Laventure\Component\Container\Utils\DTO\Bound;
use Laventure\Component\Container\Utils\DTO\BoundInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

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
     * @var ServiceProvider[]
    */
    protected array $providers = [];




    /**
     * @var array
     */
    protected array $provides = [];




    /**
     * @var Facade[]
    */
    protected array $facades = [];




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
     * @param array $bindings
     *
     * @return $this
    */
    public function bindings(array $bindings): static
    {
        foreach ($bindings as $id => $value) {
            $this->bind($id, $value);
        }

        return $this;
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
     * @param array $bindings
     * @return $this
    */
    public function singletons(array $bindings): static
    {
        foreach ($bindings as $id => $value) {
            $this->singleton($id, $value);
        }

        return $this;
    }






    /**
     * @param string $id
     * @param object $object
     * @return $this
    */
    public function instance(string $id, object $object): static
    {
        $this->instances[$id] = $object;

        return $this;
    }





    /**
     * @param array $instances
     * @return $this
    */
    public function instances(array $instances): static
    {
        foreach ($instances as $id => $object) {
            $this->instance($id, $object);
        }

        return $this;
    }







    /**
     * @param string $id
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
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
     * @throws ReflectionException
     */
    public function get(string $id)
    {
        $id = $this->alias($id);

        if ($this->has($id)) {

            $concrete = $this->bindings[$id];
            $value    = $this->resolveConcrete($concrete);

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
        // 1. Inspect if class exist
        if (!class_exists($id)) {
            throw new ContainerException("Could not make instance of ($id) in method (". __METHOD__. ")");
        }

        // 2. Inspect the class that we are trying to get from the container
        $reflection = new ReflectionClass($id);

        if (!$reflection->isInstantiable()) {
            throw new ContainerException("Class ($id) is not instantiable.");
        }

        // 3. Inspect the constructor of the class
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return $reflection->newInstance();
        }


        // 4. Inspect the constructor parameters (dependencies)
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
     * @param string $provider
     *
     * @return bool
     */
    public function hasProvider(string $provider): bool
    {
        return isset($this->providers[$provider]);
    }





    /**
     * @param string $provider
     * @return $this
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function addProvider(string $provider): static
    {
        if (!$this->hasProvider($provider)) {
            $service = $this->makeProvider($provider);
            $this->addProvides($provider, $service->getProvides());
            $service->setContainer($this);
            $this->bootProvider($service);
            $service->register();
            $this->providers[$provider] = $service;
        }

        return $this;
    }







    /**
     * @param Closure $func
     *
     * @param array $with
     *
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function callAnonymous(Closure $func, array $with = []): mixed
    {
        $with = $this->resolveDependencies(new ReflectionFunction($func), $with);

        return call_user_func_array($func, $with);
    }







    /**
     * @throws ContainerException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
    */
    public function call(string $class, string $method, array $with = []): mixed
    {
        $object = $this->make($class);
        $method = new ReflectionMethod($class, $method);

        if ($object instanceof ContainerAwareInterface) {
            $object->setContainer($this);
        }

        $with = $this->resolveDependencies($method, $with);

        return call_user_func_array([$object, $method->name], $with);
    }





    /**
     * @param string $provider
     * @return ServiceProvider
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function makeProvider(string $provider): ServiceProvider
    {
        return $this->get($provider);
    }






    /**
     * @param array $providers
     *
     * @return $this
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function addProviders(array $providers): static
    {
        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }

        return $this;
    }





    /**
     * @param string $facade
     * @return bool
     */
    public function hasFacade(string $facade): bool
    {
        return isset($this->facades[$facade]);
    }




    /**
     * @param string $facade
     * @return $this
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function addFacade(string $facade): static
    {
        if (!$this->hasFacade($facade)) {
            $this->facades[$facade] = $this->makeFacade($facade);
        }

        return $this;
    }






    /**
     * @param string $facade
     * @return Facade
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function makeFacade(string $facade): Facade
    {
        return $this->get($facade);
    }




    /**
     * @param array $facades
     *
     * @return $this
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function addFacades(array $facades): static
    {
        foreach ($facades as $facade) {
            $this->addFacade($facade);
        }

        return $this;
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
     * @return array
     */
    public function getFacades(): array
    {
        return $this->facades;
    }


    /**
     * @return array
     */
    public function getProviders(): array
    {
        return $this->providers;
    }



    /**
     * @return array
    */
    public function getProvides(): array
    {
        return $this->provides;
    }


    /**
     * @return array
    */
    public function getResolved(): array
    {
        return $this->resolved;
    }


    /**
     * @return array
    */
    public function getShared(): array
    {
        return $this->shared;
    }




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
     * @param $name
     * @return array|bool|mixed|object|string|null
     */
    public function __get($name)
    {
        return $this[$name];
    }




    /**
     * @param $name
     * @param $value
    */
    public function __set($name, $value)
    {
        $this[$name] = $value;
    }



    public function clear(): void
    {
        $this->bindings  = [];
        $this->instances = [];
        $this->aliases   = [];
        $this->resolved  = [];
        $this->provides  = [];
        $this->providers = [];
        $this->facades   = [];
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
     * @param BoundInterface $concrete
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    private function resolveConcrete(BoundInterface $concrete): mixed
    {
        $value = $concrete->value();

        if ($concrete->resolvable()) {
            return $this->resolve($value);
        }

        if ($concrete->callable()) {
            $value = $this->callAnonymous($value);
        }

        return $value;
    }




    /**
     * @param string $service
     *
     * @param array $provides
     *
     * @return void
     */
    private function addProvides(string $service, array $provides): void
    {
        foreach ($provides as $id => $aliases) {
            $this->aliases($id, $aliases);
        }

        $this->provides[$service] = $provides;
    }






    /**
     * @param ServiceProvider $provider
     *
     * @return void
    */
    private function bootProvider(ServiceProvider $provider): void
    {
        if($provider instanceof BootableServiceProvider) {
            $provider->boot();
        }
    }
}
