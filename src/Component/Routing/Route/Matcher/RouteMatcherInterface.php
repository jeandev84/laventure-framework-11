<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Matcher;

/**
 * RouteMatcherInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Matcher
*/
interface RouteMatcherInterface extends UrlMatcherInterface, MethodMatcherInterface
{
    /**
     * Determine if the current request match route
     *
     * @param string $method
     *
     * @param string $path
     *
     * @return bool
    */
    public function match(string $method, string $path): bool;
}
