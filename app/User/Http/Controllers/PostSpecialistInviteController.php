<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\CreateException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\CreateSpecialistInviteRequest;
use App\User\Services\CreateSpecialistInviteService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PostSpecialistInviteController extends Controller
{
    use ResponseBase;

    public function __construct(
        private CreateSpecialistInviteService $createSpecialistInviteService
    ) {
    }

    /**
     * @param CreateSpecialistInviteRequest $specialistInviteRequest
     * @return JsonResponse
     */
    public function handle(
        CreateSpecialistInviteRequest $specialistInviteRequest
    ): JsonResponse {
        $data = $specialistInviteRequest->validated();

        try {
            $this->createSpecialistInviteService
                ->createSpecialistInvites($data);

            return $this->response('created');
        } catch (
            CreateException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
