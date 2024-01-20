<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Flash;

use Laventure\Contract\Storage\StorageInterface;

/**
 * SessionFlashInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Flash
*/
interface SessionFlashInterface extends StorageInterface
{
    /**
     * Set flash key
     *
     * @param string $flashKey
     * @return mixed
    */
    public function setKey(string $flashKey): mixed;




    /**
     * Returns flash key
     *
     * @return string
    */
    public function getKey(): string;
}
