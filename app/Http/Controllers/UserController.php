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
    // Tampilkan form registrasi
    public function register()
    {
        return view('register');
    }

    // Proses data registrasi
    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|min:3',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|string|min:8|confirmed',
            'nik'               => 'required|digits:16|unique:users,nik',
            'no_kk'             => 'required|digits:16',
            'phone'             => 'required|string|min:10',
            'jumlah_keluarga'   => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'nik'               => $request->nik,
            'no_kk'             => $request->no_kk,
            'phone'             => $request->phone,
            'jumlah_keluarga'   => $request->jumlah_keluarga,
            'role'              => 'user',
        ]);

        return redirect()->route('login.view')->with('message', 'Registrasi berhasil. Silakan login.');
    }

    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:5',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (User::count() == 0) {
            User::create([
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

        $token = JWTAuth::fromUser($user);

        session([
            'jwt_token' => $token,
            'user' => [
                'id'   => $user->id,
                'name' => $user->name,
                'role' => $user->role
            ],
        ]);

        return redirect()->route('dashboard')->with('message', 'Login berhasil');
    }

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
            User::create([
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

    public function logout()
    {
        $token = session('jwt_token');

        if ($token) {
            try {
                JWTAuth::invalidate($token);
            } catch (JWTException $e) {
                // abaikan jika token invalid
            }
        }

        session()->forget('jwt_token');

        return redirect()->route('login.view')->with('message', 'Logout berhasil');
    }

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
        return $this->withAuthView('pengumuman');
    }

    public function forum()
    {
        return $this->withAuthView('forum');
    }

    public function bayarIuran()
    {
        return $this->withAuthView('pay');
    }

    public function kalender()
    {
        return $this->withAuthView('kalender');
    }

    public function pembayaran()
    {
        return $this->withAuthView('pay');
    }

    private function withAuthView($view)
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

            return view($view);
        } catch (TokenInvalidException | TokenExpiredException | JWTException $e) {
            return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid atau kedaluwarsa']);
        }
    }
}
