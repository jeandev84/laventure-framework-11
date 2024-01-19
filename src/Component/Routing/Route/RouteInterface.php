<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route;

use Laventure\Component\Routing\Route\Matcher\RouteMatcherInterface;

/**
 * RouteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route
*/
interface RouteInterface extends RouteMatcherInterface
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
     * Returns methods as string
     *
     * @return string
    */
    public function getMethodsAsString(): string;






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
     * route patterns
     *
     * @param array $patterns
     *
     * @return $this
    */
    public function wheres(array $patterns): static;





    /**
     * Requirement id
     *
     * @return $this
    */
    public function whereId(): static;





    /**
     * Requirement number
     *
     * @param string $name
     * @return $this
    */
    public function whereNumber(string $name): static;






    /**
     * Requirement text
     *
     * @param string $name
     * @return $this
    */
    public function whereText(string $name): static;







    /**
     * Requirement alphanumeric
     *
     * @param string $name
     * @return $this
    */
    public function whereAlphaNumeric(string $name): static;






    /**
     * Requirement sug
     *
     * @param string $name
     *
     * @return $this
    */
    public function whereSlug(string $name): static;






    /**
     * Requirements any things
     *
     * @param string $name
     *
     * @return $this
    */
    public function whereAnything(string $name): static;




    /**
     * Requirements where param in given values
     *
     * @param string $name
     *
     * @param array $values
     *
     * @return $this
    */
    public function whereIn(string $name, array $values): static;





    /**
     * Route middleware
     *
     * @param string $middleware
     *
     * @return $this
    */
    public function middleware(string $middleware): static;







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
     * Generate route path
     *
     * @param array $params
     *
     * @return string
    */
    public function generatePath(array $params = []): string;





    /**
     * Returns controller action if exist
     *
     * @return string|null
    */
    public function getController(): ?string;







    /**
     * Determine if the given action is callable
     *
     * @return bool
    */
    public function callable(): bool;






    /**
     * Return call route action
     *
     * @return mixed
    */
    public function call(): mixed;
}
