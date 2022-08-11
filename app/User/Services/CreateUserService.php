<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\CreateException;
use App\Base\Exceptions\UpdateException;
use App\Base\Helpers\DateHelper;
use App\Base\Helpers\MailHelper;
use App\Base\Models\Eloquent\Role;
use App\Base\Models\Eloquent\User;
use App\Mailing\Repositories\MailingQueueRepository;
use App\User\Exceptions\DuplicatedInformationException;
use App\User\Exceptions\UserAlreadyExistsException;
use App\User\Exceptions\UserNotCreatedException;
use App\Legacy\Quiz\Repositories\LegacyDeclarationRepository;
use App\User\Repositories\UserRepository;
use App\User\Repositories\UserRoleRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use JsonException;
use SendGrid\Mail\TypeException;
use Throwable;

class CreateUserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserRoleRepository $userRoleRepository,
        private LegacyDeclarationRepository $legacyDeclarationRepository,
        private MailingQueueRepository $mailingQueueRepository,
        private MailHelper $mail
    ) {
    }

    /**
     * @param array $data
     * @return int|null
     * @throws CreateException
     * @throws DuplicatedInformationException
     * @throws Throwable
     * @throws TypeException
     * @throws UpdateException
     * @throws UserAlreadyExistsException
     * @throws UserNotCreatedException
     */
    public function create(array $data): ?int
    {
        $userId = null;
        $type = data_get($data, 'type', null);
        $users = $this->getUserByIdentificationOrEmail($data);

        if ($users->count() > 0) {
            $isDuplicated = $this->checkUserDuplicatedInformation($data);

            if ($isDuplicated) {
                throw new DuplicatedInformationException();
            }

            if ($type === null) {
                throw new UserAlreadyExistsException();
            }

            $userId = data_get($users->first(), 'id');
        }

        if (!$userId) {
            $userId = $this->createUser($data);
        }

        if ($type === 'legacy') {
            $this->createAccessCode($userId);
        }

        return $userId;
    }

    /**
     * @param array $data
     * @return Collection
     */
    private function getUserByIdentificationOrEmail(array $data): Collection
    {
        $search = [];
        $email = data_get($data, 'email', null);
        $document = data_get($data, 'document', null);

        if ($email !== null) {
            data_set($search, 'email', $email);
        }

        if ($document !== null) {
            data_set($search, 'document', $document);
        }

        return $this->userRepository->fetchAllByMultipleOr($search);
    }

    /**
     * @param User|null $user
     * @param string $hash
     * @throws Throwable
     * @throws TypeException
     */
    private function sendCreatePasswordEmail(?User $user, string $hash): void
    {
        $emailData = [
            'name' => data_get($user, 'name'),
            'url' => env('WEB_BASE_URL') . "criar-senha/{$hash}",
        ];

        $this->mail->sendMail(
            __('email.password-create.subject'),
            data_get($user, 'email'),
            data_get($user, 'name'),
            view('email.password-create', $emailData)->render()
        );
    }

    /**
     * @param int $userId
     * @throws CreateException
     */
    private function addUserRole(int $userId): void
    {
        $this->userRoleRepository->create([
            'users_id' => $userId,
            'roles_id' => Role::USER,
        ]);
    }

    /**
     * @param array $data
     * @return bool
     */
    private function checkUserDuplicatedInformation(array $data): bool
    {
        $email = data_get($data, 'email');
        $document = data_get($data, 'document');

        $emailCheck = $this->userRepository->fetchOneByEmail($email);

        if ($emailCheck !== null) {
            $fetchedDocument = data_get($emailCheck, 'document');

            if ($document !== $fetchedDocument && !empty($document)) {
                return true;
            }
        }

        $documentCheck = $this->userRepository->fetchOneByDocument($document);

        if (
            empty($document) &&
            data_get($documentCheck, 'document', null) !== null
        ) {
            return false;
        }

        if ($documentCheck !== null) {
            $fetchedEmail = data_get($documentCheck, 'email');

            if ($email !== $fetchedEmail) {
                return true;
            }
        }

        $emailCheckId = data_get($emailCheck, 'id', null);
        $documentCheckId = data_get($documentCheck, 'id', null);

        if ($emailCheckId !== null && $documentCheckId !== null) {
            return $emailCheckId !== $documentCheckId;
        }

        return false;
    }

    /**
     * @param int $userId
     * @throws CreateException
     * @throws JsonException
     */
    private function createAccessCode(int $userId): void
    {
        $declaration = $this->legacyDeclarationRepository
            ->fetchOneByUserId($userId);

        if ($declaration !== null) {
            return;
        }

        $accessCode = strtoupper(uniqid('', true));

        $this->legacyDeclarationRepository->create([
            'users_id' => $userId,
            'access_code' => $accessCode,
            'year' => DateHelper::now('year'),
        ]);

        $this->saveAccessCodeMail($userId, $accessCode);
    }

    /**
     * @param int $userId
     * @param string $accessCode
     * @throws CreateException
     * @throws JsonException
     */
    private function saveAccessCodeMail(int $userId, string $accessCode): void
    {
        $user = $this->userRepository->fetchOneById($userId);

        $data = [
            'accessCode' => $accessCode,
            'user' => $user,
        ];

        $mailingData = [
            'view' => "email.legacy.access-code",
            'email_to' => data_get($user, 'email'),
            'name_to' => data_get($user, 'name'),
            'data' => json_encode($data, JSON_THROW_ON_ERROR),
            'subject_data' => json_encode(['name' => data_get($user, 'name')], JSON_THROW_ON_ERROR),
        ];

        $this->mailingQueueRepository->create($mailingData);
    }

    /**
     * @param array $data
     * @return int
     * @throws CreateException
     * @throws Throwable
     * @throws TypeException
     * @throws UpdateException
     * @throws UserNotCreatedException
     */
    private function createUser(array $data): int
    {
        if (!empty(data_get($data, 'password'))) {
            data_set(
                $data,
                'password',
                Hash::make(base64_decode(data_get($data, 'password')))
            );
        }

        unset($data['type'], $data['accepted_terms']);

        $userId = $this->userRepository->create($data);

        if (empty($userId)) {
            throw new UserNotCreatedException();
        }

        if (empty(data_get($data, 'password'))) {
            $user = $this->userRepository->fetchOneById($userId);
            $resetDate = DateHelper::now();

            $this->userRepository
                ->update($userId, ['reset_date' => $resetDate]);

            $hash = base64_encode(
                md5(data_get($user, 'email') . $resetDate) . '-create'
            );

            $this->sendCreatePasswordEmail($user, $hash);
        }

        $this->addUserRole($userId);

        return $userId;
    }
}
