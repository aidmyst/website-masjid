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
        $organisasi = Organisasi::orderBy('urutan', 'asc')->get();

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
        $laporan = Donasi::with('donatur')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('kategori');

        $now = Carbon::now();

        $laporanBulanIni = Donasi::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->get();

        $totalDonasiBulanIni = $laporanBulanIni->sum('nominal'); 
        $jumlahTransaksiBulanIni = $laporanBulanIni->count();
        Carbon::setLocale('id');
        $namaBulanIni = $now->translatedFormat('F Y');

        return view('donasi', compact(
            'rekening',
            'laporan',
            'totalDonasiBulanIni',
            'jumlahTransaksiBulanIni',
            'namaBulanIni'
        ));
    }
}
