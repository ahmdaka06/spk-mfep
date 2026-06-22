<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = Employee::orderBy('total_nilai', 'DESC')->get();

        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        return view('employees.create');
    }

    public function store(EmployeeStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['total_nilai'] = $this->calculateMFEP($data);

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee): RedirectResponse
    {
        $data = $request->validated();

        $data['total_nilai'] = $this->calculateMFEP($data);

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus');
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        Excel::import(
            new EmployeeImport((int) $request->bulan, (int) $request->tahun),
            $request->file('file')
        );

        return redirect()->back()->with('success', 'Import berhasil');
    }

    public function cetakLaporan()
    {
        $pegawaiTerbaik = Employee::orderBy('total_nilai', 'desc')->first();

        $pdf = Pdf::loadView('laporan.pdf', compact('pegawaiTerbaik'));

        return $pdf->download('pegawai_teladan.pdf');
    }

    public function cetakRanking()
    {
        $employees = Employee::orderBy('total_nilai', 'desc')->get();

        $pdf = Pdf::loadView('ranking_pdf', compact('employees'));

        return $pdf->download('ranking_pegawai.pdf');
    }

    public function hitungMFEP(): RedirectResponse
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $employee->update([
                'total_nilai' => $this->calculateMFEP($employee->toArray()),
            ]);
        }

        return redirect()->back()->with('success', 'Perhitungan MFEP berhasil');
    }

    private function calculateMFEP(array $data): float
    {
        return ($data['kedisiplinan'] * 0.3)
            + ($data['kualitas_kerja'] * 0.2)
            + ($data['tanggung_jawab'] * 0.2)
            + ($data['kerjasama'] * 0.2)
            + ($data['loyalitas'] * 0.1);
    }
}
