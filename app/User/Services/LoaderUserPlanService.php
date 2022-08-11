<?php

declare(strict_types=1);

namespace App\User\Services;

use App\User\Exceptions\UserNotFoundException;
use App\User\Repositories\UserRepository;

class LoaderUserPlanService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @param int $userId
     * @param string $system
     * @return array
     * @throws UserNotFoundException
     */
    public function getUserPlan(int $userId, string $system): array
    {
        $userPlan = $this->userRepository->getUserPlan($userId, $system);

        if ($userPlan === null) {
            throw new UserNotFoundException();
        }

        $slug = data_get($userPlan, 'slug');
        $active = data_get($userPlan, 'active');

        return [
            'planSlug' => $slug,
            'paid' => !!$active,
        ];
    }
}
