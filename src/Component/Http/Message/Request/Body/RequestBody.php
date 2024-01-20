<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Body;

use Laventure\Component\Http\Message\Stream\Stream;

/**
 * RequestBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Body
 *
 * @see https://www.php.net/manual/en/wrappers.php.php
*/
class RequestBody extends Stream
{
    public function __construct()
    {
        parent::__construct('php://input', 'r+');
    }
}
