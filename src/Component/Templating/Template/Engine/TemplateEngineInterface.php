<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Engine;

use Laventure\Component\Templating\Template\Compiler\CompilerInterface;
use Laventure\Component\Templating\Template\Factory\TemplateFactoryInterface;
use Laventure\Component\Templating\Template\Loader\TemplateLoaderInterface;
use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * TemplateEngineInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine
 */
interface TemplateEngineInterface
{
    /**
     * @param TemplateLoaderInterface $loader
     * @return $this
    */
    public function setLoader(TemplateLoaderInterface $loader): static;







    /**
     * @return TemplateLoaderInterface
    */
    public function getLoader(): TemplateLoaderInterface;




    /**
     * @param CompilerInterface[] $compilers
     * @return $this
    */
    public function addCompilers(array $compilers): static;






    /**
     * @param TemplateInterface $template
     *
     * @return string
    */
    public function compile(TemplateInterface $template): string;







    /**
     * @return TemplateFactoryInterface
    */
    public function getTemplateFactory(): TemplateFactoryInterface;
}
