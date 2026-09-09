<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginReuest;
use App\Http\Requests\Auth\RegisterReuest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(RegisterReuest $request){
        $user = User::query()->create([
            'name' => $request->validated()['name'],
            'password' => Hash::make($request->validated()['password']),
        ]);
        return response()->json(['message' => 'register success', 'name' => $user['name'], 'token' => $user->createToken('token')->plainTextToken], 200);
    }

    public function login(LoginReuest $request)
    {
        $user = User::query()->where('name', $request->validated()['name'])->first();
        if(!$user || !Hash::check($request->validated()['password'], $user->password)){
            return response()->json(['err' => 'Invalid username and password'], 401);
        };
        $user->tokens()->delete();
        return response()->json(['message' => 'login success', 'user' => $user->name, 'token' => $user->createToken('token')->plainTextToken], 200);
    }

    public function logout(){
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout success'], 200);
    }
}
