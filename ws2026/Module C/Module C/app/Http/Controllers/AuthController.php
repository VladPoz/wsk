<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function showLoginForm(){
        return view('login');
    }
    public function login(AuthRequest $request){
        $data = $request->validated();
        if (!auth()->attempt(['name' => $data['name'], 'password' => $data['password']])){
            return back()->withErrors(['password' => 'Invalid name or password']);
        };
        return redirect()->route('admin.dashboard');
    }
}
