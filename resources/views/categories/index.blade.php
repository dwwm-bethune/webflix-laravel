@extends('layouts.base')

@section('title')
    Catégories - @parent
@endsection

@section('content')
    <a href="{{ route('categories.create') }}">Créer une catégorie</a>

    @if (session('status'))
        <div class="bg-emerald-600 px-4 py-2 text-white">
            {{ session('status') }}
        </div>
    @endif

    <div>
        @foreach ($categories as $category)
            <div>
                <h2>
                    {{ $category->name }}
                    (id {{ $category->id }})
                </h2>

                <a href="{{ route('categories.show', $category->id) }}">Voir</a>
                <a href="{{ route('categories.edit', $category->id) }}">Modifier</a>
                <form action="{{ route('categories.delete', $category->id) }}" method="post" class="inline">
                    @csrf
                    @method('delete')
                    <button>Supprimer</button>
                </form>
            </div>
        @endforeach
    </div>

    {{ $categories->links() }}
@endsection
