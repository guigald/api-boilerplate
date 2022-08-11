<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Helpers\DateHelper;
use App\Base\Models\Eloquent\SpecialistAddress;
use App\Base\Traits\RepositoryBase;
use Illuminate\Support\Collection;

class SpecialistAddressRepository
{
    use RepositoryBase;

    public function __construct(private SpecialistAddress $model)
    {
    }

    /**
     * @param int $specialistId
     * @return Collection
     */
    public function fetchAddressesBySpecialistId(int $specialistId): Collection
    {
        return $this->model
            ->select([
                'id',
                'postal_code',
                'state',
                'city',
                'neighborhood',
                'street',
                'number',
                'complement',
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
