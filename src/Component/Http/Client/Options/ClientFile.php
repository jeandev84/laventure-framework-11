<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * ClientFile
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Options
*/
class ClientFile
{

    public function __construct(
        public string $path,
        public string $mimeType,
        public string $filename
    )
    {
    }
}
