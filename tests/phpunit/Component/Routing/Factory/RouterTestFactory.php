<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing\Factory;

use Laventure\Component\Routing\Configuration\RouterConfiguration;
use Laventure\Component\Routing\Router\Router;

/**
 * RouterTestFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Routing\Factory
*/
class RouterTestFactory
{
     const NAMESPACE = "PHPUnitTest\App\Http\Controllers";

     public static function create(): Router
     {
         $config = new RouterConfiguration(self::NAMESPACE);
         return  new Router($config);
     }
}