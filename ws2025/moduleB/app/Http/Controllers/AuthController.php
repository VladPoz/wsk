<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function loginForm(){
        return view('auth.login');
    }
    public function login(AuthRequest $request){
        $data = $request->validated();
        $user = User::query()->where('email', $data['login'])->orWhere('phone', $data['login'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()->withErrors(['Неверный логин или пароль']);
        }
        if ($user->role !== 'moderator') {
            return back()->withErrors(['Недостаточно прав']);
        }
        auth()->login($user);
        return redirect()->route('dashboard');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('welcome');
    }
}
