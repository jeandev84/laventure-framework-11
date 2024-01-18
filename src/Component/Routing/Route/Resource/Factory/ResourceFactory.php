<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Factory;

use Exception;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Component\Routing\Route\Resource\Types\WebResource;

/**
 * ResourceFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource\Factory
 */
class ResourceFactory implements ResourceFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createResource(string $type, string $name, string $controller): ResourceInterface
    {
        return match ($type) {
            ResourceType::WEB => $this->createWebResource($name, $controller),
            ResourceType::API => $this->createApiResource($name, $controller),
            default           => new Exception("Could not create resource type $type")
        };
    }



    /**
     * @inheritDoc
    */
    public function createWebResource(string $name, string $controller): ResourceInterface
    {
        return new WebResource($name, $controller);
    }



    /**
     * @inheritDoc
    */
    public function createApiResource(string $name, string $controller): ResourceInterface
    {
        return new ApiResource($name, $controller);
    }
}
