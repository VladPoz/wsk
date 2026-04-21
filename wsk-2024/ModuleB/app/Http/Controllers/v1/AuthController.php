<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(AuthRequest $request){
        $data = $request->validated();
        if (!Auth::attempt(['username' => $data['username'], 'password' => $data['password']])) {
            return response()->json('invalid login', 401);
        }
        $user = Auth::user();
        return response(['token: ' => $user->createToken('token')->plainTextToken, 'role:' => $user->role],200);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->currentAccessToken()->delete();
        return response('logout success', 200);
    }
}
