<?php

namespace App\Base\Rules;

use App\User\Repositories\UserRepository;
use Illuminate\Contracts\Validation\Rule;

class UserExists implements Rule
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $user = $this->userRepository->fetchOneById($value);

        return !empty($user);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('errors.user.validate.existence');
    }
}
