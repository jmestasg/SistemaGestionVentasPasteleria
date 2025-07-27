<?php
require_once __DIR__ . '/../../modelos/Conexion.php';
$conexion = Conexion::conectar();

// Obtener clientes y productos
$clientes = $conexion->query("SELECT ID_Cliente, Nombre FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
$productos = $conexion->query("SELECT ID_Producto, Nombre, Precio FROM productos")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Registrar Nueva Venta</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="../../controladores/ventaControlador.php" method="POST">
        <input type="hidden" name="registrar_venta" value="1">

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>
            <div class="col-md-4">
                <label for="hora" class="form-label">Hora:</label>
                <input type="time" class="form-control" name="hora" required>
            </div>
            <div class="col-md-4">
                <label for="id_cliente" class="form-label">Cliente:</label>
                <select name="id_cliente" class="form-select" required>
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente['ID_Cliente'] ?>"><?= htmlspecialchars($cliente['Nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="tipo_pago" class="form-label">Tipo de pago:</label>
            <select name="tipo_pago" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="Contado">Contado</option>
                <option value="Crédito">Crédito</option>
            </select>
        </div>

        <h5>Productos</h5>
        <table class="table table-bordered" id="tabla-productos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="body-productos"></tbody>
        </table>

        <button type="button" class="btn btn-secondary mb-3" onclick="agregarProducto()">+ Agregar Producto</button>
        <br>
        <button type="submit" class="btn btn-success">Registrar Venta</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>

    <script>
        const productosDisponibles = <?= json_encode($productos) ?>;

        function agregarProducto() {
            const tbody = document.getElementById('body-productos');
            const index = tbody.querySelectorAll('tr').length;

            const fila = document.createElement('tr');

            // Producto
            const tdProducto = document.createElement('td');
            const select = document.createElement('select');
            select.name = `productos[${index}][ID_Producto]`;
            select.className = 'form-select';
            select.required = true;

            const opcionVacia = document.createElement('option');
            opcionVacia.value = '';
            opcionVacia.text = 'Seleccione';
            select.appendChild(opcionVacia);

            productosDisponibles.forEach(prod => {
                const option = document.createElement('option');
                option.value = prod.ID_Producto;
                option.text = prod.Nombre;
                option.dataset.precio = prod.Precio;
                select.appendChild(option);
            });

            select.onchange = function () {
                const precio = this.selectedOptions[0].dataset.precio;
                inputPrecio.value = precio || '';
            };

            tdProducto.appendChild(select);

            // Cantidad
            const tdCantidad = document.createElement('td');
            const inputCantidad = document.createElement('input');
            inputCantidad.type = 'number';
            inputCantidad.min = 1;
            inputCantidad.name = `productos[${index}][Cantidad]`;
            inputCantidad.className = 'form-control';
            inputCantidad.required = true;
            tdCantidad.appendChild(inputCantidad);

            // Precio
            const tdPrecio = document.createElement('td');
            const inputPrecio = document.createElement('input');
            inputPrecio.type = 'number';
            inputPrecio.min = 0.01;
            inputPrecio.step = '0.01';
            inputPrecio.name = `productos[${index}][Precio]`;
            inputPrecio.className = 'form-control';
            inputPrecio.required = true;
            tdPrecio.appendChild(inputPrecio);

            // Acción
            const tdAccion = document.createElement('td');
            const btnEliminar = document.createElement('button');
            btnEliminar.type = 'button';
            btnEliminar.className = 'btn btn-danger btn-sm';
            btnEliminar.textContent = 'Eliminar';
            btnEliminar.onclick = () => fila.remove();
            tdAccion.appendChild(btnEliminar);

            fila.appendChild(tdProducto);
            fila.appendChild(tdCantidad);
            fila.appendChild(tdPrecio);
            fila.appendChild(tdAccion);

            tbody.appendChild(fila);

            // Disparar onchange inicial para setear precio si hay uno
            select.dispatchEvent(new Event('change'));
        }
    </script>
</body>
</html>
