<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Kernel\Contract;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * HttpKernelInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Kernel
*/
interface HttpKernelInterface extends TerminableInterface
{
    /**
     * @param $request
     *
     * @return mixed
    */
    public function handle($request): mixed;
}
