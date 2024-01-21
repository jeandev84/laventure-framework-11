<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Filesystem\Locator;

use Laventure\Component\Filesystem\Locator\FileLocator;
use PHPUnit\Framework\TestCase;

/**
 * FileLocatorTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Filesystem\Locator
 */
class FileLocatorTest extends TestCase
{
       public function testIfLocateCorrectlyPath(): void
       {
           $locator = new FileLocator(__DIR__.'/config');

           $expect = [
               'name' => 'Laventure',
               'database' => [
                   'driver' => 'mysql',
                   'host' => '127.0.0.1',
                   'dbname' => 'laventure',
                   'user' => 'root',
                   'password' => 'secret'
               ]
           ];


           $this->assertIsArray(require $locator->locate('app.php'));
           $this->assertSame($expect, require $locator->locate('app.php'));
       }
}
