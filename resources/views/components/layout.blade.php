@props(['title' => 'Intuitivas'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ time() }}">
</head>
<body class="d-flex flex-column min-vh-100">
    
    <!-- Navbar -->
    <x-navbar />

    <!-- Contenido -->
    <main class="flex-fill">
        <div class="container mt-4 pb-5">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <x-footer />

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>