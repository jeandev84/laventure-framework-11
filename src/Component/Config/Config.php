<?php

declare(strict_types=1);

namespace Laventure\Component\Config;

/**
 * Config
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Config
*/
class Config implements ConfigInterface
{
    /**
     * @param array $config
    */
    public function __construct(private readonly array $config)
    {
    }




    /**
     * @inheritDoc
    */
    public function get(string $name, mixed $default = null): mixed
    {
        $path  = explode('.', $name);
        $value = $this->config[array_shift($path)] ?? null;

        if ($value === null) {
            return $default;
        }

        foreach ($path as $key) {
            if (! isset($value[$key])) {
                return $default;
            }

            $value = $value[$key];
        }

        return $value;
    }
}
