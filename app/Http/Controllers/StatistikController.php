<?php

// app/Http/Controllers/StatistikController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistik;

class StatistikController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jamaah' => 'required|integer',
            'tpq' => 'required|integer',
            'kajian' => 'required|integer',
            'program' => 'required|integer',
        ]);

        // Simpan atau update (hanya ada 1 baris statistik)
        Statistik::updateOrCreate(
            ['id' => 1], // pastikan selalu update row dengan id = 1
            [
                'jamaah' => $request->jamaah,
                'tpq' => $request->tpq,
                'kajian' => $request->kajian,
                'program' => $request->program,
            ]
        );

        return redirect()->route('dashboard')
        ->with('active_tab', 'masjid')
        ->with('success', 'Data statistik masjid berhasil ditambahkan ✅');
    }
}
