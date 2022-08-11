<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\UserRole;
use App\Base\Traits\RepositoryBase;

class UserRoleRepository
{
    use RepositoryBase;

    public function __construct(private UserRole $model)
    {
    }
}
