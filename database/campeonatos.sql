-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-08-2022 a las 07:04:58
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `campeonatos`
--
CREATE DATABASE IF NOT EXISTS `campeonatos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `campeonatos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
  `idAlu` int(11) NOT NULL,
  `nombAlu` varchar(45) DEFAULT NULL,
  `apeAlu` varchar(45) DEFAULT NULL,
  `dniAlu` varchar(8) DEFAULT NULL,
  `fnacAlu` varchar(45) DEFAULT NULL,
  `dniApo` varchar(8) DEFAULT NULL,
  `nombApo` varchar(70) DEFAULT NULL,
  `apeApo` varchar(70) DEFAULT NULL,
  `foto` varchar(15) DEFAULT NULL,
  `idEsc` int(11) NOT NULL,
  `idCamp` int(11) NOT NULL,
  `idUsu` int(11) NOT NULL,
  `pesoAlu` double(5,2) DEFAULT NULL,
  `tallaAlu` double(5,2) DEFAULT NULL,
  `idDep` int(11) NOT NULL,
  `idSexo` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idAlu`, `nombAlu`, `apeAlu`, `dniAlu`, `fnacAlu`, `dniApo`, `nombApo`, `apeApo`, `foto`, `idEsc`, `idCamp`, `idUsu`, `pesoAlu`, `tallaAlu`, `idDep`, `idSexo`) VALUES
(1, 'maria', 'pezo', '11111111', NULL, '22222222', 'pedro', 'perez', NULL, 1, 1, 1, 50.00, 152.33, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeonato`
--

DROP TABLE IF EXISTS `campeonato`;
CREATE TABLE `campeonato` (
  `idCamp` int(11) NOT NULL,
  `descrCamp` varchar(100) DEFAULT NULL,
  `finiCamp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `campeonato`
--

INSERT INTO `campeonato` (`idCamp`, `descrCamp`, `finiCamp`) VALUES
(1, 'INTERESCPÑAR', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

DROP TABLE IF EXISTS `deporte`;
CREATE TABLE `deporte` (
  `idDep` int(11) NOT NULL,
  `descrDep` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deporte`
--

INSERT INTO `deporte` (`idDep`, `descrDep`) VALUES
(1, 'FUTBOL'),
(2, 'VOLEY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

DROP TABLE IF EXISTS `escuela`;
CREATE TABLE `escuela` (
  `idEsc` int(11) NOT NULL,
  `descrEsc` varchar(45) DEFAULT NULL,
  `dirEsc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`idEsc`, `descrEsc`, `dirEsc`) VALUES
(1, 'COMERCIO NRO 64', 'JR.CALLE 123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsu` int(11) NOT NULL,
  `nombUsu` varchar(45) DEFAULT NULL,
  `apeUsu` varchar(45) DEFAULT NULL,
  `dniUsu` varchar(7) DEFAULT NULL,
  `passUsu` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsu`, `nombUsu`, `apeUsu`, `dniUsu`, `passUsu`) VALUES
(1, 'david', 'fachin', '1234', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idAlu`),
  ADD UNIQUE KEY `dniApo_UNIQUE` (`dniApo`);

--
-- Indices de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`idCamp`);

--
-- Indices de la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD PRIMARY KEY (`idDep`);

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`idEsc`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idAlu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `idCamp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `deporte`
--
ALTER TABLE `deporte`
  MODIFY `idDep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `escuela`
--
ALTER TABLE `escuela`
  MODIFY `idEsc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
