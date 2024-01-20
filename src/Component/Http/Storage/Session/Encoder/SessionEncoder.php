<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Encoder;

/**
 * SessionEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Encoder
*/
class SessionEncoder implements SessionEncoderInterface
{
    /**
     * @inheritDoc
    */
    public function encode(): string|false
    {
        return session_encode();
    }



    /**
     * @inheritDoc
    */
    public function decode(string $data): bool
    {
        return session_decode($data);
    }
}
