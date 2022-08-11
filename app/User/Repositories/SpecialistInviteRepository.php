<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\SpecialistInvite;
use App\Base\Traits\RepositoryBase;

class SpecialistInviteRepository
{
    use RepositoryBase;

    public function __construct(private SpecialistInvite $model)
    {
    }
}
