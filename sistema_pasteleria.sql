-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2025 a las 07:27:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_pasteleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `ID_Categoria` int(11) NOT NULL,
  `Nombre_Categoria` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Estado` varchar(10) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID_Categoria`, `Nombre_Categoria`, `Descripcion`, `Estado`) VALUES
(1, 'Tortas Especiales', 'Tortas personalizadas para eventos importantes como cumpleaños, bodas, aniversarios o celebraciones únicas. Se destacan por su diseño exclusivo y presentación detallada', 'Activo'),
(2, 'Tortas Frias', 'Tortas refrigeradas con ingredientes especiales.', 'Activo'),
(3, 'Tortas Clasicas', 'Las tortas clásicas de siempre, hechas con ingredientes de calidad.', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Nombre`, `Apellidos`, `Correo`, `Telefono`, `Direccion`) VALUES
(2, 'Juan', 'Alimaña', 'alimana@gmail.com', '959595959', 'Calle Guatemala 101'),
(3, 'Bryan ', 'Quempes', 'bryanquempes@gmail.com', '959563161', 'Av. 15 de Agosto 1001'),
(4, 'Angela', 'Torreblanca', 'torreblancaangela@gmail.com', '959595957', 'cerro camote C-1'),
(5, 'Diana', 'Maquera', 'maqueradiana@outlook.com', '989895562', 'Av. Parra 757');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `ID_Detalle` int(11) NOT NULL,
  `ID_Venta` int(11) DEFAULT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_Unitario` decimal(10,2) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`ID_Detalle`, `ID_Venta`, `ID_Producto`, `Cantidad`, `Precio_Unitario`, `Subtotal`) VALUES
(1, 3, 4, 2, 95.00, 0.00),
(2, 3, 5, 1, 85.00, 0.00),
(3, 4, 5, 2, 85.00, 0.00),
(4, 4, 6, 1, 90.00, 0.00),
(5, 5, 6, 1, 90.00, 0.00),
(6, 6, 6, 1, 90.00, 90.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  `Categoria` varchar(50) DEFAULT NULL,
  `Stock` int(11) DEFAULT 0,
  `Fecha_Creacion` datetime DEFAULT current_timestamp(),
  `Estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `ID_Categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Nombre`, `Descripcion`, `Precio`, `Imagen`, `Categoria`, `Stock`, `Fecha_Creacion`, `Estado`, `ID_Categoria`) VALUES
(3, 'Bavarois de Maracuyá', NULL, 75.00, NULL, 'Tortas Frias', 8, '2025-07-23 21:38:33', 'Activo', NULL),
(4, 'Torta Helada', NULL, 95.00, NULL, 'Tortas Frias', 1, '2025-07-24 11:32:09', 'Activo', NULL),
(5, 'Torta Tres Leches', NULL, 85.00, NULL, 'Tortas Especiales', 1, '2025-07-24 17:15:06', 'Activo', NULL),
(6, 'Selva Negra', NULL, 90.00, NULL, 'Tortas Especiales', 7, '2025-07-24 17:16:22', 'Activo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_Proveedor` int(11) NOT NULL,
  `Razon_Social` varchar(100) DEFAULT NULL,
  `RUC` varchar(11) DEFAULT NULL,
  `Tipo_Producto` varchar(50) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ID_Proveedor`, `Razon_Social`, `RUC`, `Tipo_Producto`, `Telefono`, `Direccion`, `Correo`, `Estado`) VALUES
(1, 'Nestle Peru S.A.', '20123456789', 'Lacteos', '987654321', 'Cal. Luis Galvani Nro. 493 - Lima', 'nestleperu@gmail.com', 'Activo'),
(2, 'ss', 's', 'ss', 'ss', 'ss', 'ss@gmail.com', 'Eliminado'),
(3, 'Dulce Aroma Peru', '20544812658', 'Decoracion', '989646412', 'Av. Circunvalacion 100', 'aromasperu@outlook.com', 'Activo'),
(4, 'Mercado Mayorista', '10234584688', 'Frutas Frescas', '942364111', 'Calle Principal ', 'mercadomayorista@hotmail.com', 'Activo'),
(5, 'San Fernando', '10564598712', 'Huevos', '986456289', 'Av. Fernandini 515', 'sanfernando@outlook.com', 'Activo'),
(6, 'Molinos Modernos', '20986545231', 'Harina de Trigo', '986423178', 'Av. las flores 187', 'molinosmodernos@gmail.com', 'Activo'),
(7, 'Chocolates Helena', '20894514511', 'Chocolates, cacao en polvo', '985611546', 'Calle las Begonias ', 'helenachocolates@gmail.com', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `clave`) VALUES
(1, 'diana', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5'),
(2, 'sergio', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5'),
(3, 'jimena', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5'),
(4, 'jennifer', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID_Venta` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `ID_Cliente` int(11) DEFAULT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Tipo_Pago` enum('Contado','Crédito') NOT NULL,
  `Estado` enum('Completada','Anulada') DEFAULT 'Completada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID_Venta`, `Fecha`, `Hora`, `ID_Cliente`, `Total`, `Tipo_Pago`, `Estado`) VALUES
(3, '2025-07-24', '17:24:00', 4, 275.00, 'Contado', 'Completada'),
(4, '2025-07-24', '18:10:00', 3, 260.00, 'Contado', 'Completada'),
(5, '2025-07-25', '11:41:00', 5, 90.00, 'Contado', 'Completada'),
(6, '2025-07-27', '14:34:00', 5, 90.00, 'Crédito', 'Completada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`ID_Detalle`),
  ADD KEY `ID_Venta` (`ID_Venta`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `fk_categoria` (`ID_Categoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_Venta`),
  ADD KEY `ID_Cliente` (`ID_Cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `ID_Detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID_Venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`ID_Venta`) REFERENCES `ventas` (`ID_Venta`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`ID_Categoria`) REFERENCES `categorias` (`ID_Categoria`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
