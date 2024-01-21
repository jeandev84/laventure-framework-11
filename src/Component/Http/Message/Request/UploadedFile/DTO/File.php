<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\UploadedFile\DTO;

/**
 * ClientFile
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Upload
*/
class File
{
    /**
     * @param string|null $name
     * @param string|null $fullPath
     * @param string|null $type
     * @param string|null $tempName
     * @param int|null $error
     * @param int|null $size
    */
    public function __construct(
        public ?string   $name,
        public ?string   $fullPath,
        public ?string   $type,
        public ?string $tempName,
        public ?int $error,
        public ?int $size
    ) {
    }
}
