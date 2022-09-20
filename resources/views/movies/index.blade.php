@extends('layouts.base')

@section('title')
    Nos films - @parent
@endsection

@section('content')
    @auth
    <a href="{{ route('movies.create') }}" class="inline-block bg-blue-500 py-2 px-3 text-white rounded-lg hover:bg-blue-400 duration-300">Créer un film</a>
    @endauth

    <div class="flex py-8">
        <div class="w-1/4 mr-8">
            <div class="bg-white shadow rounded p-4">
                <form action="" method="get">
                    <div class="mb-3">
                        <label for="order_by">Trier par</label>
                        <select name="order_by" id="order_by">
                            <option value="title" @selected(request()->order_by === 'title')>Titre</option>
                            <option value="released_at" @selected(request('order_by') === 'released_at')>Date de sortie</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="categories">Filtrer par catégories</label>
                        @foreach ($categories as $category)
                            <div>
                                <label for="categories-{{ $category->id }}">
                                    <input type="checkbox"
                                        @checked(in_array($category->id, request('filters.categories', [])))
                                        name="filters[categories][]"
                                        value="{{ $category->id }}"
                                        id="categories-{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button class="bg-blue-500 text-white px-4 py-2">Filtrer</button>
                </form>
            </div>
        </div>
        <div class="w-3/4 flex flex-wrap -mx-3">
            @foreach ($movies as $movie)
                <div class="w-1/5 mb-6">
                    <div class="bg-white mx-3 rounded shadow">
                        @if ($movie->cover)
                        <img class="rounded-t h-64 object-cover" src="{{ $movie->cover }}">
                        @endif
                        <div class="p-3">
                            <h2 class="mb-1 underline min-h-[50px]">
                                <a href="{{ route('movies.show', $movie) }}">
                                    {{ $movie->title }}
                                </a>
                            </h2>
                            <p class="text-xs">
                                @if ($movie->released_at)
                                {{ $movie->released_at->translatedFormat('d F Y') }} |
                                @endif
                                @if ($movie->category)
                                {{ $movie->category->name }} |
                                @endif
                                {{ $movie->duration }}
                            </p>

                            @can('update', $movie)
                            <a class="bg-gray-500 py-2 px-3 text-white rounded-lg hover:bg-gray-400 duration-300 inline-block" href="{{ route('movies.edit', $movie->id) }}">Modifier</a>
                            @endcan

                            @can('delete', $movie)
                            <form action="{{ route('movies.delete', $movie->id) }}" method="post" class="inline">
                                @csrf
                                @method('delete')
                                <button class="bg-red-500 py-2 px-3 text-white rounded-lg hover:bg-red-400 duration-300 inline-block">Supprimer</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{ $movies->links() }}
@endsection
