@extends('layouts.base')

@section('title')
    Les acteurs - @parent
@endsection

@section('content')
    <a href="{{ route('actors.create') }}" class="bg-blue-500 py-2 px-3 text-white rounded-lg hover:bg-blue-400 duration-300">Créer un acteur</a>

    <div class="flex flex-wrap -mx-3 py-8">
        @foreach ($actors as $actor)
            <div class="w-1/5 mb-6">
                <div class="bg-white mx-3 rounded h-full shadow">
                    @if ($actor->avatar)
                    <img class="rounded-t" src="{{ $actor->avatar }}">
                    @endif
                    <div class="p-3">
                        <h2 class="mb-4 underline">
                            <a href="{{ route('actors.show', $actor) }}">
                                {{ $actor->name }}
                            </a>
                        </h2>
                        <p class="mb-4">
                            @if ($actor->birthday)
                            {{ $actor->birthday->translatedFormat('d F Y') }}
                            @endif
                        </p>

                        <a class="bg-gray-500 py-2 px-3 text-white rounded-lg hover:bg-gray-400 duration-300 inline-block" href="{{ route('actors.edit', $actor->id) }}">Modifier</a>
                        <form action="{{ route('actors.destroy', $actor->id) }}" method="post" class="inline">
                            @csrf
                            @method('delete')
                            <button class="bg-red-500 py-2 px-3 text-white rounded-lg hover:bg-red-400 duration-300 inline-block">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
