<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Extension;

use Laventure\Component\Templating\Template\Filter\TemplateFilter;
use Laventure\Component\Templating\Template\Function\TemplateFunction;

/**
 * ExtensionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Extension
 */
interface ExtensionInterface
{
    /**
     * @return TemplateFunction[]
    */
    public function getFunctions(): array;



    /**
     * @return TemplateFilter[]
    */
    public function getFilters(): array;
}
