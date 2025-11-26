<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sejarah;

class SejarahController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Sejarah::create($request->all());

        return redirect()->route('dashboard')
        ->with('active_tab', 'sejarah')
        ->with('success', 'Data sejarah berhasil ditambahkan ✅');
    }

    public function update(Request $request, Sejarah $sejarah)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $sejarah->update($request->all());

        return redirect()->route('dashboard')
        ->with('active_tab', 'sejarah')
        ->with('success', 'Data sejarah berhasil diperbarui ✅');
    }

    public function destroy(Sejarah $sejarah)
    {
        $sejarah->delete();
        return redirect()->route('dashboard')
        ->with('active_tab', 'sejarah')
        ->with('success', 'Data sejarah telah dihapus ✅');
    }
}
