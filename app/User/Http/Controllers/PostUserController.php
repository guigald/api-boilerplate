<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\CreateException;
use App\Base\Exceptions\UpdateException;
use App\User\Exceptions\DuplicatedInformationException;
use App\User\Exceptions\UserAlreadyExistsException;
use App\User\Exceptions\UserNotCreatedException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\CreateUserRequest;
use App\User\Services\CreateUserService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;
use SendGrid\Mail\TypeException;
use Throwable;

class PostUserController extends Controller
{
    use ResponseBase;

    public function __construct(private CreateUserService $createUserService)
    {
    }

    /**
     * @param CreateUserRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function handle(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $userId = $this->createUserService->create($data);

            return $this->response('created', ['users_id' => $userId]);
        } catch (
            CreateException |
            UpdateException |
            TypeException |
            UserNotCreatedException |
            UserAlreadyExistsException |
            DuplicatedInformationException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
