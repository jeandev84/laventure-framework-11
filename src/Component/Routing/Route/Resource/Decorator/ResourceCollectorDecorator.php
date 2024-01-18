<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Decorator;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Methods\Enums\HttpMethod;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * ResourceRouteCollectorDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource\Decorator
 */
class ResourceCollectorDecorator
{
    /**
     * @var RouteCollectorInterface
    */
    protected RouteCollectorInterface $collector;


    /**
     * @var string
    */
    protected string $controller;




    /**
      * @param RouteCollectorInterface $collector
      * @param string $controller
    */
    public function __construct(RouteCollectorInterface $collector, string $controller)
    {
        $this->collector  = $collector;
        $this->controller = $controller;
    }




    /**
     *  Collect route called by each kind methods
     *  Example : $this->map('GET|POST|PUT|DELETE', '/any', [], 'any');
     *
     * @param $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function map($methods, string $path, mixed $action, string $name = ''): RouteInterface
    {
        $route = $this->collector->map($methods, $path, $action, $name);

        return $this->collector->controller($this->controller, $route);
    }




    /**
     * Collect route called by method GET
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
     */
    public function get(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::GET, $path, $action, $name);
    }





    /**
     * Collect route called by method POST
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
     */
    public function post(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::POST, $path, $action, $name);
    }






    /**
     * Collect route called by method PUT
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function put(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::PUT, $path, $action, $name);
    }






    /**
     * Collect route called by method PATH
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
     */
    public function patch(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::PATCH, $path, $action, $name);
    }





    /**
     * Collect route called by method DELETE
     *
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return RouteInterface
    */
    public function delete(string $path, mixed $action, string $name = ''): RouteInterface
    {
        return $this->map(HttpMethod::DELETE, $path, $action, $name);
    }






    /**
     * @return RouteCollectorInterface
    */
    public function getRouteCollector(): RouteCollectorInterface
    {
        return $this->collector;
    }

}
