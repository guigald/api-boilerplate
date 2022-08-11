<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\UpdateException;
use App\User\Repositories\SpecialistAddressRepository;

class EditSpecialistAddressService
{
    public function __construct(
        private SpecialistAddressRepository $specialistAddressRepository
    ) {
    }

    /**
     * @param int $specialistId
     * @param array $data
     * @throws UpdateException
     */
    public function editSpecialistAddress(int $specialistId, array $data): void
    {
        foreach (data_get($data, 'addresses') as $address) {
            if (data_get($address, 'main')) {
                $this->specialistAddressRepository
                    ->unableMainBySpecialistId($specialistId);
            }

            $addressId = data_get($address, 'id');
            unset($address['id']);

            $this->specialistAddressRepository->update($addressId, $address);
        }
    }
}
