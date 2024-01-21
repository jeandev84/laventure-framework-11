<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler\Blocks;

use Laventure\Component\Templating\Template\Compiler\CompilerInterface;

/**
 * BlocksCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\Blocks
*/
class BlocksCompiler implements CompilerInterface
{
    /**
     * @var array
    */
    protected array $blocks = [];



    /**
     * @inheritDoc
    */
    public function compile(string $content): string
    {
        $pattern = '/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $value) {
            if (! array_key_exists($value[1], $this->blocks)) {
                $this->blocks[$value[1]] = '';
            }
            if (str_contains($value[2], '@parent') === false) {
                $this->blocks[$value[1]] = $value[2];
            } else {
                $this->blocks[$value[1]] = str_replace('@parent', $this->blocks[$value[1]], $value[2]);
            }
            $content = str_replace($value[0], '', $content);
        }

        return $this->compileYields($content);
    }






    /**
     * @param string $content
     *
     * @return string
    */
    public function compileYields(string $content): string
    {
        foreach ($this->blocks as $name => $value) {
            $content = preg_replace("/{% yield ?$name ?%}/", $value, $content);
        }

        return $content;
    }






    /**
     * @return array
    */
    public function getBlocks(): array
    {
        return $this->blocks;
    }
}
