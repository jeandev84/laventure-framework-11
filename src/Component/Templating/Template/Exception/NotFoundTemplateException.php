<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Exception;

/**
 * NotFoundTemplateException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Exception
*/
class NotFoundTemplateException extends TemplateException
{
    /**
     * @param string $path
    */
    public function __construct(string $path)
    {
        parent::__construct("Template $path does not exist.", 404);
    }
}
