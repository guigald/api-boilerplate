<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\UpdateException;
use App\Base\Http\Controllers\Controller;
use App\User\Exceptions\SpecialistAlreadyExistsException;
use App\User\Http\Requests\EditSpecialistRequest;
use App\User\Services\EditSpecialistService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PutSpecialistController extends Controller
{
    use ResponseBase;

    public function __construct(
        private EditSpecialistService $editSpecialistService
    ) {
    }

    /**
     * @param EditSpecialistRequest $request
     * @param int $specialistId
     * @return JsonResponse
     */
    public function handle(
        EditSpecialistRequest $request,
        int $specialistId
    ): JsonResponse {
        $data = $request->validated();

        try {
            $this->editSpecialistService->editSpecialist($specialistId, $data);

            return $this->response('updated');
        } catch (UpdateException | SpecialistAlreadyExistsException $e) {
            return $this->response('error', [], $e);
        }
    }
}
