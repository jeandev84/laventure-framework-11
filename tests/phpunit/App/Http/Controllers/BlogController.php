<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Http\Controllers;

/**
 * BlogController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http\Controllers
*/
class BlogController
{
      public function list(): string
      {
           return __METHOD__;
      }
}