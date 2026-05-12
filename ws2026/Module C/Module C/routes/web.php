<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NewsController::class, 'welcomePage'])->name('welcome');
Route::get('/news/{id}', [NewsController::class, 'newsPage'])->name('news');

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('loginSubmit');
});

Route::prefix('admin')->middleware(['auth', 'adm'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboardPage'])->name('admin.dashboard');
    Route::get('/news', [NewsController::class, 'adminAllNews'])->name('admin.allNews');
    Route::get('/news/create', [NewsController::class, 'adminNewsCreate'])->name('admin.news.create');
    Route::post('/news/create', [NewsController::class, 'adminNewsStore'])->name('admin.news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'adminNewsEdit'])->name('admin.news.edit');
    Route::post('/news/{id}/edit', [NewsController::class, 'adminNewsUpdate'])->name('admin.news.update');
    Route::prefix('category')->group(callback: function () {
        Route::get('/', [CategoryController::class, 'Category'])->name('admin.category');
        Route::get('/create', [CategoryController::class, 'CategoryCreate'])->name('admin.category.create');
        Route::post('/create', [CategoryController::class, 'CategoryStore'])->name('admin.category.store');
        Route::get('{id}/edit', [CategoryController::class, 'CategoryEdit'])->name('admin.category.edit');
        Route::patch('{id}/edit', [CategoryController::class, 'CategoryUpdate'])->name('admin.category.update');
        Route::delete('{id}', [CategoryController::class, 'CategoryDelete'])->name('admin.category.delete');
    });
    Route::prefix('comments')->group(callback: function () {
        Route::get('/', [CommentController::class, 'CommentsList'])->name('admin.comments');
        Route::patch('/{id}', [CommentController::class, 'CommentsUpdate'])->name('admin.comments.update');
        Route::delete('/{id}', [CommentController::class, 'CommentsDelete'])->name('admin.comments.delete');
    });
});
