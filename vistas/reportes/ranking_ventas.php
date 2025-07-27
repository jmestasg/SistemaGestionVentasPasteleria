<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once '../../modelos/Conexion.php';
require_once '../../modelos/Venta.php';

$venta = new Venta();
$ranking = $venta->obtenerRankingVentas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ranking de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary">Ranking de Ventas por Ingreso</h4>
            <a href="index.php" class="btn btn-secondary btn-sm">← Volver a Reportes</a>
        </div>

        <div class="bg-white p-4 rounded shadow-sm">
            <?php if (count($ranking) > 0): ?>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Tipo de Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ranking as $index => $fila): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $fila['Fecha'] ?></td>
                                <td><?= $fila['Cliente'] ?></td>
                                <td>S/ <?= number_format($fila['Total'], 2) ?></td>
                                <td><?= $fila['Tipo_Pago'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">No hay ventas registradas.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
