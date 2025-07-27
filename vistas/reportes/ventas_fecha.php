<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once '../../modelos/Conexion.php';
require_once '../../modelos/Venta.php';

$venta = new Venta();
$resultados = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $resultados = $venta->obtenerVentasPorFechas($fechaInicio, $fechaFin);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas por Fecha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary">Ventas por Rango de Fechas</h4>
            <a href="index.php" class="btn btn-secondary btn-sm">← Volver a Reportes</a>
        </div>

        <!-- Formulario -->
        <div class="bg-white p-4 rounded shadow-sm mb-4">
            <form method="POST" class="row g-3">
                <div class="col-md-5">
                    <label for="fecha_inicio" class="form-label">Desde:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                </div>
                <div class="col-md-5">
                    <label for="fecha_fin" class="form-label">Hasta:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </form>
        </div>

        <!-- Resultados -->
        <?php if (!empty($resultados)): ?>
            <div class="bg-white p-4 rounded shadow-sm">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Cliente</th>
                            <th>Total (S/)</th>
                            <th>Tipo Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $i => $venta): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $venta['Fecha'] ?></td>
                                <td><?= $venta['Hora'] ?></td>
                                <td><?= $venta['Cliente'] ?></td>
                                <td><?= number_format($venta['Total'], 2) ?></td>
                                <td><?= $venta['Tipo_Pago'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <div class="alert alert-warning">No se encontraron ventas para ese rango de fechas.</div>
        <?php endif; ?>
    </div>
</body>
</html>
