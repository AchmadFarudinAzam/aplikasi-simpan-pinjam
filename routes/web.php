<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TabunganController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Nasabah\DashboardController as NasabahDashboard;
use App\Http\Controllers\Nasabah\DashboardController;
use App\Http\Controllers\Nasabah\PinjamanController;
use App\Http\Controllers\Nasabah\SimpananController;
use App\Http\Controllers\Nasabah\ProfilController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi.index');
Route::get('/registrasi/create', [RegistrasiController::class, 'create'])->name('registrasi.create');
Route::post('/registrasi/create', [RegistrasiController::class, 'store'])->name('registrasi.store');

// Login Admin
Route::get('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'prosesLoginAdmin'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logoutAdmin'])->name('admin.logout');

// Login Nasabah
Route::get('/nasabah/login', [AuthController::class, 'loginNasabah'])->name('nasabah.login');
Route::post('/nasabah/login', [AuthController::class, 'prosesLoginNasabah'])->name('nasabah.login.submit');
Route::post('/nasabah/logout', [AuthController::class, 'logoutNasabah'])->name('nasabah.logout');

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    if (!session('admin_id')) return redirect()->route('admin.login');
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/nasabah/index', [NasabahController::class, 'index'])->name('admin.nasabah.index');
Route::get('/admin/nasabah/create', [NasabahController::class, 'create'])->name('admin.nasabah.create');
Route::post('/admin/nasabah/create', [NasabahController::class, 'store'])->name('admin.nasabah.store');
Route::get('/admin/nasabah/edit', [NasabahController::class, 'edit'])->name('admin.nasabah.edit');
Route::delete('/admin/nasabah/{kd}', [NasabahController::class, 'destroy'])->name('admin.nasabah.destroy');
Route::get('/admin/tabungan/index', [TabunganController::class, 'index'])->name('admin.tabungan.index');

// Tambahkan route ke controller Nasabah
Route::get('/admin/pengajuan', [NasabahController::class, 'daftarPengajuan'])->name('admin.pengajuan');
Route::post('/admin/pengajuan/{kd}/konfirmasi', [NasabahController::class, 'konfirmasiPengajuan'])->name('admin.pengajuan.konfirmasi');

// Verifikasi angsuran
Route::get('/admin/pengajuan/verifikasi', [NasabahController::class, 'verifikasiAngsuran'])->name('admin.pengajuan.verifikasi');
Route::post('/admin/pengajuan/konfirmasi/{kd}', [NasabahController::class, 'konfirmasiAngsuran'])->name('admin.pengajuan.konfirmasi');

//Laporan pinjaman
Route::get('admin/laporan/simpanan', [LaporanController::class, 'laporanSimpanan'])->name('admin.laporan.simpanan');
Route::get('admin/laporan/pinjaman', [LaporanController::class, 'laporanPinjaman'])->name('admin.laporan.pinjaman');

Route::prefix('admin')->group(function () {
    Route::get('/laporan/pinjaman/pdf', [LaporanController::class, 'exportPinjamanPdf'])->name('admin.laporan.pinjaman.pdf');
    Route::get('/laporan/simpanan/pdf', [LaporanController::class, 'exportSimpananPdf'])->name('admin.laporan.simpanan.pdf');
});

//Verifikasi simpanan
Route::get('/admin/simpanan', [NasabahController::class, 'verifikasiSimpanan'])->name('admin.simpanan.verifikasi');
Route::post('/admin/simpanan/{id}', [NasabahController::class, 'konfirmasiSimpanan'])->name('admin.simpanan.konfirmasi');


// Dashboard Nasabah
Route::get('/nasabah/dashboard', function () {
    if (!session('nasabah_id')) return redirect()->route('nasabah.login');
    return view('nasabah.dashboard');
})->name('nasabah.dashboard');
Route::get('/nasabah/dashboard', [DashboardController::class, 'dashboard'])->name('nasabah.dashboard');
Route::get('/nasabah/pinjaman', [PinjamanController::class, 'index'])->name('nasabah.pinjaman');
Route::get('/nasabah/pinjaman/form', [PinjamanController::class, 'form'])->name('nasabah.pinjaman.form');
Route::get('/nasabah/pinjaman/{kd}/detail', [PinjamanController::class, 'detail'])->name('nasabah.pinjaman.detail');
Route::post('/nasabah/pinjaman/ajukan', [PinjamanController::class, 'ajukan'])->name('nasabah.pinjaman.ajukan');
Route::get('/nasabah/pinjaman/{kd}/bayar', [PinjamanController::class, 'formBayar'])->name('nasabah.bayar.form');
Route::post('/nasabah/pinjaman/{kd}/bayar', [PinjamanController::class, 'prosesBayar'])->name('nasabah.bayar.proses');
Route::get('nasabah/riwayat', [PinjamanController::class, 'riwayat'])->name('nasabah.riwayat');
Route::get('/nasabah/pinjaman/pdf', [PinjamanController::class, 'exportPinjamanPDF'])->name('nasabah.pinjaman.pdf');
Route::get('/nasabah/simpanan/pdf', [SimpananController::class, 'exportSimpananPDF'])->name('nasabah.simpanan.pdf');


Route::get('/nasabah/simpanan', [SimpananController::class, 'simpanan'])->name('nasabah.simpanan');
Route::post('/nasabah/simpanan/tambah', [SimpananController::class, 'tambahSimpanan'])->name('nasabah.simpanan.tambah');

//profile nasabah
Route::get('/nasabah/profil', [ProfilController::class, 'profil'])->name('nasabah.profil');
Route::post('/nasabah/profil/update', [ProfilController::class, 'updateProfil'])->name('nasabah.profil.update');
Route::get('/nasabah/profil/edit', [ProfilController::class, 'editProfil'])->name('nasabah.profil.edit');
Route::get('/nasabah/password', [ProfilController::class, 'formGantiPassword'])->name('nasabah.password.form');
Route::post('/nasabah/password/update', [ProfilController::class, 'updatePassword'])->name('nasabah.password.update');