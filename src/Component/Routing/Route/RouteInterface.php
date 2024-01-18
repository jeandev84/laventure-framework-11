<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route;

/**
 * RouteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route
*/
interface RouteInterface
{
    /**
     * Returns route path
     *
     * @return string
     */
    public function getPath(): string;






    /**
     * Returns route pattern
     *
     * @return string
     */
    public function getPattern(): string;





    /**
     * Returns route action will be executed.
     *
     * @return mixed
     */
    public function getAction(): mixed;





    /**
     * Returns name of route
     *
     * @return string
     */
    public function getName(): string;





    /**
     * Returns route methods
     *
     * @return array
    */
    public function getMethods(): array;





    /**
     * Returns route patterns
     *
     * @return array
   */
    public function getPatterns(): array;





    /**
     * Returns matches params from url
     *
     * @return array
    */
    public function getParams(): array;





    /**
     * Returns route middlewares
     *
     * @return array
    */
    public function getMiddlewares(): array;





    /**
     * Returns route options
     *
     * @return array
    */
    public function getOptions(): array;





    /**
     * Route patterns
     *
     * @param string $name
     * @param string $regex
     * @return $this
    */
    public function where(string $name, string $regex): static;






    /**
     * Route middleware
     *
     * @param string $middleware
     *
     * @return $this
    */
    public function middleware(string $middleware): static;





    /**
     * route patterns
     *
     * @param array $patterns
     *
     * @return $this
    */
    public function wheres(array $patterns): static;






    /**
     * route middlewares
     *
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewares(array $middlewares): static;






    /**
     * Collect route options
     *
     * @param array $options
     *
     * @return $this
    */
    public function options(array $options): static;





    /**
     * Determine if the given name exist in options
     *
     * @param string $name
     *
     * @return bool
    */
    public function hasOption(string $name): bool;






    /**
     * Returns route option
     *
     * @param string $name
     *
     * @param $default
     *
     * @return mixed
    */
    public function getOption(string $name, $default = null): mixed;







    /**
     * Determine if the current request match route
     *
     * @param string $method
     *
     * @param string $path
     *
     * @return bool
    */
    public function match(string $method, string $path): bool;






    /**
     * Generate route path
     *
     * @param array $params
     *
     * @return string
    */
    public function generatePath(array $params = []): string;
}
