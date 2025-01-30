<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'title' => 'required',
            'text' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
