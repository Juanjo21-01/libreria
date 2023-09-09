<x-app-layout>
    <h1 class="text-primary my-4">Ventas</h1>

    <!-- agregar nueva venta ---->
    <section class="row align-items-center justify-content-md-end g-3 mb-4">
        <div class="col-auto">
            <div class="d-flex  align-items-center">
                <a href="{{ route('ventas.create') }}" class="btn btn-success bg-gradient"> <i
                        class="bi bi-plus-lg me-2"></i>Agregar
                    Venta</a>
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
                        <th class="col-3 shadow">Fecha de la Venta</th>
                        <th class="col-2 shadow">Impuesto</th>
                        <th class="col-2 shadow">Total</th>
                        <th class="col-3 shadow text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td class="col-2 text-center align-middle">{{ $venta->id }}</td>
                            <td class="col-3 align-middle">{{ $venta->fecha_venta }}</td>
                            <td class="col-2 align-middle">{{ $venta->impuesto * 100 }}%</td>
                            <td class="col-2 align-middle">{{ $venta->total }}</td>
                            <td class="col-3 align-middle">
                                <div class="d-flex justify-content-evenly flex-column flex-sm-row align-items-center">
                                    <a href="{{ route('ventas.show', $venta->id) }}"
                                        class="btn btn-outline-primary mb-1 mb-sm-0 mx-1"><i class="bi bi-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
