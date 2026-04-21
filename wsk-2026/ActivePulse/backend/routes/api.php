<?php

use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CommunityController;
use App\Http\Controllers\api\CommunityUsersController;
use App\Http\Controllers\api\CommunityTaskController;


Route::get('avatar', [UserController::class, 'getAvatar']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::post('community/store', [CommunityController::class, 'store'])->middleware('auth:sanctum');
Route::post('community/signin', [CommunityController::class, 'signIn'])->middleware('auth:sanctum');
Route::get('community/list', [CommunityUsersController::class, 'UserCommunityList'])->middleware('auth:sanctum');
Route::get('community/{slug}/task', [CommunityTaskController::class, 'GetCommunityTasks'])->middleware('auth:sanctum');
Route::post('community/{slug}/join', [CommunityUsersController::class, 'UserJoinedCommunity'])->middleware('auth:sanctum');
