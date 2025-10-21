-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-03-2025 a las 23:43:02
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bootcamp`
--
CREATE DATABASE IF NOT EXISTS `bootcamp` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci;
USE `bootcamp`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocupacion`
--

CREATE TABLE `ocupacion` (
  `ocupacion_id` int NOT NULL,
  `ocupacion_descripcion` varchar(40) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `ocupacion_estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad`
--

CREATE TABLE `seguridad` (
  `seguridad_id` int NOT NULL,
  `seguridad_pregunta` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `seguridad_respuesta` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `tipo_usuario_id` int NOT NULL,
  `tipo_usuario_descripcion` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `tipo_usuario_estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`tipo_usuario_id`, `tipo_usuario_descripcion`, `tipo_usuario_estatus`) VALUES
(1, 'Administrador', 1),
(4, 'Cliente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `trabajador_id` int NOT NULL,
  `trabajador_nacionalidad` varchar(10) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `trabajador_cedula` varchar(10) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `trabajador_nombres` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `trabajador_apellidos` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `trabajador_telefono` varchar(15) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `trabajador_correo` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `trabajador_fecha_nacimiento` date NOT NULL,
  `trabajador_fecha_ingreso` date NOT NULL,
  `ocupacion_id` int NOT NULL,
  `trabajador_estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int NOT NULL,
  `usuario_nombre` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_username` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_password` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_telefono` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_tipo` int NOT NULL,
  `usuario_estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ocupacion`
--
ALTER TABLE `ocupacion`
  ADD PRIMARY KEY (`ocupacion_id`);

--
-- Indices de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  ADD PRIMARY KEY (`seguridad_id`),
  ADD KEY `seguridad_usuario` (`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`tipo_usuario_id`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`trabajador_id`),
  ADD KEY `trabajador_ocupacion` (`ocupacion_id`),
  ADD KEY `ocupacion_id` (`ocupacion_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `usuario_tipo` (`usuario_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ocupacion`
--
ALTER TABLE `ocupacion`
  MODIFY `ocupacion_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  MODIFY `seguridad_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `tipo_usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `trabajador_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `seguridad`
--
ALTER TABLE `seguridad`
  ADD CONSTRAINT `seguridad_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `trabajador_ibfk_1` FOREIGN KEY (`ocupacion_id`) REFERENCES `ocupacion` (`ocupacion_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usuario_tipo`) REFERENCES `tipo_usuario` (`tipo_usuario_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
