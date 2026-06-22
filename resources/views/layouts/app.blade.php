<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    {{-- CSS global --}}
    @vite(['resources/css/app.css'])

    {{-- CSS spécifique à la page --}}
    @stack('styles')

    <title>@yield('title')</title>
</head>
<body>

    @yield('content')

</body>
</html>