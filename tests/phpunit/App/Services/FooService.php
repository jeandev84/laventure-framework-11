<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Services;

/**
 * FooService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Factory
*/
class FooService
{
    public function foo(): string
    {
        return __METHOD__;
    }
}