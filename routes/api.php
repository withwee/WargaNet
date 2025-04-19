<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengumumanController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:api')->get('/dashboard', [UserController::class, 'dashboard']);
Route::middleware('auth:api')->post('/logout', [UserController::class, 'logout']);

