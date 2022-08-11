<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Exceptions\SpecialistNotValidatedException;
use App\Auth\Exceptions\UnauthorizedException;
use App\Auth\Services\LoginService;
use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ResponseBase;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(
        private LoginService $loginService
    ) {
        $this->middleware('auth:api', ['except' => ['handler']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function handler(Request $request): JsonResponse
    {
        try {
            return $this->response(
                'success',
                $this->loginService->login($request)
            );
        } catch (
            UnauthorizedException  |
            SpecialistNotValidatedException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
