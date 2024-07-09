DROP DATABASE IF EXISTS equiposglq;
CREATE DATABASE equiposglq;
USE equiposglq;
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

--
-- Volcado de datos para la tabla `accxequi`
--

INSERT INTO `accxequi` (`ideqxpr`, `idvacc`) VALUES
(8, 14),
(10, 18),
(10, 26),
(9, 19),
(9, 21),
(9, 22),
(9, 23),
(6, 15),
(6, 16),
(6, 17),
(7, 14);

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
  `idperentd` bigint(11) DEFAULT NULL,
  `idperrecd` bigint(11) DEFAULT NULL,
  `fecdev` date DEFAULT NULL,
  `observd` varchar(1000) DEFAULT NULL,
  `numcel` int(10) DEFAULT NULL,
  `opecel` bigint(11) DEFAULT NULL,
  `estexp` tinyint(1) DEFAULT 1,
  `difasg` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignar`
--

INSERT INTO `asignar` (`ideqxpr`, `idequ`, `idperent`, `idperrec`, `fecent`, `observ`, `idperentd`, `idperrecd`, `fecdev`, `observd`, `numcel`, `opecel`, `estexp`, `difasg`) VALUES
(6, 1, 1, 1, '2024-06-18', 'No', NULL, NULL, NULL, NULL, NULL, NULL, 1, '20240618145020'),
(7, 1, 1, 1, '2024-06-18', 'NOP\r\n', NULL, NULL, NULL, NULL, NULL, NULL, 1, '20240618145205'),
(8, 1, 1, 1, '2024-06-18', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, '20240618145352'),
(9, 2, 1, 1, '2024-06-18', 'No', NULL, NULL, NULL, NULL, 227575, 38, 1, '20240618145421'),
(10, 2, 1, 2, '2024-06-19', 'Seddef', NULL, NULL, NULL, NULL, 322566, 38, 1, '20240619163951');

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
  `procs` varchar(11) DEFAULT NULL,
  `actequ` tinyint(1) DEFAULT 1,
  `tipcon` bigint(11) DEFAULT NULL,
  `contrato` varchar(250) DEFAULT NULL,
  `valrcont` bigint(11) DEFAULT NULL,
  `pagequ` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequ`, `marca`, `modelo`, `serialeq`, `nomred`, `idvtpeq`, `capgb`, `ram`, `procs`, `actequ`, `tipcon`, `contrato`, `valrcont`, `pagequ`) VALUES
(1, 'HP', '24-g003la', '8CC6381SMQ', 'ADM_FN_CON_04', 8, 512, 16, 'i5-6200U CP', 1, 10, '', 0, 52),
(2, 'Samsung', 'A21s', '351261442981315', NULL, NULL, 128, 16, NULL, 1, NULL, NULL, NULL, 54);

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
(54, 2);

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
(3, 'Empleado', 1, 52);

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
  `emaper` varchar(255) NOT NULL,
  `pasper` text DEFAULT NULL,
  `cargo` varchar(100) NOT NULL,
  `usured` varchar(50) NOT NULL,
  `actper` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idper`, `nomper`, `apeper`, `idvtpd`, `ndper`, `emaper`, `pasper`, `cargo`, `usured`, `actper`) VALUES
(1, 'David', 'Chaparro', 1, '1072642921', 'soporteit@galqui.com', 'b37276a94dfc2d512045932d36c8df69b8c2c729sGlaqs2%', 'Aprendiz Sena', 'soporteit', 1),
(2, 'Prueba', 'Persona', 1, '1987654', 'persona@prueba.com', '305244cc2d9afd44b7ffc6bd96b605151739a5absGlaqs2%', 'Intento', 'prupersona', 1);

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
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prgxequi`
--

CREATE TABLE `prgxequi` (
  `idprxeq` bigint(11) NOT NULL,
  `idequ` bigint(11) NOT NULL,
  `idvprg` bigint(11) NOT NULL,
  `verprg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prgxequi`
--

INSERT INTO `prgxequi` (`idprxeq`, `idequ`, `idvprg`, `verprg`) VALUES
(21, 1, 27, '2016'),
(22, 1, 33, '10');

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
(18, '345345', NULL, 1, 2, '2024-06-17', 2, 1, '0000-00-00', 1);

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
(7, 201, 'Portátil', 2, 1),
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
(19, 503, 'Audífonos', 5, 1),
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
(38, 901, 'Claro', 9, 1),
(39, 902, 'Movistar', 9, 1);

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
  ADD PRIMARY KEY (`idprxeq`),
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
  MODIFY `ideqxpr` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddom` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequ` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmod` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perxpef`
--
ALTER TABLE `perxpef`
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `prgxequi`
--
ALTER TABLE `prgxequi`
  MODIFY `idprxeq` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `idtaj` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `valor`
--
ALTER TABLE `valor`
  MODIFY `idval` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
