<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('CustomAuth');
    });
    Route::middleware(['CustomAuth'])->prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'list']);
        Route::middleware('CustomRole')->post('/', [EventController::class, 'create']);
        Route::get('/{id}', [EventController::class, 'show']);
        Route::middleware('CustomRole')->put('/{id}', [EventController::class, 'update']);
        Route::middleware('CustomRole')->delete('/{id}', [EventController::class, 'delete']);
        Route::get('/{id}/my-status', [EventController::class, 'status']);
    });
});
