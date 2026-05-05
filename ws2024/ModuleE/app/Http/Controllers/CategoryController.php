<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request){
        $data = $request->validated();
        Category::query()->create($data);
        return redirect()->route('admin.category.index');
    }

    public function edit($id){
        $category = Category::query()->findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id){
        $data = $request->validated();
        Category::query()->findOrFail($id)->update($data);
        return redirect()->route('admin.category.index');
    }
}
