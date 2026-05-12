<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function Category(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $categories = Category::query()->with('news')->get();

        foreach($categories as $category){
            $category->news_count = $category->news->count();
        }

        return view('admin.category',compact('categories'));
    }

    public function CategoryCreate(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('admin.categoryCreate');
    }

    public function CategoryStore(CategoryFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Category::query()->create($data);
        return redirect()->route('admin.category')->with(['success' => 'Категория успешно создана']);
    }

    public function CategoryEdit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $category = Category::query()->findOrFail($id);
        return view('admin.categoryEdit',compact('category'));
    }

    public function CategoryUpdate(CategoryFormRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        Category::query()->findOrFail($id)->update($data);
//        dd('wadaw');
        return redirect()->route('admin.category')->with(['success' => 'Категория успешно обновлен']);
    }

    public function CategoryDelete($id): RedirectResponse
    {
        $category = Category::query()->with('news')->findOrFail($id);
        if($category->news->count() === 0){
            $category->delete();
        }else{
            return redirect()->route('admin.category')->with(['err' => 'Нельзя удалять категорию у которой есть новость']);
        }
        return redirect()->route('admin.category')->with(['success' => 'Категория успешно удалена']);
    }
}
