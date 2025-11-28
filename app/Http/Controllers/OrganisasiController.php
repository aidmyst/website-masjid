<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi; // Ganti model
use Illuminate\Support\Facades\File;

class OrganisasiController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:2048'
        ]);
    
        $file = $request->file('gambar');
        $namaFile = time() . '_' . $file->getClientOriginalName();
    
        // Path ke public_html/uploads/organisasi
        $uploadPath = base_path('../public_html/uploads/organisasi');
    
        // Pastikan folder ada
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }
    
        // Pindah file
        $file->move($uploadPath, $namaFile);
    
        // Simpan path yang bisa diakses browser
        Organisasi::create([
            'gambar' => 'uploads/organisasi/' . $namaFile
        ]);
    
        return redirect()->route('dashboard')
            ->with('active_tab', 'sejarah')
            ->with('success', 'Gambar struktur organisasi berhasil di-upload ✅');
    }

    public function destroy(Organisasi $organisasi)
    {
        // Hapus file fisik
        if (File::exists(public_path($organisasi->gambar))) {
            File::delete(public_path($organisasi->gambar));
        }

        // Hapus record database
        $organisasi->delete();

        return redirect()->route('dashboard')
        ->with('active_tab', 'sejarah')
        ->with('success', 'Gambar struktur organisasi dihapus ✅');
    }
}