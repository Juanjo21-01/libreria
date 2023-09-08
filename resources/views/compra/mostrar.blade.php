<x-app-layout>
    <section class="row align-items-center justify-content-between g-3 my-4">
        <div class="col-auto">
            <h2 class="text-primary-emphasis mb-0">Detalles de la Compra</h2>
        </div>
    </section>

    <!-- informacion de la compra -->
    <section class="row mb-2">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto ">
                            <p class="m-0">Se compró al proveedor: @foreach ($proveedor as $id => $prov)
                                    @if ($id == $compra->proveedor_id)
                                        <a href="{{ route('proveedores.show', $compra->proveedor_id) }}">
                                            {{ Str::title($prov) }}
                                        </a>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="col-auto">
                            <p class="m-0">La compra fue registrada por: @foreach ($usuario as $id => $us)
                                    @if ($id == $compra->usuario_id)
                                        {{ Str::title($us) }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body shadow">
                    <div class="table-responsive col-md-12">
                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead class="thead">
                                <tr class="text-success">
                                    <th class="col-4 shadow">Producto</th>
                                    <th class="col-3 shadow">Cantidad</th>
                                    <th class="col-2 shadow">Q. Precio</th>
                                    <th class="col-3 shadow">Q. SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalle as $det)
                                    <tr>
                                        <td class="col-4">{{ $det->producto->nombre }}</td>
                                        <td class="col-3 text-center">{{ $det->cantidad }}

                                        </td>
                                        <td class="col-2 text-center"> {{ $det->precio }}</td>
                                        <td class="col-3 text-end">Q.
                                            {{ number_format($det->cantidad * $det->precio, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="text-end">
                                <tr>
                                    <th colspan="3" class="text-secondary">
                                        SUBTOTAL:
                                    </th>
                                    <th class="text-secondary">
                                        Q.
                                        {{ number_format($subtotal, 2) }}

                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-danger">
                                        IMPUESTO {{ $compra->impuesto * 100 }}%:
                                    </th>
                                    <th class="text-danger">
                                        Q.
                                        {{ number_format($subtotal * $compra->impuesto, 2) }}
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-success">
                                        TOTAL:
                                    </th>
                                    <th class="text-success">
                                        Q.
                                        {{ number_format($compra->total, 2) }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center py-3">
                    <a href="{{ route('compras.index') }}" class="btn btn-primary bg-gradient">
                        <i class="bi bi-arrow-left-square"></i></i> Regresar</a>
                </div>
            </div>

            <div class="py-3">
                <h4 class="card-tittle">Observaciones: </h4>
                <textarea class="form-control bg-body-tertiary" disabled>
                {{ $compra->observacion }}           </textarea>
            </div>

            <div class="py-3">
                <h4 class="card-tittle">Fecha de compra: </h4>
                <p class="form-control bg-body-tertiary">
                    {{ $compra->created_at->toFormattedDateString() }} a las
                    {{ date('H : i : s', strtotime($compra->created_at)) }}
                </p>
            </div>

        </div>
    </section>
</x-app-layout>
