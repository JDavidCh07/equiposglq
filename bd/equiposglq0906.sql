-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2024 a las 00:08:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `equiposglq`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `idtaj` bigint(11) NOT NULL,
  `numtajpar` varchar(100) DEFAULT NULL,
  `numtajofi` varchar(100) DEFAULT NULL,
  `idperent` bigint(11) NOT NULL,
  `idperrec` bigint(11) NOT NULL,
  `fecent` date DEFAULT NULL,
  `idperentd` bigint(11) DEFAULT NULL,
  `idperrecd` bigint(11) DEFAULT NULL,
  `fecdev` date DEFAULT NULL,
  `esttaj` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarjeta`
--

INSERT INTO `tarjeta` (`idtaj`, `numtajpar`, `numtajofi`, `idperent`, `idperrec`, `fecent`, `idperentd`, `idperrecd`, `fecdev`, `esttaj`) VALUES
(3, '0002445012', '0001710650 026,06714', 1, 1, '2024-04-18', 1, 1, '2024-06-13', 2),
(4, '10054587', '', 1, 2, '2024-06-13', 2, 1, '2024-06-14', 2),
(7, '34534534', '5464654', 1, 1, '2024-06-14', 1, 1, '2024-06-14', 2),
(8, '4545', NULL, 1, 2, '2024-06-14', 2, 1, '2024-06-13', 2),
(9, NULL, '454452', 1, 1, NULL, 1, 1, '2024-06-15', 2),
(10, NULL, '454452', 1, 1, '2024-06-13', 1, 1, '2024-06-15', 2),
(11, '784551', '848151', 1, 2, '2024-04-30', 2, 1, '2024-06-15', 2),
(12, '485455', '155651', 1, 1, '2024-06-17', 1, 1, '2024-06-18', 2),
(13, '485455', '155651', 1, 1, '2024-06-17', 1, 1, '2024-06-18', 2),
(14, '485455', '155651', 1, 1, '2024-06-17', 1, 1, '2024-06-18', 2),
(15, '32424', '32454434', 1, 2, '2024-06-17', 2, 1, '2024-06-18', 2),
(16, '8484', '1212', 1, 2, '2024-06-17', 2, 1, '2024-06-12', 2),
(17, '435345', NULL, 1, 2, '2024-06-17', 2, 1, '2024-06-17', 2),
(18, '345345', NULL, 1, 2, '2024-06-17', 2, 1, '2024-06-27', 2),
(19, '89965', NULL, 1, 1, '2024-06-26', NULL, NULL, '0000-00-00', 1),
(20, '61122515', NULL, 1, 2, '2024-07-03', NULL, NULL, NULL, 1),
(21, '1452987847', NULL, 1, 6, '2024-07-09', NULL, NULL, NULL, 1),
(22, '54241045', NULL, 1, 13, '2024-07-09', NULL, NULL, NULL, 1),
(23, NULL, '0013708124 209,11100', 1, 17, '2024-06-27', NULL, NULL, NULL, 1),
(24, '0003821203', '0013708124 209,11100', 1, 14, '2024-06-01', 14, 1, '2024-05-26', 2),
(25, '0003820518', '0013307047 203,03239', 1, 4, '2023-11-27', NULL, NULL, NULL, 1),
(26, '0003821082', '0013304288 203,00480', 1, 18, '2023-11-14', NULL, NULL, NULL, 1),
(27, '0002445421', NULL, 1, 15, '2024-06-11', NULL, NULL, NULL, 1),
(28, '0011967453', '4545987', 1, 8, '2024-06-24', NULL, NULL, NULL, 1),
(29, '0003112012', NULL, 1, 6, '2024-06-19', 6, 1, '2024-07-08', 2),
(30, '0012407026 189,20722', '0001802290 027,32818', 1, 5, '2024-06-20', 5, 1, '2024-07-09', 2),
(31, '0003111906', NULL, 1, 17, '2023-08-08', 17, 1, '2024-07-08', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD PRIMARY KEY (`idtaj`),
  ADD KEY `idperent` (`idperent`),
  ADD KEY `idperrec` (`idperrec`),
  ADD KEY `idperentd` (`idperentd`),
  ADD KEY `idperrecd` (`idperrecd`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `idtaj` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`idperent`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `tarjeta_ibfk_2` FOREIGN KEY (`idperrec`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `tarjeta_ibfk_3` FOREIGN KEY (`idperentd`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `tarjeta_ibfk_4` FOREIGN KEY (`idperrecd`) REFERENCES `persona` (`idper`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
