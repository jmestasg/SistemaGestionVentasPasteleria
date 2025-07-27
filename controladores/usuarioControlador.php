<?php
require_once 'modelos/Usuario.php';

class UsuarioControlador {
    public static function login($usuario, $clave) {
        $datos = Usuario::validar($usuario, $clave);
        if ($datos) {
            session_start();
            $_SESSION['usuario'] = $datos['nombre_usuario'];
            header("Location: vistas/dashboard.php");
        } else {
            session_start();
            $_SESSION['error'] = "Usuario o contraseña incorrectos";
            header("Location: login.php");
        }
    }
}
?>
