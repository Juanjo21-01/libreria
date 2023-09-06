<x-app-layout>
    <section class="row align-items-center justify-content-between g-3 my-4">
        <div class="col-auto">
            <h2 class="text-primary-emphasis mb-0">Detalles del Producto</h2>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center">
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-outline-success me-3"> <i
                        class="bi bi-pencil-square"></i> Editar</a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                    data-bs-target="#eliminar-producto-{{ $producto->id }}">
                    <i class="bi bi-trash3-fill"></i> Eliminar producto
                </button>
                <!-- Modal -->
                <div class="modal fade" id="eliminar-producto-{{ $producto->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form method="post" action="{{ route('productos.destroy', $producto->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">
                                        ¿Está seguro de que desea eliminar al producto:
                                        {{ $producto->nombre }}?
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-danger-emphasis">
                                        {{ __('Una vez que se elimine al producto, todos sus recursos y datos se eliminarán permanentemente. ') }}
                                    </p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Nombre: </b>
                                            {{ $producto->nombre }}</li>
                                        <li class="list-group-item"><b>Tipo: </b>
                                            @foreach ($tiposProductos as $id => $tipo)
                                                @if ($producto->tipo_producto_id == $id)
                                                    {{ $tipo }}
                                                @endif
                                            @endforeach
                                        </li>
                                        <li class="list-group-item"><b>Precio: </b>
                                            {{ $producto->precio_unitario }}</li>
                                        <li class="list-group-item"><b>Cantidad: </b>
                                            {{ $producto->stock }}</li>
                                        <li class="list-group-item"><b>Proveedor: </b>
                                            @foreach ($proveedores as $id => $proveedor)
                                                @if ($producto->proveedor_id == $id)
                                                    {{ $proveedor }}
                                                @endif
                                            @endforeach
                                        </li>
                                        <li class="list-group-item"><b>Fecha de creación: </b>
                                            {{ $producto->created_at }}</li>
                                    </ul>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger bg-gradient">
                                        {{ __('Eliminar producto') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- informacion del producto -->
    <section class="row mb-2">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-body pb-3">
                    <div class="row mb-3 align-items-center">
                        <div class="col-12 col-lg-6 text-center">
                            <h3>{{ $producto->nombre }}</h3>
                            <p>Se Creó en {{ $producto->created_at->toFormattedDateString() }}</p>

                            <div class="row py-2 ">
                                <p>Proveedor: <b>
                                        @foreach ($proveedores as $id => $proveedor)
                                            @if ($producto->proveedor_id == $id)
                                                {{ $proveedor }}
                                            @endif
                                        @endforeach
                                    </b>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 border-start border-3">
                            <div class="py-2">
                                <h4>Tipo de producto</h4>
                                <p class="form-control">
                                    @foreach ($tiposProductos as $id => $tipo)
                                        @if ($producto->tipo_producto_id == $id)
                                            {{ $tipo }}
                                        @endif
                                    @endforeach
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="py-1">
                                        <h4>Precio unitario</h4>
                                        <p class="form-control">
                                            {{ $producto->precio_unitario }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="py-1">
                                        <h4>Stock</h4>
                                        <p
                                            class="form-control text-white @if ($producto->stock > 5) bg-success @else bg-danger @endif">
                                            {{ $producto->stock }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2">
                                <h4>Descripción</h4>
                                <textarea class="form-control" disabled>
                                    {{ $producto->descripcion }}
                                </textarea>
                            </div>

                            <div class="py-2">
                                <h4>Última
                                    fecha de actualización</h4>
                                <p class="form-control">
                                    {{ $producto->updated_at->toFormattedDateString() }} a las
                                    {{ date('H : i : s', strtotime($producto->updated_at)) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center py-3">
                    <a href="{{ route('productos.index') }}" class="btn btn-primary bg-gradient">
                        <i class="bi bi-arrow-left-square"></i></i> Regresar</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
