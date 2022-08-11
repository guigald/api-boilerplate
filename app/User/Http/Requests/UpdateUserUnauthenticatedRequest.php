<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use App\Base\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserUnauthenticatedRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'document' => 'string|min:11',
            'birthdate' => 'string',
        ];
    }
}
