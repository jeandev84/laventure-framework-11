<?php
declare(strict_types=1);

namespace Laventure\Component\Filesystem\Locator;


/**
 * FileLocator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\Locator
*/
class FileLocator implements FileLocatorInterface
{


    /**
     * base path
     *
     * @var string
    */
    protected string $root;




    /**
     * @param string $root
    */
    public function __construct(string $root)
    {
        $this->root = $this->normalizeBasePath($root);
    }



    /**
     * @inheritDoc
    */
    public function locate(string $file): string
    {
        return join(DIRECTORY_SEPARATOR, [$this->root, $this->normalizePath($file)]);
    }





    /**
     * @inheritDoc
    */
    public function locateResources(string $pattern): array
    {
        return glob($this->locate($pattern)) ?: [];
    }



    /**
     * @param string $path
     * @return string
    */
    public function normalizePath(string $path): string
    {
        return str_replace(["\\", "/"], DIRECTORY_SEPARATOR, trim($path, '\\/'));
    }




    /**
     * @param string $root
     * @return string
    */
    public function normalizeBasePath(string $root): string
    {
         return rtrim($root, DIRECTORY_SEPARATOR);
    }





    /**
     * @inheritDoc
    */
    public function root(): string
    {
        return $this->root;
    }
}