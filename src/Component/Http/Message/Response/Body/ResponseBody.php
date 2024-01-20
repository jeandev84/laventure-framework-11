<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Body;

use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;

/**
 * ResponseBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Body
 *
 * @see https://www.php.net/manual/en/wrappers.php.php
*/
class ResponseBody extends Stream
{
    /**
     * @var array
    */
    protected array $contents = [];




    /**
     * @throws StreamException
    */
    public function __construct()
    {
        parent::__construct('php://output', 'w+');
    }



    /**
     * @param string $string
     * @return int
    */
    public function write(string $string): int
    {
        ob_start();
        parent::write($string);
        $this->contents[] = ob_get_clean();
        return 1;
    }


    /**
     * @return string
    */
    public function getContents(): string
    {
        return join($this->contents);
    }
}
