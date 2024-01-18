<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resolver;

/**
 * RouteResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resolver
 */
interface RouteResolverInterface
{
    /**
     * Resolve route methods
     *
     * @param $methods
     *
     * @return array
    */
    public function resolveMethods($methods): array;



    /**
     * Resolve route path
     *
     * @param string $path
     * @return string
    */
    public function resolvePath(string $path): string;




    /**
     * Resolve route action
     *
     * @param mixed $action
     * @return mixed
    */
    public function resolveAction(mixed $action): mixed;





    /**
     * @param string $name
     *
     * @return string
    */
    public function resolveName(string $name): string;





    /**
     * @param array $middlewares
     *
     * @return array
    */
    public function resolveMiddlewares(array $middlewares): array;
}
