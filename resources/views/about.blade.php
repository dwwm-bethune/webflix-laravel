<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A propos - Laravel</title>
</head>
<body>
    <h1>A propos</h1>
    <ul>
        @foreach ($team as $user)
            <li>
                {{ $user['name'].' - '.$user['job'] }}
            </li>
        @endforeach

        {{ $team[0]['name'] }}
    </ul>
</body>
</html>
