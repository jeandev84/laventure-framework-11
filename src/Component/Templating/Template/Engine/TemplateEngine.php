<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Engine;

use Laventure\Component\Templating\Template\Cache\TemplateCacheInterface;
use Laventure\Component\Templating\Template\Compiler\Blocks\BlocksCompiler;
use Laventure\Component\Templating\Template\Compiler\CompilerInterface;
use Laventure\Component\Templating\Template\Compiler\Echos\EchosCompiler;
use Laventure\Component\Templating\Template\Compiler\Echos\EscapedEchoCompiler;
use Laventure\Component\Templating\Template\Compiler\Php\PhpCompiler;
use Laventure\Component\Templating\Template\Factory\TemplateFactoryInterface;
use Laventure\Component\Templating\Template\Loader\TemplateLoaderInterface;
use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * TemplateEngine
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine
 */
class TemplateEngine implements TemplateEngineInterface
{
    /**
     * @var TemplateLoaderInterface
     */
    protected TemplateLoaderInterface $loader;



    /**
     * @var TemplateCacheInterface
     */
    protected TemplateCacheInterface $cache;




    /**
     * @var TemplateFactoryInterface
     */
    protected TemplateFactoryInterface $templateFactory;




    /**
     * @var CompilerInterface[]
    */
    protected array $compilers = [];




    /**
     * @param TemplateLoaderInterface $loader
     *
     * @param TemplateCacheInterface $cache
     * @param TemplateFactoryInterface $templateFactory
     */
    public function __construct(
        TemplateLoaderInterface $loader,
        TemplateCacheInterface  $cache,
        TemplateFactoryInterface $templateFactory
    ) {
        $this->loader = $loader;
        $this->cache  = $cache;
        $this->templateFactory = $templateFactory;
        $this->addCompilers($this->getDefaultCompilers());
    }






    /**
     * @return TemplateCacheInterface
     */
    public function getCache(): TemplateCacheInterface
    {
        return $this->cache;
    }




    /**
     * @inheritDoc
     */
    public function setLoader(TemplateLoaderInterface $loader): static
    {
        $this->loader = $loader;

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getLoader(): TemplateLoaderInterface
    {
        return $this->loader;
    }






    /**
     * @inheritDoc
    */
    public function getTemplateFactory(): TemplateFactoryInterface
    {
        return $this->templateFactory;
    }






    /**
     * @return CompilerInterface[]
     */
    public function getCompilers(): array
    {
        return $this->compilers;
    }




    /**
     * @param CompilerInterface $compiler
     *
     * @return $this
    */
    public function addCompiler(CompilerInterface $compiler): static
    {
        $this->compilers[] = $compiler;

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function addCompilers(array $compilers): static
    {
        foreach ($compilers as $compiler) {
            $this->addCompiler($compiler);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function compile(TemplateInterface $template): string
    {
        $content = $this->includePaths($template);

        foreach ($this->getCompilers() as $compiler) {
            $content = $compiler->compile($content);
        }

        $cachePath = $this->cache->cache($template->getPath(), $content);
        $template  =  $this->templateFactory->createTemplate(
            $cachePath,
            $template->getParameters()
        );

        return strval($template);
    }






    /**
     * @param TemplateInterface $template
     *
     * @return string
    */
    private function includePaths(TemplateInterface $template): string
    {
        $pattern = '/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i';
        $content = $this->loader->loadContent($template->getPath());

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $value) {
            $included = $this->templateFactory->createTemplate($value[2]);
            $content  = str_replace($value[0], $this->includePaths($included), $content);
        }

        return preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $content);
    }




    private function getDefaultCompilers(): array
    {
        return [
            new BlocksCompiler(),
            new EscapedEchoCompiler(),
            new EchosCompiler(),
            new PhpCompiler()
        ];
    }
}
