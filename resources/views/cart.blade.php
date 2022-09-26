@extends('layouts.base')

@section('title')
    Mon panier - @parent
@endsection

@section('content')
    @error('payment')
        <p>{{ $message }}</p>
    @enderror

    <h1 class="font-bold text-3xl mb-3">Mon panier</h1>
    <ul>
        @foreach (session('products', []) as $movie)
            <li>
                <a href="{{ route('movies.show', $movie) }}" class="flex justify-between">
                    <img class="w-32" src="{{ $movie->cover }}" alt="{{ $movie->title }}">
                    {{ $movie->title }} -
                    {{ $movie->price_with_tax }} ({{ $movie->price_without_tax }})
                </a>
            </li>
        @endforeach
        <li>Total du panier: {{ $totalWithTaxes }}</li>
    </ul>

    @if (session('payment_success'))
        {{ session('payment_success') }}
    @else
        @if (!empty(session('products', [])))
        <form action="{{ route('pay-2') }}" method="post" id="payment-form">
            @csrf
            <div class="bg-white px-4 py-2 my-3" id="card-element"></div>
            <div class="text-red-500" id="card-error"></div>
            <input type="hidden" name="payment_method">
            <button class="bg-blue-500 px-4 py-2 text-white rounded-xl" id="card-button">Payer</button>
        </form>
        @endif
    @endif
@endsection
