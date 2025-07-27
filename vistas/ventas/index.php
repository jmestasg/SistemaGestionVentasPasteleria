<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once(__DIR__ . '/../../modelos/Venta.php');
$ventas = Venta::obtenerTodas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Ventas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Ventas Registradas</h3>
        <a href="../../controladores/logout.php" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
        </a>
    </div>

    <div class="mb-3 d-flex gap-2 flex-wrap">
        <a href="crear.php" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Nueva Venta</a>
        <a href="../dashboard.php" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Volver al Dashboard</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm bg-white text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Tipo de Pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $v): ?>
                <tr>
                    <td><?= $v['ID_Venta'] ?></td>
                    <td><?= $v['Fecha'] ?></td>
                    <td><?= $v['Hora'] ?></td>
                    <td><?= htmlspecialchars($v['Cliente']) ?></td>
                    <td>S/ <?= number_format($v['Total'], 2) ?></td>
                    <td><?= $v['Tipo_Pago'] ?></td>
                    <td><?= $v['Estado'] ?></td>
                    <td>
                        <a href="ver.php?id=<?= $v['ID_Venta'] ?>" class="btn btn-sm btn-primary">Ver</a>
                        <a href="../../controladores/ventaControlador.php?accion=anular&id=<?= $v['ID_Venta'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Seguro que deseas anular esta venta?');">Anular</a>
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
