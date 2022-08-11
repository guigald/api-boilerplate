<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Exceptions\SpecialistNotValidatedException;
use App\Auth\Exceptions\UnauthorizedException;
use Illuminate\Http\Request;

class LoginService
{
    public function __construct(
        private AuthService $authService,
    ) {
    }

    /**
     * @param Request $request
     * @return array
     * @throws SpecialistNotValidatedException
     * @throws UnauthorizedException
     */
    public function login(Request $request): array
    {
        $credentials = $this->authService->getCredentials(
            $request->header('Authorization')
        );

        if (!$token = auth('api')->attempt($credentials)) {
            throw new UnauthorizedException();
        }

        return $this->authService->getResponse((string) $token);
    }
}
