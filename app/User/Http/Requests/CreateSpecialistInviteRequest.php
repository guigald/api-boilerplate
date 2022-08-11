<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use App\Base\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CreateSpecialistInviteRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'emails' => 'array|required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [];
    }
}
