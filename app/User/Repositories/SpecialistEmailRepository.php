<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Helpers\DateHelper;
use App\Base\Models\Eloquent\SpecialistEmail;
use App\Base\Traits\RepositoryBase;
use Exception;

class SpecialistEmailRepository
{
    use RepositoryBase;

    public function __construct(private SpecialistEmail $model)
    {
    }

    /**
     * @param int $specialistId
     * @return SpecialistEmail|null
     */
    public function fetchEmailsBySpecialistId(
        int $specialistId
    ): ?SpecialistEmail {
        return $this->model
            ->select([
                'id',
                'email',
                'main',
            ])
            ->where('specialists_id', $specialistId)
            ->get();
    }

    /**
     * @param int $specialistId
     */
    public function unableMainBySpecialistId(int $specialistId): void
    {
        $this->model
            ->where('specialists_id', $specialistId)
            ->update([
                'main' => false,
                'updated_at' => DateHelper::now()
            ]);
    }
}
