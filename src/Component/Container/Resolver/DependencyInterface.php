<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Resolver;

use Laventure\Component\Container\Exception\ContainerException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use ReflectionFunctionAbstract;
use ReflectionParameter;

/**
 * DependencyInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Resolver
*/
interface DependencyInterface
{
    /**
     * @return ContainerInterface
    */
    public function getContainer(): ContainerInterface;




    /**
     * @param ReflectionFunctionAbstract $func
     * @param array $with
     * @return array
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function resolveDependencies(ReflectionFunctionAbstract $func, array $with = []): array;





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
    public function resolveDependency(ReflectionParameter $parameter, array $with = []): mixed;
}
