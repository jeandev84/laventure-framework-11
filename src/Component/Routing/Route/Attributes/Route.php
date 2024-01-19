<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Attributes;

use Attribute;

/**
 * Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Attributes
*/
#[Attribute(
    Attribute::TARGET_METHOD | Attribute::TARGET_CLASS
)]
class Route
{
    public function __construct(
        protected string $path,
        protected array $methods = ['GET'],
        protected string $name = '',
        protected array $requirements = [],
        protected array $default = []
    ) {
    }


    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }


    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }


    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return array
     */
    public function getRequirements(): array
    {
        return $this->requirements;
    }


    /**
     * @return array
    */
    public function getDefault(): array
    {
        return $this->default;
    }
}
