<x-app-layout>

    <section class="row align-items-center justify-content-between g-3 my-4">
        <div class="col-auto">
            <h2 class="text-primary-emphasis mb-0">Detalles del Proveedor</h2>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center">
                <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-outline-success me-3"> <i
                        class="bi bi-pencil-square"></i> Editar</a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                    data-bs-target="#eliminar-proveedor-{{ $proveedor->id }}">
                    <i class="bi bi-trash3-fill"></i> Eliminar proveedor
                </button>
                <!-- Modal -->
                <div class="modal fade" id="eliminar-proveedor-{{ $proveedor->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            </div>
        </div>
    </section>

    <!-- informacion del proveedor -->
    <section class="row mb-2">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-body pb-3">
                    <div class="row mb-3 align-items-center">
                        <div class="col-12 col-lg-6 text-center">
                            <h3>{{ $proveedor->nombre }}</h3>
                            <p>Se Unió en {{ $proveedor->created_at->toFormattedDateString() }}</p>
                        </div>
                        <div class="col-12 col-lg-6 border-start border-3">
                            <div class="py-2">
                                <h4>Nit</h4>
                                <p class="form-control">{{ $proveedor->nit }}</p>
                            </div>
                            <div class="py-2">
                                <h4>Direccion</h4>
                                <p class="form-control"> {{ $proveedor->direccion }}</p>
                            </div>
                            <div class="py-2">
                                <h4>Teléfono</h4>
                                <p class="form-control ">
                                    {{ $proveedor->telefono }}</p>
                            </div>
                            <div class="py-2">
                                <h4>Última
                                    fecha de actualización</h4>
                                <p class="form-control">
                                    {{ $proveedor->updated_at->toFormattedDateString() }} a las
                                    {{ date('H : i : s', strtotime($proveedor->updated_at)) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center py-3">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-primary bg-gradient">
                        <i class="bi bi-arrow-left-square"></i></i> Regresar</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
