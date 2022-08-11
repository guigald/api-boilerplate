<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\UpdateException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\EditSpecialistAddressRequest;
use App\User\Services\EditSpecialistAddressService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PutSpecialistAddressController extends Controller
{
    use ResponseBase;

    public function __construct(
        private EditSpecialistAddressService $editSpecialistAddressService
    ) {
    }

    /**
     * @param EditSpecialistAddressRequest $request
     * @param int $specialistId
     * @return JsonResponse
     */
    public function handle(
        EditSpecialistAddressRequest $request,
        int $specialistId
    ): JsonResponse {
        $data = $request->validated();

        try {
            $this->editSpecialistAddressService
                ->editSpecialistAddress($specialistId, $data);

            return $this->response('updated');
        } catch (UpdateException $e) {
            return $this->response('error', [], $e);
        }
    }
}
