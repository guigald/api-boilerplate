<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\UpdateException;
use App\Base\Helpers\DateHelper;
use App\Base\Models\Eloquent\User;
use App\User\Exceptions\TokenExpiredException;
use App\User\Exceptions\UserNotFoundException;
use App\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class ChangeUserPasswordService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     * @throws TokenExpiredException
     * @throws UpdateException
     * @throws UserNotFoundException
     */
    public function changePasswordByHash(
        string $password,
        string $hash
    ): bool {
        list($hash, $type) = $this->getHashAndType($hash);

        $user = $this->userRepository->getUserByHash($hash);

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        if ($type === 'recover') {
            $minutesDifference = DateHelper::getDiffTimeIn(
                data_get($user, 'reset_date'),
                DateHelper::now()
            );

            if ($minutesDifference > env('PASSWORD_CHANGE_TIME_EXPIRE')) {
                throw new TokenExpiredException();
            }
        }

        return $this->setNewPassword($user, $password);
    }

    /**
     * @param User $user
     * @param string $newPassword
     * @return bool
     * @throws UpdateException
     */
    private function setNewPassword(User $user, string $newPassword): bool
    {
        return $this->userRepository->update(
            data_get($user, 'id'),
            [
                'password' => Hash::make(base64_decode($newPassword)),
                'reset_date' => null,
            ]
        );
    }

    /**
     * @param string $hash
     * @return array
     */
    private function getHashAndType(string $hash): array
    {
        $decodedHash = base64_decode($hash);
        return explode('-', $decodedHash);
    }
}
