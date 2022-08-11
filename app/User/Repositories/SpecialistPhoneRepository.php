<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Helpers\DateHelper;
use App\Base\Models\Eloquent\SpecialistPhone;
use App\Base\Traits\RepositoryBase;
use Illuminate\Support\Collection;

class SpecialistPhoneRepository
{
    use RepositoryBase;

    public function __construct(private SpecialistPhone $model)
    {
    }

    /**
     * @param int $specialistId
     * @return Collection
     */
    public function fetchPhonesBySpecialistId(int $specialistId): Collection
    {
        return $this->model
            ->select([
                'id',
                'phone',
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
