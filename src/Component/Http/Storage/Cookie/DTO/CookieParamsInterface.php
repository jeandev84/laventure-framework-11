<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie\DTO;

/**
 * CookieParamsInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\ClientCookie
*/
interface CookieParamsInterface
{
    /**
     * @return string
    */
    public function getName(): string;




    /**
     * @return string
    */
    public function getValue(): string;





    /**
     * @return int
    */
    public function getExpires(): int;






    /**
     * @return string
    */
    public function getPath(): string;






    /**
     * @return string
    */
    public function getDomain(): string;







    /**
     * @return bool
    */
    public function getSecure(): bool;






    /**
     * @return bool
    */
    public function getHttpOnly(): bool;
}
