<?php

use App\Http\Controllers\LapPendapatanController;
use App\Http\Controllers\IjinInstrukturController;
use App\Http\Controllers\DepositKelasController;
use App\Http\Controllers\DepositRegulerController;
use App\Http\Controllers\AktivasiController;
use App\Http\Controllers\JadwalharController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\JadwaldefController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LapGymController;
use App\Http\Controllers\LapKelasController;
use App\Http\Controllers\LapKinerjaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PresensiGymController;
use App\Http\Controllers\PresensiKelasController;
use App\Http\Controllers\PromoController;
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

// kelas
Route::get('/kelas', [KelasController::class, 'index']);
Route::post('/kelas/tambah', [KelasController::class, 'tambah']);
Route::patch('/kelas/{id}', [KelasController::class, 'update']);
Route::delete('/kelas/{id}', [KelasController::class, 'hapus']);

// pegawai
Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::post('/pegawai/tambah', [PegawaiController::class, 'tambah']);
Route::patch('/pegawai/{id}', [PegawaiController::class, 'update']);
Route::delete('/pegawai/{id}', [PegawaiController::class, 'hapus']);

// promo
Route::get('/promo', [PromoController::class, 'index']);
Route::post('/promo/tambah', [PromoController::class, 'tambah']);
Route::patch('/promo/{id}', [PromoController::class, 'update']);
Route::delete('/promo/{id}', [PromoController::class, 'hapus']);

// penganturan member
Route::get('/member', [MemberController::class, 'index']);
Route::get('/member/tambah', [MemberController::class, 'tambah']);
Route::post('/member/save', [MemberController::class, 'save']);
Route::get('/member/{id}/edit', [MemberController::class, 'edit']);
Route::patch('/member/{id}', [MemberController::class, 'update']);
Route::delete('/member/{id}', [MemberController::class, 'hapus']);
Route::get('/member/{id}/cetak', [MemberController::class, 'cetak']);
Route::get('/member/{id}/reset', [MemberController::class, 'reset']);

// jadwal default
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

// jadwal harian
Route::get('/jadwalhar', [JadwalharController::class, 'index']);
Route::get('/jadwalhar/generate', [JadwalharController::class, 'generate']);
Route::get('/jadwalhar/tambah', [JadwalharController::class, 'tambah']);
Route::post('/jadwalhar/save', [JadwalharController::class, 'save']);
Route::get('/jadwalhar/{id}/edit', [JadwalharController::class, 'edit']);
Route::patch('/jadwalhar/{id}', [JadwalharController::class, 'update']);
Route::get('/jadwalhar/{id}/editinstruktur', [JadwalharController::class, 'editinstruktur']);
Route::patch('/jadwalhar/{id}/simpaninstruktur', [JadwalharController::class, 'simpaninstruktur']);
Route::patch('/jadwalhar/{id}/ubahstatus', [JadwalharController::class, 'ubahstatus']);
Route::delete('/jadwalhar/{id}', [JadwalharController::class, 'hapus']);

// aktivasi tahunan
Route::get('/aktivasi', [AktivasiController::class, 'index']);
Route::get('/aktivasi/tambah', [AktivasiController::class, 'tambah']);
Route::post('/aktivasi/save', [AktivasiController::class, 'save']);
Route::get('/aktivasi/{id}/cetak', [AktivasiController::class, 'cetak']);

// deposit reguler
Route::get('/deposit_reguler', [DepositRegulerController::class, 'index']);
Route::get('/deposit_reguler/tambah', [DepositRegulerController::class, 'tambah']);
Route::post('/deposit_reguler/save', [DepositRegulerController::class, 'save']);
Route::get('/deposit_reguler/{id}/cetak', [DepositRegulerController::class, 'cetak']);

// deposit kelas
Route::get('/deposit_kelas', [DepositKelasController::class, 'index']);
Route::get('/deposit_kelas/tambah', [DepositKelasController::class, 'tambah']);
Route::post('/deposit_kelas/save', [DepositKelasController::class, 'save']);
Route::get('/deposit_kelas/{id}/cetak', [DepositKelasController::class, 'cetak']);

//ijin instruktur
Route::get('/ijin_instruktur', [IjinInstrukturController::class, 'index']);
Route::get('/ijin_instruktur/tambah', [IjinInstrukturController::class, 'tambah']);
Route::post('/ijin_instruktur/save', [IjinInstrukturController::class, 'save']);
Route::post('/ijin_instruktur/konfirmasi', [IjinInstrukturController::class, 'konfirmasi']);

//presensi gym
Route::get('/presensi_gym', [PresensiGymController::class, 'index']);
Route::get('/presensi_gym/scan', [PresensiGymController::class, 'scan']);
Route::post('/presensi_gym/cek_member', [PresensiGymController::class, 'cek_member']);
Route::get('/presensi_gym/{id}/absensi', [PresensiGymController::class, 'absensi']);
Route::post('/presensi_gym/save', [PresensiGymController::class, 'save']);
Route::get('/presensi_gym/{id}/cetak', [PresensiGymController::class, 'cetak']);

//lap pendapatan
Route::get('/lap_pendapatan', [LapPendapatanController::class, 'index']);
Route::post('/lap_pendapatan/update_lap', [LapPendapatanController::class, 'update_lap']);

//lap gym bulanan
Route::get('/lap_gym', [LapGymController::class, 'index']);
Route::post('/lap_gym/update_lap', [LapGymController::class, 'update_lap']);

//presensi kelas
Route::get('/presensi_kelas', [PresensiKelasController::class, 'index']);
Route::get('/presensi_kelas/{id}/absen_member', [PresensiKelasController::class, 'absen_member']);
Route::post('/presensi_kelas/save_absensi', [PresensiKelasController::class, 'save_absensi']);
Route::get('/presensi_kelas/index_kasir', [PresensiKelasController::class, 'index_kasir']);
Route::get('/presensi_kelas/{id}/cetak', [PresensiKelasController::class, 'cetak']);
Route::get('/presensi_kelas/{id}/cetak_paket', [PresensiKelasController::class, 'cetak_paket']);
Route::get('/presensi_kelas/{id}/mulai_kelas', [PresensiKelasController::class, 'mulai_kelas']);

//lap kelas
Route::get('/lap_kelas', [LapKelasController::class, 'index']);
Route::post('/lap_kelas/update_lap', [LapKelasController::class, 'update_lap']);

//lap kelas
Route::get('/lap_kinerja', [LapKinerjaController::class, 'index']);
Route::post('/lap_kinerja/update_lap', [LapKinerjaController::class, 'update_lap']);
