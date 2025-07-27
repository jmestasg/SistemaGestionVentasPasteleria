<?php
class Conexion {
    public static function conectar() {
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=sistema_pasteleria", "root", "");
            $conexion->exec("SET NAMES utf8");
            return $conexion;
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
}
?>
