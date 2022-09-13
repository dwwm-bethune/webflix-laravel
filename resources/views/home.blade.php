@extends('layouts.base')

@section('title')
    Accueil - @parent
@endsection

@section('content')
    <h1 class="font-bold text-3xl mb-3">Accueil {{ $name }}</h1>
    {!! $html !!}

    <ul>
    @foreach ($cars as $car)
        <li>{{ $car }}</li>
    @endforeach
    </ul>

    <a href="{{ route('about') }}">A propos</a>
@endsection
