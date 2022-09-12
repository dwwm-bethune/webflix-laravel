<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @section('title') Webflix @show
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    Menu ?

    @yield('content')

    Footer ?
</body>
</html>
