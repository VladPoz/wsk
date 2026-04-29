<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PollController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PollController::class, 'welcome'])->name('welcome');
Route::middleware('guest')->prefix('login')->group(function () {
    Route::get('/', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/', [AdminController::class, 'login'])->name('login.submit');
});
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::prefix('category')->group(function () {
       Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
       Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
       Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
       Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
       Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    });
    Route::prefix('poll')->group(function () {
        Route::get('/', [PollController::class, 'index'])->name('admin.poll.index');
        Route::get('/create', [PollController::class, 'create'])->name('admin.poll.create');
        Route::post('/store', [PollController::class, 'store'])->name('admin.poll.store');
        Route::get('/edit/{id}', [PollController::class, 'edit'])->name('admin.poll.edit');
        Route::post('/update/{id}', [PollController::class, 'update'])->name('admin.poll.update');
        Route::get('/delete/{id}', [PollController::class, 'destroy'])->name('admin.poll.delete');
    });
});
Route::prefix('poll')->group(function () {
    Route::get('/{slug}', [PollController::class, 'show'])->name('poll.index');
    Route::post('/{slug}', [PollController::class, 'submit'])->name('poll.submit');
});
