<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\Company;
use App\Base\Traits\RepositoryBase;

class CompanyRepository
{
    use RepositoryBase;

    public function __construct(private Company $model)
    {
    }
}
