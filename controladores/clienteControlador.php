<?php
require_once(__DIR__ . '/../modelos/Cliente.php');

// Manejo de eliminación por GET
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = intval($_GET['id']);
        Cliente::eliminar($id);
        header("Location: ../vistas/clientes/index.php?msg=Cliente eliminado");
        exit();
    } else {
        echo "ID de cliente no especificado para eliminar.";
        exit();
    }
}

// Manejo de edición por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"])) {
    if ($_POST["accion"] == "editar" && isset($_POST["id"])) {
        Cliente::actualizar(
            $_POST["id"],
            $_POST["nombre"],
            $_POST["apellidos"],
            $_POST["correo"],
            $_POST["telefono"],
            $_POST["direccion"]
        );

        header("Location: ../vistas/clientes/index.php");
        exit();
    }
}


class ClienteControlador {
    public static function index() {
        $clientes = Cliente::obtenerTodos();
        include __DIR__ . '/../vistas/clientes/index.php';
    }

    public static function crear() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Cliente::crear($_POST["nombre"], $_POST["apellidos"], $_POST["correo"], $_POST["telefono"], $_POST["direccion"]);
            // Redirigir de forma absoluta con respecto al navegador
            header("Location: /sistema_pasteleria/vistas/clientes/index.php");
            exit();
        }
        include __DIR__ . '/../vistas/clientes/crear.php';
    }

    public static function editar() {
        if (!isset($_GET["id"])) {
            echo "Cliente no especificado";
            exit();
        }

        $cliente = Cliente::obtenerPorID($_GET["id"]);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Cliente::actualizar($_GET["id"], $_POST["nombre"], $_POST["apellidos"], $_POST["correo"], $_POST["telefono"], $_POST["direccion"]);
            header("Location: /sistema_pasteleria/vistas/clientes/index.php");
            exit();
        }

        include __DIR__ . '/../vistas/clientes/editar.php';
    }

    public static function eliminar() {
        if (isset($_GET["id"])) {
            Cliente::eliminar($_GET["id"]);
            header("Location: /sistema_pasteleria/vistas/clientes/index.php");
            exit();
        }
        echo "ID no proporcionado";
    }
}
