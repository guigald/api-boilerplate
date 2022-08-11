<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Exceptions\SpecialistNotValidatedException;
use App\Auth\Exceptions\UnauthorizedException;
use App\Auth\Services\RefreshTokenService;
use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class RefreshTokenController extends Controller
{
    use ResponseBase;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(
        private RefreshTokenService $refreshTokenService
    ) {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @return JsonResponse
     */
    public function handler(): JsonResponse
    {
        try {
            return $this->response(
                'success',
                $this->refreshTokenService->refresh()
            );
        } catch (
            UnauthorizedException  |
            SpecialistNotValidatedException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
