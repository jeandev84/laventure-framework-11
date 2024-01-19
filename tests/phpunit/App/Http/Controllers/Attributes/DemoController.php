<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Http\Controllers\Attributes;

/**
 * DemoController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http\Controllers\Attributes
 */
class DemoController
{
    public function index(): string
    {
        return __METHOD__;
    }


    public function show(int $id): string
    {
        return __METHOD__;
    }


    public function store(array $params): string
    {
        return __METHOD__;
    }



    public function update($id): string
    {
        return __METHOD__;
    }




    public function destroy($id): string
    {
        return __METHOD__;
    }
}