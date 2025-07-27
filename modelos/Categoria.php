<?php
require_once(__DIR__ . '/Conexion.php');

class Categoria {

    public static function obtenerTodas() {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM categorias";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function crear($nombre_categoria, $descripcion, $estado) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO categorias (Nombre_Categoria, Descripcion, Estado) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([$nombre_categoria, $descripcion, $estado]);
    }

    public static function obtenerPorId($id) {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM categorias WHERE ID_Categoria = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizar($id, $nombre_categoria, $descripcion, $estado) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE categorias SET Nombre_Categoria = ?, Descripcion = ?, Estado = ? WHERE ID_Categoria = ?";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([$nombre_categoria, $descripcion, $estado, $id]);
    }

    public static function eliminar($id) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM categorias WHERE ID_Categoria = ?";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([$id]);
    }
}
