<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Http\Request;

class KajianController extends Controller
{
    /**
     * Menampilkan halaman kajian publik.
     */
    public function index()
    {
        // Mengambil data daftar kajian
        $kajian = Kajian::orderBy('hari', 'desc')->get();

        // <-- 3. KIRIM SEMUA DATA YANG DIBUTUHKAN KE VIEW
        return view('kajian', compact('kajian'));
    }

    /**
     * Menyimpan data kajian baru dari form di dashboard admin.
     */
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

    /**
     * Menghapus data kajian dari database.
     */
    public function destroy(Kajian $kajian)
    {
        $kajian->delete();
        return redirect()->route('dashboard')
        ->with('active_tab', 'kajian')
        ->with('success', 'Jadwal kajian dihapus ✅');
    }

    /**
     * Memperbarui data kajian yang sudah ada.
     */
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