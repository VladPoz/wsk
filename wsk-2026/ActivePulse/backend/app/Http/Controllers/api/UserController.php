<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getAvatar(){
        $path = Storage::disk('public')->files('images/avatars');
        return response()->json($path);
    }

    public function register(RegisterUserRequest $request){
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'avatar' => $data['avatar'],
            'is_admin' => $data['is_admin'],
        ]);
        $token = $user->createToken('token')->plainTextToken;
        return response()->json(['message'=>'User register', 'token' => $token, 'name' => $data['name']], 200);
    }

    public function login(LoginUserRequest $request){
        $data = $request->validated();
        $user = User::query()->where('name', $data['name'])->first();
        if ($user) {
            return response()->json(['message'=>'User login', 'token' => $user->createToken('token')->plainTextToken, 'name'=> $data['name'], 'avatar' => $user->avatar], 200);
        }
        return response()->json(['error'=>'Invalid data'], 401);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Logged out'], 200);
    }
}
