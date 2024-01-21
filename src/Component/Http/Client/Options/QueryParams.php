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
 * @package  Laventure\Component\Http\Client\Options
 */
class QueryParams extends Parameter
{
    protected string $separator;

    public function __construct(array $params = [], string $separator = '&')
    {
        parent::__construct($params);
        $this->withSeparator($separator);
    }


    /**
     * @param string $separator
     * @return $this
    */
    public function withSeparator(string $separator): static
    {
        $this->separator = $separator;

        return $this;
    }




    /**
     * @return string
    */
    public function toString(): string
    {
        return http_build_query($this->params, '', $this->separator);
    }
}
