<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('custom_auth');
    });
    Route::middleware('custom_auth')->prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'eventsList']);
        Route::post('/', [EventController::class, 'store'])->middleware('custom_admin');
        Route::prefix('{event}')->group(function () {
            Route::get('/', [EventController::class, 'eventDetails']);
            Route::put('/', [EventController::class, 'update'])->middleware('custom_admin');;
            Route::delete('/', [EventController::class, 'delete'])->middleware('custom_admin');;
            Route::get('my-status', [EventController::class, 'myStatus']);
        });
    });
    Route::middleware('custom_auth')->get('my-participant', [ParticipantController::class, 'myParticipant']);
    Route::middleware('custom_auth')->prefix('participants')->group(function () {
        Route::post('/', [ParticipantController::class, 'store']);
        Route::prefix('{participant}')->group(function () {
            Route::put('/', [ParticipantController::class, 'update']);
            Route::delete('/', [ParticipantController::class, 'delete']);
        });
    });
    Route::middleware('custom_auth')->get('my-registrations', [RegistrationController::class, 'myRegistrations']);
    Route::middleware('custom_auth')->prefix('registrations')->group(function () {
        Route::post('/', [RegistrationController::class, 'store']);
        Route::prefix('{registration}')->group(function () {
            Route::patch('/confirm', [RegistrationController::class, 'confirm'])->middleware('custom_admin');
            Route::patch('/cancel', [RegistrationController::class, 'cancel']);
        });
    });
});
