<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboardPage(){
        $user = auth()->user();
        $topNews = News::orderBy('views', 'desc')->take(10)->get();
        return view('admin.dashboard')->with(['user' => $user, 'topNews' => $topNews]);
    }
}
