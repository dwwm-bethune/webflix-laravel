<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

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
            // 'movies' => $category->movies,
            'movies' => $category->movies()->paginate(3),
            // 'movies' => Movie::where('category_id', $category->id)->paginate(3),
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // dump($request->name);
        // dump(request()->name);
        // dump(request('name'));

        $request->validate([
            'name' => 'required|min:2|unique:categories',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        // On redirige vers la liste
        return redirect()->route('categories');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            // On exclut la catégorie qu'on modifie de la vérification du doublon
            'name' => 'required|min:2|unique:categories,name,'.$category->id,
        ]);

        // $category->name = $request->name;
        // $category->save();

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories')->with('status', 'La catégorie '.$category->id.' a été modifiée.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories')->with('status', 'La catégorie '.$category->name.' a été supprimée.');
    }
}
