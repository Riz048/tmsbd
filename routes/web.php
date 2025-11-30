<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KepalaPerpusController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\UserController;


// =======================
// PUBLIC AREA
// =======================

Route::get('/', [BukuController::class, 'index'])->name('beranda');

Route::get('/detail-buku/{id}', [BukuController::class, 'detail'])
    ->name('detail.buku');

Route::get('/kategori/{tipe}', [CategoryController::class, 'show'])
    ->name('user.kategori.show');


// =======================
// AUTH
// =======================

Route::get('/login', [AuthController::class, 'login'])
    ->middleware('guest.manual')
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->middleware('guest.manual')
    ->name('authenticate');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth.manual')
    ->name('logout');


// =======================
// USER (SISWA & GURU)
// =======================

Route::middleware(['auth.manual', 'role.manual:siswa,guru'])->group(function () {
    Route::get('/riwayat', [UserController::class, 'riwayat'])
        ->name('user.transaksi.riwayat');
});

Route::get('/referensi', [ReferensiController::class, 'home'])
    ->name('user.referensi.home');

Route::get('/referensi/{kategori}', [ReferensiController::class, 'kategori'])
    ->name('user.referensi.kategori');


// =======================
// PETUGAS AREA
// =======================

Route::middleware(['auth.manual', 'role.manual:petugas'])->group(function () {

    Route::get('/petugas/dashboard', [PetugasController::class, 'dashboard'])
        ->name('petugas.dashboard');

    Route::get('/petugas/buku/tambah', [PetugasController::class, 'tambahBuku'])
        ->name('petugas.buku.tambah');

    Route::post('/petugas/buku/tambah', [PetugasController::class, 'simpanBuku'])
        ->name('petugas.buku.simpan');

    Route::get('/petugas/peminjaman', [PetugasController::class, 'peminjaman'])
        ->name('petugas.peminjaman');

    Route::get('/petugas/pengembalian', [PetugasController::class, 'pengembalian'])
        ->name('petugas.pengembalian');
});


// =======================
// KEPALA PERPUSTAKAAN
// =======================

Route::middleware(['auth.manual', 'role.manual:kep_perpus'])->group(function () {

    Route::get('/kepperpus/dashboard', [KepalaPerpusController::class, 'dashboard'])
        ->name('kepperpus.dashboard');

    Route::get('/kepperpus/petugas', [KepalaPerpusController::class, 'dataPetugas'])
        ->name('kepperpus.petugas');

    Route::get('/kepperpus/laporan/peminjaman', [KepalaPerpusController::class, 'laporanPeminjaman'])
        ->name('kepperpus.laporan.peminjaman');

    Route::get('/kepperpus/laporan/pengembalian', [KepalaPerpusController::class, 'laporanPengembalian'])
        ->name('kepperpus.laporan.pengembalian');
});


// =======================
// KEPALA SEKOLAH
// =======================

Route::middleware(['auth.manual', 'role.manual:kepsek'])->group(function () {

    Route::get('/kepsek/dashboard', [KepsekController::class, 'dashboard'])
        ->name('kepsek.dashboard');

    Route::get('/kepsek/akun', [KepsekController::class, 'manajemenAkun'])
        ->name('kepsek.akun');

    Route::get('/kepsek/validasi', [KepsekController::class, 'validasiAkademik'])
        ->name('kepsek.validasi');

    Route::get('/kepsek/laporan', [KepsekController::class, 'laporan'])
        ->name('kepsek.laporan');
});
