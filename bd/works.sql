-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2019 a las 15:59:27
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `works`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mail` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mails`
--

INSERT INTO `mails` (`id`, `id_usuario`, `mail`) VALUES
(1, 1, 'marcos@gmail.com'),
(2, 1, 'juan@hotmail.com'),
(3, 1, 'maria@yahoo.com'),
(4, 1, 'carol@gmail.com'),
(5, 1, 'lucas@yahoo.com'),
(6, 1, 'pedro@yahoo.com'),
(7, 1, 'andrea@gmail.com'),
(8, 1, 'laura@yahoo.com'),
(9, 1, 'orlando@yahoo.com'),
(10, 1, 'karla@yahoo.com'),
(11, 1, 'laurafr@gmail.com'),
(12, 1, 'eritobi@yahoo.com'),
(13, 1, 'liror@gmail.com'),
(14, 1, 'pablo@yahoo.com'),
(15, 3, 'logistics@redsunfarms.com'),
(16, 3, 'eileen@pfenningsfarms.ca'),
(17, 3, 'sal@bradfordproduce.com'),
(18, 3, 'wendy@brennbfarms.com'),
(19, 3, 'contact@furlanbros.com'),
(20, 3, 'sales@jaycee-herb.com'),
(21, 3, 'joey@nationalproduce.com'),
(22, 3, 'sales@orangelinefarms.com'),
(23, 3, 'mary@shabaturaproduce.com'),
(24, 3, 'info@vinelandgrowers.com'),
(25, 3, 'info@freshdirectproduce.com'),
(26, 3, 'Info@to-jo.com'),
(27, 3, 'WoodvilleFarmsLtd@gmail.com'),
(28, 3, 'sal@bralfordproduce.com'),
(29, 1, 'abcd@gmail.com'),
(30, 4, 'hola@hola.com'),
(31, 4, 'brayanjeshuavz@gmail.com'),
(32, 4, 'jcamilo@tradex.com'),
(33, 4, 'brayanjeshuavz@gail.com'),
(34, 4, 'jcamilo@tradex.co'),
(35, 4, 'talcorer@sadas.sadas'),
(36, 2, 'tal@tal.com'),
(37, 2, 'hola@tal.com'),
(38, 1, 'hola@ola.com'),
(39, 2, 'mala@mala.com'),
(40, 2, 'sadsa@sada.casd'),
(41, 2, 'jfonseca@tradexusalogistics.nl'),
(42, 2, 'holque@tal.com'),
(43, 2, 'saulo@saulin.com'),
(44, 2, 'jondoe@example.com'),
(45, 2, 'jsmith@example.com'),
(46, 2, 'hola@ta2l.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

CREATE TABLE `trabajo` (
  `id_trabajo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `calls` int(1) NOT NULL,
  `leads` int(1) NOT NULL,
  `followup` int(1) NOT NULL,
  `mails` int(1) NOT NULL,
  `loads` int(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajo`
--

INSERT INTO `trabajo` (`id_trabajo`, `id_usuario`, `calls`, `leads`, `followup`, `mails`, `loads`, `date`) VALUES
(1, 3, 1, 1, 1, 1, 1, '2019-01-10'),
(2, 2, 1, 1, 1, 1, 1, '2019-02-03'),
(3, 1, 1, 0, 1, 1, 1, '2019-02-01'),
(4, 2, 1, 0, 1, 1, 1, '2019-02-03'),
(5, 4, 0, 0, 0, 1, 0, '2019-02-03'),
(6, 2, 0, 1, 0, 0, 0, '2019-02-04'),
(7, 4, 1, 1, 1, 1, 1, '2019-02-04'),
(8, 2, 0, 0, 0, 0, 0, '2019-02-05'),
(9, 3, 1, 1, 1, 1, 1, '2019-02-07'),
(10, 2, 0, 0, 0, 1, 0, '2019-02-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(130) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `last_session` datetime DEFAULT NULL,
  `activacion` int(11) NOT NULL DEFAULT '0',
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) DEFAULT NULL,
  `password_request` int(11) DEFAULT '0',
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `nombre`, `correo`, `last_session`, `activacion`, `token`, `token_password`, `password_request`, `id_tipo`) VALUES
(1, 'admin', '$2y$10$ZZZgvjPCUK2mh67HsBsRHOjeWlpUN3JbPEdv6seKwW5CioocY9PZG', 'Jeshua', 'brayan@tradexusalogistics.com', '2019-02-11 11:22:46', 1, '13d39c7d4184fcccc18d90f70b18beac', '', 0, 1),
(2, 'jcamilo', '$2y$10$BSet0meH2FGvu7jaNKmizuAqqfPNcdA/CbSI2RCAglE36llmS7h8C', 'Juan Camilo', 'jcamilo@tradexusalogistics.com', '2019-02-13 09:58:32', 1, 'e9be41827c3fab2d444cad992f031762', '', 0, 2),
(3, 'tony', '$2y$10$xo6EdDIn.o9nloPiarKgGuTPlH4VK591ZMPLVQvElG4PmTcQe.ACe', 'Anthony Manzanilla', 'anthony@tradexusalogistics.com', '2019-02-11 09:44:01', 1, '5cadc0911b9ac12690fb1ab67e08a7ee', '', 0, 2),
(4, 'tony2', '$2y$10$xo6EdDIn.o9nloPiarKgGuTPlH4VK591ZMPLVQvElG4PmTcQe.ACe', 'Manzanillo', 'anthony@tradexusalogistics.com', '2019-02-07 14:33:50', 1, '5cadc0911b9ac12690fb1ab67e08a7ee', '', 0, 2),
(5, 'lol', '$2y$10$eduwoGTMdqRLEuGGzlUF2uD.pbecU3GAIqthwd0FRDW1mRJPyHUQO', 'lol', 'brayanjeshuavz@gmail.com', NULL, 0, '47956714f0a955d1a65887c143863785', NULL, 0, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD PRIMARY KEY (`id_trabajo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  MODIFY `id_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mails`
--
ALTER TABLE `mails`
  ADD CONSTRAINT `mails_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD CONSTRAINT `trabajo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
