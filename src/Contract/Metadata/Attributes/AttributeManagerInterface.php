<?php

declare(strict_types=1);

namespace Laventure\Contract\Metadata\Attributes;

use ReflectionClass;

/**
 * AttributeManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Metadata\Attributes
*/
interface AttributeManagerInterface
{
    /**
     * @return string
    */
    public function getClassname(): string;



    /**
     * @return ReflectionClass|\Reflector
    */
    public function getReflection(): ReflectionClass;



    /**
     * @param string $class
     * @return $this
    */
    public function withInstanceOf(string $class): static;



    /**
     * @return string
    */
    public function getInstanceOf(): string;



    /**
     * @param string $instanceOf
     * @return array
    */
    public function getClassAttributes(string $instanceOf): array;



    /**
     * @return array
    */
    public function getMethodAttributes(): array;





    /**
     * @return array
    */
    public function getMethods(): array;




    /**
     * @return array
    */
    public function getMethodParameters(): array;
}
