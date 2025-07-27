<?php
require_once(__DIR__ . '/../../modelos/Producto.php');

$busqueda = $_GET['busqueda'] ?? '';
$resultados = Producto::buscar($busqueda);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Resultados de búsqueda</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <?php if (!empty($resultados)): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Fecha de Creación</th>
                    <th>Stock</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $producto): ?>
                    <tr>
                        <td><?= $producto['ID_Producto'] ?></td>
                        <td><?= htmlspecialchars($producto['Nombre']) ?></td>
                        <td><?= $producto['Precio'] ?></td>
                        <td><?= $producto['Categoria'] ?></td>
                        <td><?= $producto['Fecha_Creacion'] ?></td>
                        <td><?= $producto['Stock'] ?></td>
                        <td><?= $producto['Estado'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No se encontraron productos.</div>
    <?php endif; ?>
</div>
</body>
</html>
