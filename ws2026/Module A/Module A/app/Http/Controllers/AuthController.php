<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request){
        $data = $request->validated();

        $token = Str::random(64);
        $user = User::query()->create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => 'USER',
            'api_token' => $token,
        ]);
        return response()->json(["token" => $token, "role" => $user->role]);
    }
    public function login(LoginRequest $request){
        $data = $request->validated();
        $user = User::query()->where('username', $data['username'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)){
            return response()->json(['message' => "Invalid login"], 422);
        }
        $token = Str::random(64);
        $user->update(['api_token' => $token]);
        return response()->json(["token" => $token, "role" => $user->role]);
    }
    public function logout(Request $request){
        $user = auth()->user();
        $user->update(['api_token' => null]);
        return response()->json(["message" => "logout success"]);
    }
}
