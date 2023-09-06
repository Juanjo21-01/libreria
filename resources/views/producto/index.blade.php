<x-app-layout>
    <h1 class="text-primary my-4">Productos</h1>

    <!-- agregar nuevo producto ---->
    <section class="row align-items-center justify-content-md-between g-3 mb-4">
        <div class="col-auto">
            <a href="{{ route('tipos-productos.index') }}" class="btn btn-secondary bg-gradient"> <i
                    class="bi bi-arrow-repeat me-2"></i>Tipos de Productos</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('productos.create') }}" class="btn btn-success bg-gradient"> <i
                    class="bi bi-plus-lg me-2"></i>Agregar
                Producto</a>
        </div>
    </section>

    <!-- Tabla ---->
    <section class="row bg-body-tertiary">
        <div class="table-responsive scrollbar py-2">
            <table class="table table-sm table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-1 shadow text-center">ID</th>
                        <th class="col-3 shadow">Nombre</th>
                        <th class="col-2 shadow">Tipo</th>
                        <th class="col-1 shadow">Precio</th>
                        <th class="col-1 shadow">Cantidad</th>
                        <th class="col-2 shadow">Proveedor</th>
                        <th class="col-2 shadow text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="col-1 text-center align-middle">{{ $producto->id }}</td>
                            <td class="col-3 align-middle">{{ $producto->nombre }}</td>
                            <td class="col-2 align-middle">
                                @foreach ($tiposProductos as $id => $tipo)
                                    @if ($producto->tipo_producto_id == $id)
                                        {{ $tipo }}
                                    @endif
                                @endforeach

                            </td>
                            <td class="col-1 align-middle">Q. {{ $producto->precio_unitario }}</td>
                            <td class="col-1 align-middle">{{ $producto->stock }}</td>
                            <td class="col-2 align-middle">
                                @foreach ($proveedores as $id => $proveedor)
                                    @if ($producto->proveedor_id == $id)
                                        {{ $proveedor }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="col-2 align-middle">
                                <div class="d-flex justify-content-evenly flex-column flex-sm-row align-items-center">
                                    <a href="{{ route('productos.edit', $producto->id) }}"
                                        class="btn btn-outline-success mb-1 mb-sm-0"> <i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('productos.show', $producto->id) }}"
                                        class="btn btn-outline-primary mb-1 mb-sm-0 mx-1"><i class="bi bi-eye"></i></a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#eliminar-producto-{{ $producto->id }}">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="eliminar-producto-{{ $producto->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
