<x-guest-layout>
    <div class="m-2">
        {{ __('Olvidaste tu contraseña? No hay Problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos por correo electrónico un enlace de restablecimiento de contraseña que le permitirá elegir una nueva contraseña.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-floating">
            <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus
                placeholder="email@example.com" />
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="m-3 text-center">
            <x-btn-exito>
                {{ __('Reestablecer') }}
            </x-btn-exito>
        </div>
    </form>
</x-guest-layout>
