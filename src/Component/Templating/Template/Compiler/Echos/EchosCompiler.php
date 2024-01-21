<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler\Echos;

use Laventure\Component\Templating\Template\Compiler\CompilerInterface;

/**
 * EchosCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\Echos
 */
class EchosCompiler implements CompilerInterface
{
    /**
     * @inheritDoc
    */
    public function compile(string $content): string
    {
        return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $content);
    }
}
