<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\CreateException;
use App\Base\Models\Eloquent\Role;
use App\Base\Models\Eloquent\Specialist;
use App\User\Exceptions\SpecialistAlreadyExistsException;
use App\User\Repositories\CompanyRepository;
use App\User\Repositories\SpecialistAddressRepository;
use App\User\Repositories\SpecialistCompanyRepository;
use App\User\Repositories\SpecialistEmailRepository;
use App\User\Repositories\SpecialistPhoneRepository;
use App\User\Repositories\SpecialistRepository;
use App\User\Repositories\SpecialistSkillRepository;
use App\User\Repositories\UserRoleRepository;

class CreateSpecialistService
{
    public function __construct(
        private SpecialistRepository $specialistRepository,
        private SpecialistEmailRepository $specialistEmailRepository,
        private SpecialistPhoneRepository $specialistPhoneRepository,
        private SpecialistSkillRepository $specialistSkillRepository,
        private SpecialistAddressRepository $specialistAddressRepository,
        private UserRoleRepository $userRoleRepository,
        private SpecialistCompanyRepository $specialistCompanyRepository,
        private CompanyRepository $companyRepository
    ) {
    }

    /**
     * @param int $userId
     * @param array $data
     * @return int|null
     * @throws CreateException
     * @throws SpecialistAlreadyExistsException
     */
    public function createSpecialist(int $userId, array $data): ?int
    {
        $specialist = $this->getSpecialistByUserId($userId);

        if ($specialist !== null) {
            return data_get($specialist, 'id');
        }

        $documentTypeId = data_get($data, 'specialist_document_types_id', null);
        $document = data_get($data, 'specialist_document', null);
        $addresses = data_get($data, 'addresses', null);
        $emails = data_get($data, 'emails', null);
        $phones = data_get($data, 'phones', null);
        $skills = data_get($data, 'skills', null);

        $specialistData = [
            // TODO: Remove this when the admin screen to validate is created
            'validated' => true,
        ];

        data_set($specialistData, 'users_id', $userId);

        if ($documentTypeId !== null) {
            data_set(
                $specialistData,
                'specialist_document_types_id',
                $documentTypeId
            );

            $specialist = $this->getSpecialistByDocument(
                $documentTypeId,
                $document
            );

            if ($specialist !== null) {
                throw new SpecialistAlreadyExistsException();
            }
        }

        if ($document !== null) {
            data_set($specialistData, 'specialist_document', $document);
        }

        $specialistId = $this->specialistRepository->create($specialistData);

        $this->addSpecialistInCompany($specialistId, $data);
        $this->setAddresses($addresses, $specialistId);
        $this->setEmails($emails, $specialistId);
        $this->setPhones($phones, $specialistId);
        $this->setSkills($skills, $specialistId);
        $this->addSpecialistRole($userId);

        return $specialistId;
    }

    /**
     * @param int $userId
     * @throws CreateException
     */
    private function addSpecialistRole(int $userId): void
    {
        $this->userRoleRepository->create([
            'users_id' => $userId,
            'roles_id' => Role::SPECIALIST,
        ]);
    }

    /**
     * @param array|null $addresses
     * @param int $specialistId
     * @throws CreateException
     */
    private function setAddresses(?array $addresses, int $specialistId): void
    {
        foreach ($addresses as $address) {
            data_set($address, 'specialists_id', $specialistId);
            $this->specialistAddressRepository->create($address);
        }
    }

    /**
     * @param array|null $emails
     * @param int $specialistId
     * @throws CreateException
     */
    private function setEmails(?array $emails, int $specialistId): void
    {
        foreach ($emails as $email) {
            data_set($email, 'specialists_id', $specialistId);
            $this->specialistEmailRepository->create($email);
        }
    }

    /**
     * @param array|null $phones
     * @param int $specialistId
     * @throws CreateException
     */
    private function setPhones(?array $phones, int $specialistId): void
    {
        foreach ($phones as $phone) {
            data_set($phone, 'specialists_id', $specialistId);
            $this->specialistPhoneRepository->create($phone);
        }
    }

    /**
     * @param array|null $skills
     * @param int $specialistId
     * @throws CreateException
     */
    private function setSkills(?array $skills, int $specialistId): void
    {
        if (!empty($skills)) {
            foreach ($skills as $skill) {
                data_set($skill, 'specialists_id', $specialistId);
                $this->specialistSkillRepository->create($skill);
            }
        }
    }

    /**
     * @param int $documentTypeId
     * @param string $document
     * @return Specialist|null
     */
    private function getSpecialistByDocument(
        int $documentTypeId,
        string $document
    ): ?Specialist {
        return $this->specialistRepository
            ->fetchOneByDocument($document, $documentTypeId);
    }

    /**
     * @param int $specialistId
     * @param array $data
     * @throws CreateException
     */
    private function addSpecialistInCompany(
        int $specialistId,
        array $data
    ): void {
        $companyId = data_get($data, 'companies_id', null);
        $companyName = data_get($data, 'company', data_get($data, 'name'));
        $companyOwner = false;

        if ($companyId === null) {
            $companyOwner = true;
            $companyId = $this->companyRepository
                ->create(['name' => $companyName]);
        }

        $this->specialistCompanyRepository->create([
            'companies_id' => $companyId,
            'specialists_id' => $specialistId,
            'owner' => $companyOwner,
        ]);
    }

    private function getSpecialistByUserId(int $userId): ?Specialist
    {
        return $this->specialistRepository->fetchSpecialistByUserId($userId);
    }
}
