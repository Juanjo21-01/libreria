<div class="card-header">
    <h2 class="text-success fw-medium">
        {{ __('Información del Perfil') }}
    </h2>

    <p class="card-text">
        {{ __('Actualiza la información del perfil y la dirección de correo electrónico de tu cuenta.') }}
    </p>

</div>
<div class="card-body">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group mb-2">
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required 
                placeholder="{{ old('name', $user->name) }}" autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group mb-2">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required
                placeholder="{{ old('email', $user->email) }}" autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            {{-- Si es correo no esta verificado --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-danger">
                        {{ __('Su dirección de correo electrónico no está verificada.') }}

                        <button form="send-verification" class="btn btn-secondary">
                            {{ __('Click para re-enviar email de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex flex-column align-items-center">
            <x-btn-exito>{{ __('Actualizar') }}</x-btn-exito>

            @if (session('status') === 'profile-updated')
                <p class="mt-3 text-success" id="mensaje-guardar">{{ __('Guardado...') }}</p>
                <script>
                    setTimeout(() => {
                        document.getElementById('mensaje-guardar').remove();
                    }, 3000);
                </script>
            @endif
        </div>
    </form>
</div>
