<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;

/**
 * StreamResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
 */
class StreamResponse extends Response
{
    /**
     * @param resource|string $resource
     * @param int $status
     * @param array $headers
     * @throws StreamException
    */
    public function __construct(mixed $resource, int $status = 200, array $headers = [])
    {
        parent::__construct($status, $headers, new Stream($resource));
    }
}
