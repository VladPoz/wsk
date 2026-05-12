<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsFiltersRequest;
use App\Http\Requests\NewsFormRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function welcomePage(NewsFiltersRequest $request){
        $data = $request->validated();
        $news = News::query()->with('category')->where('status', 'PUBLISHED');

        if(isset($data['search'])){
            $news = $news->where('title', 'like', '%'.$data['search'].'%');
        }
        if(isset($data['category_id'])){
            $news = $news->where('category_id', $data['category_id']);
        }
        $categories = Category::all();
        return view('welcome')->with(['categories' => $categories, 'news' => $news->get()]);
    }

    public function newsPage($id){
        if(auth()->check() && auth()->user()->role === 'ADMIN'){
            $news = News::query()->findOrFail($id);
            $news->update(['views' => $news->views + 1]);
            return view('news', compact('news'));
        }
        $news = News::query()->where('status', 'PUBLISHED')->findOrFail($id);
        $news->update(['views' => $news->views + 1]);
        return view('news', compact('news'));
    }

    public function adminAllNews(NewsFiltersRequest $request){
        $data = $request->validated();
        $news = News::query()->with('category');

        if(isset($data['search'])){
            $news = $news->where('title', 'like', '%'.$data['search'].'%');
        }
        if(isset($data['category_id'])){
            $news = $news->where('category_id', $data['category_id']);
        }
        $categories = Category::all();
        return view('admin.news')->with(['categories' => $categories, 'news' => $news->get()]);
    }

    public function adminNewsCreate(){
        $categories = Category::all();
        return view('admin.newsCreate')->with(['categories' => $categories]);
    }

    public function adminNewsStore(NewsFormRequest $request){
        $data = $request->validated();

        $path_to_image = $data['image']->store('', 'public');

        $data['image'] = $path_to_image;

        News::query()->create($data);

        return redirect()->route('admin.allNews')->with(['success' => 'Новость успешно создана']);
    }

    public function adminNewsEdit($id){
        $news = News::query()->findOrFail($id);
        $categories = Category::all();
        return view('admin.newsEdit')->with(['categories' => $categories, 'news' => $news]);
    }

    public function adminNewsUpdate(NewsFormRequest $request, $id){
        $news = News::query()->findOrFail($id);

        $data = $request->validated();

        $path_to_image = $data['image']->store('', 'public');

        $data['image'] = $path_to_image;

        $news->update($data);

        return redirect()->route('admin.allNews')->with(['success' => 'Новость успешно обновлена']);
    }
}
