<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Coucou {{ $name }}</h1>
    {!! $html !!}

    <ul>
    @foreach ($cars as $car)
        <li>{{ $car }}</li>
    @endforeach
    </ul>

    <a href="/a-propos">A propos</a>
</body>
</html>
