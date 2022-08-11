<?php

declare(strict_types=1);

namespace App\Auth\Repositories;

use App\Base\Models\Eloquent\User;
use App\Base\Traits\RepositoryBase;

class UserRepository
{
    use RepositoryBase;

    public function __construct(private User $model)
    {
    }

    /**
     * @param string $field
     * @param string $value
     * @return User|null
     */
    public function fetchOneBy(string $field, string $value): ?User
    {
        return $this->model->where($field, $value)->get()->first();
    }
}
