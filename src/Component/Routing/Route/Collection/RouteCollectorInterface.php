<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collection;


use Laventure\Component\Routing\Route\Route;

/**
 * RouteCollectorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collection
 */
interface RouteCollectorInterface
{
       /**
        * Map routes with more methods
        *
        * Example: Route('GET|POST', '/contact-us', ..., 'contact.us')
        *
        * @param string $methods
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return mixed
       */
       public function map(string $methods, string $path, mixed $action, string $name = ''): Route;




       /**
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return mixed
       */
       public function get(string $path, mixed $action, string $name = ''): Route;





       /**
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return mixed
       */
       public function post(string $path, mixed $action, string $name = ''): Route;






       /**
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return Route
       */
       public function put(string $path, mixed $action, string $name = ''): Route;






       /**
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return Route
       */
       public function patch(string $path, mixed $action, string $name = ''): Route;





      /**
       * @param string $path
       * @param mixed $action
       * @param string $name
       * @return Route
      */
      public function delete(string $path, mixed $action, string $name = ''): Route;






      /**
       * Returns routes
       *
       * @return Route[]
      */
      public function getRoutes(): array;
}