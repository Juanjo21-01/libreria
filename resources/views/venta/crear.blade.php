<x-app-layout>
    <section class="row py-4 bg-body-tertiary">
        <h2 class="text-success">Registrar Venta</h2>
        <hr class="my-4 ">

        <!-- Formulario de registro de la venta ---->
        <form method="POST" action="{{ route('ventas.store') }}" role="form" enctype="multipart/form-data">
            @csrf

            <!-- Producto y cantidad de la venta ---->
            <div class="row mb-3 align-items-center">
                <div class="col-12 col-sm-6">
                    <div class="row">
                        <x-input-label for="producto_id" value="Producto"
                            class="col-sm-2 col-form-label pe-0 fw-semibold" />
                        <div class="col-sm-10">
                            <select class="form-select" name="producto_id" id="producto_id" required>
                                <option value="0" disabled selected>Seleccione un producto</option>
                                @foreach ($productos as $id => $producto)
                                    <option value="{{ $id }}">{{ $producto }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="row align-items-center">
                        <x-input-label for="cantidad" value="Cantidad de Productos"
                            class="col-sm-2 col-form-label pe-0 fw-semibold" />
                        <div class="col-sm-10">
                            <x-text-input id="cantidad" type="number" name="cantidad" :value="old('cantidad')" autofocus
                                min="0" step="1" />
                            <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Precio de la venta ---->
            <div class="row mb-3 align-items-center">
                <div class="col-6 col-lg-3">
                    <div class="row">
                        <x-input-label for="precio" value="Precio" class="col-sm-2 col-form-label pe-0 fw-semibold" />
                        <div class="col-sm-10">
                            <x-text-input id="precio" type="number" name="precio" :value="old('precio')" autofocus
                                min="0" step="0.01" />
                            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <!-- Fecha de la venta ---->
                    <div class="row">
                        <x-input-label for="fecha_venta" value="Fecha"
                            class="col-sm-2 col-form-label pe-0 fw-semibold" />
                        <div class="col-sm-10">
                            <x-text-input id="fecha_venta" type="date" name="fecha_venta" :value="old('fecha_venta')" required
                                autofocus />
                            <x-input-error :messages="$errors->get('fecha_venta')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <!-- Descripcion de la venta ---->

                    <div class="row mb-3 align-items-center justify-content-center">
                        <x-input-label for="observacion" value="Observaciones"
                            class="col-sm-2 col-form-label me-2 fw-semibold" />
                        <div class="col-sm-10">
                            <textarea class="form-control" name="observacion" id="observacion" rows="3">{{ old('observacion') }}</textarea>
                            <x-input-error :messages="$errors->get('observacion')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detalle de las ventas --}}
            <div class="card">
                <div class="card-header shadow-sm text-center">
                    <button type="button" id="agregar" class="btn btn-primary">Agregar Producto</button>
                </div>
                <div class="card-body shadow">
                    <h4 class="card-tittle">Detalles de Venta</h4>
                    <div class="table-responsive col-md-12">
                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead class="thead">
                                <tr class="text-success">
                                    <th class="col-2 shadow">Eliminar</th>
                                    <th class="col-4 shadow">Producto</th>
                                    <th class="col-2 shadow">Cantidad</th>
                                    <th class="col-2 shadow">Q. Precio</th>
                                    <th class="col-2 shadow">Q. SubTotal</th>
                                </tr>
                            </thead>
                            <tbody id="detalles">

                            </tbody>
                            <tfoot class="text-end">
                                <tr>
                                    <th colspan="4" class="text-secondary">
                                        TOTAL:
                                    </th>
                                    <th class="text-secondary">
                                        <span id="total">Q. 0.00</span>
                                    </th>
                                </tr>
                                <tr id="dvOcultar">
                                    <th colspan="4" class="text-danger">
                                        IMPUESTO 12 %:
                                    </th>
                                    <th class="text-danger">
                                        <span id="total_impuesto">Q. 0.00</span>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-success">
                                        TOTAL A PAGAR:
                                    </th>
                                    <th class="text-success">
                                        <span id="total_pagar_html">Q. 0.00</span>
                                        <input type="hidden" name="total" id="total_pagar">
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Botones ---->
            <div class="d-flex justify-content-evenly mt-5">
                <a href="{{ route('ventas.index') }}" class="btn btn-danger"><i class="bi bi-x-square"></i>
                    Cancelar</a>

                <x-btn-exito id="guardar"><i class="bi bi-arrow-up-square"></i></i> Registrar </x-btn-exito>
            </div>

            {{-- script para el detalle --}}
            <script>
                // click en agregar producto
                document.getElementById("agregar").addEventListener("click", function() {
                    agregarProducto();
                });

                // variables
                let cont = 0,
                    total = 0,
                    subtotal = [];

                // ocultar el boton para guardar la venta
                const guardarBtn = document.getElementById("guardar");
                guardarBtn.style.display = "none";

                // funcion para agregar productos al detalle
                function agregarProducto() {
                    // id del producto
                    const producto_id = document.getElementById("producto_id").value;
                    // nombre del producto
                    const producto = document.getElementById("producto_id").options[document.getElementById("producto_id")
                        .selectedIndex].text;
                    // cantidad de productos
                    const cantidad = parseFloat(document.getElementById("cantidad").value);
                    // precio del producto
                    const precio = parseFloat(document.getElementById("precio").value);


                    if (producto_id !== "" && !isNaN(cantidad) && cantidad > 0 && !isNaN(precio) && precio !== "") {
                        subtotal[cont] = cantidad * precio;
                        total += subtotal[cont];
                        let fila =
                            '<tr id="fila' +
                            cont +
                            '"> <td class="text-center"> <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' +
                            cont +
                            ');"><i class="bi bi-x-lg"></i></button> </td>    <td><input type="hidden" name="producto_id[]" value="' +
                            producto_id +
                            '">' +
                            producto +
                            '</td>   <td><input type="hidden" name="cantidad[]" value="' +
                            cantidad +
                            '"><input class="form-control" type="text" value="' +
                            cantidad +
                            '" disabled> </td>   <td><input type="hidden" id="precio[]" name="precio[]" value="' +
                            precio +
                            '"> <input class="form-control" type="number" id="precio[]" value="' +
                            precio +
                            '" disabled> </td>        <td class="text-end">Q. ' +
                            subtotal[cont] +
                            " </td></tr>    ";

                        cont++;
                        limpiar();
                        totales();
                        evaluar();
                        document.getElementById("detalles").innerHTML += fila;
                    } else {
                        alert(
                            'Los campos de Productos, Cantidad y Precio son requeridos'
                        );
                    }
                }

                function limpiar() {
                    document.getElementById("cantidad").value = "";
                    document.getElementById("precio").value = "";
                }

                function totales() {
                    document.getElementById("total").innerHTML = `Q. ${total.toFixed(2)}`
                    let total_impuesto = total * (12 / 100);
                    let total_pagar = total + total_impuesto;
                    document.getElementById("total_impuesto").innerHTML = `Q. ${total_impuesto.toFixed(2)} `
                    document.getElementById("total_pagar_html").innerHTML = `Q. ${total_pagar.toFixed(2)}`
                    document.getElementById("total_pagar").value = total_pagar.toFixed(2);
                }

                function evaluar() {
                    if (total > 0) {
                        guardarBtn.style.display = "block";
                    } else {
                        guardarBtn.style.display = "none";
                    }
                }

                function eliminar(index) {
                    total -= subtotal[index];
                    let total_impuesto = total * (12 / 100);
                    let total_pagar_html = total + total_impuesto;
                    document.getElementById("total").innerHTML = `Q. ${total.toFixed(2)}`
                    document.getElementById("total_impuesto").innerHTML = `Q. ${total_impuesto.toFixed(2)}`
                    document.getElementById("total_pagar_html").innerHTML = `Q. ${total_pagar_html.toFixed(2)}`
                    document.getElementById("total_pagar").value = total_pagar_html.toFixed(2);
                    let fila = document.getElementById("fila" + index);
                    fila.parentNode.removeChild(fila);
                    evaluar();
                }
            </script>
        </form>
    </section>
</x-app-layout>
