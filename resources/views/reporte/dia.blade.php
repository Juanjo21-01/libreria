<x-app-layout>
    <h1 class="text-primary my-4">Ventas del día</h1>

    <!-- informacion ---->
    <section class="row align-items-center justify-content-sm-between justify-content-center g-3 mb-4 text-center">
        <div class="col-auto">
            <h6>Total de ventas:</h6>
            <p class="form-control text-danger fw-bold">
                {{ $ventas->count() }}
            </p>
        </div>
        <div class="col-auto ">
            <h6>Total ingresado:</h6>
            <p class="form-control text-success fw-bold">
                Q. {{ number_format($total, 2) }}
            </p>
        </div>
        <div class="col-auto">
            <h6>Fecha:</h6>
            <p class="form-control text-primary fw-bold">
                {{ date('d-m-Y') }}
            </p>
        </div>
    </section>

    <!-- tabla de ventas ---->
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
