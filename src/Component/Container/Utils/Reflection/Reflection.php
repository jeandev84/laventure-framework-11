<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Utils\Reflection;

use ReflectionClass;
use ReflectionException;
use Reflector;

/**
 * Reflection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Utils\Reflection
*/
class Reflection implements ReflectionInterface
{

    /**
     * @var ReflectionClass
    */
    protected ReflectionClass $class;



    /**
     * @param $class
     * @throws ReflectionException
    */
    public function __construct($class)
    {
        $class = new ReflectionClass($class);

        if (!$class->isInstantiable()) {

        }
    }




    /**
     * @inheritDoc
    */
    public function getReflector(): Reflector
    {
        return $this->class;
    }
}
