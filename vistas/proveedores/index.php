<?php
require_once "../../modelos/Proveedor.php";
$proveedor = new Proveedor();
$lista = $proveedor->obtenerProveedores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Proveedores</h2>
        <a href="../logout.php" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
    </div>

    <div class="mb-3 d-flex gap-2 flex-wrap">
        <a href="crear.php" class="btn btn-sm btn-success">+ Nuevo Proveedor</a>
        <a href="../dashboard.php" class="btn btn-sm btn-secondary">← Volver al Dashboard</a>
    </div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Razón Social</th>
            <th>RUC</th>
            <th>Tipo Producto</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $prov): ?>
            <tr>
                <td><?= $prov['ID_Proveedor'] ?></td>
                <td><?= htmlspecialchars($prov['Razon_Social']) ?></td>
                <td><?= $prov['RUC'] ?></td>
                <td><?= $prov['Tipo_Producto'] ?></td>
                <td><?= $prov['Telefono'] ?></td>
                <td><?= $prov['Direccion'] ?></td>
                <td><?= $prov['Correo'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $prov['ID_Proveedor'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="../../controladores/proveedorControlador.php?eliminar=<?= $prov['ID_Proveedor'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar proveedor?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    
</body>
</html>
