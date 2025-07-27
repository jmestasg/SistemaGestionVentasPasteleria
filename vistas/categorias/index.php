<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}
require_once(__DIR__ . '/../../modelos/Categoria.php');
$categorias = Categoria::obtenerTodas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sección Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categorías</h2>
        <a href="../../controladores/logout.php" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
    </div>

    <div class="mb-3 d-flex gap-2 flex-wrap">
        <a href="crear.php" class="btn btn-primary btn-sm">+ Nueva Categoría</a>
        <a href="../dashboard.php" class="btn btn-secondary btn-sm">← Volver al Dashboard</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm bg-white text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= $categoria['ID_Categoria'] ?></td>
                        <td><?= $categoria['Nombre_Categoria'] ?></td>
                        <td><?= $categoria['Descripcion'] ?></td>
                        <td><?= $categoria['Estado'] ?></td>
                        <td>
                            <a href="editar.php?id=<?= $categoria['ID_Categoria'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="../../controladores/categoriaControlador.php?accion=eliminar&id=<?= $categoria['ID_Categoria'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Estás seguro que deseas eliminar esta categoría?');">
                               Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
