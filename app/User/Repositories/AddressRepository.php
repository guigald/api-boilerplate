<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\Address;
use App\Base\Traits\RepositoryBase;
use Illuminate\Support\Collection;

class AddressRepository
{
    use RepositoryBase;

    public function __construct(private Address $model)
    {
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function fetchAddressesBySpecialistId(int $userId): Collection
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
                'complement'
            ])
            ->where('users_id', $userId)
            ->get();
    }
}
