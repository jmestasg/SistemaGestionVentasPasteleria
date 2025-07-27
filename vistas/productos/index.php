<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once(__DIR__ . '/../../modelos/Producto.php');

// Si se envió búsqueda, filtramos
$productos = isset($_GET['buscar']) && !empty(trim($_GET['buscar']))
    ? Producto::buscarPorNombre($_GET['buscar'])
    : Producto::obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .logout-link {
            text-decoration: none;
            font-size: 0.9rem;
            color: #dc3545;
        }

        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Gestión de Productos</h2>
        <a href="../../controladores/logout.php" class="logout-link">
            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
        </a>
    </div>

    <div class="mb-3 d-flex gap-2 flex-wrap">
        <a href="crear.php" class="btn btn-sm btn-success">+ Nuevo Producto</a>
        <a href="../dashboard.php" class="btn btn-sm btn-secondary">← Volver al Dashboard</a>
    </div>

    <!-- Formulario de búsqueda -->
    <form class="mb-3" method="GET" action="">
        <div class="input-group">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar por nombre..." value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm bg-white align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Fecha de Creación</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?= $p['ID_Producto'] ?></td>
                        <td><?= htmlspecialchars($p['Nombre']) ?></td>
                        <td>S/ <?= number_format($p['Precio'], 2) ?></td>
                        <td><?= htmlspecialchars($p['Categoria']) ?></td>
                        <td><?= $p['Fecha_Creacion'] ?></td>
                        <td><?= $p['Stock'] ?></td>
                        <td><?= $p['Estado'] ?></td>
                        <td>
                            <a href="editar.php?id=<?= $p['ID_Producto'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="../../controladores/productoControlador.php?accion=eliminar&id=<?= $p['ID_Producto'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                               Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
