@extends('layouts.base')

@section('title')
    {{ $movie->title }} - @parent
@endsection

@section('content')
    <a href="{{ route('movies') }}">Retour aux films</a>
    <div class="flex gap-8">
        <div class="w-1/2">
            @if ($movie->cover)
            <img class="rounded" src="{{ $movie->cover }}">
            @endif
        </div>
        <div class="w-1/2">
            <h1 class="text-3xl">{{ $movie->title }}</h1>
            <div class="my-3">
                {{ $movie->synopsis }}
            </div>

            @if ($movie->actors)
            <div class="mt-3">
                <h2 class="text-2xl">Casting</h2>
                <div class="flex">
                    @foreach ($movie->actors as $actor)
                        <div class="w-1/5 mr-5">
                            <a href="{{ route('actors.show', $actor) }}">
                                @if ($actor->avatar)
                                <img class="rounded" src="{{ $actor->avatar }}">
                                @endif
                                <h3>{{ $actor->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
