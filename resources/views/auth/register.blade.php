@extends('layouts.base')

@section('title')
    Inscription - @parent
@endsection

@section('content')
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach

    <form action="" method="post">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <label for="terms">
            <input type="checkbox" name="terms" id="terms">
            Accepter les conditions d'utilisation du site
        </label>

        <div>
            <button class="px-4 py-3 bg-blue-500 text-white">Inscription</button>
        </div>
    </form>
@endsection
