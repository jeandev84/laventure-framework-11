<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Extension;

/**
 * AbstractExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Extension
 */
abstract class AbstractExtension implements ExtensionInterface
{
    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [];
    }




    /**
     * @inheritdoc
     */
    public function getFilters(): array
    {
        return [];
    }
}
