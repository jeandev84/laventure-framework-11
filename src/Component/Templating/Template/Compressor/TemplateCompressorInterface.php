<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compressor;

use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * TemplateCompressorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compressor
 */
interface TemplateCompressorInterface
{
    /**
     * @param TemplateInterface $template
     *
     * @return string
    */
    public function compress(TemplateInterface $template): string;
}
