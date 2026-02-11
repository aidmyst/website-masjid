<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;

class OrganisasiController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
        ]);

        $urutan = 99;
        switch ($request->divisi) {
            case 'Penasehat':
                $urutan = 1;
                break;
            case 'Ketua':
                $urutan = 2;
                break;
            case 'Wakil Ketua':
                $urutan = 3;
                break;
            case 'Sekretaris':
                $urutan = 4;
                break;
            case 'Bendahara':
                $urutan = 5;
                break;
            default:
                $urutan = 10;
                break;
        }

        Organisasi::create([
            'nama' => $request->nama,
            'divisi' => $request->divisi,
            'urutan' => $urutan
        ]);

        return redirect()->route('dashboard')
            ->with('active_tab', 'sejarah')
            ->with('success', 'Data pengurus berhasil ditambahkan ✅');
    }

    public function update(Request $request, Organisasi $organisasi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
        ]);

        $urutan = 99;
        switch ($request->divisi) {
            case 'Penasehat':
                $urutan = 1;
                break;
            case 'Ketua':
                $urutan = 2;
                break;
            case 'Wakil Ketua':
                $urutan = 3;
                break;
            case 'Sekretaris':
                $urutan = 4;
                break;
            case 'Bendahara':
                $urutan = 5;
                break;
            default:
                $urutan = 10;
                break;
        }

        $organisasi->update([
            'nama' => $request->nama,
            'divisi' => $request->divisi,
            'urutan' => $urutan
        ]);

        return redirect()->route('dashboard')
            ->with('active_tab', 'sejarah')
            ->with('success', 'Data pengurus berhasil diperbarui ✅');
    }

    public function destroy(Organisasi $organisasi)
    {
        $organisasi->delete();

        return redirect()->route('dashboard')
            ->with('active_tab', 'sejarah')
            ->with('success', 'Data pengurus dihapus ✅');
    }
}
