<?php
require_once "Conexion.php";

class Proveedor {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::conectar();
    }

    public function obtenerProveedores() {
        $sql = "SELECT * FROM proveedores WHERE Estado != 'Eliminado'";
        return $this->conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProveedorPorID($id) {
        $sql = "SELECT * FROM proveedores WHERE ID_Proveedor = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearProveedor($data) {
        $sql = "INSERT INTO proveedores (Razon_Social, RUC, Tipo_Producto, Telefono, Direccion, Correo)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            $data['Razon_Social'],
            $data['RUC'],
            $data['Tipo_Producto'],
            $data['Telefono'],
            $data['Direccion'],
            $data['Correo']
        ]);
    }

    public function actualizarProveedor($id, $data) {
        $sql = "UPDATE proveedores SET Razon_Social=?, RUC=?, Tipo_Producto=?, Telefono=?, Direccion=?, Correo=?
                WHERE ID_Proveedor=?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            $data['Razon_Social'],
            $data['RUC'],
            $data['Tipo_Producto'],
            $data['Telefono'],
            $data['Direccion'],
            $data['Correo'],
            $id
        ]);
    }

    public function eliminarProveedor($id) {
        $sql = "UPDATE proveedores SET Estado = 'Eliminado' WHERE ID_Proveedor = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$id]);
    }
}
