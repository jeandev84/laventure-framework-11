<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Matcher;

use Laventure\Component\Routing\Route\Collector\RouteCollector;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * UrlMatcherInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Matcher
 */
interface UrlMatcherInterface
{
    /**
     * Determine if the given method in route methods
     *
     * @param string $uri
     *
     * @return bool
    */
    public function matchPath(string $uri): bool;
}
