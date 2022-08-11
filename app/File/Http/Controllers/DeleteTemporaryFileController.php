<?php

declare(strict_types=1);

namespace App\File\Http\Controllers;

use App\File\Exceptions\FileNotFoundException;
use App\File\Exceptions\PermissionDeniedException;
use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use App\File\Services\DeleteFileService;
use Illuminate\Http\JsonResponse;

class DeleteTemporaryFileController extends Controller
{
    use ResponseBase;

    public function __construct(
        private DeleteFileService $deleteFileService
    ) {
    }

    /**
     * @param int $fileId
     * @return JsonResponse
     */
    public function handle(int $fileId): JsonResponse
    {
        try {
            $this->deleteFileService->deleteFile($fileId);

            return $this->response('deleted');
        } catch (PermissionDeniedException | FileNotFoundException $e) {
            return $this->response('error', [], $e);
        }
    }
}
