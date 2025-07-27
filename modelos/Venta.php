<?php
require_once(__DIR__ . '/Conexion.php');

class Venta {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::conectar(); // Se asegura la conexión al instanciar la clase
    }

    // Obtener todas las ventas
    public static function obtenerTodas() {
        $conexion = Conexion::conectar();
        $sql = "SELECT v.ID_Venta, v.Fecha, v.Hora, c.Nombre AS Cliente, v.Total, v.Tipo_Pago, v.Estado
                FROM ventas v
                LEFT JOIN clientes c ON v.ID_Cliente = c.ID_Cliente
                ORDER BY v.Fecha DESC, v.Hora DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Obtener ventas entre fechas (para reportes por fecha)
    public function obtenerVentasPorFechas($inicio, $fin) {
        $sql = "SELECT v.Fecha, v.Hora, c.Nombre AS Cliente, v.Total, v.Tipo_Pago
                FROM ventas v
                INNER JOIN clientes c ON v.ID_Cliente = c.ID_Cliente
                WHERE v.Fecha BETWEEN :inicio AND :fin
                ORDER BY v.Fecha ASC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':inicio', $inicio);
        $stmt->bindParam(':fin', $fin);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerVentasPorCliente($nombreCliente)
    {
    $consulta = $this->conexion->prepare("
    SELECT v.*, CONCAT(c.Nombre, ' ', c.Apellidos) AS Cliente 
    FROM ventas v
    JOIN clientes c ON v.ID_Cliente = c.ID_Cliente
    WHERE c.Nombre LIKE :nombre
");

    $consulta->execute([':nombre' => "%$nombreCliente%"]);
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }


    public function obtenerVentasPorProducto($producto) {
    $sql = "SELECT v.Fecha, p.nombre AS Nombre_Producto, d.Cantidad, d.Subtotal
            FROM ventas v
            JOIN detalle_venta d ON v.ID_Venta = d.ID_Venta
            JOIN productos p ON d.ID_Producto = p.ID_Producto
            WHERE p.nombre LIKE :producto
            ORDER BY v.Fecha DESC";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(['producto' => "%$producto%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function obtenerRankingVentas() {
    $sql = "SELECT v.Total, v.Tipo_Pago, v.Fecha, c.Nombre AS Cliente
            FROM ventas v
            JOIN clientes c ON v.ID_Cliente = c.ID_Cliente
            ORDER BY v.Total DESC
            LIMIT 10";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Registrar una nueva venta
    public static function registrar($fecha, $hora, $id_cliente, $total, $tipo_pago, $detalleProductos = []) {
        $conexion = Conexion::conectar();
        try {
            $conexion->beginTransaction();

            $sqlVenta = "INSERT INTO ventas (Fecha, Hora, ID_Cliente, Total, Tipo_Pago)
                         VALUES (?, ?, ?, ?, ?)";
            $stmtVenta = $conexion->prepare($sqlVenta);
            $stmtVenta->execute([$fecha, $hora, $id_cliente, $total, $tipo_pago]);
            $idVenta = $conexion->lastInsertId();

            foreach ($detalleProductos as $item) {
                $sqlCheckStock = "SELECT Stock FROM productos WHERE ID_Producto = ?";
                $stmtCheck = $conexion->prepare($sqlCheckStock);
                $stmtCheck->execute([$item['ID_Producto']]);
                $stock = $stmtCheck->fetchColumn();

                if ($stock < $item['Cantidad']) {
                    throw new Exception("Stock insuficiente para el producto ID: " . $item['ID_Producto']);
                }

                $precio = $item['Precio'];
                $cantidad = $item['Cantidad'];
                $subtotal = $precio * $cantidad;

                $sqlDetalle = "INSERT INTO detalle_venta (ID_Venta, ID_Producto, Cantidad, Precio_Unitario, Subtotal)
                               VALUES (?, ?, ?, ?, ?)";
                $stmtDetalle = $conexion->prepare($sqlDetalle);
                $stmtDetalle->execute([$idVenta, $item['ID_Producto'], $cantidad, $precio, $subtotal]);

                $sqlStock = "UPDATE productos SET Stock = Stock - ? WHERE ID_Producto = ?";
                $stmtStock = $conexion->prepare($sqlStock);
                $stmtStock->execute([$cantidad, $item['ID_Producto']]);
            }

            $conexion->commit();
            return true;
        } catch (Exception $e) {
            $conexion->rollBack();
            return false;
        }
    }

    // Anular venta (devolver stock y marcar estado)
    public static function anular($idVenta) {
        $conexion = Conexion::conectar();

        try {
            $conexion->beginTransaction();

            $sqlDetalles = "SELECT ID_Producto, Cantidad FROM detalle_venta WHERE ID_Venta = ?";
            $stmtDetalles = $conexion->prepare($sqlDetalles);
            $stmtDetalles->execute([$idVenta]);
            $detalles = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);

            foreach ($detalles as $detalle) {
                $sqlStock = "UPDATE productos SET Stock = Stock + ? WHERE ID_Producto = ?";
                $stmtStock = $conexion->prepare($sqlStock);
                $stmtStock->execute([$detalle['Cantidad'], $detalle['ID_Producto']]);
            }

            $sqlAnular = "UPDATE ventas SET Estado = 'Anulada' WHERE ID_Venta = ?";
            $stmtAnular = $conexion->prepare($sqlAnular);
            $stmtAnular->execute([$idVenta]);

            $conexion->commit();
            return true;
        } catch (PDOException $e) {
            $conexion->rollBack();
            return false;
        }
    }
}
