<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RegistrationController;
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
    Route::middleware(['CustomAuth'])->get('my-participant', [ParticipantController::class, 'myParticipant']);
    Route::middleware(['CustomAuth'])->prefix('participants')->group(function () {
        Route::post('/', [ParticipantController::class, 'create']);
        Route::prefix('{id}')->group(function () {
            Route::put('/', [ParticipantController::class, 'update']);
            Route::delete('/', [ParticipantController::class, 'delete']);
        });
    });
    Route::middleware(['CustomAuth'])->prefix('registrations')->group(function () {
        Route::post('/', [RegistrationController::class, 'create']);
        Route::prefix('{id}')->group(function () {
            Route::patch('/confirm', [RegistrationController::class, 'updateConfirm'])->middleware('CustomRole');
            Route::patch('/cancel', [RegistrationController::class, 'updateCancel']);
        });
    });
    Route::middleware(['CustomAuth'])->get('my-registrations', [RegistrationController::class, 'myRegistrations']);
});
