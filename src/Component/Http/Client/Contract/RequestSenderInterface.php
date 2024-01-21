<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Contract;

use Psr\Http\Message\ResponseInterface;

/**
 * RequestSenderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Contract
 */
interface RequestSenderInterface
{
    /**
     * @return ResponseInterface
    */
    public function send(): ResponseInterface;
}
