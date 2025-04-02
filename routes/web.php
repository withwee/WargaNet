<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes hanya bisa diakses jika belum login
Route::middleware('redirect.custom')->group(function () {
    Route::get('/', fn () => view('landing'))->name('home');
    Route::get('/register', fn () => view('register'))->name('register.view');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::get('/login', fn () => view('login'))->name('login.view');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

// Logout tetap bisa
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth.custom')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});


