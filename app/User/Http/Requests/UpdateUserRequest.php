<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use App\Base\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'string|min:3',
            'email' => 'string|email',
            'phone' => 'string|min:10|max:11',
            'phone2' => 'string|min:10|max:11',
            'document' => 'string|min:11',
            'birthdate' => 'string',
        ];
    }
}
