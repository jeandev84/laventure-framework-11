<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route;

/**
 * Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route
*/
class Route implements RouteInterface
{

    /**
     * route methods
     *
     * @var array
    */
    protected array $methods = [];


    /**
     * route path
     *
     * @var string
    */
    protected string $path;




    /**
     * route action
     *
     * @var mixed
    */
    protected mixed $action;




    /**
     * route name
     *
     * @var string
    */
    protected string $name = '';




    /**
     * route pattern
     *
     * @var string
    */
    protected string $pattern;



    /**
     * @var array
    */
    protected array $wheres = [];



    /**
     * route patterns
     *
     * @var array
    */
    protected array $patterns = [];




    /**
     * route patterns replaces
     *
     * @var array
    */
    protected array $replaces = [];





    /**
     * route params
     *
     * @var array
    */
    protected array $params = [];




    /**
     * route options
     *
     * @var array
    */
    protected array $options = [];




    /**
     * route middlewares
     *
     * @var array
    */
    protected array $middlewares = [];



    /**
     * @param array $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
    */
    public function __construct(array $methods, string $path, mixed $action, string $name = '')
    {
        $this->methods($methods)
             ->path($path)
             ->action($action)
             ->name($name);
    }



    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }




    /**
     * @inheritDoc
    */
    public function getAction(): mixed
    {
         return $this->action;
    }





    /**
     * @inheritDoc
    */
    public function getName(): ?string
    {
         return $this->name;
    }



    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {
        return $this->methods;
    }




    /**
     * @inheritDoc
    */
    public function getPattern(): string
    {
        return $this->pattern;
    }



    /**
     * @inheritDoc
    */
    public function getPatterns(): array
    {
        return $this->patterns;
    }



    /**
     * @inheritDoc
    */
    public function getParams(): array
    {
        return $this->params;
    }




    /**
     * @inheritDoc
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }



    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }





    /**
     * @inheritdoc
    */
    public function methods(array $methods): static
    {
         $this->methods = $methods;

         return $this;
    }




    /**
     * @inheritdoc
    */
    public function path(string $path): static
    {
        $this->path = $this->normalizePath($path);

        $this->pattern($this->path);

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function action(mixed $action): static
    {
        $this->action = $action;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function pattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }




    /**
     * Route patterns
     *
     * @param string $name
     * @param string $regex
     * @return $this
    */
    public function where(string $name, string $regex): static
    {
        $resolver              = new RoutePattern($name, $regex);
        $this->wheres[$name]   = $resolver->getPatterns();
        $this->replaces[$name] = $resolver->getReplaces();
        $this->pattern         = $resolver->replace($this->pattern);
        $this->patterns[$name] = $regex;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function wheres(array $patterns): static
    {
        foreach ($patterns as $name => $regex) {
            $this->where($name, $regex);
        }

        return $this;
    }




    /**
     * @param string $middleware
     *
     * @return $this
    */
    public function middleware(string $middleware): static
    {
        $this->middlewares[] = $middleware;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function middlewares(array $middlewares): static
    {
         foreach ($middlewares as $middleware) {
             $this->middleware($middleware);
         }

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function options(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }




    /**
     * Determine if the given name exist in options
     *
     * @param string $name
     *
     * @return bool
    */
    public function hasOption(string $name): bool
    {
        return isset($this->options[$name]);
    }





    /**
     * @param string $name
     *
     * @param $default
     *
     * @return mixed
    */
    public function getOption(string $name, $default = null): mixed
    {
        return $this->options[$name] ?? $default;
    }



    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): bool
    {

    }



    /**
     * @inheritDoc
    */
    public function generateUri(array $params = []): string
    {

    }



    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return property_exists($this, $offset);
    }



    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (!$this->offsetExists($offset)) {
            return false;
        }

        return $this->{$offset};
    }



    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($this->offsetExists($offset)) {
            $this->{$offset} = $value;
        }
    }



    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->{$offset});
        }
    }





    /**
     * @param string $path
     * @return string
    */
    private function normalizePath(string $path): string
    {
        return sprintf('/%s', trim($path, '/'));
    }



    /**
     * @param string $regex
     * @return string
    */
    private function normalizeRegex(string $regex): string
    {
        return str_replace('(', '(?:', $regex);
    }
}