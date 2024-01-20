<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session\Module;

/**
 * SessionModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session\Module
*/
class SessionModule implements SessionModuleInterface
{
    /**
     * @inheritDoc
    */
    public function name(string $module = null): string
    {
        return session_module_name($module);
    }
}
