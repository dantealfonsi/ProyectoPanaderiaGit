-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2024 a las 04:52:53
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendapanaderia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `IDcarrito` bigint(20) NOT NULL,
  `IDusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`IDcarrito`, `IDusuario`) VALUES
(18, 5),
(17, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `IDcategoria` bigint(20) NOT NULL,
  `nombre_categoria` varchar(30) NOT NULL,
  `descripcion_categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `IDproducto` bigint(20) NOT NULL,
  `IDcategoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `ID` int(11) NOT NULL,
  `IDpedido` bigint(20) DEFAULT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `AMO` varchar(34) DEFAULT NULL,
  `ENVIA` varchar(34) DEFAULT NULL,
  `RECIBE` varchar(34) DEFAULT NULL,
  `MENSAJE` text DEFAULT NULL,
  `ACTIVO` int(11) DEFAULT 0,
  `LEIDO` int(11) DEFAULT 0,
  `CERRADO` int(11) DEFAULT 0,
  `BG` varchar(34) DEFAULT '#DEEEF3',
  `FG` varchar(34) DEFAULT '#4D4D4D'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`ID`, `IDpedido`, `FECHA`, `AMO`, `ENVIA`, `RECIBE`, `MENSAJE`, `ACTIVO`, `LEIDO`, `CERRADO`, `BG`, `FG`) VALUES
(23, 10, '2024-05-24 02:39:37', '5', '5', '6', 'hola', 0, 1, 0, '#F5C5DD', '#4D4D4D'),
(24, 10, '2024-05-24 02:45:23', '6', '6', '5', 'dime', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(25, 10, '2024-05-24 02:48:52', '5', '5', '6', 'aqui estoy', 0, 1, 0, '#F5C5DD', '#4D4D4D');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `itempedido`
--

INSERT INTO `itempedido` (`IDitempedido`, `IDproducto`, `IDpedido`, `precio`, `cantidad`, `fechaCreacion`) VALUES
(24, 88, 9, 22, 1, '2024-05-19 23:54:55'),
(25, 1, 10, 25, 1, '2024-05-19 23:56:11'),
(26, 88, 10, 22, 1, '2024-05-19 23:56:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `IDusuario` bigint(20) DEFAULT NULL,
  `UBICACION` varchar(200) DEFAULT NULL,
  `NOTICIA` text DEFAULT NULL,
  `BG` varchar(255) DEFAULT '#FFC0CB',
  `FG` varchar(255) DEFAULT '#1A1A1A',
  `VISTO` int(11) NOT NULL DEFAULT 0,
  `BLOQUEADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_usuario`
--

INSERT INTO `pedido_usuario` (`IDpedido`, `IDusuario`, `total`, `direccion`, `telefono`, `estado`, `fechaCreacion`) VALUES
(9, 6, 22, '1234 caca', '04264804', 'FALLIDO', '2024-05-22 15:48:56'),
(10, 6, 47, '1234 caca', '04264804', 'EXITOSO', '2024-05-22 13:28:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IDproducto` bigint(20) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion_producto` text NOT NULL,
  `imagen_producto` text NOT NULL,
  `precio_producto` float NOT NULL,
  `categoria_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IDproducto`, `nombre_producto`, `descripcion_producto`, `imagen_producto`, `precio_producto`, `categoria_producto`) VALUES
(1, 'Random', 'AASDASDASDASD', 'Assets\\images\\products\\cupcake_pic.png', 25, 0),
(88, 'papa', 'papas en manteca', 'productoimagenes\\9af6de2a0d.png', 22, 0),
(89, 'asdasdasd', 'asDASDASD', 'productoimagenes\\e240b42727.png', 546, 3),
(90, 'asdasdasd', 'asasd', 'productoimagenes\\bda1d33888.png', 656559, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `IDtipo` bigint(20) NOT NULL,
  `nombre_tipo` varchar(30) NOT NULL,
  `descripcion_tipo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `IDproducto` bigint(20) NOT NULL,
  `IDtipo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`IDtransaccion`, `IDusuario`, `IDpedido`, `metodoPago`, `estado`, `fechaCreacion`) VALUES
(23, 6, 9, 'efectivo', 'FALLIDO', '2024-05-22 15:48:56'),
(24, 6, 10, 'transferencia', 'EXITOSO', '2024-05-22 13:28:12');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDusuario`, `nombreUsuario`, `contrasena`, `nombre`, `apellido`, `correo`, `direccion`, `telefono`, `descripcion`, `claveVerificacion`, `verificado`, `suscrito`, `esAdmin`, `fechaCreacion`) VALUES
(1, 'oprah123', '$2y$10$V36s47xci9IwmUMJAQJQ..PAQz9i4ZrST15KibRrdaEzqVwNmRoie', 'Oprah', 'Windsor', 'vinoveg106@chatdays.com', 'Nueva York', '57458962', '', '18981cb084d8b9392a26041542908bdc', 1, 1, 1, '2024-05-15 01:24:38'),
(2, 'siri123', '$2y$10$F4agSnQaMewBbKKcoavmn.vmn4Utci5WM1KtFjQ7b/nSQm4lCbVkm', 'Siri', 'Windsor', 'tadoso1652@aranelab.com', '', '', '', 'e14520491a0cfcba3d5d9de1798273a5', 1, 0, 0, '2020-12-25 14:03:48'),
(3, 'sanjana2020', '$2y$10$YG6ch/.jzZ9.TGR1D6RVY.FMPHCGX52Bhy6BDYD.4HY4SZ6isovaS', 'sanjana', 'lolo', 'sanjana.ramchurun@umail.uom.ac.mu', '', '', '', 'b394c058279a76504793c869410d41b8', 1, 0, 0, '2020-12-26 18:16:08'),
(4, 'sanjana2021', '$2y$10$zwnOI5uDLMjFTPh9TuNBf.edR00sOnkp04SRHgkboTUyBDsIPYbZe', 'lala', 'lolo', 'katy61100@outlook.com', 'flic en flac', '55555555', 'lin bon', 'd7a55e39acca229015eb6224163b3298', 1, 0, 0, '2020-12-26 18:19:45'),
(5, 'pepes', '$2y$10$wkoJJFdBY1IyahK2PXwu/.AnGrWdh5KpijABJ32CdfHF/TzOqShTC', 'pepexx', 'verazxx', 'pepe@gmail.com', 'xx xxxx', 'xxx', 'xxx', 'f424ffb8411b6cefe3bd4f3461371575', 1, 0, 1, '2024-05-15 13:40:55'),
(6, 'pedro', '$2y$10$KXCKoqgWEmhVkS4W006XD.80YuhlK72umUALwFJBTp9l9mJ025NHO', 'Pedro', 'Parker', 'pedroparker@gmail.com', '', '04264804', '', 'd2612ee7435844101f35be825b58ef36', 1, 0, 0, '2024-05-19 22:05:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`IDcarrito`),
  ADD KEY `IDusuario` (`IDusuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IDcategoria`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD KEY `1_Producto_Muchas_Categorias` (`IDproducto`),
  ADD KEY `1_Categoria_Muchos_Productos` (`IDcategoria`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `itemcarrito`
--
ALTER TABLE `itemcarrito`
  ADD PRIMARY KEY (`IDitemcarrito`),
  ADD KEY `1_Carrito_Cero-o-más_ItemsCarrito` (`IDcarrito`),
  ADD KEY `1_Producto_Muchos_ItemsCarrito` (`IDproducto`);

--
-- Indices de la tabla `itempedido`
--
ALTER TABLE `itempedido`
  ADD PRIMARY KEY (`IDitempedido`),
  ADD KEY `1_Pedido_Muchos_ItemsPedido` (`IDpedido`),
  ADD KEY `1_Producto_Muchos_ItemsPedido` (`IDproducto`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `pedido_usuario`
--
ALTER TABLE `pedido_usuario`
  ADD PRIMARY KEY (`IDpedido`),
  ADD KEY `1_Usuario_Muchos_Pedidos` (`IDusuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IDproducto`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`IDtipo`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD KEY `1_Producto_Muchos_Tipos` (`IDproducto`),
  ADD KEY `1_Tipo_Muchos_Productos` (`IDtipo`) USING BTREE;

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`IDtransaccion`),
  ADD KEY `1_Pedido_Muchas_Transacciones` (`IDpedido`),
  ADD KEY `1_Usuario_Muchas_Transacciones` (`IDusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `IDcarrito` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `IDcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `itemcarrito`
--
ALTER TABLE `itemcarrito`
  MODIFY `IDitemcarrito` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `itempedido`
--
ALTER TABLE `itempedido`
  MODIFY `IDitempedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedido_usuario`
--
ALTER TABLE `pedido_usuario`
  MODIFY `IDpedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IDproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `IDtipo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `IDtransaccion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
