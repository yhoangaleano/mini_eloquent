{\rtf1\ansi\ansicpg1252\cocoartf1671\cocoasubrtf100
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0

\f0\fs24 \cf0 -- phpMyAdmin SQL Dump\
-- version 4.8.2\
-- https://www.phpmyadmin.net/\
--\
-- Servidor: localhost:3306\
-- Tiempo de generaci\'f3n: 11-12-2018 a las 17:19:30\
-- Versi\'f3n del servidor: 5.7.21\
-- Versi\'f3n de PHP: 7.2.7\
\
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";\
SET time_zone = "+00:00";\
\
--\
-- Base de datos: `db_v_y_c`\
--\
CREATE DATABASE IF NOT EXISTS `db_v_y_c` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;\
USE `db_v_y_c`;\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `movies`\
--\
\
CREATE TABLE `movies` (\
  `id` int(10) UNSIGNED NOT NULL,\
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,\
  `director` int(10) UNSIGNED NOT NULL,\
  `describe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,\
  `rate` tinyint(3) UNSIGNED NOT NULL,\
  `release_at` timestamp NULL DEFAULT NULL,\
  `created_at` timestamp NULL DEFAULT NULL,\
  `updated_at` timestamp NULL DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `questions`\
--\
\
CREATE TABLE `questions` (\
  `id` int(11) UNSIGNED NOT NULL,\
  `question` tinytext,\
  `user_id` int(11) DEFAULT NULL,\
  `created_at` timestamp NULL DEFAULT NULL,\
  `updated_at` timestamp NULL DEFAULT NULL,\
  `deleted_at` timestamp NULL DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `questions`\
--\
\
INSERT INTO `questions` (`id`, `question`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES\
(1, 'Have you ever met your doppelganger?', 1, '2018-10-18 15:46:45', '2018-10-18 15:46:45', NULL),\
(2, 'Have you ever met your doppelganger?', 1, '2018-10-18 15:48:22', '2018-10-18 15:48:22', NULL),\
(3, 'Have you ever met your doppelganger?', 1, '2018-10-18 16:11:12', '2018-10-18 16:11:12', NULL),\
(4, 'dsadsdsa', 1, '2018-11-21 05:00:00', NULL, NULL);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `tblCliente`\
--\
\
CREATE TABLE `tblCliente` (\
  `idCliente` int(11) NOT NULL,\
  `documento` varchar(20) DEFAULT NULL,\
  `nombreCompleto` varchar(60) NOT NULL,\
  `direccion` varchar(100) DEFAULT NULL,\
  `telefonoFijo` varchar(20) NOT NULL,\
  `celularPrincipal` varchar(20) DEFAULT NULL,\
  `celularAlternativo` varchar(20) DEFAULT NULL,\
  `correoElectronico` varchar(60) NOT NULL,\
  `observaciones` text,\
  `estado` tinyint(4) NOT NULL DEFAULT '1'\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `tblCliente`\
--\
\
INSERT INTO `tblCliente` (`idCliente`, `documento`, `nombreCompleto`, `direccion`, `telefonoFijo`, `celularPrincipal`, `celularAlternativo`, `correoElectronico`, `observaciones`, `estado`) VALUES\
(1, '123456789', 'Julian Andres Paez Restrepo', 'Calle 77 ab #86 a 24', '5032233', '304565765', '', 'julianpaez@gmail.com', '', 1),\
(2, '1234321456', 'Miguel Arciniegas ', '', '4670098', '', '', 'julianpaez1@gmail.com', '', 1),\
(3, '', 'Jorge Andres Robledo', '', '0000000000', '', '', 'jorge@gmail.com', 'dadsdas', 0);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `tblEmpresa`\
--\
\
CREATE TABLE `tblEmpresa` (\
  `idEmpresa` int(11) NOT NULL,\
  `nombreEmpresa` varchar(100) DEFAULT NULL,\
  `regimen` varchar(50) DEFAULT NULL,\
  `NIT` varchar(20) DEFAULT NULL,\
  `urlLogo` varchar(100) DEFAULT NULL,\
  `direccion` varchar(100) DEFAULT NULL,\
  `telefono` varchar(30) DEFAULT NULL,\
  `celular` varchar(30) DEFAULT NULL,\
  `correoElectronico` varchar(60) DEFAULT NULL,\
  `descripcion` varchar(300) DEFAULT NULL,\
  `descripcionPieFactura` text\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `tblEmpresa`\
--\
\
INSERT INTO `tblEmpresa` (`idEmpresa`, `nombreEmpresa`, `regimen`, `NIT`, `urlLogo`, `direccion`, `telefono`, `celular`, `correoElectronico`, `descripcion`, `descripcionPieFactura`) VALUES\
(5, 'Variedades y Comunicaciones', 'R\'e9gimen Simplificado', '98763007-1', 'uploads/factory/1540222447_Jobs-y-Wozniak-en-el-garaje.jpg', 'Cra. 36 A No. 77 BB - 45 Robledo Bello Horizonte', '4746745', '3005659290', 'variedcom@gmail.com', 'Venta y Servicio T\'e9cnico de Celulares. Internet - Papeler\'eda - Llamadas a Celular. Reparaci\'f3n y Accesorios para Computadores.', 'LA GARANT\'cdA NO CUBRE. Golpes, humedad, sobrecarga, equipos apagados, pantalla t\'e1ctil, flex, yustin y levantamiento de sellos de garant\'eda. NO SE DEVUELVE DINERO. No nos hacemos Responsables por tel\'e9fonos o accesorios que no sean reclamados despu\'e9s de 30 d\'edas. Se presume que los equipos tra\'eddos son de buena procedencia.');\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `tblLog`\
--\
\
CREATE TABLE `tblLog` (\
  `idLog` int(11) NOT NULL,\
  `query_error` text,\
  `modelo` varchar(50) DEFAULT NULL,\
  `codigoError` varchar(45) DEFAULT NULL,\
  `mensajeError` text,\
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `tblLog`\
--\
\
INSERT INTO `tblLog` (`idLog`, `query_error`, `modelo`, `codigoError`, `mensajeError`, `fecha`) VALUES\
(1, 'No existe la pregunta con el ID 3', 'Question', '0', 'No query results for model [Mini\\\\Model\\\\Question] 3', '2018-10-18 16:03:36'),\
(2, 'No existe el servicio con el ID 3', 'Service', '42S22', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \\'tblServicio.id\\' in \\'where clause\\' (SQL: select * from `tblServicio` where `tblServicio`.`id` = 3 limit 1)', '2018-10-22 17:56:32'),\
(3, 'No existe el servicio con el ID 3', 'Service', '42S22', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \\'id\\' in \\'where clause\\' (SQL: update `tblServicio` set `tblServicio`.`updated_at` = 2018-10-22 12:58:57, `nombreServicio` = Asesorias Hola, `updated_at` = 2018-10-22 12:58:57 where `id` is null)', '2018-10-22 17:58:57'),\
(4, 'No existe el servicio con el ID 3', 'Service', '42S22', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \\'id\\' in \\'where clause\\' (SQL: update `tblServicio` set `tblServicio`.`updated_at` = 2018-10-22 13:00:48, `nombreServicio` = Asesorias hhh, `updated_at` = 2018-10-22 13:00:48 where `id` is null)', '2018-10-22 18:00:48'),\
(5, 'No existe el servicio con el ID 1', 'Service', '42S22', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \\'id\\' in \\'where clause\\' (SQL: update `tblServicio` set `tblServicio`.`updated_at` = 2018-10-22 13:01:01, `nombreServicio` = Servicio T\'e9cnico hhhh, `updated_at` = 2018-10-22 13:01:01 where `id` is null)', '2018-10-22 18:01:01'),\
(6, 'SHOW COLUMNS FROM db_v_y_c.urlLogo', 'Generator', '42S02', 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \\'db_v_y_c.urllogo\\' doesn\\'t exist', '2018-10-23 14:24:54'),\
(7, 'SHOW COLUMNS FROM db_v_y_c.nombreEmpresa', 'Generator', '42S02', 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \\'db_v_y_c.nombreempresa\\' doesn\\'t exist', '2018-10-23 14:24:59');\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `tblServicio`\
--\
\
CREATE TABLE `tblServicio` (\
  `idServicio` int(11) NOT NULL,\
  `nombreServicio` varchar(60) NOT NULL,\
  `estado` tinyint(4) DEFAULT '1',\
  `created_at` timestamp NULL DEFAULT NULL,\
  `updated_at` timestamp NULL DEFAULT NULL,\
  `deleted_at` timestamp NULL DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `tblServicio`\
--\
\
INSERT INTO `tblServicio` (`idServicio`, `nombreServicio`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES\
(1, 'Servicio T\'e9cnico', 1, '2018-10-22 17:40:50', '2018-10-22 17:40:50', NULL),\
(2, 'Software', 1, '2018-10-22 17:41:00', '2018-10-22 17:41:00', NULL),\
(3, 'Asesor\'edas', 1, '2018-10-22 17:50:21', '2018-10-22 19:25:35', NULL);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `tblUsuario`\
--\
\
CREATE TABLE `tblUsuario` (\
  `idUsuario` int(11) NOT NULL,\
  `usuario` varchar(45) NOT NULL,\
  `contrasena` varchar(60) NOT NULL,\
  `nombreCompleto` varchar(60) NOT NULL,\
  `correoElectronico` varchar(60) NOT NULL,\
  `estado` tinyint(4) DEFAULT '1',\
  `rol` varchar(50) DEFAULT 'VENDEDOR',\
  `codigo` varchar(45) DEFAULT NULL,\
  `fechaRecuperacion` timestamp NULL DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `tblUsuario`\
--\
\
INSERT INTO `tblUsuario` (`idUsuario`, `usuario`, `contrasena`, `nombreCompleto`, `correoElectronico`, `estado`, `rol`, `codigo`, `fechaRecuperacion`) VALUES\
(6, 'yhoang', '$2y$10$TVAe3cG9K9bSZtXnLkHSwuXJWvf4Pt7eSoomndRAKLUXpCL/8.ndW', 'Yhoan Galeano', 'yhoangaleano@gmail.com', 1, 'ADMINISTRADOR', '1542640092NccMUCMK', '2018-11-20 15:08:12'),\
(19, 'juanjo', '$2y$10$pcb6kRFoFdVmlDXVuWS2F.S73ypOy2Os4DgJ7G9CRyAijvpgautDe', 'Juan Jose Cardona', 'juanjocardona@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(20, 'yhoang2', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano2@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(21, 'yhoang3', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano3@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(22, 'yhoang4', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano4@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(23, 'yhoang5', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano5@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(24, 'yhoang6', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano6@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(25, 'yhoang7', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano7@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(26, 'yhoang8', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano8@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(27, 'yhoang9', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano9@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(28, 'yhoang10', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano10@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(29, 'yhoang11', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano11@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(30, 'yhoang12', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano12@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(31, 'yhoang13', '$2y$10$OmD/fFCDXY6rZkpCuvle2uIuBdOeugX/PllJ2FZzXGK/qeiyOPIFK', 'Yhoan Andres Galeano Urrea', 'yhoangaleano13@gmail.com', 1, 'VENDEDOR', '1536113522SMbKbEWY', '2018-09-06 02:12:02'),\
(32, 'julian24', '$2y$10$vWzqry9suh5KGKAANhruaOUaqrHktuEh5bOkqDhxt2ihs65MdFMUy', 'Julian Suarez', 'julian@gmail.com', 1, 'VENDEDOR', NULL, NULL),\
(33, 'edilia', '$2y$10$7QRkQT5RIdO8/i.L70T/xetnAH.HTWS1CixpMWua/m1OlaGAJrrxW', 'Edilia Urrea', 'edilia@gmail.com', 1, 'VENDEDOR', NULL, NULL),\
(34, 'juan', '$2y$10$Lv1I12noT0pJVl7t8w7Uh.fqxu49c6ilKzDmqTB1zobqfAtkuYzam', 'Juan Cardona', 'juan@hotmail.com', 1, 'VENDEDOR', NULL, NULL),\
(35, 'luis', '$2y$10$QqX4A9sVpKGe33frkLfLHe.ag2U/SvXE3VxGQ1T9dyOJFdqq1vHaK', 'Lucho Suarez Perez', 'lucho@gmail.com', 1, 'VENDEDOR', NULL, NULL),\
(36, 'armando', '$2y$10$IkbmAaQJOWpIob.woL9SjOuncZNmzV1z.9pf7W9HVe7cii1tASd5q', 'Armando Marin', 'armando@gmail.com', 1, 'VENDEDOR', NULL, NULL),\
(37, 'adalcar', '$2y$10$mHSerXkbx7HdsvQ6A0WB4uiUnaAVPpgWRUFBzJyCVFrYP4iIPwSlq', 'Adalberto Carcamo', 'adalcar26@gmail.com', 1, 'VENDEDOR', NULL, NULL),\
(38, 'andreslopez', '$2y$10$iwL0.6eyFN.lT02AyJktUeHFAj.9ZIYVeCXtrS3fBj71um84mbGTy', 'Andres Lopez', 'andres@gmail.com', 1, 'ADMINISTRADOR', NULL, NULL),\
(39, 'dulce', '$2y$10$W.bbL8e6.Kv97gcz3i.Wwu4Jr3w7dXflXoW6ZTRmW8.G2y9oxJvTa', 'Dulce Galeano', 'dulce@gmail.com', 1, 'VENDEDOR', NULL, NULL),\
(40, 'hannamaria', '$2y$10$g8xEFM7kILknbpuJljnlo.YA/o.ewpKlQqi7VDVQ4/P2YD4H00be2', 'Hanna Maria', 'hannamaria446@gmail.com', 1, 'ADMINISTRADOR', '1536587488aEdWTdOL', '2018-09-11 13:51:28'),\
(41, 'jesusmunoz', '$2y$10$jat1oXB9lL2ZVB1GKvYdcOwAy1myw1mGmi2HMOxnrouIgpMdIY7QC', 'Jesus Antonio Mu\'f1oz Gonzalez', 'sguarin025@misena.edu.co', 1, 'ADMINISTRADOR', '1537402462JfBDJQPC', '2018-09-21 00:14:22');\
\
--\
-- \'cdndices para tablas volcadas\
--\
\
--\
-- Indices de la tabla `movies`\
--\
ALTER TABLE `movies`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Indices de la tabla `questions`\
--\
ALTER TABLE `questions`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Indices de la tabla `tblCliente`\
--\
ALTER TABLE `tblCliente`\
  ADD PRIMARY KEY (`idCliente`);\
\
--\
-- Indices de la tabla `tblEmpresa`\
--\
ALTER TABLE `tblEmpresa`\
  ADD PRIMARY KEY (`idEmpresa`);\
\
--\
-- Indices de la tabla `tblLog`\
--\
ALTER TABLE `tblLog`\
  ADD PRIMARY KEY (`idLog`);\
\
--\
-- Indices de la tabla `tblServicio`\
--\
ALTER TABLE `tblServicio`\
  ADD PRIMARY KEY (`idServicio`);\
\
--\
-- Indices de la tabla `tblUsuario`\
--\
ALTER TABLE `tblUsuario`\
  ADD PRIMARY KEY (`idUsuario`);\
\
--\
-- AUTO_INCREMENT de las tablas volcadas\
--\
\
--\
-- AUTO_INCREMENT de la tabla `movies`\
--\
ALTER TABLE `movies`\
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;\
\
--\
-- AUTO_INCREMENT de la tabla `questions`\
--\
ALTER TABLE `questions`\
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;\
\
--\
-- AUTO_INCREMENT de la tabla `tblCliente`\
--\
ALTER TABLE `tblCliente`\
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;\
\
--\
-- AUTO_INCREMENT de la tabla `tblEmpresa`\
--\
ALTER TABLE `tblEmpresa`\
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;\
\
--\
-- AUTO_INCREMENT de la tabla `tblLog`\
--\
ALTER TABLE `tblLog`\
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;\
\
--\
-- AUTO_INCREMENT de la tabla `tblServicio`\
--\
ALTER TABLE `tblServicio`\
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;\
\
--\
-- AUTO_INCREMENT de la tabla `tblUsuario`\
--\
ALTER TABLE `tblUsuario`\
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;\
}