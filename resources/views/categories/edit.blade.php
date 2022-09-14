@extends('layouts.base')

@section('title')
    Modifier {{ $category->name }} - @parent
@endsection

@section('content')
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <form method="post">
        @csrf
        @method('put')

        <label for="name">Nom</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}">

        <button>Modifier</button>
    </form>
@endsection
