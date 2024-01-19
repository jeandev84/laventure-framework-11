<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Service;

/**
 * FooService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service
*/
class FooService
{
    public function foo(): string
    {
        return __METHOD__;
    }
}