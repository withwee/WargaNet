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
    // Proses registrasi user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:12|confirmed',
            'nik'      => 'required|digits:16|unique:users,nik',
            'no_kk'    => 'required|digits:16|unique:users,no_kk',
            'phone'    => 'required|string|max:15',
            'jumlah_keluarga' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'nik'      => $request->nik,
            'no_kk'    => $request->no_kk,
            'phone'    => $request->phone,
            'jumlah_keluarga' => $request->jumlah_keluarga,
        ]);

        return redirect()->route('login.view')->with('message', 'Registrasi berhasil, silakan login.');
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

        $user = User::where('nik', $request->nik)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['error' => 'NIK atau Password salah'])->withInput();
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat token'])->withInput();
        }

        // Simpan data user ke dalam session
        session([
            'jwt_token' => $token,
            'user' => [
                'id'   => $user->id,
                'name' => $user->name,
            ],
        ]);

        return redirect()->route('dashboard')->with('message', 'Login berhasil');
    }

    // Logout user dan hapus token
    public function logout()
    {
        try {
            if (session()->has('jwt_token')) {
                JWTAuth::invalidate(session('jwt_token'));
            }
        } catch (JWTException $e) {
            // Abaikan error jika token tidak valid atau sudah expired
        }

        session()->forget(['jwt_token', 'user']);

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

        } catch (TokenInvalidException $e) {
            return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid']);
        } catch (TokenExpiredException $e) {
            return redirect()->route('login.view')->withErrors(['error' => 'Token kedaluwarsa']);
        } catch (JWTException $e) {
            return redirect()->route('login.view')->withErrors(['error' => 'Terjadi kesalahan dengan token']);
        }

        return view('dashboard', compact('user'));
    }
}
