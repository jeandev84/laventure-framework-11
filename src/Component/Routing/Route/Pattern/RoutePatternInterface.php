<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Pattern;

/**
 * RoutePatternInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Pattern
 */
interface RoutePatternInterface
{
    /**
     * Returns pattern name
     *
     * @return string
    */
    public function getName(): string;



    /**
     * Returns pattern expression
     *
     * @return string
    */
    public function getRegex(): string;




    /**
     * Returns patterns
     *
     * @return string[]
    */
    public function toArray(): array;
}
