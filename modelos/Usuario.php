<?php
require_once 'Conexion.php';

class Usuario {
    public static function validar($usuario, $clave) {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :usuario AND clave = SHA2(:clave, 256)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute(['usuario' => $usuario, 'clave' => $clave]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
