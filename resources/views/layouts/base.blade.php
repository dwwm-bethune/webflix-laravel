<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @section('title') {{ config('app.name') }} @show
    </title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 font-[Nunito]">
    <header class="shadow bg-white">
        <div class="flex items-center max-w-7xl mx-auto px-3">
            <h1 class="text-xl font-bold mr-4">{{ config('app.name') }}</h1>
            <div class="flex justify-between items-center flex-grow">
                <ul class="flex">
                    <li><a class="inline-block py-4 px-2" href="{{ route('home') }}">Accueil</a></li>
                    <li><a class="inline-block py-4 px-2" href="{{ route('categories') }}">Catégories</a></li>
                    <li><a class="inline-block py-4 px-2" href="{{ route('movies') }}">Films</a></li>
                    <li><a class="inline-block py-4 px-2" href="{{ route('actors.index') }}">Acteurs</a></li>
                    <li><a class="inline-block py-4 px-2" href="{{ route('about') }}">A propos</a></li>
                </ul>

                <div>
                    @auth
                    {{ Auth::user()->name }}
                    <a href="{{ route('logout') }}">Déconnexion</a>
                    @else
                    <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            </div>
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
