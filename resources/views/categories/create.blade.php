@extends('layouts.base')

@section('title')
    Créer une catégorie - @parent
@endsection

@section('content')
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <form method="post">
        @csrf

        <label for="name">Nom</label>
        <input type="text" name="name" id="name">

        <button>Ajouter</button>
    </form>
@endsection
