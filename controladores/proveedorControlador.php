<?php
require_once "../modelos/Proveedor.php";

$proveedor = new Proveedor();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Razon_Social' => $_POST['razon_social'],
        'RUC' => $_POST['ruc'],
        'Tipo_Producto' => $_POST['tipo_producto'],
        'Telefono' => $_POST['telefono'],
        'Direccion' => $_POST['direccion'],
        'Correo' => $_POST['correo']
    ];

    if (isset($_POST['id'])) {
        $proveedor->actualizarProveedor($_POST['id'], $data);
    } else {
        $proveedor->crearProveedor($data);
    }
    header("Location: ../vistas/proveedores/index.php");
    exit;
}

if (isset($_GET['eliminar'])) {
    $proveedor->eliminarProveedor($_GET['eliminar']);
    header("Location: ../vistas/proveedores/index.php");
    exit;
}
