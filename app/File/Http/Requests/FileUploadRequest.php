<?php

declare(strict_types=1);

namespace App\File\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'file' => 'file|mimes:pdf,jpg,jpeg,png,txt',
            'type' => 'string|nullable'
        ];
    }
}
