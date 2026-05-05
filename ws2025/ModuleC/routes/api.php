<?php

use App\Http\Controllers\AdvertsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'getCurrentUser']);
    Route::patch('/', [UserController::class, 'updateUser']);
    Route::get('/adverts', [UserController::class, 'getUserAdverts']);
});
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::prefix('adverts')->group(function () {
    Route::get('/', [AdvertsController::class, 'getAdverts']);
    Route::middleware('auth:sanctum')->post('/', [AdvertsController::class, 'createAdvert']);
    Route::get('/{id}', [AdvertsController::class, 'getAdvert']);
    Route::middleware(['auth:sanctum', 'statusCheck'])->patch('/{id}', [AdvertsController::class, 'updateAdvert']);
    Route::middleware(['auth:sanctum', 'statusCheck'])->delete('/{id}', [AdvertsController::class, 'deleteAdvert']);
    Route::middleware(['auth:sanctum', 'statusCheck'])->post('{id}/update-status', [AdvertsController::class, 'updateAdvertStatus']);
});
