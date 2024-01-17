<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resolver;

use Laventure\Component\Routing\Route\Group\RouteGroupInterface;

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
    )
    {
        $this->group     = $group;
        $this->namespace = $namespace;
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
        return '';
    }



    /**
     * @inheritDoc
    */
    public function resolveAction(mixed $action): mixed
    {
        return '';
    }



    /**
     * @inheritDoc
    */
    public function resolveName(string $name): string
    {
        return '';
    }
}