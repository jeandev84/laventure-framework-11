<?php
declare(strict_types=1);

namespace Laventure\Component\Routing;


use Laventure\Component\Routing\Route\Collection\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * RouterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing
*/
interface RouterInterface
{

     /**
      * Returns route collection
      *
      * @return RouteCollectionInterface
     */
     public function getCollection(): RouteCollectionInterface;




     /**
      * Determine if the current request match route
      *
      * @param string $method
      *
      * @param string $uri
      *
      * @return Route|false
     */
     public function match(string $method, string $uri): Route|false;





     /**
      * @param string $name
      * @param array $params
      * @return string|null
     */
     public function generate(string $name, array $params = []): ?string;
}