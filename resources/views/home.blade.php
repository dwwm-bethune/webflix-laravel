<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
</head>
<body>
    <h1>Coucou {{ $name }}</h1>
    {!! $html !!}

    <ul>
    @foreach ($cars as $car)
        <li>{{ $car }}</li>
    @endforeach
    </ul>
</body>
</html>
