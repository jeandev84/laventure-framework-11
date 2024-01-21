<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Renderer\Adapters;

use Laventure\Component\Templating\Renderer\RendererInterface;

/**
 * TwigRendererAdapter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Renderer\Adapters
 */
class TwigRendererAdapter implements RendererInterface
{
    /**
     * @inheritdoc
     */
    public function resourcePath(string $path): static
    {
        return $this;
    }



    /**
     * @inheritDoc
     */
    public function addGlobals(array $data): static
    {
        return $this;
    }




    /**
     * @inheritDoc
     */
    public function addPath(string $id, string $path): static
    {
        return $this;
    }




    /**
     * @inheritDoc
     */
    public function addExtensions(array $extensions): static
    {
        return $this;
    }




    /**
     * @inheritDoc
     */
    public function render(string $path, array $data = []): string
    {
        return '';
    }




    /**
     * @inheritDoc
     */
    public function getGlobals(): array
    {
        return [];
    }




    /**
     * @inheritDoc
     */
    public function getExtensions(): array
    {
        return [];
    }





    /**
     * @inheritDoc
     */
    public function getPaths(): array
    {
        return [];
    }
}
