<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Factory;

use Laventure\Component\Routing\Router\Router;

/**
 * RouterTestFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Factory
*/
class RouterTestFactory
{
     const NAMESPACE = "PHPUnitTest\App\Http\Controllers";

     public static function create(): Router
     {
         return new Router(self::NAMESPACE);
     }
}