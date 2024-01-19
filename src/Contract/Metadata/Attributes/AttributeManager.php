<?php

declare(strict_types=1);

namespace Laventure\Contract\Metadata\Attributes;

use ReflectionClass;

/**
 * AttributeManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Metadata\Attributes
 */
class AttributeManager implements AttributeManagerInterface
{
    /**
     * @var ReflectionClass
    */
    private ReflectionClass $reflection;



    /**
     * @var string
    */
    private string $instanceOf;




    /**
     * @var array
    */
    private array $methods = [];



    /**
     * @var array
    */
    private array $attributes = [];



    /**
     * @var array
    */
    private array $instanceAttributes = [];



    /**
     * @var array
    */
    private array $methodParameters = [];




    /**
     * @param $class
     * @throws \ReflectionException
    */
    public function __construct($class)
    {
        $this->reflection = new ReflectionClass($class);
    }



    /**
     * @param string $class
     * @return $this
    */
    public function withInstanceOf(string $class): static
    {
        $this->instanceOf = $class;

        foreach ($this->reflection->getMethods() as $method) {

            $methodName  = $method->getName();
            $attributes = $method->getAttributes($class);
            $this->methods[$methodName] = $method;

            if (empty($attributes)) {
                continue;
            }

            $this->attributes[$methodName] = $attributes;

            foreach ($attributes as $attribute) {
                $this->instanceAttributes[$methodName][] = $attribute->newInstance();
            }

            foreach ($method->getParameters() as $parameter) {
                $this->methodParameters[$methodName][] = $parameter->getName();
            }
        }

        return $this;
    }


    /**
     * @param string $instanceOf
     * @return array
    */
    public function getClassAttributes(string $instanceOf): array
    {
        return $this->reflection->getAttributes($instanceOf);
    }


    /**
     * @return array
    */
    public function getMethods(): array
    {
        return $this->methods;
    }




    /**
     * @return array
    */
    public function getMethodAttributes(): array
    {
        return $this->attributes;
    }


    /**
     * @return array
     */
    public function getInstanceAttributes(): array
    {
        return $this->instanceAttributes;
    }


    /**
     * @return string
     */
    public function getInstanceOf(): string
    {
        return $this->instanceOf;
    }


    /**
     * @return array
     */
    public function getMethodParameters(): array
    {
        return $this->methodParameters;
    }


    /**
     * @return ReflectionClass
     */
    public function getReflection(): ReflectionClass
    {
        return $this->reflection;
    }




    /**
     * @return string
    */
    public function getClassname(): string
    {
        return $this->reflection->getName();
    }
}
