<?php

namespace App\Imports;



use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // SKIP kalau nama kosong
        if (
            empty($row['nama']) ||
            empty($row['nip'])
        ) {
            return null;
        }

        return new Employee([

            'nip' => (string) $row['nip'],
            'nama' => $row['nama'],
            'bidang' => $row['bidang'],
            'jabatan' => $row['jabatan'],
        
            'kedisiplinan' => $row['kedisiplinan'],
            'kualitas_kerja' => $row['kualitas_kerja'],
            'tanggung_jawab' => $row['tanggung_jawab'],
            'kerjasama' => $row['kerjasama'],
            'loyalitas' => $row['loyalitas'],

            'total_nilai' => 0,
        ]);
    }
}


