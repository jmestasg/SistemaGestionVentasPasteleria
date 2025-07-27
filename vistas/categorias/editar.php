<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}
require_once(__DIR__ . '/../../modelos/Categoria.php');
$categoria = Categoria::obtenerPorId($_GET['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2>Editar Categoría</h2>
    <form action="../../controladores/categoriaControlador.php" method="POST">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" value="<?= $categoria['ID_Categoria'] ?>">
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="<?= $categoria['Nombre_Categoria'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea class="form-control" name="descripcion"><?= $categoria['Descripcion'] ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Estado:</label>
            <select class="form-select" name="estado" required>
                <option value="Activo" <?= $categoria['Estado'] === 'Activo' ? 'selected' : '' ?>>Activo</option>
                <option value="Inactivo" <?= $categoria['Estado'] === 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
