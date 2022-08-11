<?php

declare(strict_types=1);

namespace App\File\Services;

use App\Base\Exceptions\CreateException;
use App\Base\Helpers\UploadHelper;
use App\File\Exceptions\FileNotSavedException;
use App\File\Repositories\TemporaryFileRepository;

class FileService
{
    public function __construct(
        private TemporaryFileRepository $temporaryFileRepository
    ) {
    }

    /**
     * @param array $data
     * @return array
     * @throws CreateException
     * @throws FileNotSavedException
     */
    public function saveFile(array $data): array
    {
        $file = data_get($data, 'file');
        $type = data_get($data, 'type', 'temp');

        $path = $type === 'temp'
            ? UploadHelper::uploadTemporaryFile($file)
            : UploadHelper::uploadPublicFile($file);

        $fileId = $this->temporaryFileRepository->create([
            'path' => (string) $path,
            'original_name' => $file->getClientOriginalName(),
        ]);

        return [
            'id' => $fileId,
            'file' => (string) $path,
        ];
    }
}
