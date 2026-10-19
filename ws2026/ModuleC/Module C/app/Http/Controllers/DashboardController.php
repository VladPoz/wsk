<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboardPage(){
        $user = auth()->user();
        $topNews = News::orderBy('views', 'desc')->take(10)->get();
        $news_count = News::query()->count();
        $news_draft = News::query()->where('status', 'draft')->orderBy('created_at', 'desc')->take(5)->get();
        $comments = Comment::query()->with('news')->where('status', 'pending')->orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.dashboard')->with(['user' => $user, 'topNews' => $topNews, 'news_count' => $news_count, 'news_draft' => $news_draft, 'comments' => $comments]);
    }

    public function getNewsCount(Request $request){
        return back()->with(['news_count' => News::query()->where('news.status', $request->status)->count(), 'status' => $request->status]);
    }
}
