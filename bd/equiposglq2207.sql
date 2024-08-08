-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2024 a las 23:07:05
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
-- Estructura de tabla para la tabla `accxequi`
--

CREATE TABLE `accxequi` (
  `ideqxpr` bigint(11) NOT NULL,
  `idvacc` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar`
--

CREATE TABLE `asignar` (
  `ideqxpr` bigint(11) NOT NULL,
  `idequ` bigint(11) DEFAULT NULL,
  `idperent` bigint(11) NOT NULL,
  `idperrec` bigint(11) NOT NULL,
  `fecent` date DEFAULT NULL,
  `observ` varchar(1000) DEFAULT NULL,
  `firent` varchar(255) DEFAULT NULL,
  `idperentd` bigint(11) DEFAULT NULL,
  `idperrecd` bigint(11) DEFAULT NULL,
  `fecdev` date DEFAULT NULL,
  `observd` varchar(1000) DEFAULT NULL,
  `firdev` varchar(255) DEFAULT NULL,
  `numcel` int(10) DEFAULT NULL,
  `opecel` bigint(11) DEFAULT NULL,
  `estexp` tinyint(1) DEFAULT 1,
  `difasg` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `iddom` bigint(11) NOT NULL,
  `nomdom` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`iddom`, `nomdom`) VALUES
(1, 'T. Documento'),
(2, 'T. Equipo'),
(3, 'Accesorios PC'),
(4, 'Estado'),
(5, 'Accesorios Móvil'),
(6, 'Office'),
(7, 'Windows'),
(8, 'T. Mantenimiento'),
(9, 'Operador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequ` bigint(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `serialeq` varchar(50) NOT NULL,
  `nomred` varchar(50) DEFAULT NULL,
  `idvtpeq` bigint(11) DEFAULT NULL,
  `capgb` bigint(5) NOT NULL,
  `ram` bigint(11) NOT NULL,
  `procs` varchar(100) DEFAULT NULL,
  `actequ` tinyint(1) DEFAULT 1,
  `tipcon` bigint(11) DEFAULT NULL,
  `pagequ` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmod` int(5) NOT NULL,
  `nommod` varchar(100) NOT NULL,
  `imgmod` varchar(255) DEFAULT NULL,
  `actmod` tinyint(1) NOT NULL DEFAULT 1,
  `idpag` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmod`, `nommod`, `imgmod`, `actmod`, `idpag`) VALUES
(1, 'Registro', NULL, 1, 51),
(2, 'Configuración', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `idpag` bigint(11) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `nompag` varchar(25) NOT NULL,
  `arcpag` varchar(100) NOT NULL,
  `ordpag` int(3) NOT NULL,
  `menpag` varchar(30) NOT NULL,
  `mospag` tinyint(1) DEFAULT NULL,
  `idmod` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagina`
--

INSERT INTO `pagina` (`idpag`, `icono`, `nompag`, `arcpag`, `ordpag`, `menpag`, `mospag`, `idmod`) VALUES
(1, 'fa fa-solid fa-cubes', 'Módulos', 'views/vmod.php', 1, 'home.php', 1, 2),
(2, 'fa fa-regular fa-file', 'Páginas', 'views/vpag.php', 2, 'home.php', 1, 2),
(3, 'fa fa-solid fa-user', 'PagxPef', 'views/vpgxf.php', 3, 'home.php', 2, 2),
(4, 'fa fa-solid fa-address-card', 'Perfiles', 'views/vpef.php', 4, 'home.php', 1, 2),
(5, 'fa fa-solid fa-user', 'PerxPef', 'views/vperxf.php', 5, 'home.php', 2, 2),
(6, 'fa fa-solid fa-boxes-stacked', 'Dominio', 'views/vdom.php', 6, 'home.php', 1, 2),
(7, 'fa fa-solid fa-dollar-sign', 'Valor', 'views/vval.php', 7, 'home.php', 1, 2),
(51, 'fa fa-solid fa-arrows-turn-to-dots', 'Asignar', 'views/vasg.php', 51, 'home.php', 1, 1),
(52, 'fa fa-solid fa-laptop', 'Equipos', 'views/vequ.php', 52, 'home.php', 1, 1),
(53, 'fa fa-solid fa-user', 'Personas', 'views/vper.php', 54, 'home.php', 1, 1),
(54, 'fa fa-solid fa-mobile', 'Celulares', 'views/vequ.php', 53, 'home.php', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagxpef`
--

CREATE TABLE `pagxpef` (
  `idpag` bigint(11) NOT NULL,
  `idpef` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagxpef`
--

INSERT INTO `pagxpef` (`idpag`, `idpef`) VALUES
(2, 1),
(4, 1),
(6, 1),
(1, 1),
(7, 1),
(3, 1),
(5, 1),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(51, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idpef` bigint(11) NOT NULL,
  `nompef` varchar(100) NOT NULL,
  `idmod` int(5) NOT NULL,
  `idpag` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idpef`, `nompef`, `idmod`, `idpag`) VALUES
(1, 'Administrador', 2, 1),
(2, 'Sistemas', 1, 51),
(3, 'Colaborador', 1, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idper` bigint(11) NOT NULL,
  `nomper` varchar(100) NOT NULL,
  `apeper` varchar(100) NOT NULL,
  `idvtpd` bigint(11) NOT NULL,
  `ndper` varchar(12) NOT NULL,
  `emaper` varchar(255) DEFAULT NULL,
  `pasper` text DEFAULT NULL,
  `cargo` varchar(100) NOT NULL,
  `usured` varchar(50) DEFAULT NULL,
  `actper` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idper`, `nomper`, `apeper`, `idvtpd`, `ndper`, `emaper`, `pasper`, `cargo`, `usured`, `actper`) VALUES
(1, 'JUAN DAVID', 'CHAPARRO DOMINGUEZ', 1, '1072642921', 'soportei@galqui.com', 'b37276a94dfc2d512045932d36c8df69b8c2c729sGlaqs2%', 'APRENDIZ SENA', 'soporteit', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perxpef`
--

CREATE TABLE `perxpef` (
  `idper` bigint(11) NOT NULL,
  `idpef` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perxpef`
--

INSERT INTO `perxpef` (`idper`, `idpef`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prgxequi`
--

CREATE TABLE `prgxequi` (
  `idequ` bigint(11) NOT NULL,
  `idvprg` bigint(11) NOT NULL,
  `verprg` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE `valor` (
  `idval` bigint(11) NOT NULL,
  `codval` bigint(11) DEFAULT NULL,
  `nomval` varchar(70) NOT NULL,
  `iddom` bigint(11) NOT NULL,
  `actval` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valor`
--

INSERT INTO `valor` (`idval`, `codval`, `nomval`, `iddom`, `actval`) VALUES
(1, 101, 'CC', 1, 1),
(3, 102, 'CE', 1, 1),
(4, 103, 'TI', 1, 1),
(5, 104, 'DNI', 1, 1),
(6, 105, 'PEP', 1, 1),
(7, 201, 'Portatil', 2, 1),
(8, 202, 'All in One', 2, 1),
(9, 203, 'Torre', 2, 1),
(10, 401, 'Propio', 4, 1),
(11, 402, 'Alquiler', 4, 1),
(13, 301, 'Mouse', 3, 1),
(14, 302, 'Teclado', 3, 1),
(15, 303, 'Cargador', 3, 1),
(16, 304, 'Funda', 3, 1),
(17, 305, 'Pad Mouse', 3, 1),
(18, 502, 'Cable de datos', 5, 1),
(19, 503, 'Audifonos', 5, 1),
(20, 505, 'Protector', 5, 1),
(21, 504, 'SIM', 5, 1),
(22, 506, 'Caja', 5, 1),
(23, 507, 'Manuales', 5, 1),
(26, 501, 'Cargador', 5, 1),
(27, 601, 'Standard', 6, 1),
(28, 602, 'Home & Business', 6, 1),
(29, 604, 'Professional Plus', 6, 1),
(30, 603, 'Professional', 6, 1),
(31, 605, 'Office 365', 6, 1),
(32, 701, 'Home', 7, 1),
(33, 702, 'Pro', 7, 1),
(34, 703, 'Enterprise', 7, 1),
(35, 801, 'Preventivo', 8, 1),
(36, 802, 'Correctivo', 8, 1),
(37, 803, 'Predictivo', 8, 1),
(38, 901, 'N/A', 9, 1),
(39, 902, 'Claro', 9, 1),
(40, 903, 'Movistar', 9, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accxequi`
--
ALTER TABLE `accxequi`
  ADD KEY `ideqxpr` (`ideqxpr`),
  ADD KEY `idvacc` (`idvacc`);

--
-- Indices de la tabla `asignar`
--
ALTER TABLE `asignar`
  ADD PRIMARY KEY (`ideqxpr`),
  ADD KEY `idequ` (`idequ`),
  ADD KEY `idperent` (`idperent`),
  ADD KEY `idperrec` (`idperrec`),
  ADD KEY `idperentd` (`idperentd`),
  ADD KEY `idperrecd` (`idperrecd`);

--
-- Indices de la tabla `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`iddom`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idequ`),
  ADD KEY `idvtpeq` (`idvtpeq`),
  ADD KEY `tipcon` (`tipcon`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmod`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`idpag`),
  ADD KEY `idmod` (`idmod`);

--
-- Indices de la tabla `pagxpef`
--
ALTER TABLE `pagxpef`
  ADD KEY `idpag` (`idpag`),
  ADD KEY `idpef` (`idpef`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idpef`),
  ADD KEY `idmod` (`idmod`),
  ADD KEY `idpag` (`idpag`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idper`),
  ADD KEY `idvtpd` (`idvtpd`);

--
-- Indices de la tabla `perxpef`
--
ALTER TABLE `perxpef`
  ADD KEY `idper` (`idper`),
  ADD KEY `idpef` (`idpef`);

--
-- Indices de la tabla `prgxequi`
--
ALTER TABLE `prgxequi`
  ADD KEY `idequ` (`idequ`),
  ADD KEY `idvprg` (`idvprg`);

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
-- Indices de la tabla `valor`
--
ALTER TABLE `valor`
  ADD PRIMARY KEY (`idval`),
  ADD UNIQUE KEY `codval` (`codval`),
  ADD KEY `iddom` (`iddom`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignar`
--
ALTER TABLE `asignar`
  MODIFY `ideqxpr` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddom` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequ` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmod` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `idpag` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `pagxpef`
--
ALTER TABLE `pagxpef`
  MODIFY `idpag` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idpef` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `perxpef`
--
ALTER TABLE `perxpef`
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `idtaj` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `valor`
--
ALTER TABLE `valor`
  MODIFY `idval` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accxequi`
--
ALTER TABLE `accxequi`
  ADD CONSTRAINT `accxequi__ibfk_1` FOREIGN KEY (`ideqxpr`) REFERENCES `asignar` (`ideqxpr`);

--
-- Filtros para la tabla `asignar`
--
ALTER TABLE `asignar`
  ADD CONSTRAINT `asignar_ibfk_1` FOREIGN KEY (`idequ`) REFERENCES `equipo` (`idequ`),
  ADD CONSTRAINT `asignar_ibfk_3` FOREIGN KEY (`idperent`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `asignar_ibfk_4` FOREIGN KEY (`idperrec`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `asignar_ibfk_5` FOREIGN KEY (`idperentd`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `asignar_ibfk_6` FOREIGN KEY (`idperrecd`) REFERENCES `persona` (`idper`);

--
-- Filtros para la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD CONSTRAINT `pagina_ibfk_1` FOREIGN KEY (`idmod`) REFERENCES `modulo` (`idmod`);

--
-- Filtros para la tabla `pagxpef`
--
ALTER TABLE `pagxpef`
  ADD CONSTRAINT `pagxpef_ibfk_1` FOREIGN KEY (`idpag`) REFERENCES `pagina` (`idpag`),
  ADD CONSTRAINT `pagxpef_ibfk_2` FOREIGN KEY (`idpef`) REFERENCES `perfil` (`idpef`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`idmod`) REFERENCES `modulo` (`idmod`);

--
-- Filtros para la tabla `perxpef`
--
ALTER TABLE `perxpef`
  ADD CONSTRAINT `perxpef_ibfk_1` FOREIGN KEY (`idper`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `perxpef_ibfk_2` FOREIGN KEY (`idpef`) REFERENCES `perfil` (`idpef`);

--
-- Filtros para la tabla `prgxequi`
--
ALTER TABLE `prgxequi`
  ADD CONSTRAINT `prgxequi__ibfk_1` FOREIGN KEY (`idequ`) REFERENCES `equipo` (`idequ`);

--
-- Filtros para la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`idperent`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `tarjeta_ibfk_2` FOREIGN KEY (`idperrec`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `tarjeta_ibfk_3` FOREIGN KEY (`idperentd`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `tarjeta_ibfk_4` FOREIGN KEY (`idperrecd`) REFERENCES `persona` (`idper`);

--
-- Filtros para la tabla `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `valor_ibfk_1` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
