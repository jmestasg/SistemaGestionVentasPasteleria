<?php
require_once "Conexion.php";

class Cliente {
    public static function obtenerTodos() {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM clientes";
        return $conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function crear($nombre, $apellidos, $correo, $telefono, $direccion) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO clientes (Nombre, Apellidos, Correo, Telefono, Direccion)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([$nombre, $apellidos, $correo, $telefono, $direccion]);
    }

    public static function obtenerPorID($id) {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM clientes WHERE ID_Cliente = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizar($id, $nombre, $apellidos, $correo, $telefono, $direccion) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE clientes SET Nombre = ?, Apellidos = ?, Correo = ?, Telefono = ?, Direccion = ?
                WHERE ID_Cliente = ?";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([$nombre, $apellidos, $correo, $telefono, $direccion, $id]);
    }

    public static function eliminar($id) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM clientes WHERE ID_Cliente = ?";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([$id]);
    }
}
