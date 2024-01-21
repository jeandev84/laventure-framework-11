<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Factory;

use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * TemplateFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Factory
 */
interface TemplateFactoryInterface
{
    /**
     * @param string $path
     * @param array $parameters
     * @return TemplateInterface
    */
    public function createTemplate(string $path, array $parameters = []): TemplateInterface;
}
