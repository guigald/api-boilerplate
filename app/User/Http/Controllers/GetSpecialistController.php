<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use App\User\Exceptions\SpecialistNotFoundException;
use App\User\Services\LoaderSpecialistService;
use Illuminate\Http\JsonResponse;

class GetSpecialistController extends Controller
{
    use ResponseBase;

    public function __construct(
        private LoaderSpecialistService $loaderSpecialistService
    ) {
    }

    /**
     * @param int $specialistId
     * @return JsonResponse
     */
    public function handle(int $specialistId): JsonResponse
    {
        try {
            $specialist = $this->loaderSpecialistService
                ->getSpecialist($specialistId);

            return $this->response('success', $specialist->toArray());
        } catch (
            SpecialistNotFoundException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
