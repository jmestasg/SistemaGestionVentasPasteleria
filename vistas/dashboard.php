<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistema Pastelería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ebfffaff;
        }
        .navbar {
            background-color: #06649bff;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-title {
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand">🍰 Pastelería Deliciosa</span>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                Bienvenido, <?= htmlspecialchars($usuario) ?>
            </span>
            <a href="../logout.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Panel Principal</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="../vistas/clientes/index.php" class="text-decoration-none">
                <div class="card text-white bg-success h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text">Gestión de clientes registrados</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="productos/index.php" class="text-decoration-none">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Productos</h5>
                        <p class="card-text">Agregar, editar y eliminar productos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="ventas/index.php" class="text-decoration-none">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ventas</h5>
                        <p class="card-text">Registrar y consultar ventas</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <a href="proveedores/index.php" class="text-decoration-none">
                <div class="card text-white bg-info h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Proveedores</h5>
                        <p class="card-text">Administrar proveedores</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="categorias/index.php" class="text-decoration-none">
                <div class="card text-white bg-secondary h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Categorías</h5>
                        <p class="card-text">Clasificación de productos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="reportes/index.php" class="text-decoration-none">
                <div class="card text-white bg-dark h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Ranking y consultas avanzadas</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
