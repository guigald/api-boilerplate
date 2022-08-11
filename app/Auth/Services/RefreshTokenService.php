<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Exceptions\SpecialistNotValidatedException;
use App\Auth\Exceptions\UnauthorizedException;
use App\Auth\Repositories\PermissionRepository;
use App\Auth\Repositories\UserRepository;
use App\Base\Helpers\StringHelper;
use App\Base\Models\Eloquent\Permission;
use App\Base\Models\Eloquent\Specialist;
use App\Base\Models\Eloquent\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RefreshTokenService
{
    public function __construct(
        private AuthService $authService,
    ) {
    }

    /**
     * @return array
     * @throws SpecialistNotValidatedException
     */
    public function refresh()
    {
        return $this->authService->getResponse(auth('api')->refresh());
    }
}
