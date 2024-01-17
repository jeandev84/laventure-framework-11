<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collector;


use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteCollectorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collector
 */
interface RouteCollectorInterface
{
       /**
        * Map routes with more methods
        *
        * Example:
        *      $this->map(
        *             'GET|POST',
        *             '/contact-us',
        *              [App\Controller\ContactController::class, 'index'],
        *             'contact.us'
        *            );
        *
        *     $this->map(
        *       'GET|POST',
        *       '/contact-us',
        *       function () { return "Hello Friends"; },
        *       'contact.us'
        *       );
        *
        * @param $methods
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return RouteInterface
       */
       public function map($methods, string $path, mixed $action, string $name = ''): RouteInterface;




       /**
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return RouteInterface
       */
       public function get(string $path, mixed $action, string $name = ''): RouteInterface;





       /**
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return RouteInterface
       */
       public function post(string $path, mixed $action, string $name = ''): RouteInterface;






       /**
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return RouteInterface
       */
       public function put(string $path, mixed $action, string $name = ''): RouteInterface;






       /**
        * @param string $path
        * @param mixed $action
        * @param string $name
        * @return RouteInterface
       */
       public function patch(string $path, mixed $action, string $name = ''): RouteInterface;





      /**
       * @param string $path
       * @param mixed $action
       * @param string $name
       * @return RouteInterface
      */
      public function delete(string $path, mixed $action, string $name = ''): RouteInterface;






      /**
       * Returns routes
       *
       * @return RouteInterface[]
      */
      public function getRoutes(): array;
}