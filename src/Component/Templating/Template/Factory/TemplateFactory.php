<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Factory;

use Laventure\Component\Templating\Template\Template;
use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * TemplateFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Factory
 */
class TemplateFactory implements TemplateFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createTemplate(string $path, array $parameters = []): TemplateInterface
    {
        return new Template($path, $parameters);
    }
}
