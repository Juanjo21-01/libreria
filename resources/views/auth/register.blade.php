<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h1 class="mb-3 fw-normal text-success">Registrarse</h1>

        <!-- Name -->
        <div class="form-floating">
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" placeholder="nombre" />
            <x-input-label for="name" :value="__('Nombre')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-floating">
            <x-text-input id="email" type="email" name="email" :value="old('email')" required
                autocomplete="username" placeholder="nombre@ejemplo.com" />
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-floating">
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                placeholder="password" />
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-floating">
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="password" />
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="my-3">
            <a class="text-decoration-none" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-btn-exito class="ms-4">
                {{ __('Registrarse') }}
            </x-btn-exito>
        </div>
    </form>
</x-guest-layout>
