<x-app-layout>
    <section class="row py-4 bg-body-tertiary">
        <h2 class="text-success">Agregar Proveedor</h2>
        <hr class="my-4 ">

        <!-- Formulario de registro de proveedor ---->
        <form method="POST" action="{{ route('proveedores.store') }}" role="form" enctype="multipart/form-data">
            @csrf

            <!-- Nombre del proveedor ---->
            <div class="row mb-3">
                <x-input-label for="nombre" value="Nombre" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <x-text-input id="nombre" type="text" name="nombre" :value="old('nombre')" required autofocus
                        minlength='5' maxlength="45" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
            </div>

            <!-- Nit del proveedor ---->
            <div class="row mb-3">
                <x-input-label for="nit" value="Nit" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <x-text-input id="nit" type="text" name="nit" :value="old('nit')" required autofocus
                        minlength='8' maxlength="15" />
                    <x-input-error :messages="$errors->get('nit')" class="mt-2" />
                </div>
            </div>

            <!-- Direccion del proveedor ---->
            <div class="row mb-3">
                <x-input-label for="direccion" value="Direccion" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <x-text-input id="direccion" type="text" name="direccion" :value="old('direccion')" required autofocus
                        minlength='5' maxlength="100" />
                    <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                </div>
            </div>

            <!-- Telefono del proveedor ---->
            <div class="row mb-3">
                <x-input-label for="telefono" value="Telefono" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <x-text-input id="telefono" type="text" name="telefono" :value="old('telefono')" required autofocus
                        minlength='5' maxlength="15" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                </div>
            </div>

            <!-- Botones ---->
            <div class="d-flex justify-content-evenly">
                <a href="{{ route('proveedores.index') }}" class="btn btn-danger"><i class="bi bi-x-square"></i>
                    Cancelar</a>

                <x-btn-exito><i class="bi bi-arrow-up-square"></i></i> Registrar </x-btn-exito>
            </div>

        </form>
    </section>
</x-app-layout>
