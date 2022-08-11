<?php

declare(strict_types=1);

namespace App\File\Http\Controllers;

use App\Base\Exceptions\CreateException;
use App\File\Exceptions\FileNotSavedException;
use App\File\Http\Requests\FileUploadRequest;
use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use App\File\Services\FileService;
use Illuminate\Http\JsonResponse;

class PostFileUploadController extends Controller
{
    use ResponseBase;

    public function __construct(private FileService $fileService)
    {
    }

    /**
     * @param FileUploadRequest $request
     * @return JsonResponse
     */
    public function handle(FileUploadRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $result = $this->fileService->saveFile($data);

            return $this->response('success', $result);
        } catch (CreateException | FileNotSavedException $e) {
            return $this->response('error', [], $e);
        }
    }
}
