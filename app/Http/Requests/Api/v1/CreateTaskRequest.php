<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'text' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
