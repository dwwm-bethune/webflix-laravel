@extends('layouts.base')

@section('title')
    Mot de passe oublié - @parent
@endsection

@section('content')
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach

    <form action="{{ route('password.update') }}" method="post">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ request()->email }}">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div>
            <button class="px-4 py-3 bg-blue-500 text-white">
                Réinitialiser le mot de passe
            </button>
        </div>
    </form>
@endsection
