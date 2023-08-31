<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Estilos -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Encabezado -->
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-4 text-white " href="{{ route('dashboard') }}">Libreria</a>
        {{-- <button class="nav-link px-3 text-white d-md-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        </button> --}}
    </header>


    <!-- Contenido de la página -->
    <div class="container-fluid">
        <div class="row">
            <!-- navegacion -->
            @include('layouts.navigation')

            <!-- informacion -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
