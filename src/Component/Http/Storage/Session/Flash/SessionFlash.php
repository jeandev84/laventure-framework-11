<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Flash;

use Laventure\Component\Http\Storage\Session\SessionInterface;

/**
 * SessionFlash
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Flash
*/
class SessionFlash implements SessionFlashInterface
{
    /**
     * @var string
    */
    protected string $flashKey = 'session.flash';



    /**
     * @var SessionInterface
    */
    protected SessionInterface $session;



    /**
     * @param SessionInterface $session
    */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }



    /**
     * @inheritDoc
    */
    public function setKey(string $flashKey): static
    {
        $this->flashKey = $flashKey;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getKey(): string
    {
        return $this->flashKey;
    }



    /**
     * @inheritDoc
    */
    public function set($id, $value): static
    {
        return $this;
    }



    /**
     * @inheritDoc
    */
    public function has($id): bool
    {
        return false;
    }



    /**
     * @inheritDoc
    */
    public function get($id, $default = null): mixed
    {
        return $id;
    }




    /**
     * @inheritDoc
    */
    public function forget($id): bool
    {
        unset($id);

        return false;
    }




    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function destroy(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {

    }



    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {

    }
}
