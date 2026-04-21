<?php

use App\Http\Controllers\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('place', [\App\Http\Controllers\v1\PlaceController::class, 'index']);
        Route::get('place/{id}', [\App\Http\Controllers\v1\PlaceController::class, 'show']);
        Route::post('place', [\App\Http\Controllers\v1\PlaceController::class, 'store'])->middleware('admin');
    });
});
