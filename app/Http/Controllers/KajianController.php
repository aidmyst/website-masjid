<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Http\Request;

class KajianController extends Controller
{
    public function index()
    {
        $kajian = Kajian::orderBy('hari', 'desc')->get();

        return view('kajian', compact('kajian'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hari' => 'required|date',
            'waktu' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'pemateri' => 'required|string|max:255',
        ]);

        Kajian::create($validatedData);

        return redirect()->route('dashboard')
        ->with('active_tab', 'kajian')
        ->with('success', 'Data jadwal kajian berhasil ditambahkan ✅');
    }

    public function destroy(Kajian $kajian)
    {
        $kajian->delete();
        return redirect()->route('dashboard')
        ->with('active_tab', 'kajian')
        ->with('success', 'Jadwal kajian dihapus ✅');
    }

    public function update(Request $request, Kajian $kajian)
    {
        $validatedData = $request->validate([
            'hari' => 'required|date',
            'waktu' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'pemateri' => 'required|string|max:255',
        ]);

        $kajian->update($validatedData);
        
        return redirect()->route('dashboard')
        ->with('active_tab', 'kajian')
        ->with('success', 'Jadwal kajian diperbarui ✅');
    }
}