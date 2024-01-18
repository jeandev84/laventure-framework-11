<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Http\Controllers;

/**
 * SiteController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http\Controllers
*/
class SiteController
{
    public function index(): string
    {
        return __METHOD__;
    }


    public function about(): string
    {
        return __METHOD__;
    }


    public function contactUs(): string
    {
        return __METHOD__;
    }
}