<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Utils\Params;

/**
 * ParameterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Utils\Parameter
 */
interface ParameterInterface
{
    /**
     * @param $id
     * @param $value
     * @return mixed
     */
    public function set($id, $value): mixed;




    /**
     * @param array $params
     *
     * @return mixed
     */
    public function add(array $params): mixed;





    /**
     * @param $id
     * @return bool
     */
    public function has($id): bool;








    /**
     * @return int
    */
    public function count(): int;






    /**
     * @param $id
     * @param null $default
     * @return mixed
    */
    public function get($id, $default = null): mixed;





    /**
     * @param $id
     *
     * @return void
    */
    public function remove($id): void;





    /**
     * @return array
    */
    public function all(): array;
}
