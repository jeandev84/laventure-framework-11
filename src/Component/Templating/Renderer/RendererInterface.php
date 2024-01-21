<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Renderer;

/**
 * RendererInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Renderer
 */
interface RendererInterface
{
    /**
     * Set resource path
     *
     * @param string $path
     * @return mixed
    */
    public function resourcePath(string $path): mixed;





    /**
    * add global data using in template
    *
    * @param array $data
    * @return mixed
      */
    public function addGlobals(array $data): mixed;





    /**
     * named path add by alias for example
     *
     * @param string $id
     * @param string $path
     * @return mixed
    */
    public function addPath(string $id, string $path): mixed;





    /**
     * @param array $extensions
     *
     * @return mixed
    */
    public function addExtensions(array $extensions): mixed;






    /**
     * @param string $path
     * @param array $data
     * @return string
    */
    public function render(string $path, array $data = []): string;






    /**
     * Returns all globals data
     *
     * @return array
    */
    public function getGlobals(): array;






    /**
     * Returns all extensions
     *
     * @return array
    */
    public function getExtensions(): array;






    /**
     * Returns all named paths
     *
     * @return array
    */
    public function getPaths(): array;
}
