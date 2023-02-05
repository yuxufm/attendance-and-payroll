<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ------- Pegawai Routes -------


// public routes
Route::get('pegawai/login', [PegawaiController::class, 'login']);

// POST
Route::post('pegawai/login', [PegawaiController::class, 'login']);

// private routes
Route::prefix('pegawai')->middleware('pegawaiAuth')->group(function () {
    Route::get('/', [PegawaiController::class, 'index']);
    Route::get('logout', [PegawaiController::class, 'logout']);

    Route::get('absensi', [PegawaiController::class, 'lihatAbsensi']);
    Route::get('absensi/masuk-kerja', [PegawaiController::class, 'masukKerja']);
    Route::get('absensi/selesai-kerja', [PegawaiController::class, 'selesaiKerja']);

    Route::get('payslip', [PegawaiController::class, 'lihatPayslip']);
});

// ------- End of Pegawai Routes -------



// ------- Admin Routes -------


// public routes
Route::get('admin/login', [AdminController::class, 'login']);

// POST
Route::post('admin/login', [AdminController::class, 'login']);

// private routes
Route::prefix('admin')->middleware('adminAuth')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('logout', [AdminController::class, 'logout']);

    Route::get('absensi', [AdminController::class, 'lihatAbsensi']);
    Route::get('payslip', [AdminController::class, 'lihatPayslip']);
    Route::get('payslip/buat', [AdminController::class, 'buatPayslip']);

    Route::post('payslip/buat', [AdminController::class, 'buatPayslip']);
});


// ------- End of Admin Routes -------
