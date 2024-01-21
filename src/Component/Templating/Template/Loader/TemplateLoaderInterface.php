<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Loader;

/**
 * TemplateEngineLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine\Loader
 */
interface TemplateLoaderInterface
{
    /**
     * @param string $path
     * @return string
    */
    public function loadPath(string $path): string;




    /**
     * @param string $path
     * @return string
    */
    public function loadContent(string $path): string;





    /**
     * @param string $path
     * @return $this
    */
    public function setResourcePath(string $path): static;



    /**
     * @return string
    */
    public function getResourcePath(): string;
}
