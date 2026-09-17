<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
       Route::post('register', [AuthController::class, 'register']);
       Route::post('login', [AuthController::class, 'login']);
       Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });
    Route::middleware('auth:sanctum')->prefix('task')->group(function () {
        Route::get('/', [TaskController::class, 'getAllMyTasks']);
        Route::post('/', [TaskController::class, 'addMyTask']);
        Route::get('/{task}', [TaskController::class, 'getMyTask']);
        Route::put('/{task}/edit', [TaskController::class, 'editMyTask']);
        Route::patch('/{task}/status', [TaskController::class, 'toggleTaskStatus']);
        Route::patch('/{task}/count/plus', [TaskController::class, 'plusCompletedTask']);
        Route::patch('/{task}/count/minus', [TaskController::class, 'minusCompletedTask']);
        Route::delete('/{task}/del', [TaskController::class, 'deleteMyTask']);
    });
});
