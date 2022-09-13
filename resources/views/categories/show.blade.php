@extends('layouts.base')

@section('title')
    {{ $category->name }} - @parent
@endsection

@section('content')
    <a href="{{ route('categories') }}">Retour aux catégories</a>
    <h1>{{ $category->name }}</h1>
@endsection
