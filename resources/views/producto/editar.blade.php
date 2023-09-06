<x-app-layout>
    <section class="row py-4 bg-body-tertiary">
        <h2 class="text-success">Editar Producto</h2>
        <hr class="my-4 ">

        <!-- Formulario de registro de producto ---->
        <form method="POST" action="{{ route('productos.update', $producto->id) }}" role="form"
            enctype="multipart/form-data">
            @csrf
            @method('patch')

            <p class="text-secondary">Información del Producto: {{ $producto->nombre }}</p>

            <!-- Nombre del producto ---->
            <div class="row mb-3">
                <x-input-label for="nombre" value="Nombre" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <x-text-input id="nombre" type="text" name="nombre" :value="old('nombre', $producto->nombre)" required autofocus
                        minlength='5' maxlength="45" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
            </div>

            <!-- Tipo de producto ---->
            <div class="row mb-3">
                <x-input-label for="tipo_producto_id" value="Tipo de Producto"
                    class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <select class="form-select" name="tipo_producto_id" id="tipo_producto_id" required>
                        <option value="0" disabled>Seleccione un tipo de producto</option>
                        @foreach ($tiposProductos as $id => $tipo)
                            <option value="{{ $id }}" @if ($producto->tipo_producto_id == $id) selected @endif>
                                {{ $tipo }}</option>
                        @endforeach

                    </select>
                    <x-input-error :messages="$errors->get('tipo_producto_id')" class="mt-2" />
                </div>
            </div>

            <!-- Precio y Stock del producto ---->
            <div class="row mb-3 align-items-center">
                <div class="col-8">
                    <div class="row align-items-center">
                        <x-input-label for="precio_unitario" value="Precio Unitario"
                            class="col-sm-3 col-form-label pe-0 fw-semibold" />
                        <div class="col-sm-9">
                            <x-text-input id="precio_unitario" type="number" name="precio_unitario" :value="old('precio_unitario', $producto->precio_unitario)"
                                required autofocus min="0" step="0.01" />
                            <x-input-error :messages="$errors->get('precio_unitario')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <x-input-label for="stock" value="Stock"
                            class="col-sm-2 col-form-label pe-0 fw-semibold text-md-end" />
                        <div class="col-sm-10">
                            <x-text-input id="stock" type="number" name="stock" :value="old('stock', $producto->stock)" required
                                autofocus min="0" step="1" />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proveedor del producto ---->
            <div class="row mb-3">
                <x-input-label for="proveedor_id" value="Proveedor" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <select class="form-select" name="proveedor_id" id="proveedor_id" required>
                        <option value="0" disabled>Seleccione un proveedor</option>
                        @foreach ($proveedores as $id => $proveedor)
                            <option value="{{ $id }}" @if ($producto->proveedor_id == $id) selected @endif>
                                {{ $proveedor }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('proveedor_id')" class="mt-2" />
                </div>
            </div>

            <!-- Descrición del producto ---->
            <div class="row mb-3">
                <x-input-label for="descripcion" value="Descripción" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                <div class="col-sm-10">
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>
            </div>


            <!-- Botones ---->
            <div class="d-flex justify-content-evenly">
                <a href="{{ route('productos.index') }}" class="btn btn-danger"><i class="bi bi-x-square"></i>
                    Cancelar</a>

                <x-btn-exito><i class="bi bi-arrow-up-square"></i></i> Actualizar </x-btn-exito>
            </div>

        </form>
    </section>
</x-app-layout>
