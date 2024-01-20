<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template;

use Stringable;

/**
 * TemplateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template
*/
interface TemplateInterface extends Stringable
{
    /**
     * Returns path of template
     *
     * @return string
    */
    public function getPath(): string;




    /**
     * Returns template parameters
     *
     * @return array
    */
    public function getParameters(): array;





    /**
     * @return string
    */
    public function getContent(): string;





    /**
     * Determine if template path exists
     *
     * @return bool
    */
    public function exists(): bool;








    /**
     * Returns template content
     *
     * @return string
    */
    public function __toString(): string;
}
