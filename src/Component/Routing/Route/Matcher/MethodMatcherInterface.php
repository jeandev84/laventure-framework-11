<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Matcher;

/**
 * MethodMatcherInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Matcher
*/
interface MethodMatcherInterface
{
    /**
     * @param string $method
     *
     * @return bool
    */
    public function matchMethod(string $method): bool;
}
