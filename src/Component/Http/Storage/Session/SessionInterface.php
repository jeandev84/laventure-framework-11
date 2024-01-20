<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session;

use Laventure\Component\Http\Storage\Session\Cache\SessionCacheInterface;
use Laventure\Component\Http\Storage\Session\Cookies\SessionCookieInterface;
use Laventure\Component\Http\Storage\Session\Encoder\SessionEncoderInterface;
use Laventure\Component\Http\Storage\Session\Flash\SessionFlashInterface;
use Laventure\Component\Http\Storage\Session\Id\SessionIdInterface;
use Laventure\Component\Http\Storage\Session\Module\SessionModuleInterface;
use Laventure\Component\Http\Storage\Session\Name\SessionNameInterface;
use Laventure\Contract\Storage\SavePathInterface;
use Laventure\Contract\Storage\StorageInterface;

/**
 * SessionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\Session
 *
 * @see https://www.php.net/manual/en/ref.session.php
*/
interface SessionInterface extends StorageInterface, SavePathInterface
{
    /**
     * Returns the name of session
     *
     * @return SessionNameInterface
    */
    public function name(): SessionNameInterface;




    /**
     * Returns session status
     *
     * @return mixed
    */
    public function status(): mixed;




    /**
     * start session
     *
     * @return void
    */
    public function start(): void;




    /**
     * session abort
     *
     * @return mixed
    */
    public function abort(): mixed;






    /**
     * session commit
     *
     * @return mixed
    */
    public function commit(): mixed;





    /**
     * session reset
     *
     * @return mixed
    */
    public function reset(): mixed;




    /**
     * session unset
     *
     * @return mixed
    */
    public function unset(): mixed;





    /**
     * write and close
     *
     * @return mixed
    */
    public function close(): mixed;





    /**
     * @return mixed
    */
    public function gc(): mixed;




    /**
     * @param string|null $name
     * @return void
    */
    public function register(string $name = null): void;






    /**
     * Returns session module info
     *
     * @return SessionModuleInterface
    */
    public function module(): SessionModuleInterface;





    /**
     * session id manager
     *
     * @return SessionIdInterface
    */
    public function id(): SessionIdInterface;






    /**
     * @return SessionFlashInterface
    */
    public function flash(): SessionFlashInterface;




    /**
     * session cache manager
     *
     * @return SessionCacheInterface
    */
    public function cache(): SessionCacheInterface;




    /**
     * @return SessionEncoderInterface
    */
    public function encoder(): SessionEncoderInterface;




    /**
     * @return SessionCookieInterface
    */
    public function cookie(): SessionCookieInterface;
}
