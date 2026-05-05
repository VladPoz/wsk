<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        try {
            $data = $request->validate([
                'username' => 'required|string|unique:users,username|min:3',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);
        }catch (\Exception $exception){
            return response()->json(['message' => "Invalid data"], 422);
        }
        $token = Str::random(64);
        $user = User::query()->create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'api_token' => $token,
        ]);
        return response()->json(["token" => $token, "role" => $user->role]);
    }
    public function login(Request $request){
        try {
            $data = $request->validate([
                'username' => 'string',
                'password' => 'string',
            ]);
        }catch (\Exception $exception){
            return response()->json(['message' => "Invalid login"], 422);
        }
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
