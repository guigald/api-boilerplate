<?php

declare(strict_types=1);

namespace App\File\Services;

use App\Base\Helpers\FileHelper;

class LoaderFileService
{
    public function __construct()
    {
    }

    /**
     * @param string $bucket
     * @param string $path
     * @return string
     */
    public function getFileUrl(string $bucket, string $path): string
    {
        return FileHelper::getFileUrl(
            $bucket,
            base64_decode($path)
        );
    }
}
