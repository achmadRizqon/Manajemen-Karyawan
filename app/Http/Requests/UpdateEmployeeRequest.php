<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_code' => [
                'required',
                'string',
                Rule::unique('employees', 'employee_code')->ignore($this->employee),
            ],
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255'],
            'phone'         => ['required', 'string', 'max:20'],
            'department_id' => ['required', 'exists:departments,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_code.required'  => 'Kode karyawan wajib diisi.',
            'employee_code.unique'    => 'Kode karyawan sudah digunakan.',
            'name.required'           => 'Nama karyawan wajib diisi.',
            'email.required'          => 'Email wajib diisi.',
            'email.email'             => 'Format email tidak valid.',
            'phone.required'          => 'Nomor HP wajib diisi.',
            'department_id.required'  => 'Department wajib dipilih.',
            'department_id.exists'    => 'Department tidak ditemukan.',
        ];
    }
}
