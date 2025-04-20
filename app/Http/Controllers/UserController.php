<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UserController extends Controller
{
    // ADMIN LOGIN
    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:5',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
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
                'role' => $user->role,
            ],
        ]);

        return redirect()->route('dashboard')->with('message', 'Login berhasil');
    }

    // USER LOGIN
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

        $token = JWTAuth::fromUser($user);

        session([
            'jwt_token' => $token,
            'user' => [
                'id'   => $user->id,
                'name' => $user->name,
                'role' => $user->role,
            ],
        ]);

        return redirect()->route('pengumuman')->with('message', 'Login berhasil');
    }

    // LOGOUT
    public function logout()
    {
        $token = session('jwt_token');
        if ($token) {
            try {
                JWTAuth::invalidate($token);
            } catch (JWTException $e) {}
        }

        session()->forget('jwt_token');

        return redirect()->route('login.view')->with('message', 'Logout berhasil');
    }

    // DASHBOARD
    public function dashboard()
    {
        $user = $this->getAuthenticatedUserOrRedirect();
        if (!$user instanceof User) return $user;

        return view('dashboard', compact('user'));
    }

    // PENGUMUMAN (user & admin)
    public function pengumuman()
    {
        $user = $this->getAuthenticatedUserOrRedirect();
        if (!$user instanceof User) return $user;

        $pengumumans = Pengumuman::latest()->get();

        if ($user->role === 'admin') {
            return view('admin.pengumumanAdmin', compact('pengumumans'));
        }

        return view('pengumuman', compact('pengumumans'));
    }

    public function forum()
    {
        $user = $this->getAuthenticatedUserOrRedirect();
        if (!$user instanceof User) return $user;

        return view('forum');
    }

    public function bayarIuran()
    {
        $user = $this->getAuthenticatedUserOrRedirect();
        if (!$user instanceof User) return $user;

        return view('pay');
    }

    public function kalender()
    {
        $user = $this->getAuthenticatedUserOrRedirect();
        if (!$user instanceof User) return $user;

        return view('kalender');
    }

    public function pembayaran()
    {
        $user = $this->getAuthenticatedUserOrRedirect();
        if (!$user instanceof User) return $user;

        return view('pay');
    }

    // 🔐 Ambil user dari JWT token di session
    private function getAuthenticatedUserOrRedirect()
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

            return $user;

        } catch (TokenInvalidException | TokenExpiredException | JWTException $e) {
            return redirect()->route('login.view')->withErrors(['error' => 'Token tidak valid atau kedaluwarsa']);
        }
    }
}
