<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Name;

use Stringable;

/**
 * SessionNameInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Name
*/
interface SessionNameInterface extends Stringable
{
    /**
     * Set session name
     *
     * @param string $name
     * @return void
    */
    public function set(string $name): void;




    /**
     * Returns session name
     *
     * @return string
    */
    public function get(): string;
}
