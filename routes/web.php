<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\JadwaldefController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\InstrukturController;
use Illuminate\Support\Facades\Route;

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

Route::get('/a', function () {
    return view('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

// pengaturan instruktur
Route::get('/instruktur', [InstrukturController::class, 'index']);
Route::post('/instruktur/tambah', [InstrukturController::class, 'tambah']);
Route::patch('/instruktur/{id}', [InstrukturController::class, 'update']);
Route::delete('/instruktur/{id}', [InstrukturController::class, 'hapus']);

// penganturan member
Route::get('/member', [MemberController::class, 'index']);
Route::get('/member/tambah', [MemberController::class, 'tambah']);
Route::post('/member/save', [MemberController::class, 'save']);
Route::get('/member/{id}/edit', [MemberController::class, 'edit']);
Route::patch('/member/{id}', [MemberController::class, 'update']);
Route::delete('/member/{id}', [MemberController::class, 'hapus']);
Route::get('/member/{id}/cetak', [MemberController::class, 'cetak']);
Route::get('/member/{id}/reset', [MemberController::class, 'reset']);

// jadwal
Route::get('/jadwaldef', [JadwaldefController::class, 'index']);
Route::get('/jadwaldef/tambah', [JadwaldefController::class, 'tambah']);
Route::post('/jadwaldef/save', [JadwaldefController::class, 'save']);
Route::get('/jadwaldef/{id}/edit', [JadwaldefController::class, 'edit']);
Route::patch('/jadwaldef/{id}', [JadwaldefController::class, 'update']);
Route::delete('/jadwaldef/{id}', [JadwaldefController::class, 'hapus']);

// akun
Route::get('/', function () {
    return view('login');
});
Route::get('/akun/ubahpassword', function () {
    return view('akun.ubahpassword');
});
Route::post('/akun/auth', [AkunController::class, 'auth']);
Route::post('/akun/ubah', [AkunController::class, 'ubah']);
Route::post('/akun/logout', [AkunController::class, 'logout']);
