<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session;

use Laventure\Contract\Storage\StorageInterface;

/**
 * ArraySession ( This is used for unit testing for example )
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session
*/
class ArraySession implements StorageInterface
{
    /**
     * @var array
    */
    protected array $sessions = [];




    /**
     * @param array $sessions
    */
    public function __construct(array $sessions)
    {
        $this->sessions = $sessions;
    }




    /**
     * @inheritDoc
    */
    public function set($id, $value): static
    {
        $this->sessions[$id] = $value;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function has($id): bool
    {
        return isset($this->sessions[$id]);
    }





    /**
     * @inheritDoc
    */
    public function get($id, $default = null): mixed
    {
        return $this->sessions[$id] ?? $default;
    }




    /**
     * @inheritDoc
    */
    public function forget($id): bool
    {
        unset($this->sessions[$id]);

        return $this->has($id);
    }





    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return $this->sessions;
    }




    /**
     * @inheritDoc
    */
    public function destroy(): bool
    {
        $this->sessions = [];

        return empty($this->sessions);
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
}
