@extends('layouts.base')

@section('title')
    Login - @parent
@endsection

@section('content')
    @error('email')
        <p>{{ $message }}</p>
    @enderror

    <form action="" method="post">
        @csrf

        <input type="text" name="email" value="{{ old('email') }}">
        <input type="password" name="password">
        <input type="checkbox" name="remember">

        <button>Connexion</button>
    </form>
@endsection
