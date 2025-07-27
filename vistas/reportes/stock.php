<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once '../../modelos/Conexion.php';
require_once '../../modelos/Producto.php';

$producto = new Producto();
$productos = $producto->obtenerTodos(); // Usa el método que lista todos los productos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary">Reporte de Stock de Productos</h4>
            <a href="index.php" class="btn btn-secondary btn-sm">← Volver a Reportes</a>
        </div>

        <!-- Tabla -->
        <div class="bg-white p-4 rounded shadow-sm">
            <?php if (count($productos) > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $index => $producto): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $producto['Nombre'] ?></td>
                                <td><?= $producto['Categoria'] ?></td>
                                <td>S/ <?= number_format($producto['Precio'], 2) ?></td>
                                <td><?= $producto['Stock'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">No hay productos registrados.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
