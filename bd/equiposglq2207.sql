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
(1, 13),
(1, 15),
(2, 15),
(2, 16),
(3, 13),
(3, 14),
(3, 15),
(4, 15),
(5, 13),
(5, 14),
(5, 17),
(6, 15),
(7, 26),
(7, 18),
(7, 20),
(8, 18),
(8, 21),
(9, 26),
(9, 19),
(9, 21),
(10, 18),
(10, 20),
(11, 26),
(11, 18),
(11, 21),
(11, 20),
(12, 18),
(12, 19),
(12, 21);

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
(1, 1, 1, 10, '2024-06-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '20240718123605'),
(2, 1, 1, 3, '2024-06-01', NULL, 3, 1, '2024-05-26', NULL, NULL, NULL, 2, '20240718123606'),
(3, 4, 1, 11, '2023-11-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '20240718123607'),
(4, 3, 1, 7, '2024-06-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '20240718123608'),
(5, 2, 1, 6, '2024-06-19', NULL, 6, 1, '2024-07-08', NULL, NULL, NULL, 2, '20240718123609'),
(6, 7, 1, 10, '2023-08-08', NULL, 10, 1, '2024-07-08', NULL, NULL, NULL, 2, '20240718123610'),
(7, 9, 1, 10, '2024-06-27', NULL, NULL, NULL, NULL, NULL, NULL, 38, 1, '20240718123614'),
(8, 10, 1, 3, '2024-06-01', NULL, 3, 1, '2024-05-26', NULL, 2147483647, 40, 2, '20240718123615'),
(9, 11, 1, 11, '2023-11-14', NULL, NULL, NULL, NULL, NULL, 2147483647, 39, 1, '20240718123616'),
(10, 12, 1, 7, '2024-06-11', NULL, NULL, NULL, NULL, NULL, NULL, 38, 1, '20240718123617'),
(11, 13, 1, 6, '2024-06-19', NULL, 6, 1, '2024-07-08', NULL, 2147483647, 40, 2, '20240718123618'),
(12, 14, 1, 10, '2023-08-08', NULL, 10, 1, '2024-07-08', NULL, 2147483647, 39, 2, '20240718123619');

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

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequ`, `marca`, `modelo`, `serialeq`, `nomred`, `idvtpeq`, `capgb`, `ram`, `procs`, `actequ`, `tipcon`, `pagequ`) VALUES
(1, 'LENOVO', 'THIINKPAD X13', 'GM05VZN1', 'GAL-ING-PRO-04', 7, 474, 16, '11th Gen Intel(R) Core(TM) i7-1185G7 @ 3.00GHz', 1, 11, 52),
(2, 'HP', '2458', '5CG2223J0C', 'GLQ_CMP_01', 7, 256, 8, 'AMD Ryzen 5 5500U with Radeon Graphics', 1, 11, 52),
(3, 'LENOVO', 'YOGA 520', 'MP1E5DQF', 'GLQ_BDG_01', 7, 1000, 16, 'Intel(R) Core(TM) i7-8550U CPU @ 1.80GHz', 2, 10, 52),
(4, 'LENOVO', 'THINK PAD', 'PF3E91QV', 'GG-TEC-01', 7, 512, 8, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz', 2, 10, 52),
(5, 'LENOVO', 'THINKPAD E14', 'PF3L67P7', 'GLQ_OFI_07', 7, 256, 16, '12th Gen Intel Core i7 - 1265U Vpro @ 3.60 GHz', 1, 11, 52),
(6, 'LENOVO', 'THINKPAD E14', 'PF3L4PPA', 'GAL_GE_EJE_04', 7, 512, 16, '11th Gen Intel(R) Core(TM) i7-1165G7 @ 2.80GHz', 1, 11, 52),
(7, 'DELL', 'LATITUDE 9420', '15Z8CK3', 'ADM_COMPR', 7, 512, 16, '11th Gen Intel(R) Core(TM) i7-1165G7 @ 2.80GHz', 1, 10, 52),
(8, 'Micro-Star International', 'GL62M 7RDX', '9S716J9622422ZHB000020', 'EJE_PRO_COO_01', 7, 2000, 16, 'Intel(R) Core(TM) i7-7700HQ CPU @ 2.80GHz', 1, 10, 52),
(9, 'MOTOROLA', 'G20', '356348781747939', NULL, NULL, 128, 8, NULL, 2, 11, 54),
(10, 'MOTO', 'G31', '355302642896477', NULL, NULL, 256, 8, NULL, 1, 11, 54),
(11, 'VIVO', 'Y16', '867315061634329', NULL, NULL, 128, 8, NULL, 2, 11, 54),
(12, 'IPHONE', '6 PLUS', '359321060055016', NULL, NULL, 256, 8, NULL, 2, 11, 54),
(13, 'MOTOROLA', 'G22', '359694274277208', NULL, NULL, 128, 8, NULL, 1, 11, 54),
(14, 'HONOR', 'X6s', '862800069243269', NULL, NULL, 128, 16, NULL, 1, 11, 54);

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
(1, 'David', 'Chaparro', 1, '1072642921', 'soporteit@galqui.com', 'b37276a94dfc2d512045932d36c8df69b8c2c729sGlaqs2%', 'Aprendiz Sena', 'soporteit', 1),
(2, 'Prueba', 'Persona', 1, '1987654', 'persona@prueba.com', '305244cc2d9afd44b7ffc6bd96b605151739a5absGlaqs2%', 'Intento', 'prupersona', 1),
(3, 'MARYI YULLIED', 'CELIS RIVERA', 1, '1069304404', 'rrhh@galqui.com', NULL, 'APRENDIZ SENA', '', 1),
(4, 'ALDEYSON JULIAN', 'RODRIGUEZ BOHORQUEZ', 1, '80200165', 'aldeysonrodriguez@galqui.com', NULL, 'SUPERVISOR INSTRUMENTACION Y CONTROL', 'aldeysonrodriguez', 1),
(5, 'JOHAN DAVID', 'CUERVO ACEVEDO', 1, '1055314236', 'johancuervo@galqui.com', NULL, 'SUPERVISOR JUNIOR INSTRUMENTISTA', 'johancuervo', 1),
(6, 'JEISON ALEJANDRO', 'MOLANO PINZON', 1, '1024530115', 'jeisonmolano@galqui.com', NULL, 'INGENIERO DE PROYECTOS  II', 'jeisonmolano', 1),
(7, 'DUVAN CAMILO', 'RIVERA ABRIL', 1, '1076240985', NULL, NULL, 'AUXILIAR LOGISTICO', '', 2),
(8, 'RUBEN DARIO', 'PABON RAMIREZ', 1, '80370195', 'rubenpabon@galqui.com', NULL, 'SUPERVISOR ELECTRICO', 'rubenpabon', 1),
(9, 'ALEX HUMBERTO', 'OTALORA RIVERA', 1, '80096803', 'alexotalora@galqui.com', NULL, 'LIDER DE INGENIERIA Y DISEÑO', 'alexotalora', 2),
(10, 'CAMILO ANDRES', 'MONCAYO URIBE', 1, '1100953829', 'camilomoncayo@galqui.com', 'f5c9a0190a15664fb67d4d2767cdeeb4b1c3662dsGlaqs2%', 'LIDER DE PROYECTOS', 'camilomoncayo', 1),
(11, 'JOSE GREGORIO', 'ROJAS SIERRA', 1, '80059515', 'joserojas@galqui.com', NULL, 'INGENIERO DE PLANEACION Y CONTROL II', 'joserojas', 2),
(12, 'ANDREA PAOLA', 'LAVERDE GALINDO', 1, '1072426375', 'andrealaverde@galqui,com', NULL, 'AUXILIAR DE MATERIALES E INVENTARIO', 'andrealaverde', 1),
(13, 'JULIAN DAVID', 'ACEVEDO RODRIGUEZ', 1, '1052417176', 'davidacevedo@galqui.com', NULL, 'INGENIERO DE PROYECTOS I', 'davidacevedo', 1);

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
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prgxequi`
--

CREATE TABLE `prgxequi` (
  `idequ` bigint(11) NOT NULL,
  `idvprg` bigint(11) NOT NULL,
  `verprg` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prgxequi`
--

INSERT INTO `prgxequi` (`idequ`, `idvprg`, `verprg`) VALUES
(1, 27, '2016'),
(1, 33, '10'),
(2, 30, '2019'),
(2, 33, '10'),
(3, 29, '2016'),
(3, 33, '10'),
(4, 27, '2016'),
(4, 33, '10'),
(5, 27, '2016'),
(5, 33, '10'),
(6, 31, NULL),
(6, 33, '10'),
(7, 31, NULL),
(7, 33, '10'),
(8, 31, NULL),
(8, 33, '10');

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
(1, NULL, '0013708124 209,11100', 1, 10, '2024-06-27', NULL, NULL, NULL, 1),
(2, '0003821203', '0013708124 209,11100', 1, 3, '2024-06-01', 3, 1, '2024-05-26', 2),
(3, '0003820518', '0013307047 203,03239', 1, 4, '2023-11-27', NULL, NULL, NULL, 1),
(4, '0003821082', '0013304288 203,00480', 1, 11, '2023-11-14', NULL, NULL, NULL, 1),
(5, '0002445421', NULL, 1, 7, '2024-06-11', NULL, NULL, NULL, 1),
(6, '0011967453', '4545987', 1, 8, '2024-06-24', NULL, NULL, NULL, 1),
(7, '0003112012', NULL, 1, 6, '2024-06-19', 6, 1, '2024-07-08', 2),
(8, '0012407026 189,20722', '0001802290 027,32818', 1, 5, '2024-06-20', 5, 1, '2024-07-09', 2),
(9, '0003111906', NULL, 1, 10, '2023-08-08', 10, 1, '2024-07-08', 2),
(10, '87979856465', '12565152', 1, 12, '2023-08-29', NULL, NULL, NULL, 1),
(11, NULL, '10221 , 548959', 1, 13, '2023-10-10', 13, 1, '2024-05-20', 2),
(12, '894897956', '56544', 1, 7, '2024-07-11', NULL, NULL, NULL, 1),
(13, '330321865', NULL, 1, 9, '2023-08-12', NULL, NULL, NULL, 1),
(14, NULL, '55452', 1, 13, '2023-08-12', NULL, NULL, NULL, 1);

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
  MODIFY `ideqxpr` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddom` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequ` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `perxpef`
--
ALTER TABLE `perxpef`
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `idtaj` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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