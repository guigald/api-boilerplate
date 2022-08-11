<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\UpdateException;
use App\User\Repositories\SpecialistEmailRepository;

class EditSpecialistEmailService
{
    public function __construct(
        private SpecialistEmailRepository $specialistEmailRepository
    ) {
    }

    /**
     * @param int $specialistId
     * @param array $data
     * @throws UpdateException
     */
    public function editSpecialistEmail(int $specialistId, array $data): void
    {
        foreach (data_get($data, 'emails') as $email) {
            if (data_get($email, 'main') === true) {
                $this->specialistEmailRepository
                    ->unableMainBySpecialistId($specialistId);
            }

            $emailId = data_get($email, 'id');
            unset($email['id']);

            $this->specialistEmailRepository->update($emailId, $email);
        }
    }
}
