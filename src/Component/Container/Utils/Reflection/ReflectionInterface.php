<?php
declare(strict_types=1);

namespace Laventure\Component\Container\Utils\Reflection;


use Reflector;

/**
 * ReflectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Utils\Reflection
*/
interface ReflectionInterface
{
    /**
     * @return Reflector
    */
    public function getReflection(): Reflector;
}