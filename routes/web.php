<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;

// Route publik (jika belum login)
Route::middleware('redirect.custom')->group(function () {
    Route::get('/', fn () => view('landing'))->name('home');
    Route::get('/register', fn () => view('register'))->name('register.view');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::get('/login', fn () => view('login'))->name('login.view');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/admin', fn () => view('admin'))->name('admin.view');
    Route::post('/admin', [UserController::class, 'loginAdmin'])->name('admin');
});

// Logout tetap bisa
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Route setelah login
Route::middleware('auth.custom')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
     Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/forum', [UserController::class, 'forum'])->name('forum');
    Route::get('/bayar-iuran', [UserController::class, 'bayarIuran'])->name('bayar-iuran');
    Route::get('/kalender', [UserController::class, 'kalender'])->name('kalender');
    Route::get('/pay', [UserController::class, 'pembayaran'])->name('pembayaran');
});


Route::middleware(['auth.custom', 'admin'])->group(function () {
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
});

