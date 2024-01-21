<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Utils\Params;

use Laventure\Component\Http\Utils\Params\Parameter;
use Stringable;

/**
 * QueryParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Utils\Params
 */
class QueryParams extends Parameter implements Stringable
{
    protected $separator = '';

    public function __construct(array $params = [], string $separator = '&')
    {
        parent::__construct($params);
        $this->separator = $separator;
    }

    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return http_build_query($this->params, '', $this->separator);
    }
}
