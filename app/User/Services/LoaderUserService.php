<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Models\Eloquent\User;
use App\User\Exceptions\UserNotFoundException;
use App\User\Repositories\UserRepository;

class LoaderUserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    /**
     * @param int $userId
     * @return User
     * @throws UserNotFoundException
     */
    public function getUser(int $userId): User
    {
        $user = $this->userRepository->getUserUnauthenticatedById($userId);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @param int $legacyDeclarationId
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserByLegacyDeclarationId(int $legacyDeclarationId): User
    {
        $user = $this->userRepository
            ->getUserByLegacyDeclarationId($legacyDeclarationId);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        data_set($user, 'address', $user->address()->get()->first()->toArray());

        return $user;
    }
}
