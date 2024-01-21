<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * Upload
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\DTO
 */
class Upload
{
    /**
     * @var false|resource
     */
    public $resource;

    public string $file;


    /**
     * @param string $file
    */
    public function __construct(string $file)
    {
        $this->resource = @fopen($file, 'w');
        $this->file     = $file;
    }
}
