<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\CreateException;
use App\User\Repositories\AddressRepository;

class CreateUserAddressService
{
    public function __construct(
        private AddressRepository $addressRepository
    ) {
    }

    /**
     * @param array $data
     * @return int
     * @throws CreateException
     */
    public function createUserAddress(array $data): int
    {
        return $this->addressRepository->create($data);
    }
}
