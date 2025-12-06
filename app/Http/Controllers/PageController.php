<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistik;
use App\Models\JadwalImam;
use App\Models\JadwalKhatib;
use App\Models\Sejarah;
use App\Models\Organisasi;
use App\Models\Galeri;
use App\Services\HijriDateService;
use App\Services\PrayerTimeService;
use App\Models\Rekening;
use App\Models\Donasi;
use Carbon\Carbon;

class PageController extends Controller
{
    public function tentang()
    {
        $organisasi = Organisasi::latest()->first();
    
        // Ubah path relatif menjadi URL absolut untuk Alpine JS
        $galeri = Galeri::latest()->get()->map(function ($g) {
            $g->url = asset($g->gambar);
            return $g;
        });
    
        $sejarah = Sejarah::orderBy('tahun', 'asc')->get();
    
        return view('tentang', compact('organisasi', 'galeri', 'sejarah'));
    }

    public function beranda(PrayerTimeService $prayerTime, HijriDateService $hijriDate)
    {
        $statistik = Statistik::first();
        $imam = JadwalImam::first();
        $khatib = JadwalKhatib::first();

        return view('beranda', [
            'prayerTimes'    => $prayerTime->getTodaysPrayerTimes(),
            'nextPrayerName' => $prayerTime->getNextPrayerName(),
            'currentDate'    => $prayerTime->getFormattedDate(),
            'hijriDate'      => $hijriDate->getCurrentHijriDate(),
            'statistik'      => $statistik,
            'imam'           => $imam,
            'khatib'         => $khatib,
        ]);
    }

    public function kajian()
    {
        return view('kajian');
    }

    public function donasi()
    {
        $rekening = Rekening::first();

        // 3. Mengambil data untuk TABEL di bawah (Pintu Surga, BMT, dll)
        // Kita ambil dari tabel 'donasis', bukan 'laporan_donasis'
        $laporan = Donasi::with('donatur') // Muat relasi donatur
            ->orderBy('created_at', 'desc') // Gunakan created_at
            ->get()
            ->groupBy('kategori');

        // --- LOGIKA BARU UNTUK RINGKASAN BULANAN ---
        $now = Carbon::now();

        // 4. Ambil semua donasi bulan ini dari tabel 'donasis'
        $laporanBulanIni = Donasi::whereYear('created_at', $now->year) // Gunakan created_at
            ->whereMonth('created_at', $now->month) // Gunakan created_at
            ->get();

        // 5. Hitung total pemasukan (Goal 1)
        $totalDonasiBulanIni = $laporanBulanIni->sum('nominal'); // Gunakan kolom 'nominal'

        // 6. Hitung jumlah transaksi (Goal 2 & 3)
        $jumlahTransaksiBulanIni = $laporanBulanIni->count();

        // Format nama bulan saat ini dalam Bahasa Indonesia
        Carbon::setLocale('id');
        $namaBulanIni = $now->translatedFormat('F Y');
        // --- AKHIR LOGIKA BARU ---

        return view('donasi', compact(
            'rekening',
            'laporan',
            'totalDonasiBulanIni',
            'jumlahTransaksiBulanIni',
            'namaBulanIni'
        ));
    }
}
