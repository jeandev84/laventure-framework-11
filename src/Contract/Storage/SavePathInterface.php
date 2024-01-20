<?php

declare(strict_types=1);

namespace Laventure\Contract\Storage;

/**
 * SavePathInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Storage
*/
interface SavePathInterface
{
    /**
     * save session in file
     *
     * @param string $path
     * @return void
    */
    public function savePath(string $path): void;
}
