<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Http\Controllers;

/**
 * MethodTestController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http\Controllers
 */
class MethodTestController
{
    public function testFirstMethod(): string
    {
        return __METHOD__;
    }
}