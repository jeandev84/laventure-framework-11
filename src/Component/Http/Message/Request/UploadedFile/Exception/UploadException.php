<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\UploadedFile\Exception;

use Exception;

/**
 * UploadException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Upload\Exception
 *
 * @see https://www.php.net/manual/en/features.file-upload.errors.php
*/
class UploadException extends Exception
{
    /**
     * @param int $code
    */
    public function __construct(int $code)
    {
        parent::__construct($this->codeToMessage($code), $code);
    }


    /**
     * @param int $code
     * @return string
    */
    private function codeToMessage(int $code): string
    {
        return match($code) {
            UPLOAD_ERR_INI_SIZE    => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
            UPLOAD_ERR_FORM_SIZE   => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
            UPLOAD_ERR_PARTIAL     => "The uploaded file was only partially uploaded",
            UPLOAD_ERR_NO_FILE     => "No file was uploaded",
            UPLOAD_ERR_NO_TMP_DIR  => "Missing a temporary folder",
            UPLOAD_ERR_CANT_WRITE  => "Failed to write file to disk",
            UPLOAD_ERR_EXTENSION   => "ClientFile upload stopped by extension",
            default                => "Unknown upload error"
        };
    }



}
