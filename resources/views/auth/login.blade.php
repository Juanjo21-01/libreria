<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="mb-3 fw-normal text-success">Iniciar Sesión</h1>

        <!-- Email Address -->
        <div class="form-floating">
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username" placeholder="nombre@ejemplo.com" />
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-floating">
            <x-text-input id="password" type="password" name="password" required placeholder="password"
                autocomplete="current-password" />
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-check text-start my-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">
                {{ __('Recuérdame') }}
            </label>
        </div>

        @if (Route::has('password.request'))
            <a class="text-decoration-none" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tú Contraseña?') }}
            </a>
        @endif
        <x-btn-exito class="ms-3">
            {{ __('Acceder') }}
        </x-btn-exito>
    </form>
</x-guest-layout>
