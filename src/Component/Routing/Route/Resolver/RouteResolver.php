<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resolver;

use Laventure\Component\Routing\Route\Group\RouteGroupInterface;
use RuntimeException;

/**
 * RouteResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resolver
 */
class RouteResolver implements RouteResolverInterface
{
    /**
     * @var RouteGroupInterface
    */
    protected RouteGroupInterface $group;



    /**
     * @var string
    */
    protected string $namespace;



    /**
     * @param RouteGroupInterface $group
     *
     * @param string $namespace
    */
    public function __construct(
        RouteGroupInterface $group,
        string $namespace
    ) {
        $this->group     = $group;
        $this->namespace = trim($namespace, "\\");
    }



    /**
     * @inheritDoc
    */
    public function resolveMethods($methods): array
    {
        if (is_string($methods)) {
            $methods = explode('|', $methods);
        }

        return $methods;
    }



    /**
     * @inheritDoc
    */
    public function resolvePath(string $path): string
    {
        if ($prefix = $this->group->getPath()) {
            $path = sprintf('%s/%s', trim($prefix, '/'), ltrim($path, '/'));
        }

        return $path;
    }



    /**
     * @inheritDoc
    */
    public function resolveAction(mixed $action): array|callable
    {
        if ($this->actionFromString($action)) {

            if (!$this->namespace) {
                throw new RuntimeException("Could not resolve action ($action) because namespace is not specified");
            }

            $action     = explode('@', $action, 2);
            $controller = sprintf('%s\\%s', $this->namespace, $action[0]);
            return [$controller, $action[1]];
        }

        return $action;
    }



    /**
     * @inheritDoc
    */
    public function resolveMiddlewares(array $middlewares): array
    {
        return array_merge($this->group->getMiddlewares(), $middlewares);
    }



    /**
     * @inheritDoc
    */
    public function resolveName(string $name): string
    {
        return sprintf('%s%s', $this->group->getName(), $name);
    }



    /**
     * @param $action
     *
     * @return bool
    */
    private function actionFromString($action): bool
    {
        return is_string($action) && stripos($action, '@') !== false;
    }
}
