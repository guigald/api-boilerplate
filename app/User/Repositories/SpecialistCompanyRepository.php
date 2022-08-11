<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\SpecialistCompany;
use App\Base\Traits\RepositoryBase;

class SpecialistCompanyRepository
{
    use RepositoryBase;

    public function __construct(private SpecialistCompany $model)
    {
    }
}
