<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Configuration;

use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Factory\RouteFactory;
use Laventure\Component\Routing\Route\Factory\RouteFactoryInterface;
use Laventure\Component\Routing\Route\Group\RouteGroup;
use Laventure\Component\Routing\Route\Group\RouteGroupInterface;
use Laventure\Component\Routing\Route\Resolver\RouteResolver;
use Laventure\Component\Routing\Route\Resolver\RouteResolverInterface;

/**
 * RouterConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Configuration
*/
class RouterConfiguration implements RouterConfigurationInterface
{

    /**
     * @var string
    */
    protected string $namespace;


    /**
     * @var RouteGroupInterface
    */
    protected RouteGroupInterface $routeGroup;



    /**
     * @var RouteFactoryInterface
    */
    protected RouteFactoryInterface $routeFactory;


    /**
     * @var RouteCollectionInterface
    */
    protected RouteCollectionInterface $routeCollection;


    /**
     * @var RouteResolverInterface
    */
    protected RouteResolverInterface $routeResolver;



    /**
     * @param string $namespace
    */
    public function __construct(string $namespace)
    {
        $this->namespace       = $namespace;
        $this->routeFactory    = new RouteFactory();
        $this->routeGroup      = new RouteGroup();
        $this->routeCollection = new RouteCollection();
        $this->routeResolver   = new RouteResolver($this->routeGroup, $namespace);
    }




    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return $this->namespace;
    }




    /**
     * @inheritDoc
    */
    public function getRouteFactory(): RouteFactoryInterface
    {
        return $this->routeFactory;
    }



    /**
     * @inheritDoc
    */
    public function getRouteCollection(): RouteCollectionInterface
    {
        return $this->routeCollection;
    }




    /**
     * @inheritDoc
    */
    public function getRouteGroup(): RouteGroupInterface
    {
        return $this->routeGroup;
    }



    /**
     * @inheritDoc
    */
    public function getRouteResolver(): RouteResolverInterface
    {
        return $this->routeResolver;
    }
}