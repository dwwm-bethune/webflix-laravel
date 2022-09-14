@extends('layouts.base')

@section('title')
    Créer un film - @parent
@endsection

@section('content')
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <form method="post" class="w-1/2 mx-auto">
        @csrf

        <div class="mb-3">
            <label class="block mb-1" for="title">Titre</label>
            <input class="w-full border-gray-300 @error('title') border-red-400 @enderror" type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="synopsis">Synopsis</label>
            <textarea class="w-full border-gray-300 @error('synopsis') border-red-400 @enderror" name="synopsis" id="synopsis">{{ old('synopsis') }}</textarea>
            @error('synopsis')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="duration">Durée</label>
            <input class="w-full border-gray-300 @error('duration') border-red-400 @enderror" type="text" name="duration" id="duration" value="{{ old('duration') }}">
            @error('duration')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="youtube">Youtube</label>
            <input class="w-full border-gray-300 @error('youtube') border-red-400 @enderror" type="text" name="youtube" id="youtube" value="{{ old('youtube') }}">
            @error('youtube')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="released_at">Date de sortie</label>
            <input class="w-full border-gray-300 @error('released_at') border-red-400 @enderror" type="date" name="released_at" id="released_at" value="{{ old('released_at') }}">
            @error('released_at')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="category_id">Catégorie</label>
            <select class="w-full border-gray-300 @error('category_id') border-red-400 @enderror" name="category_id" id="category_id">
                <option value="">Aucune</option>
                @foreach ($categories as $category)
                    <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button>Ajouter</button>
    </form>
@endsection
