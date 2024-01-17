<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group;


/**
 * RouteGroupInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group
 */
interface RouteGroupInterface
{

     /**
      * Returns path
      *
      * @return string
     */
     public function getPath(): string;




     /**
      * Returns namespace
      *
      * @return string
     */
     public function getNamespace(): string;



     /**
      * Returns name
      *
      * @return string
     */
     public function getName(): string;




     /**
      * Returns middlewares
      *
      * @return array
     */
     public function getMiddlewares(): array;
}