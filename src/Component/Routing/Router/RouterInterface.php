<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Router;

use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Router
*/
interface RouterInterface
{
    /**
     * Determine if the current request match route
     *
     * @param string $method
     *
     * @param string $path
     *
     * @return RouteInterface|false
    */
    public function match(string $method, string $path): RouteInterface|false;





    /**
     * Generate route path
     *
     * @param string $name
     * @param array $params
     * @return string|null
    */
    public function generate(string $name, array $params = []): ?string;





    /**
     * Determine if exists route by given name
     *
     * @param string $name
     *
     * @return bool
    */
    public function has(string $name): bool;






    /**
     * Returns named route
     *
     * @param string $name
     *
     * @return RouteInterface|null
    */
    public function getRoute(string $name): ?RouteInterface;
}
