<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler\Echos;

use Laventure\Component\Templating\Template\Compiler\CompilerInterface;

/**
 * EscapedEchoCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\Echos
 */
class EscapedEchoCompiler implements CompilerInterface
{
    /**
     * @inheritDoc
    */
    public function compile(string $content): string
    {
        $escaped = '<?php echo htmlentities($1, ENT_QUOTES, \'UTF-8\') ?>';

        return preg_replace('~\{{{\s*(.+?)\s*\}}}~is', $escaped, $content);
    }
}
