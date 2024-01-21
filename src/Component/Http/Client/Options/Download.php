<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * Download
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Options
 */
class Download
{
    /**
     * @var false|resource
    */
    public $resource;


    /**
     * @param string $path
    */
    public function __construct(string $path)
    {
        $this->resource = @fopen($path, 'w');
    }
}
