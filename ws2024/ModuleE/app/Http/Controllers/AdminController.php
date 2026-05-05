<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Auth
    public function loginForm(){
        return view('admin.login');
    }
    public function login(LoginRequest $request){
        $data = $request->validated();
        if(!Auth::attempt(['name'=>$data['name'],'password'=>$data['password']])){
            return back()->withErrors(['invalid login']);
        }
        return redirect()->route('admin.dashboard');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('welcome');
    }

//    Admin
    public function dashboard(){
        return view('admin.dashboard');
    }
}
