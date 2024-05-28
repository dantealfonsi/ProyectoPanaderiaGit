-- Volcado de datos para phpMyAdmin SQL
-- versión 5.0.4
-- https://www.phpmyadmin.net/
-- Daniel Alfonsi
-- Host: 127.0.0.1
-- Tiempo de generación: ? de Mayo de 2024 a las 04:26 PM
-- Versión del servidor: MariaDB
-- Versión de PHP: 8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendaPanaderia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `IDcarrito` bigint(20) NOT NULL,
  `IDusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`IDcarrito`, `IDusuario`) VALUES
(9, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemcarrito`
--

CREATE TABLE `itemcarrito` (
  `IDitemcarrito` bigint(20) NOT NULL,
  `IDproducto` bigint(20) NOT NULL,
  `IDcarrito` bigint(20) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `itemcarrito`
--

INSERT INTO `itemcarrito` (`IDitemcarrito`, `IDproducto`, `IDcarrito`, `precio`, `cantidad`, `fechaCreacion`) VALUES
(17, 2, 9, 25, 1, '2020-12-27 13:59:46'),
(18, 3, 9, 15, 3, '2020-12-27 14:18:52'),
(19, 5, 9, 60, 3, '2020-12-27 14:18:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `IDcategoria` bigint(20) NOT NULL,
  `nombre_categoria` varchar(30) NOT NULL,
  `descripcion_categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`IDcategoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
(1, 'pastel', 'pasteles con capa(s), glaseado y capa superior'),
(2, 'pastelito', 'pastel pequeño horneado en tazas de pastelito o muffin'),
(3, 'pastelpop', 'pastel en forma de paletas'),
(4, 'galleta', 'galletas horneadas circulares o de diferentes formas'),
(5, 'macaron', 'galletas y crema sándwich'),
(6, 'brownie', 'pasteles de chocolate fudge'),
(7, 'pasteleria', 'pasteles que no caen en ninguna otra categoría');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itempedido`
--

CREATE TABLE `itempedido` (
  `IDitempedido` bigint(20) NOT NULL,
  `IDproducto` bigint(20) NOT NULL,
  `IDpedido` bigint(20) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `itempedido`
--

INSERT INTO `itempedido` (`IDitempedido`, `IDproducto`, `IDpedido`, `precio`, `cantidad`, `fechaCreacion`) VALUES
(14, 1, 12, 25, 1, '2020-12-27 02:36:14'),
(15, 3, 12, 15, 2, '2020-12-27 02:36:14'),
(16, 2, 12, 25, 2, '2020-12-27 13:49:55'),
(17, 2, 12, 25, 4, '2020-12-27 13:58:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IDproducto` bigint(20) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion_producto` text NOT NULL,
  `imagen_producto` text NOT NULL,
  `precio_producto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IDproducto`, `nombre_producto`, `descripcion_producto`, `imagen_producto`, `precio_producto`) VALUES
(1, 'Pastelito de Vainilla', 'pastelito de vainilla con glaseado de vainilla', 'Assets\\images\\products\\cupcake_pic.png', 25),
(2, 'Pastelito de Terciopelo Rojo', 'pastelito de terciopelo rojo con glaseado de queso crema', 'Assets\\images\\products\\red_velvet_cupcake_pic.png', 25),
(3, 'Galleta con chispas de chocolate', 'galleta con chispas de chocolate', 'Assets\\images\\products\\cookies_pic.png', 15),

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_prueba`
--

CREATE TABLE `productos_prueba` (
  `IDproducto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion_producto` text NOT NULL,
  `IDcategoria_producto` int(11) NOT NULL,
  `IDtipo_producto` int(11) NOT NULL,
  `imagen_producto` text NOT NULL,
  `precio_producto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_prueba`
--

INSERT INTO `productos_prueba` (`IDproducto`, `nombre_producto`, `descripcion_producto`, `IDcategoria_producto`, `IDtipo_producto`, `imagen_producto`, `precio_producto`) VALUES
(1, 'Pastelito de Vainilla', 'pastelito de vainilla con glaseado de vainilla', 2, 2, 'Assets\\images\\products\\cupcake_pic.png', 25),
(2, 'Pastelito de Terciopelo Rojo', 'pastelito de terciopelo rojo con glaseado de queso crema', 2, 2, 'Assets\\images\\products\\red_velvet_cupcake_pic.png', 25),
(3, 'Galleta con chispas de chocolate', 'galleta con chispas de chocolate ', 4, 2, 'Assets\\images\\products\\cookies_pic.png', 15),
;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `IDproducto` bigint(20) NOT NULL,
  `IDcategoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`IDproducto`, `IDcategoria`) VALUES
(1, 2),
(2, 2),
(3, 4),
(4, 7),
(5, 7),
(6, 5),
(7, 2),
(8, 7),
(9, 7),
(10, 3),
(11, 2),
(12, 2),
(13, 6),
(14, 6),
(15, 6),
(16, 6),
(17, 6),
(18, 6),
(19, 6),
(20, 6),
(21, 6),
(22, 6),
(23, 6),
(24, 6),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

-- Estructura de tabla para la tabla `tipo_producto`
CREATE TABLE `tipo_producto` (
  `IDproducto` bigint(20) NOT NULL,
  `IDtipo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`IDproducto`, `IDtipo`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `IDtransaccion` bigint(20) NOT NULL,
  `IDusuario` bigint(20) NOT NULL,
  `IDpedido` bigint(20) NOT NULL,
  `metodoPago` text NOT NULL,
  `estado` text NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`IDtransaccion`, `IDusuario`, `IDpedido`, `metodoPago`, `estado`, `fechaCreacion`) VALUES
(12, 4, 12, 'tarjetaCredito', 'exitoso', '2020-12-27 02:36:14'),
(13, 4, 12, 'JuiceByMCB', 'exitoso', '2020-12-27 13:49:55'),
(14, 4, 12, 'tarjetaCredito', 'exitoso', '2020-12-27 13:58:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `IDtipo` bigint(20) NOT NULL,
  `nombre_tipo` varchar(30) NOT NULL,
  `descripcion_tipo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`IDtipo`, `nombre_tipo`, `descripcion_tipo`) VALUES
(1, 'nuevo', 'los productos nuevos se etiquetan como nuevos'),
(2, 'destacado', 'los productos que deben llamar la atención se etiquetan como destacados'),
(3, 'caliente', 'los productos en venta se etiquetan como calientes'),
(4, 'mejor', 'los productos más vendidos se etiquetan como mejores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDusuario` bigint(20) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `telefono` varchar(8) NOT NULL,
  `descripcion` text NOT NULL,
  `claveVerificacion` varchar(100) NOT NULL,
  `verificado` tinyint(1) NOT NULL,
  `suscrito` tinyint(1) NOT NULL,
  `esAdmin` tinyint(1) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDusuario`, `nombreUsuario`, `contrasena`, `nombre`, `apellido`, `correo`, `direccion`, `telefono`, `descripcion`, `claveVerificacion`, `verificado`, `suscrito`, `esAdmin`, `fechaCreacion`) VALUES
(1, 'oprah123', '$2y$10$pu.rx7.mCBuy.L/1WjJbiufyUm43iUHjqp9wVLcxqzH0H.qqqOrVm', 'Oprah', 'Windsor', 'vinoveg106@chatdays.com', 'Nueva York', '57458962', '', '18981cb084d8b9392a26041542908bdc', 1, 1, 1, '2020-12-25 17:59:23'),
(2, 'siri123', '$2y$10$F4agSnQaMewBbKKcoavmn.vmn4Utci5WM1KtFjQ7b/nSQm4lCbVkm', 'Siri', 'Windsor', 'tadoso1652@aranelab.com', '', '', '', 'e14520491a0cfcba3d5d9de1798273a5', 1, 0, 0, '2020-12-25 14:03:48'),
(3, 'sanjana2020', '$2y$10$YG6ch/.jzZ9.TGR1D6RVY.FMPHCGX52Bhy6BDYD.4HY4SZ6isovaS', 'sanjana', 'lolo', 'sanjana.ramchurun@umail.uom.ac.mu', '', '', '', 'b394c058279a76504793c869410d41b8', 1, 0, 0, '2020-12-26 18:16:08'),
(4, 'sanjana2021', '$2y$10$zwnOI5uDLMjFTPh9TuNBf.edR00sOnkp04SRHgkboTUyBDsIPYbZe', 'lala', 'lolo', 'katy61100@outlook.com', 'flic en flac', '55555555', 'lin bon', 'd7a55e39acca229015eb6224163b3298', 1, 0, 0, '2020-12-26 18:19:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_usuario`
--

CREATE TABLE `pedido_usuario` (
  `IDpedido` bigint(20) NOT NULL,
  `IDusuario` bigint(20) NOT NULL,
  `total` float NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(8) NOT NULL,
  `estado` text NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido_usuario`
--

INSERT INTO `pedido_usuario` (`IDpedido`, `IDusuario`, `total`, `direccion`, `telefono`, `estado`, `fechaCreacion`) VALUES
(12, 4, 55, 'flic en flac', '55555555', 'exitoso', '2020-12-27 02:36:14'),
(13, 4, 50, '22, Morc Anna', '55555555', 'exitoso', '2020-12-27 13:49:55'),
(14, 4, 100, '22, Morc Anna', '55555555', 'exitoso', '2020-12-27 13:58:44');

--
-- Índices para tablas volcadas
--

--
-- Índices para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`IDcarrito`),
  ADD KEY `IDusuario` (`IDusuario`);

--
-- Índices para la tabla `itemcarrito`
--
ALTER TABLE `itemcarrito`
  ADD PRIMARY KEY (`IDitemcarrito`),
  ADD KEY `1_Carrito_Cero-o-más_ItemsCarrito` (`IDcarrito`),
  ADD KEY `1_Producto_Muchos_ItemsCarrito` (`IDproducto`);

--
-- Índices para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IDcategoria`);

--
-- Índices para la tabla `itempedido`
--
-- ALTER TABLE para la tabla `itempedido`
ALTER TABLE `itempedido`
  ADD PRIMARY KEY (`IDitempedido`),
  ADD KEY `1_Pedido_Muchos_ItemsPedido` (`IDpedido`),
  ADD KEY `1_Producto_Muchos_ItemsPedido` (`IDproducto`);

--
-- Índices para la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IDproducto`);

--
-- Índices para la tabla `productos_prueba`
--
ALTER TABLE `productos_prueba`
  ADD PRIMARY KEY (`IDproducto`);

--
-- Índices para la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD KEY `1_Producto_Muchas_Categorias` (`IDproducto`),
  ADD KEY `1_Categoria_Muchos_Productos` (`IDcategoria`);

--
-- Índices para la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD KEY `1_Producto_Muchos_Tipos` (`IDproducto`),
  ADD KEY `1_Tipo_Muchos_Productos` (`IDtipo`);

--
-- Índices para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`IDtransaccion`),
  ADD KEY `1_Pedido_Muchas_Transacciones` (`IDpedido`),
  ADD KEY `1_Usuario_Muchas_Transacciones` (`IDusuario`);

--
-- Índices para la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`IDtipo`);

--
-- Índices para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDusuario`);

--
-- Índices para la tabla `pedido_usuario`
--
ALTER TABLE `pedido_usuario`
  ADD PRIMARY KEY (`IDpedido`),
  ADD KEY `1_Usuario_Muchos_Pedidos` (`IDusuario`);

--
-- AUTO_INCREMENT para tablas volcadas
--

--
-- AUTO_INCREMENT para la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `IDcarrito` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT para la tabla `itemcarrito`
--
ALTER TABLE `itemcarrito`
  MODIFY `IDitemcarrito` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT para la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `IDcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT para la tabla `itempedido`
--
ALTER TABLE `itempedido`
  MODIFY `IDitempedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT para la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IDproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT para la tabla `productos_prueba`
--
ALTER TABLE `productos_prueba`
  MODIFY `IDproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `IDtransaccion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT para la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `IDtipo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT para la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT para la tabla `pedido_usuario`
--
ALTER TABLE `pedido_usuario`
  MODIFY `IDpedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Restricciones para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`IDusuario`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricciones para la tabla `itemcarrito`
--
ALTER TABLE `itemcarrito`
  ADD CONSTRAINT `1_Carrito_Cero-o-más_ItemsCarrito` FOREIGN KEY (`IDcarrito`) REFERENCES `carrito` (`IDcarrito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `1_Producto_Muchos_ItemsCarrito` FOREIGN KEY (`IDproducto`) REFERENCES `productos` (`IDproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricciones para la tabla `itempedido`
--
ALTER TABLE `itempedido`
  ADD CONSTRAINT `1_Pedido_Muchos_ItemsPedido` FOREIGN KEY (`IDpedido`) REFERENCES `pedido_usuario` (`IDpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `1_Producto_Muchos_ItemsPedido` FOREIGN KEY (`IDproducto`) REFERENCES `productos` (`IDproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricciones para la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD CONSTRAINT `1_Categoria_Muchos_Productos` FOREIGN KEY (`IDcategoria`) REFERENCES `categorias` (`IDcategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `1_Producto_Muchas_Categorias` FOREIGN KEY (`IDproducto`) REFERENCES `productos` (`IDproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricciones para la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD CONSTRAINT `1_Producto_Muchos_Tipos` FOREIGN KEY (`IDproducto`) REFERENCES `productos` (`IDproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `1_Tipo_Muchos_Productos` FOREIGN KEY (`IDtipo`) REFERENCES `tipos` (`IDtipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricciones para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `1_Pedido_Muchas_Transacciones` FOREIGN KEY (`IDpedido`) REFERENCES `pedido_usuario` (`IDpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `1_Usuario_Muchas_Transacciones` FOREIGN KEY (`IDusuario`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricciones para la tabla `pedido_usuario`
--
ALTER TABLE `pedido_usuario`
  ADD CONSTRAINT `1_Usuario_Muchos_Pedidos` FOREIGN KEY (`IDusuario`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;