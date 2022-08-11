<?php

declare(strict_types=1);

namespace App\File\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use App\File\Services\LoaderFileService;
use Exception;
use Illuminate\Http\JsonResponse;

class GetFileUrlController extends Controller
{
    use ResponseBase;

    public function __construct(
        private LoaderFileService $loaderFileService
    ) {
    }

    /**
     * @param string $bucket
     * @param string $path
     * @return JsonResponse
     */
    public function handle(string $bucket, string $path): JsonResponse
    {
        try {
            $url = $this->loaderFileService->getFileUrl($bucket, $path);

            return $this->response(
                'success',
                ['url' => $url]
            );
        } catch (Exception $e) {
            return $this->response('error', [], $e);
        }
    }
}
