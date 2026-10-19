<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginReuest;
use App\Http\Requests\Auth\RegisterReuest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function loginForm(){
        return view('auth.login');
    }
    public function login(LoginReuest $request){
        $data = $request->validated();
        $user = User::query()->where('email', $data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)){
            return back()->withErrors(['errors'=>'Invalid name, email or password'])->withInput();
        }
        auth()->login($user);
        return redirect()->route('home');
    }
    public function registerForm()
    {
        return view('auth.register');
    }
    public function register(RegisterReuest $request)
    {
        $data = $request->validated();
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        auth()->login($user);
        return redirect()->route('home');
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('home');
    }
}
