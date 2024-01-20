<?php

declare(strict_types=1);

namespace Laventure\Contract\Storage;

use ArrayAccess;

/**
 * StorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Storage
*/
interface StorageInterface extends ArrayAccess
{
    /**
     * @param $id
     * @param $value
     * @return mixed
    */
    public function set($id, $value): mixed;




    /**
     * @param $id
     * @return bool
    */
    public function has($id): bool;





    /**
     * @param $id
     * @param $default
     * @return mixed
    */
    public function get($id, $default = null): mixed;





    /**
     * @param $id
     * @return mixed
    */
    public function forget($id): mixed;





    /**
     * @return array
    */
    public function all(): array;





    /**
     * session destroy
     *
     * @return mixed
    */
    public function destroy(): mixed;
}
