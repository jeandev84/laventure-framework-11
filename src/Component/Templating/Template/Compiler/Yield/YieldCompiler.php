<?php
declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler\Yield;

use Laventure\Component\Templating\Template\Compiler\Blocks\BlocksCompiler;
use Laventure\Component\Templating\Template\Compiler\CompilerInterface;

/**
 * YieldCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\CompilerInterface
*/
class YieldCompiler implements CompilerInterface
{


    /**
     * @var BlocksCompiler
    */
    protected BlocksCompiler $compiler;



    /**
     * @param BlocksCompiler $compiler
    */
    public function __construct(BlocksCompiler $compiler)
    {
        $this->compiler = $compiler;
    }



    /**
     * @inheritDoc
    */
    public function compile(string $content): string
    {
        foreach ($this->compiler->getBlocks() as $name => $value) {
            $content = preg_replace("/{% yield ?$name ?%}/", $value, $content);
        }

        return $content;
    }
}