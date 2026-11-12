@extends('layout.layout')
@section('title', 'Lista de Productos')
@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-4">

        <h2 class="mb-4 fw-bold text-dark">Dashboard Inventario</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3 mb-4">
            <div class="col">
                <div class="card text-white bg-dark border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50 text-uppercase small fw-bold">Total Productos</h6>
                        <h2 class="card-title fw-bold mb-0">17</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50 text-uppercase small fw-bold">Stock Crítico</h6>
                        <h2 class="card-title fw-bold mb-0">8</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-warning border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50 text-uppercase small fw-bold">Stock Medio</h6>
                        <h2 class="card-title fw-bold mb-0">4</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50 text-uppercase small fw-bold">Stock Normal</h6>
                        <h2 class="card-title fw-bold mb-0">5</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-danger text-white fw-bold">
                Productos Críticos
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>COD06</td>
                                <td>MAC BOOK AIR 3 FULL RETINA</td>
                                <td>2</td>
                                <td><span class="badge bg-danger">CRÍTICO</span></td>
                            </tr>
                            <tr>
                                <td>COD0010</td>
                                <td>Portatil Dell Inspiron La-587</td>
                                <td>5</td>
                                <td><span class="badge bg-danger">CRÍTICO</span></td>
                            </tr>
                            <tr>
                                <td>PROD01</td>
                                <td>Samsung Galaxy Tab 128 G</td>
                                <td>5</td>
                                <td><span class="badge bg-danger">CRÍTICO</span></td>
                            </tr>
                            <tr>
                                <td>PROD04</td>
                                <td>Iphone DUO</td>
                                <td>5</td>
                                <td><span class="badge bg-danger">CRÍTICO</span></td>
                            </tr>
                            <tr>
                                <td>PROD05</td>
                                <td>TV Sony 80"</td>
                                <td>5</td>
                                <td><span class="badge bg-danger">CRÍTICO</span></td>
                            </tr>
                            <tr>
                                <td>PROD07</td>
                                <td>Producto Prueba 07</td>
                                <td>2</td>
                                <td><span class="badge bg-danger">CRÍTICO</span></td>
                            </tr>
                            <tr>
                                <td>PROD1254</td>
                                <td>Torre de Sonido</td>
                                <td>0</td>
                                <td><span class="badge bg-danger">CRÍTICO</span></td>
                            </tr>
                            <tr>
                                <td>PROD125</td>
                                <td>Torre de Sonido</td>
                                <td>0</td>
                                <td><span class="badge bg-danger">CRÍTICO</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
