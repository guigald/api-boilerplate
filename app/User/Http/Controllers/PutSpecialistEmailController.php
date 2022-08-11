<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\UpdateException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\EditSpecialistEmailRequest;
use App\User\Services\EditSpecialistEmailService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PutSpecialistEmailController extends Controller
{
    use ResponseBase;

    public function __construct(
        private EditSpecialistEmailService $editSpecialistEmailService
    ) {
    }

    /**
     * @param EditSpecialistEmailRequest $request
     * @param int $specialistId
     * @return JsonResponse
     */
    public function handle(
        EditSpecialistEmailRequest $request,
        int $specialistId
    ): JsonResponse {
        $data = $request->validated();

        try {
            $this->editSpecialistEmailService->editSpecialistEmail($specialistId, $data);

            return $this->response('updated');
        } catch (UpdateException $e) {
            return $this->response('error', [], $e);
        }
    }
}
