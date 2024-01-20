<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session;

use Laventure\Component\Http\Storage\Session\Cache\SessionCacheInterface;
use Laventure\Component\Http\Storage\Session\Cookies\SessionCookie;
use Laventure\Component\Http\Storage\Session\Cookies\SessionCookieInterface;
use Laventure\Component\Http\Storage\Session\Encoder\SessionEncoder;
use Laventure\Component\Http\Storage\Session\Encoder\SessionEncoderInterface;
use Laventure\Component\Http\Storage\Session\Flash\SessionFlash;
use Laventure\Component\Http\Storage\Session\Flash\SessionFlashInterface;
use Laventure\Component\Http\Storage\Session\Id\SessionId;
use Laventure\Component\Http\Storage\Session\Id\SessionIdInterface;
use Laventure\Component\Http\Storage\Session\Module\SessionModule;
use Laventure\Component\Http\Storage\Session\Module\SessionModuleInterface;
use Laventure\Component\Http\Storage\Session\Name\SessionName;
use Laventure\Component\Http\Storage\Session\Name\SessionNameInterface;

/**
 * @inheritdoc
*/
class Session implements SessionInterface
{
    /**
     * @var SessionCacheInterface
    */
    protected SessionCacheInterface $cache;



    /**
     * @param SessionCacheInterface $cache
    */
    public function __construct(SessionCacheInterface $cache)
    {
        $this->cache = $cache;
    }



    /**
     * @inheritdoc
    */
    public function status(): int
    {
        return session_status();
    }




    /**
     * @inheritDoc
    */
    public function start(): void
    {
        session_start();
    }





    /**
     * @inheritDoc
    */
    public function abort(): bool
    {
        return session_abort();
    }




    /**
     * @inheritDoc
     */
    public function commit(): bool
    {
        return session_commit();
    }





    /**
     * @inheritDoc
    */
    public function reset(): bool
    {
        return session_reset();
    }





    /**
     * @inheritDoc
    */
    public function unset(): bool
    {
        return session_unset();
    }





    /**
     * @inheritDoc
    */
    public function close(): bool
    {
        return session_write_close();
    }





    /**
     * @inheritDoc
     */
    public function gc(): false|int
    {
        return session_gc();
    }





    /**
     * @inheritDoc
    */
    public function register(string $name = null): void
    {
        session_register_shutdown();
    }






    /**
     * @inheritDoc
    */
    public function id(): SessionIdInterface
    {
        return new SessionId();
    }



    /**
     * @inheritDoc
    */
    public function name(): SessionNameInterface
    {
        return new SessionName();
    }




    /**
     * @inheritDoc
    */
    public function module(): SessionModuleInterface
    {
        return new SessionModule();
    }





    /**
     * @inheritDoc
    */
    public function flash(): SessionFlashInterface
    {
        return new SessionFlash($this);
    }




    /**
     * @inheritDoc
    */
    public function cache(): SessionCacheInterface
    {
        return $this->cache;
    }




    /**
     * @inheritDoc
     */
    public function encoder(): SessionEncoderInterface
    {
        return new SessionEncoder();
    }




    /**
     * @inheritDoc
    */
    public function cookie(): SessionCookieInterface
    {
        return new SessionCookie();
    }





    /**
     * @inheritDoc
    */
    public function set($id, $value): static
    {
        $_SESSION[$id] = $value;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function has($id): bool
    {
        return isset($_SESSION[$id]);
    }





    /**
     * @inheritDoc
    */
    public function get($id, $default = null): mixed
    {
        return $_SESSION[$id] ?? $default;
    }





    /**
     * @inheritDoc
    */
    public function forget($id): bool
    {
        unset($_SESSION[$id]);

        return !$this->has($id);
    }




    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return $_SESSION;
    }





    /**
     * @inheritDoc
    */
    public function destroy(): bool
    {
        return session_destroy();
    }



    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        $this->forget($offset);
    }





    /**
     * @inheritDoc
    */
    public function savePath(string $path): void
    {

    }
}
