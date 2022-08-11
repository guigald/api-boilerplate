<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\UpdateException;
use App\Base\Helpers\DateHelper;
use App\Base\Helpers\MailHelper;
use App\Base\Models\Eloquent\User;
use App\User\Exceptions\UserNotFoundException;
use App\User\Repositories\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;

class RecoverUserPasswordService
{
    public function __construct(
        private UserRepository $userRepository,
        private MailHelper $mail
    ) {
    }

    /**
     * @param string $identification
     * @throws UserNotFoundException
     * @throws UpdateException
     * @throws Exception
     */
    public function sendRecoverPassword(string $identification): void
    {
        $resetDate = DateHelper::now();
        $property = 'document';

        if (str_contains($identification, '@')) {
            $property = 'email';
        }

        $user = $this->getUserByIdentification([
            $property => $identification,
        ]);

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        $this->userRepository
            ->update(data_get($user, 'id'), ['reset_date' => $resetDate]);

        $hash = base64_encode(
            md5(data_get($user, 'email') . $resetDate) . '-recover'
        );

        $emailData = [
            'name' => data_get($user, 'name'),
            'url' => env('WEB_BASE_URL') . "redefinir-senha/{$hash}",
        ];

        $this->mail->sendMail(
            __('email.password-recover.subject'),
            data_get($user, 'email'),
            data_get($user, 'name'),
            view('email.password-recover', $emailData)->render()
        );
    }

    /**
     * @param array $data
     * @return User|null
     */
    private function getUserByIdentification(array $data): ?Model
    {
        $search = [];

        if (!empty(data_get($data, 'email'))) {
            data_set($search, 'email', data_get($data, 'email'));
        }

        if (!empty(data_get($data, 'document'))) {
            data_set(
                $search,
                'document',
                data_get($data, 'document')
            );
        }

        return $this->userRepository->fetchOneByMultiple($search);
    }
}
