<?php

declare(strict_types=1);

namespace App\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSpecialistRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'specialist_document' => 'string',
            'specialist_document_types_id' => 'integer',
            'validated' => 'boolean',
        ];
    }
}
