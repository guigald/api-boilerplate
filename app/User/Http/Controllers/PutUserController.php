<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\UpdateException;
use App\Base\Http\Controllers\Controller;
use App\User\Exceptions\UserNotFoundException;
use App\User\Exceptions\UserWithSameDataException;
use App\User\Http\Requests\UpdateUserRequest;
use App\User\Services\UpdateUserService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PutUserController extends Controller
{
    use ResponseBase;

    public function __construct(private UpdateUserService $updateUserService)
    {
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $userId
     * @return JsonResponse
     */
    public function handle(UpdateUserRequest $request, int $userId): JsonResponse
    {
        $data = $request->validated();

        try {
            $this->updateUserService->updateUser($userId, $data);

            return $this->response('updated');
        } catch (
            UpdateException |
            UserNotFoundException |
            UserWithSameDataException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
