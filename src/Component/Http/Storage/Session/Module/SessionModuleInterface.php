<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Module;

/**
 * SessionModuleInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Module
*/
interface SessionModuleInterface
{
    /**
     * Returns session module name
     *
     * @param string|null $module
     * @return string
    */
    public function name(string $module = null): string;
}
