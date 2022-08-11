<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\UpdateException;
use App\User\Exceptions\UserNotFoundException;
use App\User\Exceptions\UserWithSameDataException;
use App\User\Repositories\UserRepository;

class UpdateUserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @param int $userId
     * @param array $data
     * @throws UpdateException
     * @throws UserNotFoundException
     * @throws UserWithSameDataException
     */
    public function updateUser(int $userId, array $data): void
    {
        if ($this->checkDuplicatedUser($userId, $data)) {
            throw new UserWithSameDataException();
        }

        $user = $this->userRepository->fetchOneById($userId);

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        $this->userRepository->update($userId, $data);
    }

    /**
     * @param int $userId
     * @param array $data
     * @return bool
     */
    private function checkDuplicatedUser(int $userId, array $data): bool
    {
        $email = data_get($data, 'email', null);
        $document = data_get($data, 'document', null);

        if ($email === null && $document === null) {
            return false;
        }

        $user = $this->userRepository->fetchOneByEmailOrDocument(
            $userId,
            $email,
            $document
        );

        return !empty($user);
    }
}
