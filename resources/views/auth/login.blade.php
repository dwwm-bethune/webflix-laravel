@extends('layouts.base')

@section('title')
    Login - @parent
@endsection

@section('content')
    @error('email')
        <p>{{ $message }}</p>
    @enderror

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

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

        <label for="remember">
            <input type="checkbox" name="remember" id="remember">
            Se rappeller de moi
        </label>

        <div>
            <button class="px-4 py-3 bg-blue-500 text-white">Connexion</button>
            <a href="{{ route('password.request') }}">Réinitialiser le mot de passe</a>
        </div>
    </form>
@endsection
