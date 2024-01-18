<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Http\Controllers;

/**
 * HomeController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http\Controllers
*/
class HomeController
{
     public function __invoke(array $params): string
     {
         return __METHOD__;
     }
}