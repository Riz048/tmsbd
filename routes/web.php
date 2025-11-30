<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;

// ===============
// HALAMAN PUBLIC
// ===============

// Beranda user
Route::get('/', [BukuController::class, 'index'])->name('beranda');

// Detail buku (public)
Route::get('/detail-buku/{id}', [BukuController::class, 'detail'])
    ->name('detail.buku');

// Kategori
    Route::get('/kategori/{tipe}', [CategoryController::class, 'show'])
    ->name('user.kategori.show');

// Kategori Fiksi (masih statis → nanti bisa dibuat dinamis)
Route::view('/novel', 'user.referensi.kategori.fiksi.novel')->name('user.kategori.novel');
Route::view('/komik', 'user.referensi.kategori.fiksi.komik')->name('user.kategori.komik');
Route::view('/mitos', 'user.referensi.kategori.fiksi.mitos')->name('user.kategori.mitos');
Route::view('/fabel', 'user.referensi.kategori.fiksi.fabel')->name('user.kategori.fabel');
Route::view('/cerpen', 'user.referensi.kategori.fiksi.cerpen')->name('user.kategori.cerpen');
Route::view('/legenda', 'user.referensi.kategori.fiksi.legenda')->name('user.kategori.legenda');

// Non-fiksi – sesuaikan nama view-nya
Route::view('/ilmu-sosial', 'user.referensi.kategori.nonfiksi.sosial')->name('buku.ilmu-sosial');
Route::view('/ilmu-terapan', 'user.referensi.kategori.nonfiksi.terapan')->name('buku.ilmu-terapan');
Route::view('/ilmu-murni', 'user.referensi.kategori.nonfiksi.murni')->name('buku.ilmu-murni');
Route::view('/bahasa', 'user.referensi.kategori.nonfiksi.bahasa')->name('buku.bahasa');
Route::view('/geografi-sejarah', 'user.referensi.kategori.nonfiksi.geosejarah')->name('buku.geografi-sejarah');
Route::view('/ilmu-agama', 'user.referensi.kategori.nonfiksi.agama')->name('buku.ilmu-agama');


// ===============
// AUTH USER
// ===============

Route::get('/login', [AuthController::class, 'login'])
    ->middleware('guest.manual')
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->middleware('guest.manual')
    ->name('authenticate');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth.manual')
    ->name('logout');


// =========================
// HALAMAN USER (SISWA/GURU)
// =========================

Route::middleware(['auth.manual', 'role.manual:siswa,guru'])->group(function () {
    Route::get('/riwayat', [UserController::class, 'riwayat'])
        ->name('user.transaksi.riwayat');
});

Route::get('/referensi', [ReferensiController::class, 'home'])
    ->name('user.referensi.home');

Route::get('/referensi/{kategori}', [ReferensiController::class, 'kategori'])
    ->name('user.referensi.kategori');
