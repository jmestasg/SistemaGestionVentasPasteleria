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
    $producto = $_POST['producto'];
    $resultados = $venta->obtenerVentasPorProducto($producto);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas por Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary">Consulta de Ventas por Producto</h4>
            <a href="index.php" class="btn btn-secondary btn-sm">← Volver a Reportes</a>
        </div>

        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-6">
                <input type="text" name="producto" class="form-control" placeholder="Ingrese nombre del producto" required>
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
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $fila): ?>
                            <tr>
                                <td><?= $fila['Fecha'] ?></td>
                                <td><?= $fila['Nombre_Producto'] ?></td>
                                <td><?= $fila['Cantidad'] ?></td>
                                <td>S/ <?= number_format($fila['Subtotal'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <div class="alert alert-warning">No se encontraron ventas de ese producto.</div>
        <?php endif; ?>
    </div>
</body>
</html>
