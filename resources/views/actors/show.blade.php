@extends('layouts.base')

@section('title')
    {{ $actor->name }} - @parent
@endsection

@section('content')
    <a href="{{ route('actors.index') }}">Retour aux acteurs</a>
    <div class="flex gap-8">
        <div class="w-1/2">
            @if ($actor->avatar)
            <img class="rounded" src="{{ $actor->avatar }}">
            @endif
        </div>
        <div class="w-1/2">
            <h1 class="text-3xl">{{ $actor->name }}</h1>
            <div class="my-3">
                @if ($actor->birthday)
                {{ $actor->birthday->age }} ans
                (Né le {{ $actor->birthday->translatedFormat('d/m/Y') }})
                @endif
            </div>

            @if ($actor->movies)
            <div class="mt-3">
                <h2 class="text-2xl">Films</h2>
                <div class="flex">
                    @foreach ($actor->movies as $movie)
                        <div class="w-1/5 mr-5">
                            <a href="{{ route('movies.show', $movie) }}">
                                @if ($movie->cover)
                                <img class="rounded" src="{{ $movie->cover }}">
                                @endif
                                <h3>{{ $movie->title }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
