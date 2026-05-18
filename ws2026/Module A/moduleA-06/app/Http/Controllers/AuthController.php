<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request){
        $user = User::query()->create([
            'username' => $request->validated()['username'],
            'password' => Hash::make($request->validated()['password']),
            'role' => 'USER',
            'api_token' => Str::random(60),
        ]);
        return response()->json([new AuthResource($user)], 201);
    }

    public function login(LoginRequest $request){
        $user = User::query()->where('username', $request->validated()['username'])->first();
        if(!$user || Hash::check($request->validated()['password'], $user->password)){
            return response()->json(['message' => 'Invalid login'], 422);
        }
        $user->update(['api_token' => Str::random(60)]);
        return response()->json([new AuthResource($user)], 200);
    }

    public function logout(){
        auth()->user()->update(['api_token' => null]);
        return response()->json(['message' => 'logout success'], 200);
    }
}
