<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::paginate(3),
        ]);
    }

    public function show(Category $category)
    {
        return view('categories.show', [
            // 'category' => Category::findOrFail($id),
            'category' => $category,
        ]);
    }
}
