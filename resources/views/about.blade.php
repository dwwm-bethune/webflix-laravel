@extends('layouts.base')

@section('title')
    A propos - @parent
@endsection

@section('content')
    <h1>A propos</h1>
    <ul>
        @foreach ($team as $user)
            <li>
                {{ $user['name'].' - '.$user['job'] }}
            </li>
        @endforeach

        {{ $team[0]['name'] }}
    </ul>
@endsection
