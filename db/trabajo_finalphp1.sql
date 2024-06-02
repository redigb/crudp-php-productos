-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-06-2024 a las 17:09:22
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trabajo_finalphp1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int NOT NULL,
  `categoria_nombre` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `categoria_ubicacion` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `categoria_creada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `categoria_actualizada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_ubicacion`, `categoria_creada`, `categoria_actualizada`) VALUES
(13, 'Maouse', 'Vitrina D', '2024-06-01 12:29:57', '2024-06-01 12:29:57'),
(14, 'Pollito', 'Areac C', '2024-06-01 16:07:24', '2024-06-01 16:07:24'),
(15, 'Celulares', 'Area D', '2024-06-02 00:37:05', '2024-06-02 00:37:05'),
(16, 'asefsef', 'sfefsefs', '2024-06-02 00:37:13', '2024-06-02 00:37:13'),
(17, 'loper rttac', 'awdawd', '2024-06-02 00:37:23', '2024-06-02 00:37:23'),
(22, 'Licuadoras', 'Vitrina A', '2024-06-02 04:55:11', '2024-06-02 04:55:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `color_id` int NOT NULL,
  `codigo_color` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nombre_color` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `color_creado` timestamp NULL DEFAULT NULL,
  `color_actualizado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`color_id`, `codigo_color`, `nombre_color`, `color_creado`, `color_actualizado`) VALUES
(2, '#white', 'Blanco', '2024-06-01 14:23:45', '2024-06-01 14:23:45'),
(3, '#Black', 'Negro', '2024-06-01 14:24:29', '2024-06-01 14:24:29'),
(4, '#B25AE6', 'Morado', '2024-06-02 00:33:51', '2024-06-02 00:33:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int NOT NULL,
  `nombre_producto` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `otros_datos` text COLLATE utf8mb4_spanish2_ci,
  `medida_id` int DEFAULT NULL,
  `color_id` int DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `producto_creado` timestamp NOT NULL,
  `producto_actualizado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `nombre_producto`, `otros_datos`, `medida_id`, `color_id`, `categoria_id`, `producto_creado`, `producto_actualizado`) VALUES
(1, 'es un producto', '13 en buen estado', 2, 2, 13, '2024-06-01 15:05:19', '2024-06-02 17:00:40'),
(3, 'Samsung A45', 'Celular tactil', 2, 3, 14, '2024-06-01 23:45:50', '2024-06-01 23:45:50'),
(4, 'Redmi', 'Xiaomi 15', 1, 3, 15, '2024-06-02 00:35:57', '2024-06-02 17:00:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamaño`
--

CREATE TABLE `tamaño` (
  `tamaño_id` int NOT NULL,
  `codigo_tamaño` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `clasificacion` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `tamaño_creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tamaño_actualizado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tamaño`
--

INSERT INTO `tamaño` (`tamaño_id`, `codigo_tamaño`, `clasificacion`, `tamaño_creado`, `tamaño_actualizado`) VALUES
(1, 'Xle3', 'MEdida a', '2024-06-01 13:47:57', '2024-06-01 13:47:57'),
(2, 'L321', 'Medida a talla', '2024-06-01 13:58:00', '2024-06-01 13:58:00'),
(3, 'ghn', 'esf', '2024-06-02 06:31:24', '2024-06-02 06:31:24'),
(5, 'awdwad', 'adw', '2024-06-02 06:31:36', '2024-06-02 06:31:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int NOT NULL,
  `usuario_nombre` varchar(70) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(70) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_email` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(30) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_foto` varchar(535) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_actualizado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_email`, `usuario_usuario`, `usuario_clave`, `usuario_foto`, `usuario_creado`, `usuario_actualizado`) VALUES
(0, 'Renzo Rd', 'Condezo', '', 'redrojo77', '$2y$10$JHiCr3KnKIoDhqzfyGMvceX526Yepu09kdbPRfdNP997zRCQNWQ.2', '', '2024-05-31 14:59:00', '2024-05-31 14:59:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `tamaño_id` (`medida_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `categoría_id` (`categoria_id`);

--
-- Indices de la tabla `tamaño`
--
ALTER TABLE `tamaño`
  ADD PRIMARY KEY (`tamaño_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tamaño`
--
ALTER TABLE `tamaño`
  MODIFY `tamaño_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`medida_id`) REFERENCES `tamaño` (`tamaño_id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `color` (`color_id`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
