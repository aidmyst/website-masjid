<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KajianController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\AuthDonasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =================================================================
// GRUP RUTENWEB (Untuk Halaman Publik & Sesi Donatur)
// SEMUA RUTE INI HARUS ADA DI DALAM GRUP 'web'
// =================================================================
Route::middleware('web')->group(function () {

    // Halaman Publik Utama
    Route::get('/beranda', [PageController::class, 'beranda'])->name('beranda');
    Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
    Route::get('/donasi', [PageController::class, 'donasi'])->name('donasi');
    Route::get('/kajian', [KajianController::class, 'index'])->name('kajian');

    // Rute Autentikasi Donatur (via Fetch/AJAX)
    // Ini adalah kunci agar sesi Anda tersimpan
    Route::post('/login-donasi', [AuthDonasiController::class, 'loginDonasi'])->name('login.donasi');
    Route::post('/register-donasi', [AuthDonasiController::class, 'register'])->name('register.donasi');
    Route::get('/logout-donasi', [AuthDonasiController::class, 'logout'])->name('logout.donasi');

    // Rute Halaman Konfirmasi Donasi (yang diproteksi)
    Route::get('/konfirmasi-donasi', [DonasiController::class, 'index'])->name('konfirmasi.donasi');
    Route::post('/konfirmasi-donasi', [DonasiController::class, 'store'])->name('konfirmasi.donasi.store');
});


// =================================================================
// GRUP RUTE ADMIN (Dashboard)
// =================================================================
Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    // Rute utama Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Kelola Kajian
    Route::post('/kajian', [KajianController::class, 'store'])->name('kajian.store');
    Route::put('/kajian/{kajian}', [KajianController::class, 'update'])->name('kajian.update');
    Route::delete('/kajian/{kajian}', [KajianController::class, 'destroy'])->name('kajian.destroy');

    // Rute Kelola Statistik
    Route::post('/statistik', [StatistikController::class, 'store'])->name('statistik.store');

    // Rute Kelola Sejarah
    Route::post('/sejarah', [SejarahController::class, 'store'])->name('sejarah.store');
    Route::put('/sejarah/{sejarah}', [SejarahController::class, 'update'])->name('sejarah.update');
    Route::delete('/sejarah/{sejarah}', [SejarahController::class, 'destroy'])->name('sejarah.destroy');

    // Rute Kelola Organisasi
    Route::post('/organisasi', [OrganisasiController::class, 'upload'])->name('organisasi.upload');
    Route::delete('/organisasi/{organisasi}', [OrganisasiController::class, 'destroy'])->name('organisasi.destroy');

    // Rute Kelola Galeri
    Route::post('/galeri', [GaleriController::class, 'upload'])->name('galeri.upload');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // Rute Kelola Donasi (oleh Admin)
    Route::post('/donasi/rekening', [DonasiController::class, 'updateRekening'])->name('donasi.rekening.update');
    Route::delete('/donasi/konfirmasi/{konfirmasi}', [DonasiController::class, 'destroyKonfirmasi'])->name('donasi.konfirmasi.destroy');
    Route::delete('/donatur/{donatur}', [AuthDonasiController::class, 'destroy'])->name('donatur.destroy');
    Route::get('/donasi/filter', [App\Http\Controllers\Admin\DashboardController::class, 'filterDonasi'])
        ->name('dashboard.donasi.filter');
});

// File otentikasi admin bawaan Laravel
require __DIR__ . '/auth.php';
