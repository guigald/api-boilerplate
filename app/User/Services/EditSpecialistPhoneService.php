<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\UpdateException;
use App\User\Repositories\SpecialistPhoneRepository;

class EditSpecialistPhoneService
{
    public function __construct(
        private SpecialistPhoneRepository $specialistPhoneRepository
    ) {
    }

    /**
     * @param int $specialistId
     * @param array $data
     * @throws UpdateException
     */
    public function editSpecialistPhone(int $specialistId, array $data): void
    {
        foreach (data_get($data, 'phones') as $phone) {
            if (data_get($phone, 'main')) {
                $this->specialistPhoneRepository
                    ->unableMainBySpecialistId($specialistId);
            }

            $phoneId = data_get($phone, 'id');
            unset($phone['id']);

            $this->specialistPhoneRepository->update($phoneId, $phone);
        }
    }
}
