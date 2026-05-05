<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Adverts;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // ===== AUTH =====
    public function register(RegisterRequest $request){
        $data = $request->validated();
        $user = User::query()->create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
        return response()->json(['description' => 'User registered successfully', 'token' => $user->createToken('token')->plainTextToken], 201);
    }
    public function login(LoginRequest $request){
        $data = $request->validated();
        $user = User::query()->where('email', $data['login'])->orWhere('phone', $data['login'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['description' => 'Invalid credentials'], 401);
        }
        return response()->json(['description' => 'Login successful','token' => $user->createToken('token')->plainTextToken], 201);
    }
    public function logout(){
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['description' => 'Logged out successfully'], 204);
    }

    // ===== User =====

    public function getCurrentUser(){
        $user = auth()->user();
        return response()->json(['description' => 'Current user profile', 'user' => $user], 200);
    }
    public function updateUser(UserUpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $user->update($data);
        return response()->json(['description' => 'Profile updated successfully', 'user' => $user], 200);
    }
    public function getUserAdverts()
    {
        $adverts = Adverts::query()->where('user_id', auth()->id())->get();
        return response()->json(['description' => "List of user's adverts", 'adverts' => $adverts], 200);
    }
}
