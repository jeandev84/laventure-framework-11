<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

use Laventure\Component\Http\Message\Response\Utils\JsonEncoder;

/**
 * Json (DTO as value object)
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Options
*/
class Json
{
    public string $data;


    /**
     * @param array|string $value
    */
    public function __construct(array|string $value)
    {
        if (is_array($value)) {
            $value = JsonEncoder::encode($value);
        }

        $this->data = $value;
    }
}
