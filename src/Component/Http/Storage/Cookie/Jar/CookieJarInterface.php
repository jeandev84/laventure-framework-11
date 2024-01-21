<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie\Jar;

use Laventure\Component\Http\Storage\Cookie\CookieInterface;
use Laventure\Component\Http\Storage\Cookie\DTO\CookieParamsInterface;
use Laventure\Contract\Storage\StorageInterface;

/**
 * CookieJarInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Storage\ClientCookie\Jar
*/
interface CookieJarInterface extends StorageInterface, CookieParamsInterface
{
    /**
     * Save cookie
     *
     * @return CookieInterface
    */
    public function save(): CookieInterface;
}
