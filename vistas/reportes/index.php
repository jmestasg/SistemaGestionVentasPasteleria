<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Panel de Reportes</h2>
        <a href="../dashboard.php" class="btn btn-secondary btn-sm">← Volver al Dashboard</a>
    </div>

    <!-- Navegación por pestañas -->
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-stock-tab" data-bs-toggle="pill" data-bs-target="#pills-stock" type="button" role="tab">Stock de Productos</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-fechas-tab" data-bs-toggle="pill" data-bs-target="#pills-fechas" type="button" role="tab">Ventas por Fecha</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-cliente-tab" data-bs-toggle="pill" data-bs-target="#pills-cliente" type="button" role="tab">Ventas por Cliente</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-producto-tab" data-bs-toggle="pill" data-bs-target="#pills-producto" type="button" role="tab">Ventas por Producto</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-ranking-tab" data-bs-toggle="pill" data-bs-target="#pills-ranking" type="button" role="tab">Ranking de Ventas</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <!-- STOCK -->
        <div class="tab-pane fade show active" id="pills-stock" role="tabpanel">
            <div class="card">
                <div class="card-header bg-primary text-white">📦 Control de Stock</div>
                <div class="card-body">
                    <form method="post" action="stock.php" target="_blank">
                        <button type="submit" class="btn btn-primary">Ver Stock de Productos</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- VENTAS POR FECHA -->
        <div class="tab-pane fade" id="pills-fechas" role="tabpanel">
            <div class="card">
                <div class="card-header bg-success text-white">📅 Ventas por Fecha</div>
                <div class="card-body">
                    <form method="post" action="ventas_fecha.php" target="_blank" class="row g-3">
                        <div class="col-md-6">
                            <label>Desde:</label>
                            <input type="date" name="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Hasta:</label>
                            <input type="date" name="fecha_fin" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- VENTAS POR CLIENTE -->
        <div class="tab-pane fade" id="pills-cliente" role="tabpanel">
            <div class="card">
                <div class="card-header bg-info text-white">👤 Ventas por Cliente</div>
                <div class="card-body">
                    <form method="post" action="ventas_cliente.php" target="_blank" class="row g-3">
                        <div class="col-md-8">
                            <label>Nombre del Cliente:</label>
                            <input type="text" name="cliente" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info mt-4 text-white">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- VENTAS POR PRODUCTO -->
        <div class="tab-pane fade" id="pills-producto" role="tabpanel">
            <div class="card">
                <div class="card-header bg-warning text-dark">🍰 Ventas por Producto</div>
                <div class="card-body">
                    <form method="post" action="ventas_producto.php" target="_blank" class="row g-3">
                        <div class="col-md-8">
                            <label>Nombre del Producto:</label>
                            <input type="text" name="producto" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-warning mt-4">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- RANKING DE VENTAS -->
        <div class="tab-pane fade" id="pills-ranking" role="tabpanel">
            <div class="card">
                <div class="card-header bg-dark text-white">🏆 Ranking de Ventas</div>
                <div class="card-body">
                    <form method="post" action="ranking_ventas.php" target="_blank">
                        <button type="submit" class="btn btn-dark">Ver Ranking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
