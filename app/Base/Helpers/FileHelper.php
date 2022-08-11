<?php

namespace App\Base\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public const DRIVER = [
        'storage' => 'CLOUD_DRIVER',
        'assets' => 'ASSETS_DRIVER',
    ];

    /**
     * @param string $bucket
     * @param string $fileName
     * @param int $minutesToExpire
     * @return string
     */
    public static function getFileUrl(
        string $bucket,
        string $fileName,
        int $minutesToExpire = 10
    ): string {
        return Storage::disk(env(self::DRIVER[$bucket]))
            ->temporaryUrl($fileName, now()->addMinutes($minutesToExpire));
    }

    /**
     * @param string $path
     * @return string
     */
    public static function getFileExtension(string $path): string
    {
        $pathArray = explode('.', $path);
        $extensionArray = explode('?', end($pathArray));
        return current($extensionArray);
    }
}
