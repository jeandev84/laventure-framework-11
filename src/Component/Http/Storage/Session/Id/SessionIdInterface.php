<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Id;

use Stringable;

/**
 * SessionIdInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Id
*/
interface SessionIdInterface extends Stringable
{
    /**
     * set session id
     *
     * @param string $id
     *
     * @return mixed
    */
    public function set(string $id): mixed;




    /**
     * create session id
     *
     * @param string $prefix
     * @return mixed
    */
    public function create(string $prefix = ''): mixed;




    /**
     * regenerate session id
     *
     * @param bool $forgetOldSession
     * @return mixed
    */
    public function regenerate(bool $forgetOldSession = false): mixed;





    /**
     * Returns session id
     *
     * @return string
    */
    public function get(): string;
}
