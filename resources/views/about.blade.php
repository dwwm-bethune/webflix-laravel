@extends('layouts.base')

@section('title')
    A propos - @parent
@endsection

@section('content')
    <h1 class="font-bold text-3xl mb-3">A propos</h1>
    <ul>
        @foreach ($team as $user)
            <li>
                <a href="{{ route('about.show', ['user' => $user['name']]) }}">
                    {{ $user['name'].' - '.$user['job'] }}
                </a>
            </li>
        @endforeach

        {{ $team[0]['name'] }}
    </ul>
@endsection
