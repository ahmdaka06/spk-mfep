<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employeeId = $this->route('employee');

        return [
            'nip' => 'required|string|max:50|unique:employees,nip,'.$employeeId,
            'nama' => 'required|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'kedisiplinan' => 'required|integer|min:1|max:100',
            'kualitas_kerja' => 'required|integer|min:1|max:100',
            'tanggung_jawab' => 'required|integer|min:1|max:100',
            'kerjasama' => 'required|integer|min:1|max:100',
            'loyalitas' => 'required|integer|min:1|max:100',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2100',
        ];
    }
}
