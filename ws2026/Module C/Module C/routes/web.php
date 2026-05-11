<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [\App\Http\Controllers\NewsController::class, 'welcomePage'])->name('welcome');
Route::get('/news/{id}', [\App\Http\Controllers\NewsController::class, 'newsPage'])->name('news');

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('loginSubmit');
});

Route::prefix('admin')->middleware(['auth', 'adm'])->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'dashboardPage'])->name('admin.dashboard');
    Route::get('/news', [\App\Http\Controllers\NewsController::class, 'adminAllNews'])->name('admin.allNews');
    Route::get('/news/create', [\App\Http\Controllers\NewsController::class, 'adminNewsCreate'])->name('admin.news.create');
    Route::post('/news/create', [\App\Http\Controllers\NewsController::class, 'adminNewsStore'])->name('admin.news.store');
    Route::get('/news/{id}/edit', [\App\Http\Controllers\NewsController::class, 'adminNewsEdit'])->name('admin.news.edit');
    Route::post('/news/{id}/edit', [\App\Http\Controllers\NewsController::class, 'adminNewsUpdate'])->name('admin.news.update');
});
