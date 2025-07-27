<?php
require_once(__DIR__ . "/Conexion.php");

class Producto
{
    public static function obtenerTodos()
    {
        $bd = Conexion::conectar();
        $sql = "SELECT * FROM productos";
        return $bd->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorId($id)
    {
        $bd = Conexion::conectar();
        $sql = "SELECT * FROM productos WHERE ID_Producto = ?";
        $stmt = $bd->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function crear($nombre, $precio, $categoria, $stock, $estado)
    {
        $bd = Conexion::conectar();
        $sql = "INSERT INTO productos (Nombre, Precio, Categoria, Stock, Estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $bd->prepare($sql);
        return $stmt->execute([$nombre, $precio, $categoria, $stock, $estado]);
    }

    public static function actualizar($id, $nombre, $precio, $categoria, $stock, $estado)
    {
        $bd = Conexion::conectar();
        $sql = "UPDATE productos SET Nombre=?, Precio=?, Categoria=?, Stock=?, Estado=? WHERE ID_Producto=?";
        $stmt = $bd->prepare($sql);
        return $stmt->execute([$nombre, $precio, $categoria, $stock, $estado, $id]);
    }

    public static function eliminar($id)
    {
        $bd = Conexion::conectar();
        $sql = "DELETE FROM productos WHERE ID_Producto=?";
        $stmt = $bd->prepare($sql);
        return $stmt->execute([$id]);
    }

    public static function buscarPorNombre($nombre) {
    $conexion = Conexion::conectar();
    $sql = "SELECT * FROM productos WHERE Nombre LIKE :nombre ORDER BY ID_Producto DESC";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':nombre' => '%' . $nombre . '%']);
    return $stmt->fetchAll();
}

}
