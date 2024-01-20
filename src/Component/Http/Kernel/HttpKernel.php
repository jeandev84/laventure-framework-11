<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Kernel;

use Laventure\Component\Http\Kernel\Contract\HttpKernelInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

/**
 * HttpKernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Kernel
 */
abstract class HttpKernel implements HttpKernelInterface
{
    /**
     * priority middlewares
     *
     * @var string[]
    */
    protected array $middlewarePriority = [];



    /**
     * priority route middlewares
     *
     * @var string[]
    */
    protected array $routeMiddlewares = [];
}
