<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagCreateUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'task_id' => 'required', 'numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
