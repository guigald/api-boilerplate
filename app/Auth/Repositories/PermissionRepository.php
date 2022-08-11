<?php

declare(strict_types=1);

namespace App\Auth\Repositories;

use App\Base\Models\Eloquent\Permission;
use App\Base\Traits\RepositoryBase;
use Illuminate\Support\Collection;

class PermissionRepository
{
    use RepositoryBase;

    public function __construct(private Permission $model)
    {
    }

    /**
     * @param string $role
     * @return Collection|null
     */
    public function fetchByRole(string $role): ?Collection
    {
        return $this->model
            ->where('slug', 'like', '%' . $role . '%')
            ->get();
    }
}
