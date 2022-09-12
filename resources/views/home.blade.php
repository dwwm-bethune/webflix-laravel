@extends('layouts.base')

@section('title')
    Accueil - @parent
@endsection

@section('content')
    <h1>Coucou {{ $name }}</h1>
    {!! $html !!}

    <ul>
    @foreach ($cars as $car)
        <li>{{ $car }}</li>
    @endforeach
    </ul>

    <a href="/a-propos">A propos</a>
@endsection
