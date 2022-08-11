<?php

namespace App\Base\Helpers;

use App\File\Exceptions\FileNotSavedException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadHelper
{
    private const TEMPORARY_DRIVER = [
        'public' => 'CLOUD_DRIVER',
        'temp' => 'TEMPORARY_DRIVER',
    ];

    /**
     * @param UploadedFile $file
     * @return string
     * @throws FileNotSavedException
     */
    public static function uploadPublicFile(UploadedFile $file): string
    {
        $path = Storage::disk(env('CLOUD_DRIVER'))->put('public', $file);

        if (!$path) {
            throw new FileNotSavedException();
        }

        return (string) $path;
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws FileNotSavedException
     */
    public static function uploadTemporaryFile(UploadedFile $file): string
    {
        $path = Storage::disk(env('TEMPORARY_DRIVER'))->put('temp', $file);

        if (!$path) {
            throw new FileNotSavedException();
        }

        return (string) $path;
    }

    /**
     * @param string $path
     * @param string $newPath
     * @return string
     * @throws FileNotSavedException
     */
    public static function uploadFile(string $path, string $newPath): string
    {
        $file = self::getTemporaryFile($path);
        $cloudFile = Storage::disk(env('CLOUD_DRIVER'))->put($newPath, $file);

        if (!$cloudFile) {
            throw new FileNotSavedException();
        }

        return (string) $cloudFile;
    }

    /**
     * @param string $path
     * @return UploadedFile|null
     */
    public static function getTemporaryFile(string $path): ?UploadedFile
    {
        $filePath = Storage::disk(env('TEMPORARY_DRIVER'))->path($path);
        $pathParts = pathinfo($path);
        $fileInfo = getimagesize($filePath);

        return new UploadedFile(
            $filePath,
            $pathParts['basename'],
            data_get($fileInfo, 'mime', FileHelper::getFileExtension($path)),
            filesize($filePath),
            true
        );
    }

    /**
     * @param string $path
     */
    public static function deleteFile(string $path): void
    {
        unlink(Storage::disk(env('TEMPORARY_DRIVER'))->path($path));
    }

    /**
     * @param string $path
     */
    public static function deletePublicFile(string $path): void
    {
        Storage::disk(env('CLOUD_DRIVER'))->delete($path);
    }
}
