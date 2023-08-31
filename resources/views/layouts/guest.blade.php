<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Autenticación - Libreria</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex align-items-center py-4 vh-100">

    <main class="w-100 m-auto" style="max-width: 330px; padding:1rem;">

        <a href="/" class="d-inline-flex flex-column text-decoration-none">
            <x-logo-libreria class="align-self-center" width="60px" />
        </a>

        {{ $slot }}
    </main>
</body>

</html>
