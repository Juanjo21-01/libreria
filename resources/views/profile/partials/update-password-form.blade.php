<div class="card-header">
    <h2 class="text-success fw-medium">
        {{ __('Actualizar Contraseña') }}
    </h2>

    <p class="card-text">
        {{ __('Asegúrese de que su cuenta esté usando una contraseña larga y aleatoria para mantenerse segura.') }}
    </p>

</div>
<div class="card-body">
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group mb-2">
            <x-input-label for="current_password" :value="__('Contraseña Actual')" />
            <x-text-input id="current_password" name="current_password" type="password"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-group mb-2">
            <x-input-label for="password" :value="__('Nueva Contraseña')" />
            <x-text-input id="password" name="password" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="form-group mb-2">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex flex-column align-items-center">
            <x-btn-exito>{{ __('Guardar') }}</x-btn-exito>

            @if (session('status') === 'password-updated')
                <p class="mt-3 text-success" id="mensaje-actualizar">{{ __('Actualizado..') }}</p>
                <script>
                    setTimeout(() => {
                        document.getElementById('mensaje-actualizar').remove();
                    }, 3000);
                </script>
            @endif
        </div>
    </form>
</div>
