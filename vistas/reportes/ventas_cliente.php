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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cliente = $_POST['cliente'];
    $resultados = $venta->obtenerVentasPorCliente($cliente);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas por Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary">Consulta de Ventas por Cliente</h4>
            <a href="index.php" class="btn btn-secondary btn-sm">← Volver a Reportes</a>
        </div>

        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-6">
                <input type="text" name="cliente" class="form-control" placeholder="Ingrese nombre del cliente" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <?php if (!empty($resultados)): ?>
            <div class="bg-white p-4 rounded shadow-sm">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Tipo de Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $venta): ?>
                            <tr>
                                <td><?= $venta['Fecha'] ?></td>
                                <td><?= $venta['Cliente'] ?></td>
                                <td>S/ <?= number_format($venta['Total'], 2) ?></td>
                                <td><?= $venta['Tipo_Pago'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <div class="alert alert-warning">No se encontraron ventas para ese cliente.</div>
        <?php endif; ?>
    </div>
</body>
</html>
