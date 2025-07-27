<?php
require_once(__DIR__ . '/../../modelos/Cliente.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    Cliente::crear($nombre, $apellidos, $correo, $telefono, $direccion);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Cliente - Sistema Pastelería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-5">
        <a href="../../logout.php" class="btn btn-sm btn-outline-danger logout-btn">Cerrar sesión</a>

        <h2 class="mb-4 text-primary text-center">Agregar Nuevo Cliente</h2>

        <div class="form-container">
            <form method="POST" class="bg-white p-4 rounded shadow-sm border">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="email" id="correo" name="correo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <textarea id="direccion" name="direccion" class="form-control" required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-success">Guardar Cliente</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
