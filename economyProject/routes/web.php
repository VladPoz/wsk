<?php

use App\Http\Controllers\v1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', function (){
        return response()->json('dashboard');
    })->name('dashboard');
});

// Auth

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::prefix('register')->group(function () {
            Route::get('/', [AuthController::class, 'registerForm'])->name('register');
            Route::post('/', [AuthController::class, 'register'])->name('register');
        });
        Route::prefix('login')->group(function () {
            Route::get('/', [AuthController::class, 'loginForm'])->name('login');
            Route::post('/', [AuthController::class, 'login'])->name('login');
        });
    });
    Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');
});
