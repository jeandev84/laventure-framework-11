<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Types;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Resource\Decorator\ResourceCollectorDecorator;
use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\Resource\Resource;

/**
 * ApiResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource\Types
*/
class ApiResource extends Resource
{
    /**
     * @param string $name
     * @param string $controller
    */
    public function __construct(string $name, string $controller)
    {
        parent::__construct(ResourceType::API, $name, $controller);
    }




    /**
     * @inheritDoc
    */
    public function map(RouteCollectorInterface $collector): RouteCollectorInterface
    {
        $decorator = new ResourceCollectorDecorator($collector, $this->controller);
        $decorator->map('GET|HEAD', $this->path(), $this->action('index'), $this->name('index'));
        $decorator->get($this->path('/{id}'), $this->action('show'), $this->name('show'));
        $decorator->post($this->path(), $this->action('store'), $this->name('store'));
        $decorator->map('PUT|PATCH', $this->path('/{id}'), $this->action('update'), $this->name('update'));
        $decorator->delete($this->path('/{id}'), $this->action('destroy'), $this->name('destroy'));
        return $collector;
    }
}
