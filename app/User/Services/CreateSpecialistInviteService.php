<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\CreateException;
use App\Base\Models\Eloquent\Company;
use App\Mailing\Repositories\MailingQueueRepository;
use App\User\Repositories\SpecialistInviteRepository;

class CreateSpecialistInviteService
{
    public function __construct(
        private SpecialistInviteRepository $specialistInviteRepository,
        private MailingQueueRepository $mailingQueueRepository
    ) {
    }

    /**
     * @param array $data
     * @throws CreateException
     */
    public function createSpecialistInvites(array $data): void
    {
        $emails = data_get($data, 'emails');
        $company = auth('api')->user()
            ->specialist()->get()->first()
            ->specialistCompany()->get()->first()
            ->company()->get()->first();

        foreach ($emails as $email) {
            $this->specialistInviteRepository->create([
                'email' => $email,
                'companies_id' => data_get($company, 'id'),
                'invite_accepted' => false,
            ]);

            $this->createInviteMailing($email, $company);
        }
    }

    /**
     * @param string $email
     * @param Company $company
     * @throws CreateException
     */
    private function createInviteMailing(string $email, Company $company): void
    {
        $companyName = data_get($company, 'name');
        $companyId = data_get($company, 'id');

        $hashData = [
            'email' => $email,
            'companies_name' => $companyName,
            'companies_id' => $companyId,
        ];

        $hash = base64_encode(json_encode($hashData));

        $mailData = [
            'view' => "email.specialist.invite",
            'email_to' => $email,
            'name_to' => $email,
            'data' => json_encode([
                'company' => $companyName,
                'url' => env('WEB_BASE_URL') . "especialista/cadastro/{$hash}",
            ]),
            'subject_data' => '[]',
        ];

        $this->mailingQueueRepository->create($mailData);
    }
}
