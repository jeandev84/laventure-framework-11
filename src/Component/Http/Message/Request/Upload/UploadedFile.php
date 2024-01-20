<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Upload;

use Laventure\Component\Http\Message\Request\Upload\DTO\File;
use Laventure\Component\Http\Message\Request\Upload\Exception\UploadException;
use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * UploadedFile
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Upload
*/
class UploadedFile implements UploadedFileInterface
{
    /**
     * @var StreamInterface
    */
    protected $stream;



    /**
     * @param int $error
     * @param string|null $clientFilename
     * @param string|null $clientMediaType
     * @param int|null $size
     * @param string|null $fullPath
     * @param string|null $tempName
    */
    public function __construct(
        protected int $error,
        protected ?string $clientFilename,
        protected ?string $clientMediaType,
        protected ?int $size,
        protected ?string $fullPath,
        protected ?string $tempName
    ) {
    }




    /**
     * @param StreamInterface $stream
     *
     * @return $this
    */
    public function withStream(StreamInterface $stream): static
    {
        $this->stream = $stream;

        return $this;
    }





    /**
     * @inheritDoc
     * @throws StreamException
    */
    public function getStream(): StreamInterface
    {
        if (! $this->stream) {
            $this->stream = new Stream($this->fullPath);
        }

        return $this->stream;
    }




    /**
     * @inheritDoc
     * @throws UploadException
    */
    public function moveTo(string $targetPath): void
    {
        if($this->error !== UPLOAD_ERR_OK) {
            throw new UploadException($this->error);
        }

        $dirname = dirname($targetPath);

        if(!is_dir($dirname)) {
            mkdir($dirname, 0777, true);
        }

        move_uploaded_file($this->tempName, $targetPath);
    }






    /**
     * @inheritDoc
    */
    public function getSize(): ?int
    {
        return $this->size;
    }




    /**
     * @inheritDoc
    */
    public function getError(): int
    {
        return $this->error;
    }




    /**
     * @inheritDoc
    */
    public function getClientFilename(): ?string
    {
        return $this->clientFilename;
    }




    /**
     * @inheritDoc
    */
    public function getClientMediaType(): ?string
    {
        return $this->clientMediaType;
    }
}
