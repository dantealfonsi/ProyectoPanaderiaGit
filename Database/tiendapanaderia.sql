-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2024 a las 23:06:37
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
-- Base de datos: `tiendapanaderia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carac_devolucion_entrada`
--

CREATE TABLE `carac_devolucion_entrada` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `codigo_producto` varchar(15) DEFAULT NULL,
  `nombre_producto` varchar(34) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `referencia` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carac_devolucion_entrada`
--

INSERT INTO `carac_devolucion_entrada` (`id`, `fecha`, `codigo_producto`, `nombre_producto`, `cantidad`, `referencia`, `precio`) VALUES
(2, '2024-06-23 20:56:53', '0002', '', 2, 625846, 8.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carac_devolucion_salida`
--

CREATE TABLE `carac_devolucion_salida` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `codigo_producto` varchar(15) DEFAULT NULL,
  `nombre_producto` varchar(34) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `referencia` int(11) NOT NULL DEFAULT 0,
  `cedula_cliente` int(9) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carac_devolucion_salida`
--

INSERT INTO `carac_devolucion_salida` (`id`, `fecha`, `codigo_producto`, `nombre_producto`, `cantidad`, `referencia`, `cedula_cliente`, `precio`) VALUES
(3, '2024-06-23 21:04:53', '0002', '', 1, 433635, NULL, 8.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carac_entrada`
--

CREATE TABLE `carac_entrada` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `codigo_producto` varchar(15) DEFAULT NULL,
  `nombre_producto` varchar(34) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `num_entrada` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carac_entrada`
--

INSERT INTO `carac_entrada` (`id`, `fecha`, `codigo_producto`, `nombre_producto`, `cantidad`, `num_entrada`, `precio`) VALUES
(8, '2024-06-23 19:16:55', '0002', 'huevo', 10, 625846, 8.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carac_salida`
--

CREATE TABLE `carac_salida` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `codigo_producto` varchar(15) DEFAULT NULL,
  `nombre_producto` varchar(34) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `num_salida` int(11) NOT NULL DEFAULT 0,
  `cedula_cliente` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carac_salida`
--

INSERT INTO `carac_salida` (`id`, `fecha`, `codigo_producto`, `nombre_producto`, `cantidad`, `num_salida`, `cedula_cliente`) VALUES
(12, '2024-06-23 19:17:43', '0002', 'huevo', 2, 433635, 5),
(13, '2024-06-23 19:17:44', '0101', 'harina de trigo', 100, 433635, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idcarrito` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`idcarrito`, `idusuario`) VALUES
(19, 5),
(20, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` bigint(20) NOT NULL,
  `nombre_categoria` varchar(30) NOT NULL,
  `descripcion_categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
(4, 'galleta', 'galletas horneadas circulares o de diferentes formas'),
(7, 'pasteleria', 'pasteles que no caen en ninguna otra categoría'),
(9, 'tortas de chocolate', ''),
(10, 'tortas de navidad', ''),
(11, 'tortas de cumpleaños', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_insumos`
--

CREATE TABLE `categoria_insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(34) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_insumos`
--

INSERT INTO `categoria_insumos` (`id`, `nombre`) VALUES
(1, 'harinas'),
(5, 'huevos'),
(6, 'sales'),
(7, 'azucares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `idpedido` bigint(20) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `amo` varchar(34) DEFAULT NULL,
  `envia` varchar(34) DEFAULT NULL,
  `recibe` varchar(34) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `activo` int(11) DEFAULT 0,
  `leido` int(11) DEFAULT 0,
  `cerrado` int(11) DEFAULT 0,
  `bg` varchar(34) DEFAULT '#DEEEF3',
  `fg` varchar(34) DEFAULT '#4D4D4D'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `idpedido`, `fecha`, `amo`, `envia`, `recibe`, `mensaje`, `activo`, `leido`, `cerrado`, `bg`, `fg`) VALUES
(45, 20, '2024-06-23 03:29:00', '', '6', '5', 'hola', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(46, 20, '2024-06-23 04:25:53', '', '5', '6', 'deme sus datos', 0, 1, 0, '#ff7380', '#4D4D4D'),
(47, 20, '2024-06-23 15:39:55', '', '6', '5', '0102 - V28129366', 0, 1, 0, '#DADFE8', '#4D4D4D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `de5`
--

CREATE TABLE `de5` (
  `id` int(11) NOT NULL,
  `codigo_producto` varchar(15) DEFAULT NULL,
  `nombre_producto` varchar(34) DEFAULT NULL,
  `proveedor` varchar(34) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `de5`
--

INSERT INTO `de5` (`id`, `codigo_producto`, `nombre_producto`, `proveedor`, `cantidad`, `precio`) VALUES
(1, '0002', 'huevo', 'Didapax', 2, 8.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion_entrada`
--

CREATE TABLE `devolucion_entrada` (
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `responsable` int(9) DEFAULT NULL,
  `referencia` int(11) NOT NULL DEFAULT 0,
  `motivo` text DEFAULT NULL,
  `proveedor` varchar(34) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devolucion_entrada`
--

INSERT INTO `devolucion_entrada` (`fecha`, `responsable`, `referencia`, `motivo`, `proveedor`) VALUES
('2024-06-23 20:56:53', 5, 625846, 'Daño', 'Didapax');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion_salida`
--

CREATE TABLE `devolucion_salida` (
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `responsable` int(9) DEFAULT NULL,
  `referencia` int(11) NOT NULL DEFAULT 0,
  `motivo` text DEFAULT NULL,
  `cedula_cliente` int(9) DEFAULT NULL,
  `subtotal` decimal(13,2) DEFAULT 0.00,
  `iva` decimal(13,2) DEFAULT 0.00,
  `total` decimal(13,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devolucion_salida`
--

INSERT INTO `devolucion_salida` (`fecha`, `responsable`, `referencia`, `motivo`, `cedula_cliente`, `subtotal`, `iva`, `total`) VALUES
('2024-06-23 21:04:53', 5, 433635, 'Daño', 5, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ds5`
--

CREATE TABLE `ds5` (
  `id` int(11) NOT NULL,
  `codigo_producto` varchar(15) DEFAULT NULL,
  `nombre_producto` varchar(34) DEFAULT NULL,
  `cedula_cliente` varchar(34) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ds5`
--

INSERT INTO `ds5` (`id`, `codigo_producto`, `nombre_producto`, `cedula_cliente`, `cantidad`, `precio`) VALUES
(1, '0002', 'huevo', '5', 1, 8.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `responsable` int(9) DEFAULT NULL,
  `num_entrada` int(11) NOT NULL DEFAULT 0,
  `proveedor` varchar(34) DEFAULT NULL,
  `devuelto` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`fecha`, `responsable`, `num_entrada`, `proveedor`, `devuelto`) VALUES
('2024-06-23 19:16:55', 5, 625846, 'Didapax', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombre_usuario` varchar(34) DEFAULT NULL,
  `cedula` int(9) NOT NULL,
  `ubicacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `fecha`, `nombre_usuario`, `cedula`, `ubicacion`) VALUES
(38, '2024-06-23 17:02:48', 'pepes', 5, 'AÑADIO UN PROOVEEDOR'),
(39, '2024-06-23 19:16:56', 'pepes', 5, 'AGREGO UNA ENTRADA DE INSUMO'),
(40, '2024-06-23 19:17:44', 'pepes', 5, 'AGREGO UNA SALIDA'),
(41, '2024-06-23 20:56:53', 'pepes', 5, 'AGREGO UNA DEVOLUCION DE INSUMOS'),
(42, '2024-06-23 21:04:53', 'pepes', 5, 'AGREGO UNA DEVOLUCION POR FABRICACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `codigo` varchar(15) NOT NULL,
  `nombre` varchar(34) DEFAULT NULL,
  `almacen` int(11) NOT NULL DEFAULT 0,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `existencia` int(11) NOT NULL DEFAULT 0,
  `categoria` varchar(34) DEFAULT NULL,
  `c_min` int(11) NOT NULL DEFAULT 0,
  `c_max` int(11) NOT NULL DEFAULT 0,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `uni` varchar(15) NOT NULL DEFAULT 'gramos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`codigo`, `nombre`, `almacen`, `precio`, `existencia`, `categoria`, `c_min`, `c_max`, `deleted`, `uni`) VALUES
('0002', 'huevo', 1, 8.00, -1, 'huevos', 1, 100, 0, 'unidades'),
('0003', 'harina de maiz', 1, 0.12, 100, 'harinas', 1, 200, 0, 'gramos'),
('0101', 'harina de trigo', 1, 0.06, 500, 'harinas', 0, 0, 0, 'gramos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemcarrito`
--

CREATE TABLE `itemcarrito` (
  `iditemcarrito` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcarrito` bigint(20) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `motivo` varchar(100) NOT NULL DEFAULT 'null',
  `iscustom` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemcocina`
--

CREATE TABLE `itemcocina` (
  `num_salida` int(11) NOT NULL DEFAULT 0,
  `idreceta` varchar(200) DEFAULT NULL,
  `idproducto` bigint(20) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `itemcocina`
--

INSERT INTO `itemcocina` (`num_salida`, `idreceta`, `idproducto`, `cantidad`) VALUES
(433635, '7ec8a429e6', 97, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itempedido`
--

CREATE TABLE `itempedido` (
  `iditempedido` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idpedido` bigint(20) NOT NULL,
  `iscustom` int(11) NOT NULL DEFAULT 0,
  `precio` float NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `motivo` varchar(200) NOT NULL DEFAULT 'null',
  `estado` varchar(200) NOT NULL DEFAULT 'EN PROCESO',
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `itempedido`
--

INSERT INTO `itempedido` (`iditempedido`, `idproducto`, `idpedido`, `iscustom`, `precio`, `cantidad`, `motivo`, `estado`, `fechacreacion`) VALUES
(36, 98, 20, 1, 50, 1, ' dsfsdfds', 'EN PROCESO', '2024-06-23 03:26:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemrecetas`
--

CREATE TABLE `itemrecetas` (
  `id` int(100) NOT NULL,
  `idproducto` bigint(20) DEFAULT NULL,
  `idreceta` varchar(200) NOT NULL,
  `codigoinsumo` varchar(15) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `uni` varchar(15) NOT NULL DEFAULT 'gramos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `itemrecetas`
--

INSERT INTO `itemrecetas` (`id`, `idproducto`, `idreceta`, `codigoinsumo`, `cantidad`, `uni`) VALUES
(18, 97, '7ec8a429e6', '0002', 2.00, 'unidades'),
(19, 97, '7ec8a429e6', '0101', 100.00, 'gramos'),
(20, 98, '0f0f2721a7', '0002', 2.00, 'unidades');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `idusuario` bigint(20) DEFAULT NULL,
  `ubicacion` varchar(200) DEFAULT NULL,
  `noticia` text DEFAULT NULL,
  `bg` varchar(255) DEFAULT '#FFC0CB',
  `fg` varchar(255) DEFAULT '#1A1A1A',
  `visto` int(11) NOT NULL DEFAULT 0,
  `bloqueado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_usuario`
--

CREATE TABLE `pedido_usuario` (
  `idpedido` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `total` float NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(8) NOT NULL,
  `municipio` varchar(200) NOT NULL,
  `localidad` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL DEFAULT 'EN PROCESO',
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_usuario`
--

INSERT INTO `pedido_usuario` (`idpedido`, `idusuario`, `total`, `direccion`, `telefono`, `municipio`, `localidad`, `estado`, `fechacreacion`) VALUES
(20, 6, 50, 'sadasdasds', '04264804', 'Bermúdez', 'Carupano', 'EN CAMINO', '2024-06-23 15:34:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `idpersona` varchar(200) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL DEFAULT 'cliente',
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `idpersona`, `nombre`, `apellido`, `telefono`, `direccion`, `cargo`, `tipo`, `deleted`) VALUES
(3, '0e993ab333', 'Juan', 'Perez', '04264804748', 'calle 174', '2', 'empleado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` bigint(20) NOT NULL,
  `idreceta` varchar(200) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion_producto` text NOT NULL,
  `imagen_producto` text NOT NULL,
  `precio_producto` float NOT NULL DEFAULT 0,
  `categoria_producto` int(11) NOT NULL,
  `habilitado` int(11) NOT NULL DEFAULT 0,
  `existencia` bigint(20) NOT NULL DEFAULT 0,
  `iscustom` int(11) NOT NULL DEFAULT 0,
  `peso` int(11) NOT NULL DEFAULT 0,
  `pisos` int(11) NOT NULL DEFAULT 1,
  `modelos` varchar(100) NOT NULL,
  `bizcocho` int(11) NOT NULL DEFAULT 0,
  `relleno` varchar(200) NOT NULL,
  `cubierta` varchar(200) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `persona` varchar(200) NOT NULL DEFAULT 'niño',
  `idtipo` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `idreceta`, `nombre_producto`, `descripcion_producto`, `imagen_producto`, `precio_producto`, `categoria_producto`, `habilitado`, `existencia`, `iscustom`, `peso`, `pisos`, `modelos`, `bizcocho`, `relleno`, `cubierta`, `motivo`, `persona`, `idtipo`) VALUES
(97, '7ec8a429e6', 'Torta cubierta', 'Torta con cubierta de vainilla', '/ProyectoPanaderiaGit/Assets/productoimagenes\\189d7f9a66.jpeg', 33.176, 11, 1, 1, 0, 0, 0, '', 0, '', '', '', 'niño', 0),
(98, '0f0f2721a7', 'Torta Rosada', 'Torta para cumpleaños', '/ProyectoPanaderiaGit/Assets/productoimagenes/f97346900f.jpeg', 50, 11, 1, 1, 1, 1, 1, 'redonda', 0, 'vainilla', 'rosado', '', 'mujer', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `rif` varchar(50) NOT NULL,
  `nombre` varchar(34) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`rif`, `nombre`, `telefono`, `direccion`, `deleted`) VALUES
('132939167', 'Didapax', '04264804748', 'calle carabobo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `idreceta` varchar(200) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `idproducto` bigint(20) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`idreceta`, `nombre`, `idproducto`, `notas`, `deleted`) VALUES
('0f0f2721a7', 'Torta Rosada', 98, ' se prepara ', 0),
('7ec8a429e6', 'Torta Cubierta Vainilla', 97, ' se mezcla la harina con los huevos y agua\n', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `responsable` int(9) DEFAULT NULL,
  `num_salida` int(11) NOT NULL DEFAULT 0,
  `motivo` text DEFAULT NULL,
  `cedula_cliente` int(9) DEFAULT NULL,
  `subtotal` decimal(13,2) DEFAULT 0.00,
  `iva` decimal(13,2) DEFAULT 0.00,
  `total` decimal(13,2) DEFAULT 0.00,
  `devuelto` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salida`
--

INSERT INTO `salida` (`fecha`, `responsable`, `num_salida`, `motivo`, `cedula_cliente`, `subtotal`, `iva`, `total`, `devuelto`) VALUES
('2024-06-23 19:17:43', 5, 433635, 'Elaboracion', 5, 22.00, 3.52, 25.52, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `idtipo` bigint(20) NOT NULL,
  `nombre_tipo` varchar(30) NOT NULL,
  `descripcion_tipo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idtipo`, `nombre_tipo`, `descripcion_tipo`) VALUES
(1, 'nuevo', 'los productos nuevos se etiquetan como nuevos'),
(2, 'destacado', 'los productos que deben llamar la atención se etiquetan como destacados'),
(3, 'caliente', 'los productos en venta se etiquetan como calientes'),
(4, 'mejor', 'los productos más vendidos se etiquetan como mejores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `idtransaccion` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `idpedido` bigint(20) NOT NULL,
  `metodopago` text NOT NULL,
  `estado` text NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`idtransaccion`, `idusuario`, `idpedido`, `metodopago`, `estado`, `fechacreacion`) VALUES
(34, 6, 20, 'pagomovil', 'EN CAMINO', '2024-06-23 15:34:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `idpersona` varchar(200) NOT NULL,
  `nombreusuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `telefono` varchar(8) NOT NULL,
  `descripcion` text NOT NULL,
  `claveverificacion` varchar(100) NOT NULL,
  `verificado` tinyint(1) NOT NULL,
  `suscrito` tinyint(1) NOT NULL,
  `esadmin` tinyint(1) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idpersona`, `nombreusuario`, `contrasena`, `nombre`, `apellido`, `correo`, `direccion`, `telefono`, `descripcion`, `claveverificacion`, `verificado`, `suscrito`, `esadmin`, `fechacreacion`, `deleted`) VALUES
(5, '', 'pepes', '$2y$10$wkoJJFdBY1IyahK2PXwu/.AnGrWdh5KpijABJ32CdfHF/TzOqShTC', 'pepes admin', 'verazxx', 'pepe@gmail.com', 'xx xxxx', 'xxx', 'xxx', 'f424ffb8411b6cefe3bd4f3461371575', 1, 0, 1, '2024-05-25 02:36:57', 0),
(6, '', 'pedro', '$2y$10$KXCKoqgWEmhVkS4W006XD.80YuhlK72umUALwFJBTp9l9mJ025NHO', 'Pedro', 'Parker josefo', 'pedroparker@gmail.com', '1235 s aaaaaaaa', '04264804', '', 'd2612ee7435844101f35be825b58ef36', 1, 0, 0, '2024-05-25 02:56:43', 0),
(9, '0e993ab333', 'juan', '$2y$10$YhXWDAf8yWkTPza1v6IIuuKMfEz47unzvhHv393UIVvYMoVQ9o8wK', 'Juan', 'Perez', 'juanperez@gmail.com', 'calle 174', '04264804', '', 'e0e5fb8cb10a54db30616165ed611f03', 1, 0, 2, '2024-06-05 17:52:16', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carac_devolucion_entrada`
--
ALTER TABLE `carac_devolucion_entrada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carac_devolucion_salida`
--
ALTER TABLE `carac_devolucion_salida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carac_entrada`
--
ALTER TABLE `carac_entrada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carac_salida`
--
ALTER TABLE `carac_salida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idcarrito`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `categoria_insumos`
--
ALTER TABLE `categoria_insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `de5`
--
ALTER TABLE `de5`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `devolucion_entrada`
--
ALTER TABLE `devolucion_entrada`
  ADD PRIMARY KEY (`referencia`);

--
-- Indices de la tabla `devolucion_salida`
--
ALTER TABLE `devolucion_salida`
  ADD PRIMARY KEY (`referencia`);

--
-- Indices de la tabla `ds5`
--
ALTER TABLE `ds5`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`num_entrada`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `itemcarrito`
--
ALTER TABLE `itemcarrito`
  ADD PRIMARY KEY (`iditemcarrito`),
  ADD KEY `1_carrito_cero-o-más_itemscarrito` (`idcarrito`),
  ADD KEY `1_producto_muchos_itemscarrito` (`idproducto`);

--
-- Indices de la tabla `itemcocina`
--
ALTER TABLE `itemcocina`
  ADD PRIMARY KEY (`num_salida`);

--
-- Indices de la tabla `itempedido`
--
ALTER TABLE `itempedido`
  ADD PRIMARY KEY (`iditempedido`),
  ADD KEY `1_pedido_muchos_itemspedido` (`idpedido`),
  ADD KEY `1_producto_muchos_itemspedido` (`idproducto`);

--
-- Indices de la tabla `itemrecetas`
--
ALTER TABLE `itemrecetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_usuario`
--
ALTER TABLE `pedido_usuario`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `1_usuario_muchos_pedidos` (`idusuario`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`rif`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`idreceta`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`num_salida`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`idtransaccion`),
  ADD KEY `1_pedido_muchas_transacciones` (`idpedido`),
  ADD KEY `1_usuario_muchas_transacciones` (`idusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carac_devolucion_entrada`
--
ALTER TABLE `carac_devolucion_entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carac_devolucion_salida`
--
ALTER TABLE `carac_devolucion_salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carac_entrada`
--
ALTER TABLE `carac_entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `carac_salida`
--
ALTER TABLE `carac_salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idcarrito` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `categoria_insumos`
--
ALTER TABLE `categoria_insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `de5`
--
ALTER TABLE `de5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ds5`
--
ALTER TABLE `ds5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `itemcarrito`
--
ALTER TABLE `itemcarrito`
  MODIFY `iditemcarrito` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `itempedido`
--
ALTER TABLE `itempedido`
  MODIFY `iditempedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `itemrecetas`
--
ALTER TABLE `itemrecetas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `pedido_usuario`
--
ALTER TABLE `pedido_usuario`
  MODIFY `idpedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `idtipo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `idtransaccion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
