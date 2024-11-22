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

// siswa
Route::resource('siswa',SiswaController::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy', 'show'
]);


