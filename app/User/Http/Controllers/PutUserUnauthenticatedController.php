<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\UpdateException;
use App\Base\Http\Controllers\Controller;
use App\User\Exceptions\UserNotFoundException;
use App\User\Exceptions\UserWithSameDataException;
use App\User\Http\Requests\UpdateUserUnauthenticatedRequest;
use App\User\Services\UpdateUserService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PutUserUnauthenticatedController extends Controller
{
    use ResponseBase;

    public function __construct(private UpdateUserService $updateUserService)
    {
    }

    /**
     * @param UpdateUserUnauthenticatedRequest $request
     * @param int $userId
     * @return JsonResponse
     */
    public function handle(UpdateUserUnauthenticatedRequest $request, int $userId): JsonResponse
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
