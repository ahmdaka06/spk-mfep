<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeeImport implements SkipsOnError, SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    use SkipsErrors, SkipsFailures;

    public function __construct(
        private int $bulan,
        private int $tahun
    ) {}

    public function model(array $row): Employee
    {
        $kedisiplinan = (int) $row['kedisiplinan'];
        $kualitasKerja = (int) $row['kualitas_kerja'];
        $tanggungJawab = (int) $row['tanggung_jawab'];
        $kerjasama = (int) $row['kerjasama'];
        $loyalitas = (int) $row['loyalitas'];

        $totalNilai = ($kedisiplinan * 0.3)
            + ($kualitasKerja * 0.2)
            + ($tanggungJawab * 0.2)
            + ($kerjasama * 0.2)
            + ($loyalitas * 0.1);

        return new Employee([
            'nip' => (string) $row['nip'],
            'nama' => $row['nama'],
            'bidang' => $row['bidang'] ?? null,
            'jabatan' => $row['jabatan'] ?? null,
            'kedisiplinan' => $kedisiplinan,
            'kualitas_kerja' => $kualitasKerja,
            'tanggung_jawab' => $tanggungJawab,
            'kerjasama' => $kerjasama,
            'loyalitas' => $loyalitas,
            'total_nilai' => $totalNilai,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ]);
    }

    public function rules(): array
    {
        return [
            'nip' => 'required|max:50',
            'nama' => 'required|string|max:255',
            'kedisiplinan' => 'required|integer|min:1|max:100',
            'kualitas_kerja' => 'required|integer|min:1|max:100',
            'tanggung_jawab' => 'required|integer|min:1|max:100',
            'kerjasama' => 'required|integer|min:1|max:100',
            'loyalitas' => 'required|integer|min:1|max:100',

        ];
    }
}
