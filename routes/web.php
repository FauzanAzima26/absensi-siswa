<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\GuruController;
use App\Http\Controllers\Backend\KelasController;
use App\Http\Controllers\Backend\RekapController;
use App\Http\Controllers\Backend\SiswaController;
use App\Http\Controllers\Backend\ExportController;
use App\Http\Controllers\Backend\AbsensiController;
use App\Http\Controllers\Backend\dashboardController;
use App\Http\Controllers\Backend\ProfileGuruController;
use App\Http\Controllers\Backend\InformasiPribadiController;



// Route::get('home', function () {
//     return view('backend.dashboard.index');
// });

//new
Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::resource('dashboard', dashboardController::class)->names('panel.dashboard');
   
    // Guru
    Route::resource('guru', GuruController::class)->names('panel.guru');
    Route::get('guru-serverside', [GuruController::class, 'getData'])->name('panel.guru.serverside');
    Route::get('guru-getClass', [GuruController::class, 'getClasses'])->name('panel.guru.getClass');

    Route::post('absensi/download', [ExportController::class, 'download'])->name('panel.absensi.download');

});

Auth::routes();

Route::resource('kelas', KelasController::class);

Route::resource('absensi', AbsensiController::class);

Route::delete('kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

// Route untuk menampilkan form edit kelas
Route::get('/kelas/edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');

// Route untuk mengupdate kelas
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');

// create
Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');

// siswa
Route::resource('siswa', SiswaController::class)->only([
    'index',
    'create',
    'store',
    'edit',
    'update',
    'destroy',
    'show'
]);

Route::get('/kelas/{kelasId}/siswa', [AbsensiController::class, 'getSiswaByKelas']);
