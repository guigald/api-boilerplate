<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRecoverRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'identification' => 'string|required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            //custom messages here
        ];
    }
}
