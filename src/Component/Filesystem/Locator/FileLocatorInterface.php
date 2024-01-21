<?php
declare(strict_types=1);

namespace Laventure\Component\Filesystem\Locator;


/**
 * FileLocatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\Locator
*/
interface FileLocatorInterface
{
     /**
      * Localize full path
      *
      * @param string $file
      *
      * @return string
     */
     public function locate(string $file): mixed;





     /**
      * @param string $pattern
      *
      * @return array
     */
     public function locateResources(string $pattern): array;






     /**
      * Returns base path
      *
      * @return string
     */
     public function root(): string;
}