<x-app-layout>
    <h1 class="text-primary my-4">Proveedores</h1>

    <!-- agregar nuevo proveedor ---->
    <section class="row align-items-center justify-content-md-end g-3 mb-4">
        <div class="col-auto">
            <div class="d-flex  align-items-center">
                <a href="{{ route('proveedores.create') }}" class="btn btn-success bg-gradient"> <i
                        class="bi bi-plus-lg me-2"></i>Agregar
                    Proveedor</a>
            </div>
        </div>
    </section>

    <!-- Tabla ---->
    <section class="row bg-body-tertiary">
        <div class="table-responsive scrollbar py-2">
            <table class="table table-sm table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-1 shadow text-center">ID</th>
                        <th class="col-2 shadow">Nombre</th>
                        <th class="col-1 shadow">Nit</th>
                        <th class="col-3 shadow">Dirección</th>
                        <th class="col-1 shadow">Telefono</th>
                        <th class="col-2 shadow text-center">Estado</th>
                        <th class="col-2 shadow text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td class="col-1 text-center align-middle">{{ $proveedor->id }}</td>
                            <td class="col-2 align-middle">{{ $proveedor->nombre }}</td>
                            <td class="col-1 align-middle">{{ $proveedor->nit }}</td>
                            <td class="col-3 align-middle">{{ $proveedor->direccion }}</td>
                            <td class="col-2 align-middle">{{ $proveedor->telefono }}</td>
                            <td class="col-1 text-center align-middle">
                                @if ($proveedor->estado == 'activo')
                                    <a class="btn btn-success btn-sm bg-gradient"
                                        href="{{ route('proveedores.cambiar-estado', $proveedor->id) }}"><i
                                            class="bi bi-check-circle"></i>
                                        ACTIVO</a>
                                @else
                                    <a class="btn btn-danger btn-sm bg-gradient"
                                        href="{{ route('proveedores.cambiar-estado', $proveedor->id) }}"><i
                                            class="bi bi-x-circle"></i>
                                        INACTIVO</a>
                                @endif

                            </td>
                            <td class="col-2 align-middle">
                                <div class="d-flex justify-content-evenly flex-column flex-sm-row align-items-center">
                                    <a href="{{ route('proveedores.show', $proveedor->id) }}"
                                        class="btn btn-outline-primary mb-1 mb-sm-0 mx-1"><i class="bi bi-eye"></i></a>
                                    @role('Administrador')
                                        <a href="{{ route('proveedores.edit', $proveedor->id) }}"
                                            class="btn btn-outline-success mb-1 mb-sm-0"> <i
                                                class="bi bi-pencil-square"></i></a>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#eliminar-proveedor-{{ $proveedor->id }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="eliminar-proveedor-{{ $proveedor->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form method="post" action="{{ route('proveedores.destroy', $proveedor->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">
                                                ¿Está seguro de que desea eliminar al Proveedor:
                                                {{ $proveedor->nombre }}?
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-danger-emphasis">
                                                {{ __('Una vez que se elimine al proveedor, todos sus recursos y datos se eliminarán permanentemente. ') }}
                                            </p>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><b>Nombre: </b>
                                                    {{ $proveedor->nombre }}</li>
                                                <li class="list-group-item"><b>Nit: </b>
                                                    {{ $proveedor->nit }}</li>
                                                <li class="list-group-item"><b>Dirección: </b>
                                                    {{ $proveedor->direccion }}</li>
                                                <li class="list-group-item"><b>Telefono: </b>
                                                    {{ $proveedor->telefono }}</li>
                                            </ul>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger bg-gradient">
                                                {{ __('Eliminar Proveedor') }}</button>
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
