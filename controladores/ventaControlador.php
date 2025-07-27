<?php
require_once __DIR__ . '/../modelos/Venta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registrar_venta'])) {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $id_cliente = $_POST['id_cliente'];
        $tipo_pago = $_POST['tipo_pago'];
        $productos = isset($_POST['productos']) ? $_POST['productos'] : [];

        $total = 0;
        foreach ($productos as $prod) {
            if (
                !isset($prod['ID_Producto'], $prod['Cantidad'], $prod['Precio']) ||
                !is_numeric($prod['Cantidad']) || $prod['Cantidad'] <= 0 ||
                !is_numeric($prod['Precio']) || $prod['Precio'] <= 0
            ) {
                header("Location: ../vistas/ventas/index.php?error=Producto con datos inválidos");
                exit();
            }

            $cantidad = (int)$prod['Cantidad'];
            $precio = (float)$prod['Precio'];
            $subtotal = $cantidad * $precio;
            $total += $subtotal;
        }

        $resultado = Venta::registrar($fecha, $hora, $id_cliente, $total, $tipo_pago, $productos);

        if ($resultado) {
            header("Location: ../vistas/ventas/index.php?mensaje=Venta registrada");
        } else {
            header("Location: ../vistas/ventas/index.php?error=Error al registrar venta");
        }
        exit();
    }

    if (isset($_POST['anular_venta'])) {
        $idVenta = $_POST['id_venta'];
        $resultado = Venta::anular($idVenta);

        if ($resultado) {
            header("Location: ../vistas/ventas/index.php?mensaje=Venta anulada");
        } else {
            header("Location: ../vistas/ventas/index.php?error=No se pudo anular la venta");
        }
        exit();
    }
}
