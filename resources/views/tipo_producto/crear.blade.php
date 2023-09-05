<x-app-layout>
    <section class="row py-4 bg-body-tertiary">
        <h2 class="text-success">Agregar Tipo de Producto</h2>
        <hr class="my-4 ">

        <!-- Formulario de registro de Tipo de Producto ---->
        <form method="POST" action="{{ route('tipos-productos.store') }}" role="form" enctype="multipart/form-data">
            @csrf

            <!-- Nombre del Tipo de Producto ---->
            <div class="row mb-3">
                <x-input-label for="nombre" value="Nombre" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <x-text-input id="nombre" type="text" name="nombre" :value="old('nombre')" required autofocus
                        minlength='5' maxlength="45" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
            </div>

            <!-- Descripcion del Tipo de Producto ---->
            <div class="row mb-3">
                <x-input-label for="descripcion" value="Descripcion" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <x-text-input id="descripcion" type="text" name="descripcion" :value="old('descripcion')" required
                        autofocus minlength='5' maxlength="45" />
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>
            </div>



            <!-- Botones ---->
            <div class="d-flex justify-content-evenly">
                <a href="{{ route('tipos-productos.index') }}" class="btn btn-danger"><i class="bi bi-x-square"></i>
                    Cancelar</a>

                <x-btn-exito><i class="bi bi-arrow-up-square"></i></i> Registrar </x-btn-exito>
            </div>

        </form>
    </section>
</x-app-layout>
