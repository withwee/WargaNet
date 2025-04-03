<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UserController extends Controller
{

    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:5',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        if (User::count() == 0) {
            $dummyUser = User::create([
                'name'     => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'nik'      => '1234567890123459',
                'no_kk'    => '1234567890123459',
                'phone'    => '08123456789',
                'jumlah_keluarga' => 1,
                'role' => 'admin'
            ]);
        }
    
        $user = User::where('name', $request->name)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['error' => 'Username atau Password salah'])->withInput();
        }
    
        // Perbaikan di sini: ganti JWTAuth::login() dengan fromUser()
        $token = JWTAuth::fromUser($user);
        
        // Simpan token di session
        session([
            'jwt_token' => $token,
            'user' => [
                'id'   => $user->id,
                'name' => $user->name,
                'role' => $user->role
            ],
        ]);
    
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('message', 'Login berhasil sebagai admin');
        }
    
        return redirect()->route('dashboard')->with('message', 'Login berhasil');
    }


    // Proses login user
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'      => 'required|digits:16',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (User::count() == 0) {
            $dummyUser = User::create([
                'name'     => 'dummyUsers',
                'email'    => 'dummy@gmail.com',
                'password' => Hash::make('password123'),
                'nik'      => '1234567890123457',
                'no_kk'    => '1234567890123456',
                'phone'    => '08123456789',
                'jumlah_keluarga' => 1,
                'role' => 'user'
            ]);
        }

        $user = User::where('nik', $request->nik)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['error' => 'NIK atau Password salah'])->withInput();
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat token'])->withInput();
        }

        session([
            'jwt_token' => $token,
            'user' => [
                'id'   => $user->id,
                'name' => $user->name,
            ],
        ]);

        return redirect()->route('pengumuman')->with('message', 'Login berhasil');
    }

        // Logout
        public function logout()
    {
        $token = session('jwt_token');

        if ($token) {
            try {
                JWTAuth::invalidate($token);
            } catch (JWTException $e) {
                // Abaikan error jika token tidak valid atau sudah expired
            }
        }

        session()->forget('jwt_token');

        return redirect()->route('login.view')->with('message', 'Logout berhasil');
    }


    // Dashboard user yang memerlukan autentikasi
    public function dashboard()
{
    try {
        $token = session('jwt_token');
        if (!$token) {
            return redirect()->route('login.view')->withErrors(['error' => 'Token tidak tersedia']);
        }

        $user = JWTAuth::setToken($token)->authenticate();
        if (!$user) {
            return redirect()->route('login.view')->withErrors(['error' => 'User tidak ditemukan']);
        }

        if ($user->role !== 'admin') {
            return redirect()->route('home')->withErrors(['error' => 'Anda tidak memiliki akses ke halaman ini.']);
        }

    } catch (TokenInvalidException | TokenExpiredException | JWTException $e) {
        return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid atau kedaluwarsa']);
    }

    return view('dashboard', compact('user'));
}


       public function pengumuman()
        {
            try {
                $token = JWTAuth::getToken() ?? session('jwt_token');
                if (!$token) {
                    return redirect()->route('login.view')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
                }
        
                $user = JWTAuth::setToken($token)->authenticate();
                if (!$user) {
                    return redirect()->route('login.view')->withErrors(['error' => 'User tidak ditemukan']);
                }
            } catch (TokenInvalidException | TokenExpiredException | JWTException $e) {
                return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid atau kedaluwarsa']);
            }
        
            return view('pengumuman');
        }
        

        public function forum()
        {
            try {
                $token = JWTAuth::getToken() ?? session('jwt_token');
                if (!$token) {
                    return redirect()->route('login.view')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
                }
        
                $user = JWTAuth::setToken($token)->authenticate();
                if (!$user) {
                    return redirect()->route('login.view')->withErrors(['error' => 'User tidak ditemukan']);
                }
            } catch (TokenInvalidException | TokenExpiredException | JWTException $e) {
                return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid atau kedaluwarsa']);
            }

            return view('forum');
        }

        public function bayarIuran()
        {
            try {
                $token = JWTAuth::getToken() ?? session('jwt_token');
                if (!$token) {
                    return redirect()->route('login.view')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
                }
        
                $user = JWTAuth::setToken($token)->authenticate();
                if (!$user) {
                    return redirect()->route('login.view')->withErrors(['error' => 'User tidak ditemukan']);
                }
            } catch (TokenInvalidException | TokenExpiredException | JWTException $e) {
                return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid atau kedaluwarsa']);
            }

            return view('pay');
        }

        public function kalender()
        {
            try {
                $token = JWTAuth::getToken() ?? session('jwt_token');
                if (!$token) {
                    return redirect()->route('login.view')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
                }
        
                $user = JWTAuth::setToken($token)->authenticate();
                if (!$user) {
                    return redirect()->route('login.view')->withErrors(['error' => 'User tidak ditemukan']);
                }
            } catch (TokenInvalidException | TokenExpiredException | JWTException $e) {
                return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid atau kedaluwarsa']);
            }
            
            return view('kalender');
        }
}
