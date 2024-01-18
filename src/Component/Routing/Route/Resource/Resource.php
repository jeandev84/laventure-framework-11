<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\RouteInterface;

/**
 * Resource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource
*/
abstract class Resource implements ResourceInterface
{
    /**
     * @var string
    */
    private string $type;



    /**
     * @var string
    */
    protected string $name;



    /**
     * @var string
    */
    protected string $controller;


    /**
     * @param string $type
     * @param string $name
     *
     * @param string $controller
    */
    public function __construct(string $type, string $name, string $controller)
    {
        $this->type       = $type;
        $this->name       = strtolower($name);
        $this->controller = $controller;
    }




    /**
     * @param string $suffix
     *
     * @return string
    */
    protected function path(string $suffix = ''): string
    {
        return sprintf('%s%s', $this->name, $suffix);
    }






    /**
     * @param string $action
     *
     * @return array
    */
    protected function action(string $action): array
    {
        return [$this->controller, $action];
    }







    /**
     * @param string $name
     *
     * @return string
    */
    protected function name(string $name): string
    {
        return sprintf('%s.%s', $this->name, $name);
    }





    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @inheritdoc
    */
    public function getController(): string
    {
        return $this->controller;
    }




    /**
     * @inheritdoc
    */
    public function getType(): string
    {
        return $this->type;
    }
}
