<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Methods\Enums;

/**
 * HttpMethod
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Methods\Enums
*/
enum HttpMethod: string
{
    public const GET     = 'GET';
    public const HEAD    = 'HEAD';
    public const POST    = 'POST';
    public const PUT     = 'PUT';
    public const PATCH   = 'PATCH';
    public const DELETE  = 'DELETE';
}
