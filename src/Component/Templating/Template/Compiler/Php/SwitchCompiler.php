<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler\Php;

use Laventure\Component\Templating\Template\Compiler\CompilerInterface;

/**
 * SwitchCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\PHP
 */
class SwitchCompiler implements CompilerInterface
{
    /**
     * @inheritDoc
     */
    public function compile(string $content): string
    {
        $content = preg_replace('/@switch?(.*):/', '<?php switch$1: ?>', $content);
        return preg_replace('/@endswitch/', '<?php endswitch; ?>', $content);
    }
}
