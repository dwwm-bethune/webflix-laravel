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
        </div>
    </div>
@endsection
