<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\Role;
use App\Base\Traits\RepositoryBase;

class RoleRepository
{
    use RepositoryBase;

    public function __construct(private Role $model)
    {
    }
}
