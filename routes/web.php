<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\MidtransController;


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
    // Forum dan Komentar
    Route::controller(ForumController::class)->group(function () {
    Route::get('/forum', 'index')->name('forum');
    Route::post('/forum', 'store')->name('forum.store');
    });

    Route::post('/forum/{forum}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/kalender', [UserController::class, 'kalender'])->name('kalender');
    
    // Route Iuran
    Route::get('/bayar-iuran', [IuranController::class, 'index'])->name('bayar-iuran'); 
    Route::get('/iuran/create', [IuranController::class, 'create'])->name('iuran.create');
    Route::get('/bayar-iuran/cari', [IuranController::class, 'cari'])->name('iuran.cari'); 
    Route::post('/bayar-iuran/{id}', [IuranController::class, 'bayar'])->name('iuran.bayar'); 
    Route::post('/iuran/store', [IuranController::class, 'store'])->name('iuran.store'); 
    Route::post('/update-status-iuran', [IuranController::class, 'updateStatus']);
    Route::get('/pay/snap-token/{id}', [IuranController::class, 'getSnapToken'])->name('pay.snap-token');
    Route::get('/pay/{id}/create-link', [IuranController::class, 'createPaymentLink'])->name('pay.create-link');
    Route::post('/bayar-iuran/callback', [MidtransController::class, 'callback']);

    // Route untuk pembayaran (menggunakan IuranController)
    Route::get('/pay', [IuranController::class, 'index'])->name('pay.index');
    Route::post('/pay/{id}/bayar', [IuranController::class, 'bayar'])->name('pay.bayar');
    Route::get('/bayar-iuran/success/{id}', [IuranController::class, 'success']);
    Route::post('/midtrans/callback', [MidtransController::class, 'callback']);
    Route::get('/bayar-iuran/success', function () {return view('bayar.successpay');});

    // New route for succespay view
    Route::get('/transaction', [IuranController::class, 'transaction'])->name('transaction');

    Route::get('/profile', [ProfileController::class, 'showEditForm'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'showEditForm'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin-only routes
Route::middleware(['auth.custom', 'admin'])->group(function () {
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    
});


