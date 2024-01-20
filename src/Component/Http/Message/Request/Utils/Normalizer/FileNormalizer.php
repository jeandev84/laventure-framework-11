<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Utils\Normalizer;

use Laventure\Component\Http\Message\Request\Factory\UploadedFileFactory;
use Psr\Http\Message\UploadedFileInterface;

use function gettype;

/**
 * UploadedFileNormalizer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Utils\Normalizer
*/
class FileNormalizer
{
    /**
     * @param array $files
     * @return array
    */
    public static function normalize(array $files): array
    {
        $normalized = [];

        foreach (self::transformFiles($files) as $id => $uploadedFiles) {
            foreach ($uploadedFiles as $uploadedFile) {
                if (is_array($uploadedFile)) {
                    $uploadedFile = UploadedFileFactory::createFromArray($uploadedFile);
                }
                if (! $uploadedFile instanceof UploadedFileInterface) {
                    throw new \RuntimeException("Could not normalize uploaded file type : ". gettype($uploadedFile));
                }
                if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
                    continue;
                }
                $normalized[$id][] = $uploadedFile;
            }
        }

        return $normalized;
    }





    /**
     * @param array $files
     * @return array
    */
    public static function transformFiles(array $files): array
    {
        $transformed = [];

        foreach ($files as $name => $fileInfo) {
            if (is_array($fileInfo['name'])) {
                foreach ($fileInfo as $attribute => $file) {
                    foreach ($file as $index => $value) {
                        $transformed[$name][$index][$attribute] = $value;
                    }
                }
            } else {
                $transformed[$name][] = $fileInfo;
            }
        }

        return $transformed;
    }
}
