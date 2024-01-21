<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

/**
 * CompilerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\Contract
 */
interface CompilerInterface
{
    /**
     * Compile and return content
     *
     * @param string $content
     * @return string
    */
    public function compile(string $content): string;
}
