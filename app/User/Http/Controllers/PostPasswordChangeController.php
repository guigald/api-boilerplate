<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\UpdateException;
use App\User\Exceptions\TokenExpiredException;
use App\User\Exceptions\UserNotFoundException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\PasswordChangeByHashRequest;
use App\User\Services\ChangeUserPasswordService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PostPasswordChangeController extends Controller
{
    use ResponseBase;

    public function __construct(
        private ChangeUserPasswordService $changeUserPasswordService
    ) {
    }

    /**
     * @param PasswordChangeByHashRequest $request
     * @param string $hash
     * @return JsonResponse
     */
    public function handle(
        PasswordChangeByHashRequest $request,
        string $hash
    ): JsonResponse {
        $data = $request->validated();

        try {
            $this->changeUserPasswordService
                ->changePasswordByHash(data_get($data, 'password'), $hash);

            return $this->response('updated');
        } catch (
            TokenExpiredException |
            UserNotFoundException |
            UpdateException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
