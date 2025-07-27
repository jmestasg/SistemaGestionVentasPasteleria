<?php
require_once(__DIR__ . '/../../modelos/Producto.php');

// Obtener categorías si las tienes en una tabla aparte (opcional)
// $categorias = Categoria::obtenerTodas(); // si usas modelo aparte
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Registrar Nuevo Producto</h2>
    <form action="../../controladores/productoControlador.php" method="POST">
        <input type="hidden" name="accion" value="crear">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio (S/)</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
        </div>

        <!-- Fecha de creación se generará automáticamente en el modelo o base de datos -->

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Producto</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
