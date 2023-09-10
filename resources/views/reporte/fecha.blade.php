<x-app-layout>
    <h1 class="text-primary my-4">Ventas por fechas</h1>

    <!-- informacion ---->
    <section class="row justify-content-sm-between justify-content-center align-items-center g-2 mb-2 text-center">
        <div class="col-auto">
            <h6>Total de ventas:</h6>
            <p class="form-control text-danger fw-bold">
                {{ $ventas->count() }}
            </p>
        </div>
        <div class="col-auto">
            <h6>Total ingresado:</h6>
            <p class="form-control text-success fw-bold">
                Q. {{ number_format($total, 2) }}
            </p>
        </div>

        <div class="col-auto">
            <form action="{{ route('reporte.consulta') }}" method="POST">
                @csrf
                <div class="input-group">
                    <span class="input-group-text">Desde</span>
                    <input type="date" class="form-control" name="desde"
                        @if (isset($Desde)) value="{{ $Desde }}" @endif>
                </div>
        </div>
        <div class="col-auto">
            <div class="input-group">
                <span class="input-group-text">Hasta</span>
                <input type="date" class="form-control" name="hasta" required
                    @if (isset($Hasta)) value="{{ $Hasta }}" @endif>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
            </form>
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
