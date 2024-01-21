<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Loader;

/**
 * TemplateEngineLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Loader
 */
class TemplateLoader implements TemplateLoaderInterface
{
    /**
     * @var string
    */
    protected string $resourcePath;



    /**
     * @param string $resourcePath
    */
    public function __construct(string $resourcePath)
    {
        $this->setResourcePath($resourcePath);
    }



    /**
     * @inheritDoc
    */
    public function loadPath(string $path): string
    {
        $path = str_replace('/', DIRECTORY_SEPARATOR, trim($path, '/'));

        return rtrim($this->resourcePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $path;
    }



    /**
     * @inheritDoc
    */
    public function loadContent(string $path): string
    {
        $path = $this->loadPath($path);

        if (! file_exists($path)) {
            return '';
        }

        return file_get_contents($path);
    }




    /**
     * @inheritdoc
    */
    public function getResourcePath(): string
    {
        return $this->resourcePath;
    }





    /**
     * @inheritDoc
    */
    public function setResourcePath(string $path): static
    {
        $this->resourcePath = $path;

        return $this;
    }
}
