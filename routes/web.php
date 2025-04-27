<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\IuranController;

// Public routes (guest only)
Route::middleware('redirect.custom')->group(function () {
    Route::get('/', fn () => view('landing'))->name('home');
    Route::get('/register', [UserController::class, 'register'])->name('register.view');
    Route::post('/register', [UserController::class, 'registerSubmit'])->name('register.submit');
    Route::get('/login', fn () => view('login'))->name('login.view');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/admin', fn () => view('admin'))->name('admin.view');
    Route::post('/admin', [UserController::class, 'loginAdmin'])->name('admin');
});

// Logout (always allowed)
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Routes setelah login
Route::middleware('auth.custom')->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Pengumuman
    Route::resource('pengumuman', PengumumanController::class)->names([
        'index' => 'pengumuman',
    ]);
    Route::post('/pengumuman/{id}/toggle-khusus', [PengumumanController::class, 'toggleKhusus'])->name('pengumuman.toggleKhusus');

    // Forum dan Kalender
    Route::get('/forum', [UserController::class, 'forum'])->name('forum');
    Route::get('/kalender', [UserController::class, 'kalender'])->name('kalender');

    // Iuran
    Route::get('/bayar-iuran', [IuranController::class, 'index'])->name('bayar-iuran');
    Route::get('/iuran/create', [IuranController::class, 'create'])->name('iuran.create');
    Route::get('/bayar-iuran/cari', [IuranController::class, 'cari'])->name('iuran.cari');
    Route::post('/bayar-iuran/{id}', [IuranController::class, 'bayar'])->name('iuran.bayar');
    Route::post('/iuran/store', [IuranController::class, 'store'])->name('iuran.store');

    // Pembayaran statis
    Route::get('/pay', [UserController::class, 'pembayaran'])->name('pembayaran');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'showEditForm'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Route khusus Admin
Route::middleware(['auth.custom', 'admin'])->group(function () {
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
});
