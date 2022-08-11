<?php

namespace App\Base\Rules;

use Illuminate\Contracts\Validation\Rule;

class Password implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
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
        /**
         * Rules:
         * - Must have lowercase
         * - Must have uppercase
         * - Must have numbers
         * - Must have symbols between these(! @ # $ % & * .)
         */

        $pass = base64_decode($value);

        if (strlen($value) < 8) {
            return false;
        }

        if (!preg_match("/.*[a-z].*/", $pass)) {
            return false;
        }

        if (!preg_match("/.*[A-Z].*/", $pass)) {
            return false;
        }

        if (!preg_match("/.*[0-9].*/", $pass)) {
            return false;
        }

        if (!preg_match("/.*[!@#$%&*.].*/", $pass)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('errors.user.validate.password');
    }
}
