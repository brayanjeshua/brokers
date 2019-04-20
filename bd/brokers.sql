-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2019 a las 20:52:12
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
-- Base de datos: `login`
--

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
(10, 3, 0, 0, 0, 1, 0, '2019-02-05');

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
(1, 'admin', '$2y$10$ZZZgvjPCUK2mh67HsBsRHOjeWlpUN3JbPEdv6seKwW5CioocY9PZG', 'Jeshua', 'brayan@tradexusalogistics.com', '2019-02-05 14:31:30', 1, '13d39c7d4184fcccc18d90f70b18beac', '', 0, 1),
(2, 'jcamilo', '$2y$10$BSet0meH2FGvu7jaNKmizuAqqfPNcdA/CbSI2RCAglE36llmS7h8C', 'Juan Camilo', 'jcamilo@tradexusalogistics.com', '2019-02-05 14:16:27', 1, 'e9be41827c3fab2d444cad992f031762', '', 0, 2),
(3, 'tony', '$2y$10$xo6EdDIn.o9nloPiarKgGuTPlH4VK591ZMPLVQvElG4PmTcQe.ACe', 'Anthony Manzanilla', 'anthony@tradexusalogistics.com', '2019-02-05 13:31:01', 1, '5cadc0911b9ac12690fb1ab67e08a7ee', '', 0, 2),
(4, 'tony2', '$2y$10$xo6EdDIn.o9nloPiarKgGuTPlH4VK591ZMPLVQvElG4PmTcQe.ACe', 'Manzanillo', 'anthony@tradexusalogistics.com', '2019-02-05 14:47:32', 1, '5cadc0911b9ac12690fb1ab67e08a7ee', '', 0, 2);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  MODIFY `id_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD CONSTRAINT `trabajo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
