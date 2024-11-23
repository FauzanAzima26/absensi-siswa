<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\GuruController;
use App\Http\Controllers\Backend\KelasController;
use App\Http\Controllers\Backend\RekapController;
use App\Http\Controllers\Backend\SiswaController;
use App\Http\Controllers\Backend\AbsensiController;
use App\Http\Controllers\Backend\ProfileGuruController;
use App\Http\Controllers\Backend\InformasiPribadiController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('backend.dashboard.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('kelas',KelasController::class);
Route::resource('guru',GuruController::class);

Route::resource('absensi',AbsensiController::class);
Route::resource('rekap',RekapController::class);
Route::resource('profile_guru',ProfileGuruController::class);

Route::delete('kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

// Route untuk menampilkan form edit kelas
Route::get('/kelas/edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');

// Route untuk mengupdate kelas
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');

// create
Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');

// siswa
Route::resource('siswa',SiswaController::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy', 'show'
]);


