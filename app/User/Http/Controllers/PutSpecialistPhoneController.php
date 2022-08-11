<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\UpdateException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\EditSpecialistPhoneRequest;
use App\User\Services\EditSpecialistPhoneService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PutSpecialistPhoneController extends Controller
{
    use ResponseBase;

    public function __construct(
        private EditSpecialistPhoneService $editSpecialistPhoneService
    ) {
    }

    /**
     * @param EditSpecialistPhoneRequest $request
     * @param int $specialistId
     * @return JsonResponse
     */
    public function handle(
        EditSpecialistPhoneRequest $request,
        int $specialistId
    ): JsonResponse {
        $data = $request->validated();

        try {
            $this->editSpecialistPhoneService->editSpecialistPhone($specialistId, $data);

            return $this->response('updated');
        } catch (UpdateException $e) {
            return $this->response('error', [], $e);
        }
    }
}
