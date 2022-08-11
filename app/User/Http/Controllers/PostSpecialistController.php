<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\CreateException;
use App\Base\Exceptions\UpdateException;
use App\User\Exceptions\DuplicatedInformationException;
use App\User\Exceptions\SpecialistAlreadyExistsException;
use App\User\Exceptions\UserAlreadyExistsException;
use App\User\Exceptions\UserNotCreatedException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\CreateSpecialistRequest;
use App\User\Http\Requests\CreateUserRequest;
use App\User\Services\CreateSpecialistService;
use App\User\Services\CreateUserService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;
use SendGrid\Mail\TypeException;
use Throwable;

class PostSpecialistController extends Controller
{
    use ResponseBase;

    public function __construct(
        private CreateUserService $createUserService,
        private CreateSpecialistService $createSpecialistService
    ) {
    }

    /**
     * @param CreateSpecialistRequest $specialistRequest
     * @param CreateUserRequest $userRequest
     * @return JsonResponse
     * @throws Throwable
     * @throws TypeException
     */
    public function handle(
        CreateSpecialistRequest $specialistRequest,
        CreateUserRequest $userRequest
    ): JsonResponse {
        $userData = $userRequest->validated();
        $specialistData = $specialistRequest->validated();

        try {
            $userId = $this->createUserService->create($userData);
            $specialistId = $this->createSpecialistService
                ->createSpecialist($userId, $specialistData);

            return $this->response(
                'created',
                [
                    'users_id' => $userId,
                    'specialists_id' => $specialistId,
                ]
            );
        } catch (
            UpdateException |
            SpecialistAlreadyExistsException |
            CreateException |
            UserNotCreatedException |
            UserAlreadyExistsException |
            DuplicatedInformationException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
