<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use App\Base\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CreateSpecialistRequest extends FormRequest
{
    public function __construct(private Password $password)
    {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required|min:3',
            'email' => 'string|required|email',
            'phone' => 'string|min:10|max:11',
            'document' => 'string|required|min:11',
            'password' => ['string', $this->password],
            'accepted_terms' => 'boolean|required',
            'specialist_document' => 'string',
            'specialist_document_types_id' => 'integer',
            'company' => 'string',
            'companies_id' => 'integer',
            'addresses' => 'array|nullable',
            'emails' => 'array|nullable',
            'phones' => 'array|nullable',
            'skills' => 'array|nullable',
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
