@extends('layouts.base')

@section('title')
    {{ $user }} - @parent
@endsection

@section('content')
    <h1>{{ $user }}</h1>
@endsection
