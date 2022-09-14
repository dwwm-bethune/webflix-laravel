<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
	public function index()
	{
		return view('movies.index', [
			'movies' => Movie::with('category')->paginate(10),
		]);
	}

	public function show(Movie $movie)
	{
		return view('movies.show', [
			'movie' => $movie,
		]);
	}

	public function create()
	{
		return view('movies.create', [
			'categories' => Category::all(),
		]);
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
            'title' => 'required|min:2', // '|unique:movies'
            'synopsis' => 'required|min:10',
            'duration' => 'required|integer|min:0',
            'youtube' => 'nullable|string',
            'released_at' => 'nullable|date',
			'cover' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

		if ($request->hasFile('cover')) {
			$validated['cover'] = '/storage/'.$request->file('cover')->store('covers');
		}

		Movie::create($validated);

        return redirect()->route('movies');
	}
}
