<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalImam;

class JadwalImamController extends Controller
{
    public function update(Request $request)
    {
        // PERBAIKAN: Ubah 'required' menjadi 'nullable'
        $request->validate([
            'subuh'        => 'nullable|string|max:255',
            'dhuhur_ashar' => 'nullable|string|max:255',
            'maghrib_isya' => 'nullable|string|max:255',
        ]);

        // Update data (ID 1) atau buat baru jika belum ada
        JadwalImam::updateOrCreate(
            ['id' => 1],
            [
                'subuh'        => $request->subuh,
                'dhuhur_ashar' => $request->dhuhur_ashar,
                'maghrib_isya' => $request->maghrib_isya,
            ]
        );

        // Redirect kembali ke Dashboard (Tab Masjid)
        return redirect()->route('dashboard')
            ->with('active_tab', 'masjid') 
            ->with('success', 'Jadwal Imam berhasil diperbarui!');
    }
}