<x-app-layout>
    <h1 class="text-primary my-4">Bienvenid@ {{ auth()->user()->name }}</h1>

    <!-- Consultas de productos ---->
    <section class="card shadow">
        <div class="card-header">
            <h4 class="card-title">Productos</h4>
        </div>
        <div class="card-body row align-items-center justify-content-start m-0 pb-1 text-center">
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-success">
                    <div class="me-3 text-success">
                        <h6 class="mb-1">Total</h6>
                        <p class="fw-bold mb-0">
                            {{ $totalProductos }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/totalProductos.png') }}">
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-warning">
                    <div class="me-3 text-warning">
                        <h6 class="mb-1">Por agotarse</h6>
                        <p class="fw-bold mb-0">
                            {{ $totalProductosPorAgotarse }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/totalProductos.png') }}">
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-danger">
                    <div class="me-3 text-danger">
                        <h6 class="mb-1">Agotados</h6>
                        <p class="fw-bold mb-0">
                            {{ $totalProductosAgotados }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/totalProductos.png') }}">
                </div>
            </div>
        </div>
    </section>

    <!-- Consultas de ventas ---->
    <section class="card shadow mt-4">
        <div class="card-header">
            <h4 class="card-title">Ventas</h4>
        </div>
        <div class="card-body row align-items-center justify-content-start m-0 pb-1 text-center">
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-primary">
                    <div class="me-3 text-success">
                        <h6 class="mb-1">Total: {{ $totalVentas }}</h6>
                        <p class="fw-bold mb-0">
                            Ganancia: Q. {{ $dineroVentas }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/ventas.png') }}">
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-primary">
                    <div class="me-3 text-success">
                        <h6 class="mb-1">Hoy: {{ $totalVentasDia }}</h6>
                        <p class="fw-bold mb-0">
                            Ganancia: Q. {{ $dineroVentasDia }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/ventas.png') }}">
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-primary">
                    <div class="me-3 text-success">
                        <h6 class="mb-1">Mes: {{ $totalVentasMes }}</h6>
                        <p class="fw-bold mb-0">
                            Ganancia: Q. {{ $dineroVentasMes }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/ventas.png') }}">
                </div>
            </div>
        </div>
    </section>

    <!-- Consultas de compras ---->
    <section class="card shadow mt-4">
        <div class="card-header">
            <h4 class="card-title">Compras</h4>
        </div>
        <div class="card-body row align-items-center justify-content-start m-0 pb-1 text-center">
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-secondary">
                    <div class="me-3 text-danger">
                        <h6 class="mb-1">Total: {{ $totalCompras }}</h6>
                        <p class="fw-bold mb-0">
                            Inversion: Q. {{ $dineroCompras }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/compras.png') }}">
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-secondary">
                    <div class="me-3 text-danger">
                        <h6 class="mb-1">Hoy: {{ $totalComprasDia }}</h6>
                        <p class="fw-bold mb-0">
                            Inversion: Q. {{ $dineroComprasDia }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/compras.png') }}">
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center alert alert-secondary">
                    <div class="me-3 text-danger">
                        <h6 class="mb-1">Mes: {{ $totalComprasMes }}</h6>
                        <p class="fw-bold mb-0">
                            Inversion: Q. {{ $dineroComprasMes }}
                        </p>
                    </div>
                    <img class="img-fluid" width="50px" height="50px" src="{{ asset('img/compras.png') }}">
                </div>
            </div>
        </div>
    </section>

    <!-- Cantidad de ventas y compras diarias ---->
    <section class="card shadow mt-4">
        <div class="card-header">
            <h4 class="card-title">Cantidad de ventas y compras diarias</h4>
        </div>
        <div class="card-body">
            <canvas id="cantidadVentasCompras" width="auto" height="100"></canvas>
        </div>
    </section>

    <!-- Total de ventas y compras diarias ---->
    <section class="card shadow my-4">
        <div class="card-header">
            <h4 class="card-title">Total de ventas y compras diarias</h4>
        </div>
        <div class="card-body">
            <canvas id="totalVentasComnpras" width="auto" height="100"></canvas>
        </div>
    </section>

    <!-- Scripts ---->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const cantidad = document.getElementById('cantidadVentasCompras').getContext('2d');
        new Chart(cantidad, {
            type: 'line',
            data: {
                labels: [<?php foreach ($ventasdia as $reg) {
                    $dia = $reg->dia;
                    echo '"' . $dia . '",';
                } ?>],
                datasets: [{
                    label: 'Ventas',
                    data: [<?php foreach ($ventasdia as $reg) {
                        echo '' . $reg->cantidad . ',';
                    } ?>],
                    borderColor: '#198754',
                    borderWidth: 3
                }, {
                    label: 'Compras',
                    data: [<?php foreach ($comprasdia as $reg) {
                        echo '' . $reg->cantidad . ',';
                    } ?>],
                    borderColor: '#dc3545',
                    borderWidth: 3
                }, ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                elements: {
                    point: {
                        radius: 6,
                        borderwidth: 4,
                        backgroundColor: 'white',
                        hoverRadius: 8,
                        hoverBorderWidth: 4,
                    }
                }
            }
        });

        const total = document.getElementById('totalVentasComnpras').getContext('2d');
        new Chart(total, {
            type: 'line',
            data: {
                labels: [<?php foreach ($ventasdia as $reg) {
                    $dia = $reg->dia;
                    echo '"' . $dia . '",';
                } ?>],
                datasets: [{
                    label: 'Ventas',
                    data: [<?php foreach ($ventasdia as $reg) {
                        echo '' . $reg->totaldia . ',';
                    } ?>],
                    borderColor: '#198754',
                    borderWidth: 3
                }, {
                    label: 'Compras',
                    data: [<?php foreach ($comprasdia as $reg) {
                        echo '' . $reg->totaldia . ',';
                    } ?>],
                    borderColor: '#dc3545',
                    borderWidth: 3
                }, ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                elements: {
                    point: {
                        radius: 6,
                        borderwidth: 4,
                        backgroundColor: 'white',
                        hoverRadius: 8,
                        hoverBorderWidth: 4,
                    }
                }
            }
        });
    </script>

</x-app-layout>
