<?php
require_once('../modelos/Categoria.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'crear') {
        Categoria::crear($_POST['nombre'], $_POST['descripcion'], $_POST['estado']);
        header('Location: ../vistas/categorias/index.php');
        exit();
    }

    if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
        Categoria::actualizar($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['estado']);
        header('Location: ../vistas/categorias/index.php');
        exit();
    }
}

if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    Categoria::eliminar($_GET['id']);
    header('Location: ../vistas/categorias/index.php');
    exit();
}
