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
interface RouteInterface extends \ArrayAccess
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
     * @return string|null
     */
    public function getName(): ?string;





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
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static;




    /**
     * @param string $pattern
     *
     * @return $this
    */
    public function pattern(string $pattern): static;





    /**
     * @param array $methods
     *
     * @return $this
    */
    public function methods(array $methods): static;




    /**
     * @param mixed $action
     *
     * @return $this
    */
    public function action(mixed $action): static;




    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static;




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
    public function generateUri(array $params = []): string;
}