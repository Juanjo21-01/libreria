<x-guest-layout>
    <div class="">
        {{ __('Esta es un área segura de la aplicación. Por favor confirme su contraseña antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="form-floating">
            <x-text-input id="password" class="" type="password" name="password" required
                autocomplete="current-password" placeholder="password" />
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="m-3 text-center">
            <x-btn-exito>
                {{ __('Confirmar') }}
            </x-btn-exito>
        </div>
    </form>
</x-guest-layout>
