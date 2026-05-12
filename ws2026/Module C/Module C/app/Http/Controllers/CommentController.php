<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function CommentsList(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $comments = Comment::query()->with('news')->where('status','pending')->orderBy('created_at' , 'desc')->get();
        return view('admin.comments', compact('comments'));
    }

    public function CommentsUpdate($id): \Illuminate\Http\RedirectResponse
    {
        $comment = Comment::query()->findOrFail($id);
        $comment->update(['status' => 'approved']);
        return redirect()->back()->with('success','Комментарий успешно одобрена');
    }

    public function CommentsDelete($id): \Illuminate\Http\RedirectResponse
    {
        $comment = Comment::query()->findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success','Комментарий успешно удалён');
    }
}
