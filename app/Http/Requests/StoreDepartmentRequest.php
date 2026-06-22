<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'unique:departments,name'],
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
