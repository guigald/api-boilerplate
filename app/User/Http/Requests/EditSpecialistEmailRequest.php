<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use App\Base\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class EditSpecialistEmailRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'emails' => 'array|nullable',
        ];
    }
}
