<?php
declare(strict_types=1);

namespace Laventure\Component\Routing;

use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing
*/
class Router implements RouterInterface, RouteCollectorInterface
{

    /**
     * @var RouteCollectionInterface
    */
    protected RouteCollectionInterface $collection;


    /**
     * @param RouteCollectionInterface|null $collection
    */
    public function __construct(
        RouteCollectionInterface $collection = null
    )
    {
        $this->collection = $collection ?: new RouteCollection();
    }



    /**
     * @inheritDoc
    */
    public function map($methods, string $path, mixed $action, string $name = ''): RouteInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function get(string $path, mixed $action, string $name = ''): RouteInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function post(string $path, mixed $action, string $name = ''): RouteInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function put(string $path, mixed $action, string $name = ''): RouteInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function patch(string $path, mixed $action, string $name = ''): RouteInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function delete(string $path, mixed $action, string $name = ''): RouteInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function getRoutes(): array
    {
        return $this->getCollection()->getRoutes();
    }



    /**
     * @inheritDoc
    */
    public function getCollection(): RouteCollectionInterface
    {
        return $this->collection;
    }




    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): RouteInterface|false
    {
         foreach ($this->getRoutes() as $route) {
             if ($route->match($method, $path)) {
                 return $route;
             }
         }

         return false;
    }




    /**
     * @inheritDoc
    */
    public function generate(string $name, array $params = []): ?string
    {
        return '';
    }
}