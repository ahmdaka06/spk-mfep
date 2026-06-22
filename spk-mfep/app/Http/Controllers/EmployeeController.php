<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;

use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('total_nilai', 'DESC')->get();

        return view ('employees.index', compact('employees'));
    }

    public function import(Request $request)
    {
        Excel::import(new EmployeeImport, $request->file('file'));

        return redirect()->back()->with('success', 'Import berhasil');
    }

    public function cetakLaporan()
    {
    $pegawaiTerbaik = Employee::orderBy('total_nilai', 'desc')->first();

    $pdf = Pdf::loadView('laporan.pdf', compact('pegawaiTerbaik'));

    return $pdf->download('pegawai_teladan.pdf');
    }

    public function hitungMFEP()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {

            $total =

                ($employee->kedisiplinan * 0.3) +
                ($employee->kualitas_kerja * 0.2) +
                ($employee->tanggung_jawab * 0.2) +
                ($employee->kerjasama * 0.2) +
                ($employee->loyalitas * 0.1);

            $employee->update([
                'total_nilai' => $total
            ]);
        }

        return redirect()->back()->with('success', 'Perhitungan MFEP berhasil');
    }
}