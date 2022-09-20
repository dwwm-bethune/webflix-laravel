@extends('layouts.base')

@section('title')
    Vérification requise - @parent
@endsection

@section('content')
    <p>
        {{ Auth::user()->name }}, la validation de votre compte est requise.
        Veuillez cliquer sur l'email reçu pour valider votre compte.
    </p>
    <p>
        Si vous avez perdu l'email, vous pouvez en recevoir un nouveau
        <a href="{{ route('verification.send') }}">en cliquant ici</a>.
    </p>
@endsection
