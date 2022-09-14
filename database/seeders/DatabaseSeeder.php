<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $category = Category::factory()->create(['name' => 'Action']);
        // Category::factory()->create(['name' => 'Comédie']);
        // $categories = Category::factory(8)->create();

        // Movie::factory()->create(['category_id' => $category]);
        // Movie::factory(19)->create(function () use ($categories) {
        //     return ['category_id' => $categories->random()];
        // });

        $key = config('services.moviedb.key');
        $client = Http::withoutVerifying();

        // Catégories
        $genres = $client->get('https://api.themoviedb.org/3/genre/movie/list?api_key='.$key.'&language=fr-FR')
            ->json('genres');

        foreach ($genres as $genre) {
            Category::factory()->create([
                'id' => $genre['id'],
                'name' => $genre['name'],
            ]);
        }

        // Films
        $movies = $client->get('https://api.themoviedb.org/3/movie/popular?api_key='.$key.'&language=fr-FR&page=1')
            ->json('results');

        foreach ($movies as $movie) {
            Movie::factory()->create([
                'title' => $movie['title'],
                'synopsis' => $movie['overview'],
                'cover' => 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
                'released_at' => $movie['release_date'] ?? null,
                'category_id' => $movie['genre_ids'][0] ?? null,
            ]);
        }
    }
}
