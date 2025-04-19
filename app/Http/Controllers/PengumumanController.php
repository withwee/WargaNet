<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();
        return view('pengumuman', compact('pengumuman')); 
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judulPengumuman' => 'required|string|max:255',
            'isiPengumuman' => 'required|string',
        ]);

        // Simpan ke database
        Pengumuman::create($validated);

        return redirect()->back()->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'judulPengumuman' => 'required|string|max:255',
            'isiPengumuman' => 'required|string',
        ]);

        // Update data
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update($validated);

        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus pengumuman
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus!');
    }

}
