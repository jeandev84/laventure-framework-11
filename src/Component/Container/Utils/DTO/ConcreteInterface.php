<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Utils\DTO;

/**
 * ConcreteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\DTO
 */
interface ConcreteInterface
{
    /**
     * @return string
    */
    public function id(): string;



    /**
     * @return mixed
    */
    public function value(): mixed;




    /**
     * Set shared value
     *
     * @return $this
    */
    public function share(bool $shared): static;





    /**
     * Determine if value shared
     *
     * @return bool
    */
    public function shared(): bool;
}
