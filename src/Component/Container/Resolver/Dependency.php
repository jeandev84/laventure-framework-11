<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Resolver;

use Laventure\Component\Container\Exception\ContainerException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use ReflectionFunctionAbstract;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

/**
 * Dependency
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Resolver
 */
class Dependency implements DependencyInterface
{
    /**
     * @var ContainerInterface
    */
    protected ContainerInterface $container;



    /**
     * @param ContainerInterface $container
    */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }



    /**
     * @inheritDoc
    */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }


    /**
     * @inheritdoc
    */
    public function resolveDependencies(ReflectionFunctionAbstract $func, array $with = []): array
    {
        return array_map(function (ReflectionParameter $parameter) use ($with) {
            return $this->resolveDependency($parameter, $with);

        }, $func->getParameters());
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
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    public function resolveDependency(ReflectionParameter $parameter, array $with = []): mixed
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
            return $this->container->get($type->getName());
        }

        if ($value = $this->container->get($name)) {
            return $value;
        }

        throw new ContainerException('Failed to resolve because invalid param "'. $name . '"');
    }
}
