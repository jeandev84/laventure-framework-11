<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Factory;

use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;

/**
 * ResourceFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource\Factory
*/
interface ResourceFactoryInterface
{
    /**
     * @param string $type
     * @param string $name
     * @param string $controller
     * @return ResourceInterface
    */
    public function createResource(string $type, string $name, string $controller): ResourceInterface;




    /**
     * @param string $name
     * @param string $controller
     * @return ResourceInterface
    */
    public function createWebResource(string $name, string $controller): ResourceInterface;




    /**
     * @param string $name
     * @param string $controller
     * @return ResourceInterface
    */
    public function createApiResource(string $name, string $controller): ResourceInterface;
}
