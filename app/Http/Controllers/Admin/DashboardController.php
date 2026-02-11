<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kajian;
use App\Models\Statistik;
use App\Models\JadwalImam;
use App\Models\JadwalKhatib;
use App\Models\Sejarah;
use App\Models\Organisasi;
use App\Models\Galeri;
use App\Models\Rekening;
use App\Models\Donasi;
use App\Models\Donatur;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKajian = Kajian::count();
        $kajian = Kajian::orderBy('hari', 'desc')->get();
        $statistik = Statistik::firstOrCreate(['id' => 1]);
        $imam = JadwalImam::first();
        $khatib = JadwalKhatib::first();
        $sejarah = Sejarah::orderBy('tahun', 'desc')->get();
        $organisasi = Organisasi::orderBy('urutan', 'asc')->get();
        $galeri = Galeri::latest()->get();
        $rekening = Rekening::first();
        $donaturs = Donatur::orderBy('created_at', 'desc')->get();
        $konfirmasiDonasi = Donasi::with('donatur')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalDonasiTerkumpul = Donasi::sum('nominal');

        return view('dashboard', compact(
            'totalKajian',
            'kajian',
            'statistik',
            'imam',
            'khatib',
            'sejarah',
            'organisasi',
            'galeri',
            'rekening',
            'konfirmasiDonasi',
            'totalDonasiTerkumpul',
            'donaturs'
        ));
    }
}
