<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once(__DIR__ . '/../../modelos/Cliente.php');
$clientes = Cliente::obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sección Clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }

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
        <h2 class="m-0">Sección Clientes</h2>
        <a href="../../controladores/logout.php" class="logout-link">
            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
        </a>
    </div>

    <div class="mb-3 d-flex gap-2 flex-wrap">
        <a href="crear.php" class="btn btn-sm btn-primary">+ Nuevo Cliente</a>
        <a href="../dashboard.php" class="btn btn-sm btn-secondary">← Volver al Dashboard</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm bg-white align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['ID_Cliente']) ?></td>
                            <td><?= htmlspecialchars($cliente['Nombre']) ?></td>
                            <td><?= htmlspecialchars($cliente['Apellidos']) ?></td>
                            <td><?= htmlspecialchars($cliente['Correo']) ?></td>
                            <td><?= htmlspecialchars($cliente['Telefono']) ?></td>
                            <td><?= htmlspecialchars($cliente['Direccion']) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $cliente['ID_Cliente'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="../../controladores/clienteControlador.php?accion=eliminar&id=<?= $cliente['ID_Cliente'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                    Eliminar
                                    </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7">No hay clientes registrados aún.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
