<x-app-layout>
    <!-- actualizar informacion -->
    <div class="mt-3 shadow-lg card border-0">
        @include('profile.partials.update-profile-information-form')
    </div>

    <!-- actualizar contraseña -->
    <div class="mt-3 shadow-lg card border-0">
        @include('profile.partials.update-password-form')
    </div>

    <!-- eliminar cuenta -->
    <div class="my-3 shadow-lg card border-0">
        @include('profile.partials.delete-user-form')
    </div>
</x-app-layout>
