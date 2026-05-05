<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Advert;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $user = auth()->user();
        $published = Advert::query()->where('status', 'published')->count();
        $moderation = Advert::query()->where('status', 'moderation')->count();
        $declined = Advert::query()->where('status', 'declined')->count();
        $users = User::query()->count();
        $top = Advert::query()->where('status', 'published')->orderBy('views_count', 'DESC')->limit(10)->get();
        return view('admin.dashboard', compact('user', 'published', 'moderation', 'declined', 'users', 'top'));
    }

//    Category

    public function categories(){
        $categories = Category::all();
        foreach($categories as $category){
            $category["published_count"] = $category->published_count();
        }
        return view('admin.categories', compact('categories'));
    }
    public function categories_create(){
        return view('admin.categories_create');
    }
    public function categories_store(CategoryRequest $request)
    {
        $data = $request->validated();
        Category::query()->create($data);
        return redirect()->route('categories')->with('success', 'Категория успешно создана');
    }
    public function categories_edit($id){
        $category = Category::query()->find($id);
        if (!$category) {
            return redirect()->route('categories')->with('error', 'Катеория не найдена');
        }
        return view('admin.categories_edit', compact('category'));
    }
    public function categories_update(CategoryRequest $request, $id){
        $data = $request->validated();
        $category = Category::query()->find($id);
        if (!$category) {
            return redirect()->route('categories')->with('error', 'Катеория не найдена');
        }
        $category->update(['name' => $data['name']]);
        return redirect()->route('categories')->with('success', 'Категория успешно обновлена');
    }
    public function categories_destroy($id){
        $category = Category::query()->find($id);
        if (!$category) {
            return redirect()->route('categories')->with('error', 'Катеория не найдена');
        }
        return view('admin.categories_destroy', compact('category'));
    }
    public function categories_delete($id){
        $category = Category::query()->find($id);
        if (!$category) {
            return redirect()->route('categories')->with('error', 'Катеория не найдена');
        }
        $adverts = Advert::query()->where('category_id', $category->id)->get();
        if ($adverts->isEmpty()) {
            $category->delete();
            return redirect()->route('categories')->with('success', 'Категория успешно удалена');
        }
        return redirect()->route('categories')->with('error', 'Данную категорию нельзя удалить');
    }

//    Users

    public function users(){
        $users = User::all();
        foreach($users as $user){
            $user["published_count"] = $user->published_count();
        }
        return view('admin.users', compact('users'));
    }

    public function users_search(Request $request){
        if(!$request->search){
            return redirect()->route('users');
        }
        $users = User::query()->where('id', $request->search)->orWhere('email', $request->search)->orWhere('phone', $request->search)->get();
        foreach($users as $user){
            $user["published_count"] = $user->published_count();
        }
        return view('admin.users', compact('users'));
    }

//    Adverts

    public function adverts(){
        $adverts = Advert::all();
//        dd($adverts);
        return view('admin.adverts', compact('adverts'));
    }
    public function adverts_search(Request $request){
        if(!$request->search){
            return redirect()->route('adverts');
        }
        $adverts = Advert::query()->where('title', $request->search)->orWhere('text', $request->search)->get();
        return view('admin.adverts', compact('adverts'));
    }
}
