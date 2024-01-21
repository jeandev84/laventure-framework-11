<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template;

use Laventure\Component\Templating\Template\Exception\NotFoundTemplateException;

/**
 * @inheritdoc
*/
class Template implements TemplateInterface
{
    /**
     * @var string
    */
    protected string $path;



    /**
     * @var array
    */
    protected array $parameters = [];



    public function __construct(string $path, array $parameters = [])
    {
        $this->path       = $path;
        $this->parameters = $parameters;
    }



    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }



    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }



    /**
     * @inheritDoc
    */
    public function exists(): bool
    {
        return file_exists($this->path);
    }





    /**
     * @inheritDoc
     * @throws NotFoundTemplateException
    */
    public function getContent(): string
    {
        if (!$this->exists()) {
            throw new NotFoundTemplateException($this->path);
        }

        extract($this->parameters, EXTR_SKIP);
        ob_start();
        require $this->path;
        return ob_get_clean();
    }





    /**
     * @inheritDoc
     * @return string
     * @throws NotFoundTemplateException
    */
    public function __toString(): string
    {
        return $this->getContent();
    }
}
