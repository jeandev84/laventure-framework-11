<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Id;

/**
 * SessionId
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session
*/
class SessionId implements SessionIdInterface
{
    /**
     * @inheritDoc
    */
    public function set(string $id): string
    {
        return session_id($id);
    }




    /**
     * @inheritDoc
    */
    public function create(string $prefix = ''): string
    {
        return session_create_id($prefix);
    }




    /**
     * @inheritDoc
    */
    public function regenerate(bool $forgetOldSession = false): bool
    {
        return session_regenerate_id($forgetOldSession);
    }




    /**
     * @inheritDoc
     */
    public function get(): string
    {
        return session_id();
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->get();
    }
}
