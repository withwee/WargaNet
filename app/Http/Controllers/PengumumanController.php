<?php
     // app/Http/Controllers/PengumumanController.php
    namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
     use App\Models\Pengumuman;
     use App\Http\Controllers\Controller;
     use Tymon\JWTAuth\Facades\JWTAuth;
     use Tymon\JWTAuth\Exceptions\JWTException;
 
 class PengumumanController extends Controller
     {
         // Tampilkan semua pengumuman
         public function index()
 {
     // buat crud disini
     try {
         $token = JWTAuth::getToken() ?? session('jwt_token');
 
         if (!$token) {
             return redirect()->route('login.view')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
         }
 
         $user = JWTAuth::setToken($token)->authenticate();
 
         if (!$user) {
             return redirect()->route('login.view')->withErrors(['error' => 'User tidak ditemukan']);
         }
 
         $pengumumans = Pengumuman::latest()->get();
 
         if ($user->role === 'admin') {
             return view('admin.pengumumanAdmin', compact('pengumumans'));
         }
 
         return view('pengumuman', compact('pengumumans'));
 
     } catch (JWTException $e) {
         return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid atau kedaluwarsa']);
     }
 }
 
         // Simpan pengumuman baru
         public function store(Request $request)
         {
             $request->validate([
                 'judulPengumuman' => 'required|string',
                 'isiPengumuman' => 'required|string',
             ]);
 
             Pengumuman::create($request->only(['judulPengumuman', 'isiPengumuman']));
 
             return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil ditambahkan!');
         }
 
         // Update pengumuman
         public function update(Request $request, $id)
         {
             $request->validate([
                 'judulPengumuman' => 'required|string|max:255',
                 'isiPengumuman' => 'required|string',
             ]);
 
             $pengumuman = Pengumuman::findOrFail($id);
             $pengumuman->update($request->only(['judulPengumuman', 'isiPengumuman']));
 
             return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil diperbarui!');
         }
 
         // Hapus pengumuman
         public function destroy($id)
         {
             $pengumuman = Pengumuman::findOrFail($id);
             $pengumuman->delete();
 
             return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil dihapus!');
         }
     }