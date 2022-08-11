<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use App\Base\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserAddressRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'users_id' => 'integer|required',
            'postal_code' => 'string|required',
            'state' => 'string|required',
            'city' => 'string|required',
            'neighborhood' => 'string|required',
            'street' => 'string|required',
            'number' => 'string|required',
            'complement' => 'string|nullable',
        ];
    }
}
