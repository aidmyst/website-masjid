<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KajianController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\JadwalImamController;
use App\Http\Controllers\JadwalKhatibController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\AuthDonasiController;

// Redirect Domain Utama
Route::get('/', [PageController::class, 'beranda'])->name('home');


// Rute Website (Publik)
Route::middleware('web')->group(function () {

    // Halaman Utama
    Route::get('/beranda', [PageController::class, 'beranda'])->name('beranda');
    Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
    Route::get('/donasi', [PageController::class, 'donasi'])->name('donasi');
    Route::get('/kajian', [KajianController::class, 'index'])->name('kajian');

    // Data Diri Donatur
    Route::post('/donasi/data-diri', [AuthDonasiController::class, 'dataDiri'])
        ->name('donasi.datadiri');

    // Logout Donatur
    Route::get('/logout-donasi', [AuthDonasiController::class, 'logout'])
        ->name('logout.donasi');

    // Konfirmasi Donasi
    Route::get('/konfirmasi-donasi', [DonasiController::class, 'index'])
        ->name('konfirmasi.donasi');
    Route::post('/konfirmasi-donasi', [DonasiController::class, 'store'])
        ->name('konfirmasi.donasi.store');
});


// Rute Dashboard (Admin)
Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profil admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kajian
    Route::post('/kajian', [KajianController::class, 'store'])->name('kajian.store');
    Route::put('/kajian/{kajian}', [KajianController::class, 'update'])->name('kajian.update');
    Route::delete('/kajian/{kajian}', [KajianController::class, 'destroy'])->name('kajian.destroy');

    // Statistik
    Route::post('/statistik', [StatistikController::class, 'store'])->name('statistik.store');

    // Jamaah
    Route::post('/jamaah', [\App\Http\Controllers\JamaahController::class, 'store'])->name('jamaah.store');
    Route::delete('/jamaah/{jamaah}', [\App\Http\Controllers\JamaahController::class, 'destroy'])->name('jamaah.destroy');

    // Jadwal Imam
    Route::post('/jadwal-imam', [JadwalImamController::class, 'update'])->name('imam.update');

    // Jadwal Khatib
    Route::post('/jadwal-khatib', [JadwalKhatibController::class, 'update'])->name('khatib.update');

    // Timeline
    Route::post('/sejarah', [SejarahController::class, 'store'])->name('sejarah.store');
    Route::put('/sejarah/{sejarah}', [SejarahController::class, 'update'])->name('sejarah.update');
    Route::delete('/sejarah/{sejarah}', [SejarahController::class, 'destroy'])->name('sejarah.destroy');

    // Struktur Pengurus
    Route::post('/organisasi', [OrganisasiController::class, 'store'])->name('organisasi.store');
    Route::put('/organisasi/{organisasi}', [OrganisasiController::class, 'update'])->name('organisasi.update');
    Route::delete('/organisasi/{organisasi}', [OrganisasiController::class, 'destroy'])->name('organisasi.destroy');

    // Galeri Kegiatan
    Route::post('/galeri', [GaleriController::class, 'upload'])->name('galeri.upload');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // Donasi
    Route::post('/donasi/rekening', [DonasiController::class, 'updateRekening'])
        ->name('donasi.rekening.update');
    Route::delete('/donasi/konfirmasi/{konfirmasi}', [DonasiController::class, 'destroyKonfirmasi'])
        ->name('donasi.konfirmasi.destroy');
    Route::put('/donasi/konfirmasi/{id}', [DonasiController::class, 'updateKonfirmasi'])
        ->name('donasi.konfirmasi.update');

    // Donatur
    Route::delete('/donatur/{donatur}', [AuthDonasiController::class, 'destroy'])
        ->name('donatur.destroy');

    // Filter Donasi
    Route::get('/donasi/filter', [DashboardController::class, 'filterDonasi'])
        ->name('dashboard.donasi.filter');
});

// Otentikasi admin (Laravel default)
require __DIR__ . '/auth.php';
