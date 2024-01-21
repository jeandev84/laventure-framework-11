<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Traits;

use Laventure\Component\Http\Utils\Params\Parameter;

/**
 * HasOptionsTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Traits
*/
trait HasOptionsTrait
{
    /**
     * @param array $options
     * @return $this
    */
    public function withOptions(array $options): static
    {
        $options = new Parameter($options);

        foreach ($options->all() as $key => $value) {
            if (!empty($value)) {
                if (method_exists($this, $key)) {
                    call_user_func_array([$this, $key], [$value]);
                }
            }
        }

        return $this;
    }

}
