<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKhatib;

class JadwalKhatibController extends Controller
{
    public function update(Request $request)
    {
        // Validasi (boleh kosong/nullable jika pekan ke-5 tidak ada)
        $request->validate([
            'jumat_1' => 'nullable|string|max:255',
            'jumat_2' => 'nullable|string|max:255',
            'jumat_3' => 'nullable|string|max:255',
            'jumat_4' => 'nullable|string|max:255',
            'jumat_5' => 'nullable|string|max:255',
        ]);

        // Update data (ID 1)
        JadwalKhatib::updateOrCreate(
            ['id' => 1],
            [
                'jumat_1' => $request->jumat_1,
                'jumat_2' => $request->jumat_2,
                'jumat_3' => $request->jumat_3,
                'jumat_4' => $request->jumat_4,
                'jumat_5' => $request->jumat_5,
            ]
        );

        return redirect()->route('dashboard')
            ->with('active_tab', 'masjid')
            ->with('success', 'Jadwal Khatib Jum\'at berhasil diperbarui!');
    }
}