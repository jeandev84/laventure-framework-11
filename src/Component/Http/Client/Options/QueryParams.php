<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

use Laventure\Component\Http\Utils\Params\Parameter;

/**
 * QueryParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\DTO
 */
class QueryParams extends Parameter
{
    protected $separator = '';

    public function __construct(array $params = [], string $separator = '&')
    {
        parent::__construct($params);
        $this->separator = $separator;
    }


    /**
     * @return string
    */
    public function toString(): string
    {
        return http_build_query($this->params, '', $this->separator);
    }
}
