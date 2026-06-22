<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('departments', 'name')->ignore($this->department),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama department wajib diisi.',
            'name.min'      => 'Nama department minimal 3 karakter.',
            'name.unique'   => 'Nama department sudah digunakan.',
        ];
    }
}
