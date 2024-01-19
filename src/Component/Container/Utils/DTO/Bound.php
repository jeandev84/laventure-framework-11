<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Utils\DTO;

/**
 * Bound
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Utils\DTO
*/
class Bound implements BoundInterface
{
    /**
     * @var string
    */
    protected string $id;


    /**
     * @var mixed
    */
    protected mixed $value;



    /**
     * @var bool
    */
    protected bool $shared;



    /**
     * @param string $id
     * @param mixed $value
     * @param bool $shared
    */
    public function __construct(string $id, mixed $value, bool $shared = false)
    {
        $this->id     = $id;
        $this->value  = $value;
        $this->shared = $shared;
    }



    /**
     * @inheritDoc
    */
    public function id(): string
    {
        return $this->id;
    }




    /**
     * @inheritDoc
    */
    public function value(): mixed
    {
        return $this->value;
    }




    /**
     * @inheritDoc
    */
    public function share(bool $shared): static
    {
        $this->shared = $shared;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function shared(): bool
    {
        return $this->shared;
    }



    /**
     * @return bool
    */
    public function callable(): bool
    {
        return is_callable($this->value);
    }




    /**
     * @return bool
    */
    public function resolvable(): bool
    {
        return (is_string($this->value) && class_exists($this->value));
    }
}
