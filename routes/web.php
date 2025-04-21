<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


// Public routes hanya bisa diakses jika belum login
Route::middleware('redirect.custom')->group(function () {
    Route::get('/', fn () => view('landing'))->name('home');
    Route::get('/register', [UserController::class, 'register'])->name('register.view');
    Route::post('/register', [UserController::class, 'registerSubmit'])->name('register.submit');
    Route::get('/login', fn () => view('login'))->name('login.view');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/admin', fn () => view('admin'))->name('admin.view');
    Route::post('/admin', [UserController::class, 'loginAdmin'])->name('admin');
});

// Logout tetap bisa
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    
// Protected routes
Route::middleware('auth.custom')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengumuman', [UserController::class, 'pengumuman'])->name('pengumuman');
    // kalo page nya udah selesai user con ganti pengumuman controller
    // get nya ganti resource
    Route::get('/forum', [UserController::class, 'forum'])->name('forum');
    Route::get('/bayar-iuran', [UserController::class, 'bayarIuran'])->name('bayar-iuran');
    Route::get('/kalender', [UserController::class, 'kalender'])->name('kalender');
    Route::get('/pay', [UserController::class, 'pembayaran'])->name('pembayaran');

    
});




