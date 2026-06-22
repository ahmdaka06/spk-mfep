<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {

    $totalPegawai = Employee::distinct('nip')->count('nip');

    return view('dashboard', compact('totalPegawai'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('employees', EmployeeController::class)
        ->except(['show']);

    Route::post('/import-pegawai', [EmployeeController::class, 'import'])->name('employees.import');

    Route::get('/hitung-mfep', [EmployeeController::class, 'hitungMFEP']);

    Route::get('/kriteria', function () {
        return view('kriteria');
    });

    Route::get('/mfep', function () {
        return view('mfep');
    });

});

/*
|--------------------------------------------------------------------------
| ADMIN & OPD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/perankingan', function (Request $request) {

        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $employees = Employee::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('total_nilai', 'DESC')
            ->get();

        return view('perankingan', compact(
            'employees',
            'bulan',
            'tahun'
        ));

    });

});

Route::middleware('auth')->group(function () {

    Route::get('/cetak-laporan', [EmployeeController::class, 'cetakLaporan'])
        ->name('cetak.laporan');

    Route::get('/cetak-ranking', [EmployeeController::class, 'cetakRanking'])
        ->name('cetak.ranking');

});

require __DIR__.'/auth.php';
