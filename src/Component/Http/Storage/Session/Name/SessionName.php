<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Name;

/**
 * SessionName
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Name
*/
class SessionName implements SessionNameInterface
{
    /**
     * @inheritDoc
    */
    public function set(string $name): void
    {
        session_name($name);
    }



    /**
     * @inheritDoc
    */
    public function get(): string
    {
        return session_name();
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->get();
    }
}
