@extends('layouts.base')

@section('title')
    Nos films - @parent
@endsection

@section('content')
    @auth
    <a href="{{ route('movies.create') }}" class="bg-blue-500 py-2 px-3 text-white rounded-lg hover:bg-blue-400 duration-300">Créer un film</a>
    @endauth

    <div class="flex flex-wrap -mx-3 py-8">
        @foreach ($movies as $movie)
            <div class="w-1/5 mb-6">
                <div class="bg-white mx-3 rounded h-full shadow">
                    @if ($movie->cover)
                    <img class="rounded-t" src="{{ $movie->cover }}">
                    @endif
                    <div class="p-3">
                        <h2 class="mb-4 underline">
                            <a href="{{ route('movies.show', $movie) }}">
                                {{ $movie->title }}
                            </a>
                        </h2>
                        <p class="mb-4">
                            @if ($movie->category)
                            {{ $movie->category->name }} |
                            @endif
                            @if ($movie->released_at)
                            {{ $movie->released_at->translatedFormat('d F Y') }} |
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

    {{ $movies->links() }}
@endsection
