<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Utils;

use Laventure\Component\Http\Utils\Params\Parameter;

/**
 * QueryParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Utils
 */
class QueryParams extends Parameter implements \Stringable
{
    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }

    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if ($this->empty()) {
            return '';
        }

        return '?' . http_build_query($this->params);
    }
}