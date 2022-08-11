<?php

declare(strict_types=1);

namespace App\File\Services;

use App\Base\Helpers\UploadHelper;
use App\File\Exceptions\FileNotFoundException;
use App\File\Exceptions\PermissionDeniedException;
use App\File\Repositories\TemporaryFileRepository;

class DeleteFileService
{
    public function __construct(
        private TemporaryFileRepository $temporaryFileRepository
    ) {
    }

    /**
     * @param int $fileId
     * @throws FileNotFoundException
     * @throws PermissionDeniedException
     */
    public function deleteFile(int $fileId): void
    {
        $file = $this->temporaryFileRepository->fetchById($fileId);

        if ($file === null) {
            throw new FileNotFoundException();
        }

        $path = data_get($file, 'path');

        if (!str_contains($path, 'public/')) {
            throw new PermissionDeniedException();
        }

        UploadHelper::deletePublicFile($path);
        $this->temporaryFileRepository->forceDelete($fileId);
    }
}
