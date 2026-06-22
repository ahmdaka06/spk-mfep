<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
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

    Route::get('/employees', [EmployeeController::class, 'index']);

    Route::post('/import-pegawai', [EmployeeController::class, 'import']);

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

// Route::middleware('auth')->group(function () {

//     Route::get('/cetak-laporan', [EmployeeController::class, 'cetakLaporan']);

// });

Route::get('/cetak-laporan', function () {

    abort_if(!Auth::check() || Auth::user()->role !== 'opd', 403);

    return app(App\Http\Controllers\EmployeeController::class)
        ->cetakLaporan();
});
Route::get('/cetak-laporan', function () {

    abort_if(
        !Auth::check() ||
        !in_array(Auth::user()->role, ['admin', 'opd']),
        403
    );

    return app(App\Http\Controllers\EmployeeController::class)
        ->cetakLaporan();

});

Route::get('/cetak-ranking', function () {

    abort_if(
        !Auth::check() ||
        !in_array(Auth::user()->role, ['admin', 'opd']),
        403
    );

    return app(App\Http\Controllers\EmployeeController::class)
        ->cetakRanking();

});

require __DIR__.'/auth.php';