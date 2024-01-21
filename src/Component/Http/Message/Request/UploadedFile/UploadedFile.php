<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\UploadedFile;

use Laventure\Component\Http\Message\Request\UploadedFile\DTO\File;
use Laventure\Component\Http\Message\Request\UploadedFile\Exception\UploadException;
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
    protected int $error;
    protected ?string $clientFilename;
    protected ?string $clientMediaType;
    protected ?int $size;
    protected ?string $fullPath;
    protected ?string $tempName;


    /**
     * @param int $error
     * @param string|null $clientFilename
     * @param string|null $clientMediaType
     * @param int|null $size
     * @param string|null $fullPath
     * @param string|null $tempName
     * @throws StreamException
    */
    public function __construct(
        int $error,
        ?string $clientFilename,
        ?string $clientMediaType,
        ?int $size,
        ?string $fullPath,
        ?string $tempName
    ) {

        if ($tempName) {
            $this->stream = new Stream($tempName, 'r+');
        }

        $this->error           = $error;
        $this->clientFilename  = $clientFilename;
        $this->clientMediaType = $clientMediaType;
        $this->size            = $size;
        $this->fullPath        = $fullPath;
        $this->tempName        = $tempName;
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
     * @return StreamInterface
    */
    public function getStream(): StreamInterface
    {
        return $this->stream;
    }


    /**
     * @inheritDoc
     * @param string $targetPath
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
