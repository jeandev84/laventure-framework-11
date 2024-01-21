<?php

declare(strict_types=1);

namespace Laventure\Component\Config;

/**
 * ConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Config
 */
interface ConfigInterface
{
    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
    */
    public function get(string $name, mixed $default = null): mixed;
}
