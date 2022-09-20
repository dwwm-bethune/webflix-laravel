@extends('layouts.base')

@section('title')
    Mot de passe oublié - @parent
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
            <button class="px-4 py-3 bg-blue-500 text-white">
                Envoyer un lien
            </button>
        </div>
    </form>
@endsection
