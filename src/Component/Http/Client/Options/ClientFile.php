<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

use Laventure\Component\Http\Client\Exception\ClientException;

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
    public string $path;
    public string $mimeType;
    public string $filename;

    /**
     * @throws ClientException
     */
    public function __construct(
        string $path,
        string $mimeType,
        string $filename
    ) {
        if (!file_exists($path)) {
            throw new ClientException("file $path does not exist.", 409);
        }

        $this->path = $path;
        $this->mimeType = $mimeType;
        $this->filename = $filename;
    }
}
