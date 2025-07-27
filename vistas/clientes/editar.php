<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once(__DIR__ . '/../../modelos/Cliente.php');

// Validar que se recibe el parámetro id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Cliente no especificado.";
    exit();
}

$id = intval($_GET['id']);
$cliente = Cliente::obtenerPorID($id);

if (!$cliente) {
    echo "Cliente no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>Editar Cliente</h2>
    <form action="../../controladores/clienteControlador.php" method="POST">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['ID_Cliente']) ?>">

        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($cliente['Nombre']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Apellidos:</label>
            <input type="text" name="apellidos" class="form-control" value="<?= htmlspecialchars($cliente['Apellidos']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Correo:</label>
            <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($cliente['Correo']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Teléfono:</label>
            <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($cliente['Telefono']) ?>">
        </div>
        <div class="mb-3">
            <label>Dirección:</label>
            <textarea name="direccion" class="form-control"><?= htmlspecialchars($cliente['Direccion']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
