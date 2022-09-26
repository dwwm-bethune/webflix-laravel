@extends('layouts.base')

@section('title')
    {{ $movie->title }} - @parent
@endsection

@section('content')
    <a href="{{ route('movies') }}">Retour aux films</a>
    <div class="flex gap-8">
        <div class="w-1/2">
            @if ($movie->cover)
            <img class="rounded" src="{{ $movie->cover }}">
            @endif
        </div>
        <div class="w-1/2">
            <h1 class="text-3xl">{{ $movie->title }}</h1>
            <div class="my-3">
                {{ $movie->synopsis }}
            </div>

            <div class="font-bold text-xl">
                <p>Prix TTC: {{ $movie->price_with_tax }}</p>
                <p>Prix HT: {{ $movie->price_without_tax }}</p>
            </div>

            <form method="post" action="{{ route('cart.store', $movie->id) }}">
                @csrf
                <button class="bg-blue-500 px-4 py-2 text-white rounded-xl inline-block">Ajouter au panier</button>
            </form>

            @if (session('payment_success'))
                {{ session('payment_success') }}
            @else
                <form action="{{ route('pay') }}" method="post" id="payment-form">
                    @csrf
                    <div class="bg-white px-4 py-2 my-3" id="card-element"></div>
                    <div class="text-red-500" id="card-error"></div>
                    <input type="hidden" name="movie" value="{{ $movie->id }}">
                    <input type="hidden" name="payment_method">
                    <button class="bg-blue-500 px-4 py-2 text-white rounded-xl" id="card-button">Payer</button>
                </form>
            @endif

            @if ($movie->actors)
            <div class="mt-3">
                <h2 class="text-2xl">Casting</h2>
                <div class="flex">
                    @foreach ($movie->actors as $actor)
                        <div class="w-1/5 mr-5">
                            <a href="{{ route('actors.show', $actor) }}">
                                @if ($actor->avatar)
                                <img class="rounded" src="{{ $actor->avatar }}">
                                @endif
                                <h3>{{ $actor->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
