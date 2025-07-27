<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'controladores/usuarioControlador.php';
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';
    UsuarioControlador::login($usuario, $clave);
} else {
    header("Location: login.php");
    exit();
}
