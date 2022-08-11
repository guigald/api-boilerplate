<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use App\Base\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeByHashRequest extends FormRequest
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
            'password' => ['string', 'required', $this->password],
        ];
    }
}
