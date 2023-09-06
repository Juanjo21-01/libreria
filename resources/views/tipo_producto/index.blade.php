<x-app-layout>
    <h1 class="text-primary my-4">Tipos de Productos</h1>

    <!-- agregar nuevo tipoProducto ---->
    <section class="row align-items-center justify-content-md-between g-3 mb-4">
        <div class="col-auto">
            <a href="{{ route('productos.index') }}" class="btn btn-secondary bg-gradient"> <i
                    class="bi bi-arrow-repeat me-2"></i>Productos</a>
        </div>
        <div class="col-auto">
            <div class="d-flex  align-items-center">
                <a href="{{ route('tipos-productos.create') }}" class="btn btn-success bg-gradient"> <i
                        class="bi bi-plus-lg me-2"></i>Agregar
                </a>
            </div>
        </div>
    </section>

    <!-- Tabla ---->
    <section class="row bg-body-tertiary">
        <div class="table-responsive scrollbar py-2">
            <table class="table table-sm table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-2 shadow text-center">ID</th>
                        <th class="col-4 shadow">Nombre</th>
                        <th class="col-4 shadow">Descripcion</th>
                        <th class="col-2 shadow text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tiposProductos as $tipoProducto)
                        <tr>
                            <td class="col-2 text-center align-middle">{{ $tipoProducto->id }}</td>
                            <td class="col-4 align-middle">{{ $tipoProducto->nombre }}</td>
                            <td class="col-4 align-middle">{{ $tipoProducto->descripcion }}</td>
                            <td class="col-2 align-middle">
                                <div class="d-flex justify-content-evenly flex-column flex-sm-row align-items-center">
                                    <a href="{{ route('tipos-productos.edit', $tipoProducto->id) }}"
                                        class="btn btn-outline-success mb-1 mb-sm-0"> <i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('tipos-productos.show', $tipoProducto->id) }}"
                                        class="btn btn-outline-primary mb-1 mb-sm-0 mx-1"><i class="bi bi-eye"></i></a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#eliminar-tipoProducto-{{ $tipoProducto->id }}">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="eliminar-tipoProducto-{{ $tipoProducto->id }}"
                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form method="post" action="{{ route('tipos-productos.destroy', $tipoProducto->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">
                                                ¿Está seguro de que desea eliminar al Tipo de Producto:
                                                {{ $tipoProducto->nombre }}?
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-danger-emphasis">
                                                {{ __('Una vez que se elimine al tipo, todos sus recursos y datos se eliminarán permanentemente. ') }}
                                            </p>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><b>Nombre: </b>
                                                    {{ $tipoProducto->nombre }}</li>
                                                <li class="list-group-item"><b>Descripción: </b>
                                                    {{ $tipoProducto->descripcion }}</li>
                                            </ul>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger bg-gradient">
                                                {{ __('Eliminar Tipo') }}</button>
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
