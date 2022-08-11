<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\CreateException;
use App\Base\Models\Eloquent\Specialist;
use App\User\Exceptions\SpecialistNotFoundException;
use App\User\Repositories\SpecialistAddressRepository;
use App\User\Repositories\SpecialistEmailRepository;
use App\User\Repositories\SpecialistPhoneRepository;
use App\User\Repositories\SpecialistRepository;
use App\User\Repositories\SpecialistSkillRepository;

class LoaderSpecialistService
{
    public function __construct(
        private SpecialistRepository $specialistRepository,
        private SpecialistEmailRepository $specialistEmailRepository,
        private SpecialistPhoneRepository $specialistPhoneRepository,
        private SpecialistSkillRepository $specialistSkillRepository,
        private SpecialistAddressRepository $specialistAddressRepository
    ) {
    }

    /**
     * @param int $specialistId
     * @return Specialist
     * @throws SpecialistNotFoundException
     */
    public function getSpecialist(int $specialistId): Specialist
    {
        $specialist = $this->getSpecialistById($specialistId);

        if ($specialist === null) {
            throw new SpecialistNotFoundException();
        }

        data_set(
            $specialist,
            'addresses',
            $this->getSpecialistAddressesById($specialistId)
        );

        data_set(
            $specialist,
            'emails',
            $this->getSpecialistEmailsById($specialistId)
        );

        data_set(
            $specialist,
            'phones',
            $this->getSpecialistPhonesById($specialistId)
        );

        data_set(
            $specialist,
            'skills',
            $this->getSpecialistSkillsById($specialistId)
        );

        return $specialist;
    }

    /**
     * @param int $specialistId
     * @return Specialist|null
     */
    private function getSpecialistById(int $specialistId): ?Specialist
    {
        return $this->specialistRepository
            ->fetchOneById($specialistId);
    }

    /**
     * @param int $specialistId
     * @return array
     */
    private function getSpecialistAddressesById(int $specialistId): array
    {
        return $this->specialistAddressRepository
            ->fetchAddressesBySpecialistId($specialistId)
            ->toArray();
    }

    /**
     * @param int $specialistId
     * @return array
     */
    private function getSpecialistEmailsById(int $specialistId): array
    {
        return $this->specialistEmailRepository
            ->fetchEmailsBySpecialistId($specialistId)
            ->toArray();
    }

    /**
     * @param int $specialistId
     * @return array
     */
    private function getSpecialistPhonesById(int $specialistId): array
    {
        return $this->specialistPhoneRepository
            ->fetchPhonesBySpecialistId($specialistId)
            ->toArray();
    }

    /**
     * @param int $specialistId
     * @return array
     */
    private function getSpecialistSkillsById(int $specialistId): array
    {
        return $this->specialistSkillRepository
            ->fetchSkillsBySpecialistId($specialistId)
            ->toArray();
    }
}
