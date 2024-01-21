<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler\Php;

use Laventure\Component\Templating\Template\Compiler\CompilerInterface;

/**
 * PhpCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\Php
*/
class PhpCompiler implements CompilerInterface
{
    /**
     * @inheritDoc
    */
    public function compile(string $content): string
    {
        foreach ($this->getCompilers() as $compiler) {
            $content = $compiler->compile($content);
        }

        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $content);
    }




    /**
     * @return CompilerInterface[]
    */
    private function getCompilers(): array
    {
        return [
            new LoopCompiler(),
            new IfCompiler(),
            new SwitchCompiler()
        ];
    }
}
