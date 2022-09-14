@extends('layouts.base')

@section('title')
    {{ $category->name }} - @parent
@endsection

@section('content')
    <a href="{{ route('categories') }}">Retour aux catégories</a>
    <h1 class="text-3xl font-bold">{{ $category->name }}</h1>

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
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $movies->links() }}
@endsection
