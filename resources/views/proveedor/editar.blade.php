<x-app-layout>
    @role('Administrador')
        <section class="row py-4 bg-body-tertiary">
            <h2 class="text-success">Editar Proveedor</h2>
            <hr class="my-4 ">

            <!-- Formulario de registro de proveedor ---->
            <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}" role="form"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                <p class="text-secondary">Información del Proveedor: {{ $proveedor->nombre }}</p>

                <!-- Nombre del proveedor ---->
                <div class="row mb-3">
                    <x-input-label for="nombre" value="Nombre" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                    <div class="col-sm-10">
                        <x-text-input id="nombre" type="text" name="nombre" :value="old('nombre', $proveedor->nombre)" required autofocus
                            minlength='5' maxlength="45" />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                </div>

                <!-- Nit del proveedor ---->
                <div class="row mb-3">
                    <x-input-label for="nit" value="Nit" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                    <div class="col-sm-10">
                        <x-text-input id="nit" type="text" name="nit" :value="old('nit', $proveedor->nit)" required autofocus
                            minlength='8' maxlength="15" />
                        <x-input-error :messages="$errors->get('nit')" class="mt-2" />
                    </div>
                </div>

                <!-- Direccion del proveedor ---->
                <div class="row mb-3">
                    <x-input-label for="direccion" value="Direccion" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                    <div class="col-sm-10">
                        <x-text-input id="direccion" type="text" name="direccion" :value="old('direccion', $proveedor->direccion)" required autofocus
                            minlength='5' maxlength="100" />
                        <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                    </div>
                </div>

                <!-- Telefono del proveedor ---->
                <div class="row mb-3">
                    <x-input-label for="telefono" value="Telefono" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                    <div class="col-sm-10">
                        <x-text-input id="telefono" type="text" name="telefono" :value="old('telefono', $proveedor->telefono)" required autofocus
                            minlength='5' maxlength="15" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>
                </div>

                <!-- Botones ---->
                <div class="d-flex justify-content-evenly">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-danger"><i class="bi bi-x-square"></i>
                        Cancelar</a>

                    <x-btn-exito><i class="bi bi-arrow-down-square"></i></i> Actualizar </x-btn-exito>
                </div>

            </form>
        </section>
    @endrole

    @role('Vendedor')
        <seciont class="row">
            <div class="col-12 text-center">
                <h2 class="text-success m-5 p-5">No estas autorizado para editar el registro</h2>
                <a class="btn btn-primary m-5" href="{{ route('proveedores.index') }}">Regresar</a>
            </div>
        </seciont>
    @endrole
</x-app-layout>
