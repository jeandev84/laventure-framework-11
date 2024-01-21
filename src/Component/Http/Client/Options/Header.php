<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * Header
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\DTO
*/
class Header
{
    public string $name;
    public string|array $value;


    /**
     * @param string $name
     * @param string|array $value
     */
    public function __construct(
        string $name,
        string|array $value
    ) {
        if (is_array($value)) {
            $value = join(', ', $value);
        }

        $this->name  = $name;
        $this->value = $value;
    }
}
