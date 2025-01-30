<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'string',
            'text' => 'string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
