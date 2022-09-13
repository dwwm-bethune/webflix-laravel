<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @section('title') {{ config('app.name') }} @show
    </title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 font-[Nunito]">
    <header class="shadow bg-white">
        <div class="flex items-center max-w-7xl mx-auto px-3">
            <h1 class="text-xl font-bold mr-4">{{ config('app.name') }}</h1>
            <ul class="flex">
                <li><a class="inline-block py-4 px-2" href="{{ route('home') }}">Accueil</a></li>
                <li><a class="inline-block py-4 px-2" href="{{ route('categories') }}">Catégories</a></li>
                <li><a class="inline-block py-4 px-2" href="{{ route('about') }}">A propos</a></li>
            </ul>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-3 py-6">
        @yield('content')
    </div>

    <footer class="text-center">
        Copyright &copy; {{ now()->year }} - {{ config('app.name') }}
    </footer>
</body>
</html>
