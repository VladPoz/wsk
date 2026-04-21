<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // ===== Categories ======

    public function getCategories(){
        $categories = Category::all();
        return response()->json(['description' => "List of categories", 'categories' => $categories], 200);
    }
}
