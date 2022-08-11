<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use App\User\Exceptions\UserNotFoundException;
use App\User\Services\LoaderUserService;
use Illuminate\Http\JsonResponse;

class GetUserUnauthenticatedController extends Controller
{
    use ResponseBase;

    public function __construct(
        private LoaderUserService $loaderUserService
    ) {
    }

    /**
     * @param int $userId
     * @return JsonResponse
     */
    public function handle(int $userId): JsonResponse
    {
        try {
            $user = $this->loaderUserService
                ->getUser($userId);

            return $this->response('success', $user->toArray());
        } catch (
            UserNotFoundException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
