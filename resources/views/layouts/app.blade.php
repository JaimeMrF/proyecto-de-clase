<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MiTienda') — Todo lo que necesitas</title>
    <link href="https://fonts.googleapis.com/css2?family=Amazon+Ember:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>


<!-- ═══ CONTENT ═══ -->
<main>
    @yield('content')
</main>


</body>
</html>