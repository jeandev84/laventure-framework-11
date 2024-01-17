<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Collection;


use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouteCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Collection
*/
interface RouteCollectionInterface
{
     /**
      * @return RouteInterface[]
     */
     public function getRoutes(): array;



     /**
      * @return RouteInterface[]
     */
     public function getNamedRoutes(): array;




     /**
       * @param string $name
       *
       * @return RouteInterface
      */
      public function getNamedRoute(string $name): RouteInterface;





       /**
        * @param string $name
        *
        * @return bool
       */
       public function hasNamedRoute(string $name): bool;
}