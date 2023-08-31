<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Libreria</title>

    <!-- Estilos -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="container bg-body-tertiary">

    <h1 class="text-center m-3">Bienvenido a la Libreria</h1>

    {{-- botones de autenticacion --}}
    <div class="d-flex justify-content-center m-3 p-3 align-items-center flex-sm-row flex-column">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary bg-gradient">Panel
                    de Control</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-success m-1 bg-gradient">Iniciar
                    Sesión</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary m-1 bg-gradient ">Registrarse</a>
                @endif
            @endauth
        @endif
    </div>

    {{-- imagenes --}}
    <div id="myCarousel" class="carousel slide pointer-event" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="bg-danger"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"
                class="bg-danger"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"
                class="active bg-danger" aria-current="true"></button>
        </div>

        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <img class="bd-placeholder-img" width="70%" height="70%" src="{{ asset('img/libreria.jpg') }}"
                    aria-hidden="true" focusable="false">
            </div>
            <div class="carousel-item active">
                <img class="bd-placeholder-img" width="70%" height="70%" src="{{ asset('img/libreria.jpg') }}"
                    aria-hidden="true" focusable="false">
            </div>
            <div class="carousel-item active">
                <img class="bd-placeholder-img" width="70%" height="70%" src="{{ asset('img/libreria.jpg') }}"
                    aria-hidden="true" focusable="false">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-danger" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-danger" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</body>

</html>
