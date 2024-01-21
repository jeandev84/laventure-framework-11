<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie\Jar;

use Laventure\Component\Http\Storage\Cookie\Cookie;
use Laventure\Component\Http\Storage\Cookie\CookieInterface;
use Laventure\Component\Http\Storage\Cookie\DTO\CookieParams;
use Laventure\Component\Http\Storage\Cookie\DTO\CookieParamsInterface;

/**
 * CookieJar
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\ClientCookie\Jar
*/
class CookieJar extends CookieParams implements CookieJarInterface
{
    /**
     * @var array
    */
    protected array $cookies = [];




    /**
     * @param array $cookies
    */
    public function __construct(array $cookies = [])
    {
        $this->cookies = $cookies ?: $_COOKIE;
    }




    /**
     * @inheritDoc
    */
    public function set($id, $value): static
    {
        return $this->name($id)->value($value);
    }




    /**
     * @inheritDoc
    */
    public function has($id): bool
    {
        return isset($this->cookies[$id]);
    }




    /**
     * @inheritDoc
    */
    public function get($id, $default = null): mixed
    {
        return $this->cookies[$id] ?? $default;
    }





    /**
     * @inheritDoc
    */
    public function forget($id): bool
    {
        $this->set($id, '')
             ->expireAfter(time() - 3600)
             ->save();

        unset($this->cookies[$id]);

        return !$this->has($id);
    }





    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return $this->cookies;
    }




    /**
     * @inheritDoc
    */
    public function destroy(): bool
    {
        foreach (array_keys($this->cookies) as $id) {
            $this->forget($id);
        }

        return empty($this->cookies);
    }




    /**
     * @inheritdoc
    */
    public function save(): CookieInterface
    {
        return new Cookie($this);
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
