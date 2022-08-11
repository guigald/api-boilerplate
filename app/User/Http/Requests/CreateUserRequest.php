<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use App\Base\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function __construct(private Password $password)
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required|min:3',
            'email' => 'string|required|email',
            'phone' => 'string|min:10|max:255',
            'document' => 'string|nullable|min:11',
            'password' => ['string', $this->password],
            'accepted_terms' => 'boolean|required',
            'type' => 'string|nullable',
            'met_in' => 'string|nullable',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'password.password' => __('errors.user.validate.password'),
        ];
    }
}
