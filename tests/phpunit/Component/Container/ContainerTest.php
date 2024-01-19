<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Container;

use Laventure\Component\Container\Container;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\Component\Container\Utils\FakeContainer;
use Psr\Container\ContainerInterface;

/**
 * ContainerTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Container
*/
class ContainerTest extends TestCase
{
       public function testInstance(): void
       {
           $fake       = new FakeContainer();
           $instance1  = new Container();
           $instance2  = new Container();
           $container1 = Container::getInstance();
           $container2 = Container::getInstance();

           $this->assertInstanceOf(ContainerInterface::class, $container1);
           $this->assertInstanceOf(ContainerInterface::class, $container2);
           $this->assertSame($container1, $container2);
           $this->assertNotSame($instance1, $container1);
           $this->assertNotSame($instance2, $container2);
           $this->assertNotSame($instance1, $instance2);
           $this->assertNotInstanceOf(ContainerInterface::class, $fake);
       }
}
