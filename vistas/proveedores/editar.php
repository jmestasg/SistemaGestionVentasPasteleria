<?php
require_once "../../modelos/Proveedor.php";
$proveedor = new Proveedor();
$dato = $proveedor->obtenerProveedorPorID($_GET['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Editar Proveedor</h2>
    <form action="../../controladores/proveedorControlador.php" method="POST">
        <input type="hidden" name="id" value="<?= $dato['ID_Proveedor'] ?>">
        <div class="mb-2">
            <label>Razón Social</label>
            <input type="text" name="razon_social" class="form-control" value="<?= $dato['Razon_Social'] ?>" required>
        </div>
        <div class="mb-2">
            <label>RUC</label>
            <input type="text" name="ruc" class="form-control" value="<?= $dato['RUC'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Tipo de Producto</label>
            <input type="text" name="tipo_producto" class="form-control" value="<?= $dato['Tipo_Producto'] ?>">
        </div>
        <div class="mb-2">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?= $dato['Telefono'] ?>">
        </div>
        <div class="mb-2">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="<?= $dato['Direccion'] ?>">
        </div>
        <div class="mb-2">
            <label>Correo</label>
            <input type="email" name="correo" class="form-control" value="<?= $dato['Correo'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
