<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('login', [\App\Http\Controllers\AuthController::class,'loginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\AuthController::class,'login'])->name('login.submit');
});
Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');
    Route::prefix('categories')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class,'categories'])->name('categories');
        Route::get('/create', [App\Http\Controllers\AdminController::class,'categories_create'])->name('categories.create');
        Route::post('/store', [App\Http\Controllers\AdminController::class,'categories_store'])->name('categories.store');
        Route::get('/{id}/edit', [App\Http\Controllers\AdminController::class,'categories_edit'])->name('categories.edit');
        Route::post('/{id}/update', [App\Http\Controllers\AdminController::class,'categories_update'])->name('categories.update');
        Route::get('/{id}/destroy', [App\Http\Controllers\AdminController::class,'categories_destroy'])->name('categories.destroy');
        Route::post('/{id}/delete', [App\Http\Controllers\AdminController::class,'categories_delete'])->name('categories.delete');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class,'users'])->name('users');
        Route::post('/', [App\Http\Controllers\AdminController::class,'users_search'])->name('users.search');
    });
    Route::prefix('adverts')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class,'adverts'])->name('adverts');
        Route::post('/', [App\Http\Controllers\AdminController::class,'adverts_search'])->name('adverts.search');
    });
});
