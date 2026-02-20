<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use Illuminate\Http\Request;

class JamaahController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:255']);
        Jamaah::create(['nama' => $request->nama]);

        return redirect()->route('dashboard')
            ->with('active_tab', 'masjid')
            ->with('success', 'Jamaah berhasil didata ✅');
    }

    public function destroy(Jamaah $jamaah)
    {
        $jamaah->delete();
        return redirect()->route('dashboard')
            ->with('active_tab', 'masjid')
            ->with('success', 'Data jamaah dihapus ✅');
    }
}