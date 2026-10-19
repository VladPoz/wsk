<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('auth');

Route::prefix('auth')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [AuthController::class, 'login__form'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });

});
