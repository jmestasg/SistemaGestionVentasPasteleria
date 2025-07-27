<?php
require_once __DIR__ . '/../../modelos/Conexion.php';
$conexion = Conexion::conectar();

// Verificamos si se envió el ID por GET
if (!isset($_GET['id'])) {
    echo "ID de venta no especificado.";
    exit;
}

$idVenta = $_GET['id'];

// Consultar datos de la venta
$sqlVenta = "SELECT v.ID_Venta, v.Fecha, v.Hora, v.Tipo_Pago, v.Total, c.Nombre AS Cliente
             FROM ventas v
             JOIN clientes c ON v.ID_Cliente = c.ID_Cliente
             WHERE v.ID_Venta = ?";
$stmtVenta = $conexion->prepare($sqlVenta);
$stmtVenta->execute([$idVenta]);
$venta = $stmtVenta->fetch(PDO::FETCH_ASSOC);

if (!$venta) {
    echo "Venta no encontrada.";
    exit;
}

// Consultar productos de la venta
$sqlProductos = "SELECT p.Nombre, dv.Cantidad, dv.Precio_Unitario, (dv.Cantidad * dv.Precio_Unitario) AS Subtotal
                 FROM detalle_venta dv
                 JOIN productos p ON dv.ID_Producto = p.ID_Producto
                 WHERE dv.ID_Venta = ?";
$stmtProductos = $conexion->prepare($sqlProductos);
$stmtProductos->execute([$idVenta]);
$productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Detalles de la Venta #<?= htmlspecialchars($venta['ID_Venta']) ?></h2>

    <div class="mb-3">
        <strong>Fecha:</strong> <?= htmlspecialchars($venta['Fecha']) ?><br>
        <strong>Hora:</strong> <?= htmlspecialchars($venta['Hora']) ?><br>
        <strong>Cliente:</strong> <?= htmlspecialchars($venta['Cliente']) ?><br>
        <strong>Tipo de pago:</strong> <?= htmlspecialchars($venta['Tipo_Pago']) ?><br>
        <strong>Total:</strong> S/. <?= number_format($venta['Total'], 2) ?>
    </div>

    <h5>Productos Vendidos</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $prod): ?>
                <tr>
                    <td><?= htmlspecialchars($prod['Nombre']) ?></td>
                    <td><?= $prod['Cantidad'] ?></td>
                    <td>S/. <?= number_format($prod['Precio_Unitario'], 2) ?></td>
                    <td>S/. <?= number_format($prod['Subtotal'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-primary">Volver al listado</a>
</body>
</html>
