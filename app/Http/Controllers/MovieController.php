<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'actors' => Actor::all(),
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
            'actor_ids' => 'nullable|exists:actors,id',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = '/storage/'.$request->file('cover')->store('covers');
        }

        // On doit exclure le champ actor_ids du tableau $validated
        $movie = Movie::create(collect($validated)->except('actor_ids')->all());
        $movie->actors()->attach($validated['actor_ids']);

        return redirect()->route('movies');
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', [
            'categories' => Category::all(),
            'movie' => $movie,
        ]);
    }

    public function update(Movie $movie, Request $request)
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
            // On supprime l'ancienne image
            if ($movie->cover) {
                Storage::delete(str($movie->cover)->remove('/storage/'));
            }

            $validated['cover'] = '/storage/'.$request->file('cover')->store('covers');
        }

        $movie->update($validated);

        return redirect()->route('movies');
    }

    public function destroy(Movie $movie)
    {
        Storage::delete(str($movie->cover)->remove('/storage/'));
        $movie->delete();

        return redirect()->route('movies');
    }
}
