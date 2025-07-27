<?php
session_start();
require_once(__DIR__ . '/../modelos/Producto.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];

    if ($accion === 'crear') {
        Producto::crear(
            $_POST['nombre'],
            $_POST['precio'],
            $_POST['categoria'],
            $_POST['stock'],
            $_POST['estado']
        );
        header('Location: ../vistas/productos/index.php');
    }

    if ($accion === 'editar') {
        Producto::actualizar(
            $_POST['id'],
            $_POST['nombre'],
            $_POST['precio'],
            $_POST['categoria'],
            $_POST['stock'],
            $_POST['estado']
        );
        header('Location: ../vistas/productos/index.php');
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' &&
    isset($_GET['accion']) &&
    $_GET['accion'] === 'eliminar' &&
    isset($_GET['id'])) {

    $id = $_GET['id'];
    Producto::eliminar($id);
    header('Location: ../vistas/productos/index.php');
    exit();
}

?>
