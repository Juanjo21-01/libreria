<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-floating">
            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus
                autocomplete="username" placeholder="example@example.com" />
            <x-input-label for="email" :value="__('Correo Electronico')" />
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
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="m-3 text-center">
            <x-btn-exito>
                {{ __('Resetear Contraseña') }}
            </x-btn-exito>
        </div>
    </form>
</x-guest-layout>
