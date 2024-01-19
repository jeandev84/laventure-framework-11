<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route;

use Laventure\Component\Routing\Route\Pattern\RoutePattern;

/**
 * Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route
*/
class Route implements RouteInterface, \ArrayAccess
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
     * route patterns
     *
     * @var RoutePattern[]
    */
    protected array $patterns = [];



    /**
     * route params indexed
     *
     * @var array
    */
    protected array $params = [];



    /**
     * matches params
     *
     * @var array
    */
    protected array $matches = [];



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
    public function __construct(
        array $methods,
        string $path,
        mixed $action,
        string $name = ''
    ) {
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
    public function getController(): ?string
    {
        return $this->getOption('controller');
    }





    /**
     * @inheritDoc
    */
    public function getName(): string
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
    public function getMethodsAsString(): string
    {
        return join('|', $this->methods);
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
    public function hasOption(string $name): bool
    {
        return isset($this->options[$name]);
    }





    /**
     * @inheritdoc
    */
    public function getOption(string $name, $default = null): mixed
    {
        return $this->options[$name] ?? $default;
    }





    /**
     * @param array $methods
     * @return $this
    */
    public function methods(array $methods): static
    {
        $this->methods = $methods;

        return $this;
    }




    /**
     * @param string $path
     * @return $this
    */
    public function path(string $path): static
    {
        $this->path = $this->normalizePath($path);

        $this->pattern($this->path);

        return $this;
    }




    /**
     * @param mixed $action
     * @return $this
    */
    public function action(mixed $action): static
    {
        if (is_array($action)) {
            $action = $this->resolveActionFromArray($action);
        }

        $this->action = $action;

        return $this;
    }





    /**
     * @param string $name
     * @return $this
    */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @param string $pattern
     * @return $this
    */
    public function pattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function where(string $name, string $regex): static
    {
        $pattern               = new RoutePattern($name, $regex);
        $this->pattern         = $pattern->replace($this->pattern);
        $this->patterns[$name] = $pattern;

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
     * @inheritdoc
    */
    public function whereId(): static
    {
        return $this->whereNumber('id');
    }




    /**
     * @inheritdoc
    */
    public function whereNumber(string $name): static
    {
        return $this->where($name, '\d+');
    }






    /**
     * @inheritdoc
    */
    public function whereText(string $name): static
    {
        return $this->where($name, '\w+');
    }






    /**
     * @inheritdoc
    */
    public function whereAlphaNumeric(string $name): static
    {
        return $this->where($name, '[^a-z_\-0-9]');
    }





    /**
     * @inheritdoc
    */
    public function whereSlug(string $name): static
    {
        return $this->where($name, '[a-z\-0-9]+');
    }






    /**
     * @inheritdoc
    */
    public function whereAnything(string $name): static
    {
        return $this->where($name, '.*');
    }





    /**
     * @inheritdoc
    */
    public function whereIn(string $name, array $values): static
    {
        return $this;
    }




    /**
     * @inheritdoc
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
     * @inheritdoc
    */
    public function matchMethod(string $method): bool
    {
        return in_array($method, $this->methods);
    }








    /**
     * @inheritdoc
    */
    public function matchPath(string $uri): bool
    {
        $path    = $this->normalizeRequestPath($uri);
        $pattern = $this->getPattern();

        if (! preg_match("#^$pattern$#i", $path, $matches)) {
            return false;
        }

        $this->matches = $matches;
        $this->params  = $this->filterParams($matches);
        $this->options(compact('uri'));

        return true;
    }




    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): bool
    {
        return $this->matchMethod($method) && $this->matchPath($path);
    }






    /**
     * @inheritDoc
    */
    public function callable(): bool
    {
        return is_callable($this->action);
    }






    /**
     * @inheritdoc
    */
    public function call(): mixed
    {
        if (!$this->callable()) {
            return false;
        }

        return call_user_func_array($this->action, $this->params);
    }





    /**
     * @inheritDoc
    */
    public function generatePath(array $params = []): string
    {
        $path     = $this->getPath();
        foreach ($params as $name => $value) {
            if (isset($this->patterns[$name])) {
                $path = $this->patterns[$name]->replaceValues($path, [$value, $value]);
            }
        }

        return $path;
    }




    /**
     * @return int
    */
    public function getPatternCount(): int
    {
        return count($this->patterns);
    }



    /**
     * @param $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return static
    */
    public static function create($methods, string $path, mixed $action, string $name = ''): static
    {
        return new self($methods, $path, $action, $name);
    }





    /**
     * @param array $route
     * @return static
    */
    public static function createFromArray(array $route): static
    {
        return self::create($route['methods'], $route['path'], $route['action'], $route['name']);
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
     * @return array
    */
    public function toArray(): array
    {
        return get_object_vars($this);
    }





    /**
     * @param string $path
     * @return string
    */
    protected function normalizePath(string $path): string
    {
        return sprintf('/%s', trim($path, '/'));
    }





    /**
     * @param string $path
     *
     * @return string
    */
    protected function normalizeRequestPath(string $path): string
    {
        return parse_url($path, PHP_URL_PATH);
    }




    /**
     * @param array $matches
     *
     * @return array
    */
    protected function filterParams(array $matches): array
    {
        return array_filter($matches, function ($key) {
            return !is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);
    }




    /**
     * @param array $callback
     * @return mixed
    */
    private function resolveActionFromArray(array $callback): mixed
    {
        $separator = "::";
        $callback  = join($separator, $callback);

        if (stripos($callback, $separator) === false) {
            $callback .= "{$separator}__invoke";
        }

        $callback = explode($separator, $callback);

        $controller = $callback[0];
        $action     = $callback[1];

        $this->options(compact('controller', 'action'));

        return join($separator, $callback);

    }
}
