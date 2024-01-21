<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler\Php;

use Laventure\Component\Templating\Template\Compiler\CompilerInterface;

/**
 * LoopCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\PHP
 */
class LoopCompiler implements CompilerInterface
{
    /**
     * @inheritDoc
     */
    public function compile(string $content): string
    {
        $content = preg_replace('/@loop?(.*):/i', '<?php foreach$1: ?>', $content);
        $content = preg_replace('/@endloop/', '<?php endforeach; ?>', $content);
        $content = preg_replace('/@for?(.*):/i', '<?php for$1: ?>', $content);
        return preg_replace('/@endfor/', '<?php endfor; ?>', $content);
    }
}
