@extends('layouts.base')

@section('title')
    Catégories - @parent
@endsection

@section('content')
    <div>
        @foreach ($categories as $category)
            <div>
                <h2>
                    {{ $category->name }}
                    (id {{ $category->id }})
                </h2>

                <a href="{{ route('categories.show', $category->id) }}">Voir</a>
            </div>
        @endforeach
    </div>
@endsection
