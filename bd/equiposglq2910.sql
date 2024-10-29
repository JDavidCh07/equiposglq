DROP DATABASE IF EXISTS glqapp;
CREATE DATABASE glqapp;
USE glqapp;
--
-- Base de datos: `glqapp`
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
  `rutpdf` varchar(255) DEFAULT NULL,
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
(9, 'Operador'),
(10, 'T. Permiso'),
(11, 'Ubicación'),
(12, 'Departamento'),
(13, 'Sexo');

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
-- Estructura de tabla para la tabla `jefxper`
--

CREATE TABLE `jefxper` (
  `idjef` bigint(11) DEFAULT NULL,
  `idper` bigint(11) DEFAULT NULL,
  `tipjef` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmod` int(5) NOT NULL,
  `nommod` varchar(100) NOT NULL,
  `imgmod` varchar(255) DEFAULT NULL,
  `actmod` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmod`, `nommod`, `imgmod`, `actmod`) VALUES
(1, 'Registro', NULL, 1),
(2, 'Configuración', NULL, 1),
(3, 'Permisos', NULL, 1);

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
(4, 'fa fa-solid fa-address-card', 'Perfiles', 'views/vpef.php', 4, 'home.php', 1, 2),
(6, 'fa fa-solid fa-boxes-stacked', 'Dominio', 'views/vdom.php', 6, 'home.php', 1, 2),
(7, 'fa fa-solid fa-dollar-sign', 'Valor', 'views/vval.php', 7, 'home.php', 1, 2),
(51, 'fa fa-solid fa-arrows-turn-to-dots', 'Asignar', 'views/vasg.php', 51, 'home.php', 1, 1),
(52, 'fa fa-solid fa-laptop', 'Equipos', 'views/vequ.php', 52, 'home.php', 1, 1),
(53, 'fa fa-solid fa-user', 'Personas', 'views/vper.php', 54, 'home.php', 1, 1),
(54, 'fa fa-solid fa-mobile', 'Celulares', 'views/vequ.php', 53, 'home.php', 1, 1),
(101, 'fa fa-solid fa-file-circle-check', 'Permisos', 'views/vprm.php', 101, 'home.php', 1, 3);

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
(53, 4),
(101, 4),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(1, 1),
(2, 1),
(4, 1),
(6, 1),
(7, 1),
(51, 3),
(53, 3),
(101, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pefxmod`
--

CREATE TABLE `pefxmod` (
  `idmod` int(5) NOT NULL,
  `idpef` bigint(11) NOT NULL,
  `idpag` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pefxmod`
--

INSERT INTO `pefxmod` (`idmod`, `idpef`, `idpag`) VALUES
(1, 4, 53),
(3, 4, 101),
(1, 2, 51),
(2, 1, 1),
(1, 3, 53),
(3, 3, 101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idpef` bigint(11) NOT NULL,
  `nompef` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idpef`, `nompef`) VALUES
(1, 'Administrador'),
(2, 'Sistemas'),
(3, 'Colaborador'),
(4, 'Recursos Humanos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idprm` bigint(11) NOT NULL,
  `noprm` bigint(11) DEFAULT NULL,
  `fecini` datetime DEFAULT NULL,
  `fecfin` datetime DEFAULT NULL,
  `idjef` bigint(11) NOT NULL,
  `idvtprm` bigint(11) NOT NULL,
  `sptrut` varchar(255) DEFAULT NULL,
  `desprm` varchar(250) DEFAULT NULL,
  `obsprm` varchar(250) DEFAULT NULL,
  `estprm` tinyint(1) DEFAULT NULL,
  `idper` bigint(11) NOT NULL,
  `idvubi` bigint(11) NOT NULL,
  `fecsol` date DEFAULT NULL,
  `fecrev` date DEFAULT NULL,
  `idrev` bigint(11) DEFAULT NULL,
  `rutpdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idprm`, `noprm`, `fecini`, `fecfin`, `idjef`, `idvtprm`, `sptrut`, `desprm`, `obsprm`, `estprm`, `idper`, `idvubi`, `fecsol`, `fecrev`, `idrev`, `rutpdf`) VALUES
(1, 1, '2024-10-31 08:00:00', '2024-10-31 13:00:00', 1, 42, NULL, 'NO', NULL, 3, 1, 49, '2024-10-29', '2024-10-29', 1, NULL),
(2, 2, '2024-11-01 14:00:00', '2024-11-01 17:30:00', 1, 44, NULL, 'NO', NULL, 3, 1, 49, '2024-10-29', '2024-10-29', 1, NULL),
(3, 3, '2024-11-04 08:00:00', '2024-11-04 13:00:00', 1, 41, NULL, 'NO', NULL, 3, 1, 49, '2024-10-29', '2024-10-29', 1, NULL),
(4, 4, '2024-11-06 14:00:00', '2024-11-06 17:30:00', 1, 44, NULL, 'NO', NULL, 3, 1, 49, '2024-10-29', '2024-10-29', 1, NULL),
(5, NULL, '2024-11-11 08:00:00', '2024-11-11 13:00:00', 1, 43, NULL, 'NO', 'NO', 4, 1, 49, '2024-10-29', '2024-10-29', 1, NULL),
(6, 5, '2024-11-12 14:00:00', '2024-11-12 17:30:00', 1, 48, NULL, 'NO', NULL, 3, 1, 49, '2024-10-29', '2024-10-29', 1, NULL),
(7, 6, '2024-11-13 08:00:00', '2024-11-13 13:00:00', 1, 41, NULL, 'NO', NULL, 3, 1, 49, '2024-10-29', '2024-10-29', 1, NULL),
(8, NULL, '2024-11-19 14:00:00', '2024-11-19 17:30:00', 1, 43, NULL, 'NO', 'NO', 4, 1, 49, '2024-10-29', '2024-10-29', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idper` bigint(11) NOT NULL,
  `nomper` varchar(100) NOT NULL,
  `apeper` varchar(100) NOT NULL,
  `idvsex` bigint(11) NOT NULL,
  `idvtpd` bigint(11) NOT NULL,
  `ndper` varchar(12) NOT NULL,
  `emaper` varchar(255) DEFAULT NULL,
  `pasper` text DEFAULT NULL,
  `idvdpt` bigint(11) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `usured` varchar(50) DEFAULT NULL,
  `actper` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idper`, `nomper`, `apeper`, `idvsex`, `idvtpd`, `ndper`, `emaper`, `pasper`, `idvdpt`, `cargo`, `usured`, `actper`) VALUES
(1, 'JUAN DAVID', 'CHAPARRO DOMINGUEZ', 61, 1, '1072642921', 'soporteit@galqui.com', '8fe5fedffcdea6ffc421774fb82253de3c30671bsGlaqs2%', 51, 'AUXILIAR IT', 'soporteit', 1),
(2, 'WILLIAM', 'ARIZA FONTECHA', 61, 1, '19440457', 'williamariza1@galqui.com', '330897bd480068afc6df282f8b2a4df487f2f696sGlaqs2%', 51, 'C.E.O & FOUNDER', 'williamariza', 1),
(3, 'SANTIAGO', 'ARIZA GONZALEZ', 61, 1, '1020757660', 'santiagoariza@galqui.com', '171b28133ac047a03ef97ef93f00448a1c4ada8bsGlaqs2%', 51, 'ENERGY TRANSITION BUSINESS DEVELOPMENT DIRECTOR', 'santiagoariza', 1),
(4, 'DIEGO FELIPE', 'ZEA VARGAS', 61, 1, '80728488', 'diegozea@galqui.com', '91ebff8fa48b45f001467d3fe2940bfd59f8b932sGlaqs2%', 51, 'GERENTE GENERAL', 'diegozea', 1),
(5, 'KARENTH JULIETH', 'MENDEZ TORRES', 62, 1, '1070011679', 'karenmendez@galqui.com', '87d39480e9ac729eda59e8acae658ff4800b658asGlaqs2%', 51, 'DIRECTOR ADMINISTRATIVO', 'karenmendez', 1),
(6, 'SAMY', 'GOLDSZTAYN LOSADA', 61, 1, '79512717', 'samygoldsztayn@galqui.com', '2e1b6fff96de862b96bde8489e336ea93323c5adsGlaqs2%', 55, 'GERENTE DE DESARROLLO DE NEGOCIOS', 'samygoldsztayn', 1),
(7, 'JULIAN DAVID', 'ACEVEDO RODRIGUEZ', 61, 1, '1052417176', 'davidacevedo@galqui.com', '6cc5184fc1c759ddb2d91bc99d3ac24c876f20c7sGlaqs2%', 52, 'INGENIERO DE PROYECTOS I ESPECIALIDAD ELECTRICA', 'julianacevedo', 1),
(8, 'ALVARO DANIEL', 'ALVARADO FAJARDO', 61, 1, '1049642457', 'alvaroalvarado@galqui.com', '1bfcf1aad1c6d7d0d3ea1ebc1a3d51278518932csGlaqs2%', 52, 'INGENIERO DE PROYECTOS I ESPECIALIDAD DE INSTRUMENTACION', 'alvaroalvarado', 1),
(9, 'HECTOR HERNAN', 'BAUTISTA AVELLA', 61, 1, '1049606406', 'hernanbautista@galqui.com', 'da2c4e875dfe9094fed6fa60d9ec46980bfc51cdsGlaqs2%', 52, 'LIDER QA/QC', 'hernanbautista', 1),
(10, 'SERGIO ANDRES', 'BLANCO ALMEIDA', 61, 1, '80797861', 'sergioblanco@galqui.com', 'bd2aafe33d56170d54a2d50685cc51bcc3aaa249sGlaqs2%', 52, 'INGENIERO DE PLANEACIÓN Y CONTROL II', 'sergioblanco', 1),
(11, 'LEDY VANESSA', 'CABEZAS CARRERO', 62, 1, '1049614093', 'vanessacabezas@galqui.com', 'acfde7293da72110e4df8984fb18a17054ae7285sGlaqs2%', 55, 'INGENIERO DE DESARROLLO DE NEGOCIOS', 'vanessacabezas', 1),
(12, 'SHARO SHIRLEY', 'CADENA BARRERA', 62, 1, '1012316801', NULL, '475fe1c5d50bf9b8ab88772fc7eb29f62a6b6548sGlaqs2%', 51, 'APRENDIZ SENA', NULL, 1),
(13, 'LIYER JULIAN', 'CARPETA CARDENAS', 61, 1, '1003533573', 'juliancarpeta@galqui.com', '748bed74fcaf1bddf1dc0646b2f8a14fcc5f0a38sGlaqs2%', 53, 'ANALISTA LOGISTICO', 'juliancarpeta', 1),
(14, 'NELSON', 'CASAS CARDOZO', 61, 1, '19342194', 'nelsoncasas@galqui.com', '6c90e229d7728f0dcbc69938a1fa41b9ee641a9esGlaqs2%', 51, 'SUPERVISOR DE LOGISTICA Y TRANSPORTE', 'nelsoncasas', 1),
(15, 'DIEGO ALEJANDRO', 'CASTIBLANCO CRUZ', 61, 1, '1015471494', 'diegocastiblanco@galqui.com', '23cfc2c34e79a2e0622233e4f630fa9200522acasGlaqs2%', 52, 'INGENIERO DE PROYECTOS I ESPECIALIDAD AUTOMATIZACION Y CONTROL', 'diegocastiblanco', 1),
(16, 'FAUNER ANDRES', 'CERON BONILLA', 61, 1, '1091970476', NULL, '66d70c6b764055499db6a4ccb9040cf2aa089570sGlaqs2%', 51, 'APRENDIZ SENA', NULL, 1),
(17, 'ASTRID LILIANA', 'CERON RODRIGUEZ', 62, 1, '1052381983', 'astridceron@galqui.com', '8fe5fedffcdea6ffc421774fb82253de3c30671bsGlaqs2%', 52, 'COORDINADOR DE PROYECTOS', 'astridceron', 1),
(18, 'WILMER ANDRES', 'CORREA SALAMANCA', 61, 1, '1049630994', 'wilmercorrea@galqui.com', '87284110e708a9f66cb86d73f181cc457334de58sGlaqs2%', 52, 'INSPECTOR QA/QC', 'wilmercorrea', 1),
(19, 'FABIO ANTONIO', 'CUBILLOS RIOS', 61, 1, '11346414', 'fabiocubillos@galqui.com', '8ed330ab40685e82d5da3c370efac204ce7d2aa3sGlaqs2%', 52, 'OPERADOR TECNICO', 'fabiocubillos', 1),
(20, 'JOHANNA PAOLA', 'DELGADO TORRES', 62, 1, '1074128495', 'johannadelgado@galqui.com', 'eecf5f7271349356f87a99e0b787894fd42cd32asGlaqs2%', 55, 'GERENTE DE DESARROLLO TÉCNICO', 'johannadelgado', 1),
(21, 'JORGE IVAN', 'ESLAVA GUZMAN', 61, 1, '1018467001', 'ivaneslava@galqui.com', '3203ab3156ebd61014de5a19da7d6e0650644871sGlaqs2%', 52, 'INGENIERO DE PROYECTOS II ESPECIALIDAD AUTOMATIZACION Y CONTROL', 'ivaneslava', 1),
(22, 'HOLMER GIOVANNY', 'ESPITIA PALACIOS', 61, 1, '11203390', 'giovannyespitia@galqui.com', 'd8846483999f67083ca86d44d6ea2fd401571846sGlaqs2%', 54, 'LIDER DE CONTABILIDAD', 'giovannyespitia', 1),
(23, 'BRAYAN DARIO', 'FORIGUA GONZALEZ', 61, 1, '1032467741', 'brayanforigua@galqui.com', '1521136e861a3d3014b1ea170e73481bd4a12787sGlaqs2%', 52, 'INGENIERO DE PROYECTOS II ESPECIALIDAD DE INNOVACION Y DESARROLLO', 'brayanforigua', 1),
(24, 'JULIETH CATALINA', 'GARZON CASALLAS', 62, 1, '1023924994', 'controldocumental@galqui.com', 'c1f85534703aaf0daaac6539af572ca004aab2e6sGlaqs2%', 52, 'PROFESIONAL DE CONTROL DOCUMENTAL', 'juliethgarzon', 1),
(25, 'EDDIE ALEXANDER', 'GOMEZ ROMERO', 61, 1, '1018483102', 'eddiegomez@galqui.com', '43b5e23b648add84473210b960b49adff6a31bb1sGlaqs2%', 52, 'INGENIERO DE PROYECTOS I ESPECIALIDAD MECANICA', 'eddiegomez', 1),
(26, 'JHON JAIRO', 'GONZALEZ RIVERA', 61, 1, '1078348551', 'jhongonzalez@galqui.com', '50dcb63e44e682199dfaafe3e9b70686314434a1sGlaqs2%', 52, 'LIDER DE TALLER CONSTRUCTIVO', 'jhongonzalez', 1),
(27, 'KAROL DAYANNA', 'GUTIERREZ MARTINEZ', 62, 1, '1052406528', 'karolgutierrez@galqui.com', '8eb9112c84545ce078eb7e83fff6e325e2cf3bf3sGlaqs2%', 55, 'INGENIERO DE PROCESOS I', 'karolgutierrez', 1),
(28, 'JAIRO', 'HERNANDEZ ARROYO', 61, 1, '73569204', 'jairohernandez@galqui.com', '98bfe7e8ef57ff3b606de35b4afe64ab094dc6c0sGlaqs2%', 52, 'INGENIERO DE PROYECTOS II ESPECIALIDAD MECANICA', 'jairohernandez', 1),
(29, 'JHON GERARDO', 'JAIME HERNANDEZ', 61, 1, '80801199', 'jhonjaime@galqui.com', '0179740958a8d2d2c3f6846c9daff0a6aff4c912sGlaqs2%', 52, 'LIDER DE TALLER CONSTRUCTIVO', 'jhonjaime', 1),
(30, 'YENI MILENA', 'LEON CAMARGO', 62, 1, '46457525', 'yenileon@galqui.com', 'd1b2d69754af733908f45800dd8669baf34c06besGlaqs2%', 52, 'GERENTE DE EJECUCION DE PROYECTOS', 'yenileon', 1),
(31, 'CINDY CAROLINA', 'LIZARAZO GOMEZ', 62, 1, '1100960586', 'carolinalizarazo@galqui.com', '04d2f5d7bcff53750223bb3b3b2bef6327840f14sGlaqs2%', 52, 'LIDER DE PROYECTOS', 'carolinalizarazo', 1),
(32, 'JUAN MIGUEL', 'LOPEZ', 61, 1, '79692351', 'juanlopez@galqui.com', 'fcd5dca22c2ef7c52ec2892008a750f53c4ef6basGlaqs2%', 54, 'DIRECTOR FINANCIERO', 'juanlopez', 1),
(33, 'LINA FERNANDA', 'LOPEZ ROSAS', 62, 1, '1006558340', 'linalopez@galqui.com', '84281fa64eb4b43f95e8f276ecc4ca43f5bc73e7sGlaqs2%', 52, 'PRACTICANTE UNIVERSITARIO - INGENIERA QUIMICA', 'linalopez', 1),
(34, 'FABIAN DAVID', 'MAHECHA MORA', 61, 1, '1020825696', 'fabianmahecha@galqui.com', '692ee5a08c2260eab7fc5755236256a068eeb056sGlaqs2%', 52, 'INSPECTOR QA/QC', 'fabianmahecha', 1),
(35, 'MIGUEL LEONARDO', 'MARTINEZ SOTO', 61, 1, '1022347823', 'miguelmartinez@galqui.com', '11a839b85f4f54f9c578da40878a9bf60c010c02sGlaqs2%', 51, 'LIDER DE RECURSOS HUMANOS', 'miguelmartinez', 1),
(36, 'DIEGO FELIPE', 'MESA GONZALEZ', 61, 1, '1018499452', 'diegomesa@galqui.com', '33804eaad9e0df956a25125d7c1732bb1759d4c7sGlaqs2%', 52, 'INGENIERO DE PROCESOS II', 'diegomesa', 1),
(37, 'JEISON ALEJANDRO', 'MOLANO PINZON', 61, 1, '1024530115', 'jeisonmolano@galqui.com', 'a53b8aff2818e9836c0ee14b08e3075187f2d76csGlaqs2%', 52, 'INGENIERO DE PROYECTOS II ESPECIALIDAD MECANICA', 'jeisonmolano', 1),
(38, 'OSCAR DANIEL', 'MONCADA RIVERA', 61, 1, '1078348661', 'oscarmoncada@galqui.com', 'ab401698481a0ee0b449a965e0fc31ce3c2d08a6sGlaqs2%', 52, 'LIDER DE TALLER CONSTRUCTIVO', 'oscarmoncada', 1),
(39, 'CAMILO ANDRES', 'MONCAYO URIBE', 61, 1, '1100953829', 'camilomoncayo@galqui.com', 'f5c9a0190a15664fb67d4d2767cdeeb4b1c3662dsGlaqs2%', 52, 'LIDER DE PROYECTOS', 'camilomoncayo', 1),
(40, 'HECTOR ALFONSO', 'MORALES CASTAÑEDA', 61, 1, '19420510', 'hectormorales@galqui.com', '207e001ad8e6381573eb57cc472080a8f8290d33sGlaqs2%', 52, 'SUPERVISOR MECANICO', 'hectormorales', 1),
(41, 'CARLOS ALBERTO', 'MORENO MORENO', 61, 1, '74856962', 'carlosmoreno@tececor.com', '6d4df4435837c87f5c1d72a4780a0b4adce0c5b1sGlaqs2%', 51, 'AUXILIAR ADMINISTRATIVO', 'carlosmoreno', 1),
(42, 'LUZ ANGELICA', 'MOSCOSO BALLEN', 62, 1, '1068953414', 'angelicamoscoso@galqui.com', '02dfad670852e68de7106a40849ab26ea39890f1sGlaqs2%', 54, 'ANALISTA CONTABLE', 'angelicamoscoso', 1),
(43, 'HEDIER ANTONIO', 'MUÑOZ BELTRAN', 61, 1, '80271565', 'hediermunoz@galqui.com', '658902e4b60b3f8c0769ab6dd51322fd10391484sGlaqs2%', 53, 'ANALISTA DE COMPRAS ', 'hediermunoz', 1),
(44, 'HENRY JHOAN', 'NOVOA LINARES', 61, 1, '1072640387', 'henrisillo@hotmail.com', '98b95488c76219adbaf5251ec9e2e5b9b3939fa2sGlaqs2%', 51, 'MENSAJERO - TODERO', NULL, 1),
(45, 'ALEX HUMBERTO', 'OTALORA RIVERA', 61, 1, '80096803', 'alexotalora@galqui.com', 'ce9dba64788f2ea17fe95f31c844a37ca37f6b46sGlaqs2%', 52, 'COORDINADOR DE INGENIERIA Y DISEÑO', 'alexotalora', 1),
(46, 'RUBEN DARIO', 'PABON RAMIREZ', 61, 1, '80370195', 'rubenpabon@galqui.com', 'e7163fc2ce65430ba669da9fff417fc26a0f35a2sGlaqs2%', 52, 'SUPERVISOR ELECTRICO', 'rubenpabon', 1),
(47, 'GERALDIN VIVIANA', 'POVEDA GRACIA', 62, 1, '1003882174', 'vivianapoveda@galqui.com', '70471b42a0d803ade2fa6eecab76b930dee527a1sGlaqs2%', 54, 'ANALISTA CONTABLE', 'vivianapoveda', 1),
(48, 'FABIO AURELIO', 'PULIDO GOMEZ', 61, 1, '74187530', 'fabiopulido@galqui.com', 'e0da0cfc2d59a7744732460f97e0d971309e5fa1sGlaqs2%', 51, 'LIDER HSEQ', 'fabiopulido', 1),
(49, 'SANDRA LIZNETH', 'PULIDO GOMEZ', 62, 1, '46377206', 'sandrapulido@galqui.com', 'c6e3c1e3f1387e4b1e15c163433bac2b294d1852sGlaqs2%', 51, 'GESTOR SOCIAL Y ADMINISTRATIVO', 'sandrapulido', 1),
(50, 'WILMER FERNEY', 'PULIDO SILVA', 61, 1, '80062830', 'wilmerpulido@galqui.com', 'ef4d74f33e752c2d6a10e3edf964a71dbb6eeed6sGlaqs2%', 52, 'LIDER DE PROYECTOS ESPECIALIDAD MECANICA', 'wilmerpulido', 1),
(51, 'DEIBY TATIANA', 'REYES HIGUERA', 62, 1, '1004005505', 'tatianareyes@galqui.com', '888ce404226caa890705bee55072fbb19c0608a6sGlaqs2%', 53, 'AUXILIAR DE COMPRAS', 'tatianareyes', 1),
(52, 'JULIAN CAMILO', 'RICO CASTRO', 61, 1, '1072667239', 'recursoshumanos@galqui.com', 'c597720c0fc6363011e290913a7a61ec16cc653esGlaqs2%', 51, 'ANALISTA DE RECURSOS HUMANOS', 'julianrico', 1),
(53, 'DANIEL ALEXANDER', 'RINCON RAMIREZ', 61, 1, '79823801', 'danielrincon@galqui.com', 'f28d2af74157e3ba645d9f6d5e384cde9ea32b4csGlaqs2%', 52, 'PROFESIONAL DE ASEGURAMIENTO TECNICO', 'danielrincon', 1),
(54, 'JORGE ALBERTO', 'RINCON RODRIGUEZ', 61, 1, '79220852', 'operaciones@galqui.com', '08d4ed6370fa68edf3096588956e0baa00c054e7sGlaqs2%', 52, 'OPERADOR TECNICO', 'jorgerincon', 1),
(55, 'DUVAN CAMILO', 'RIVERA ABRIL', 61, 1, '1076240985', 'bodegak2@galqui.com', 'a5ae9cf2f7f439d129d61f0991b5db5988f9dffbsGlaqs2%', 53, 'AUXILIAR LOGISTICO', 'duvanrivera', 1),
(56, 'MARIA SANDY', 'ROA RAMIREZ', 62, 1, '1118546940', 'sandyroa@galqui.com', 'c27f36fb368e9888b9e704769952452959897356sGlaqs2%', 51, 'PROFESIONAL HSEQ', 'sandyroa', 1),
(57, 'ALDEYSON JULIAN', 'RODRIGUEZ BOHORQUEZ', 61, 1, '80200165', 'aldeysonrodriguez@galqui.com', '8a8c5b95b771da96cdfbd89f15ba40442cafade8sGlaqs2%', 52, 'SUPERVISOR ELECTRICO', 'julianrodriguez', 1),
(58, 'ANDREA LIZETH', 'ROJAS CASTILLO', 62, 1, '1052413124', 'andrearojas@galqui.com', '5a9a73948fd92330d8b3ffd7c40d775ae583cc38sGlaqs2%', 52, 'INGENIERO DE PROYECTOS I ESPECIALIDAD DE INNOVACION Y DESARROLLO', 'andrearojas', 1),
(59, 'CAMILO ANDRES FELIPE', 'RUBIANO BALLESTEROS', 61, 1, '1010205789', 'camilorubiano@galqui.com', 'f36c25875f351da0256b7e8e98af1275f87e4f33sGlaqs2%', 53, 'PROFESIONAL DE COMPRAS', 'camilorubiano', 1),
(60, 'CESAR ERNESTO', 'RUBIO MAHECHA', 61, 1, '1013690461', 'cesarrubio@galqui.com', 'a5a14b026965027867fe64b6237354f4dec253casGlaqs2%', 52, 'ESPECIALISTA EN GESTION DE PROYECTOS', 'cesarrubio', 1),
(61, 'MARCO ANTONIO', 'SANCHEZ ', 61, 1, '13956873', 'marcosanchez@galqui.com', '965a2b8adcb29ad986f67067ca4fc24601e4eb6bsGlaqs2%', 52, 'SUPERVISOR MECANICO', 'marcosanchez', 1),
(62, 'LADY NATALIA', 'SAAVEDRA MORENO', 62, 1, '52777336', 'ladysaavedra@galqui.com', '5f07b822a4d4f62c56c6148fc024b63f3dd9c8a1sGlaqs2%', 52, 'INGENIERO DE PROYECTOS I ESPECIALIDAD ELECTRICA', 'ladysaavedra', 1),
(63, 'ANDRES FELIPE', 'SARMIENTO CORTES', 61, 1, '1030558517', 'felipesarmiento@galqui.com', 'c537f4de2eb19ec7bddf8010afc8ab5703a49a10sGlaqs2%', 55, 'INGENIERO DE DESARROLLO DE NEGOCIOS', 'felipesarmiento', 1),
(64, 'ALEXANDER', 'VACCA ESCARPETA', 61, 1, '80210900', 'alexandervacca@galqui.com', 'beafb64a5cdfa5ff97e9cdfc1973f58172a16c55sGlaqs2%', 52, 'INGENIERO DE PROYECTOS I ESPECIALIDAD MECANICA', 'alexandervacca', 1),
(65, 'DIEGO RICARDO', 'VARGAS LOPEZ', 61, 1, '1052407346', 'diegovargas@galqui.com', 'fbd92b8f9026660d8438e7f7db5afa5abdde23c8sGlaqs2%', 52, 'INSPECTOR QA/QC', 'diegovargas', 1),
(66, 'MAYERLY', 'VARGAS TIRIA', 62, 1, '1075653254', 'mayerlyvargas@galqui.com', 'a8c2311fa3bc48c8007758128900691c1cecaef7sGlaqs2%', 54, 'LIDER DE TESORERIA Y FINANZAS', 'mayerlyvargas', 1),
(67, 'MARIA PAULA', 'VELASQUEZ LEYTON', 62, 1, '1020796722', 'departamentolegal@galqui.com', '6deb4087c508b19b1b13f623710fe2becd6b03f3sGlaqs2%', 51, 'ABOGADO', 'mariavelasquez', 1),
(68, 'ANGELA GISELA', 'ALFONSO ARIAS', 62, 1, '1075673291', 'recursoshumanos@tececor.com', 'fb92d0b90b5d25b788cc89109803276a85cc019csGlaqs2%', 57, 'ANALISTA DE RECURSOS HUMANOS - TECECOR', NULL, 1),
(69, 'ORLANDO ANDRES', 'ARIZA LOPEZ', 61, 1, '1010046616', 'auxiliarcompras@galqui.com', 'fb4a3872261bd2f75793bff5abe4f8b8a0a0afc6sGlaqs2%', 57, 'ANALISTA DE COMPRAS - TECECOR', NULL, 1),
(70, 'JOSE RENE', 'ARIZA PARRA', 61, 1, '80797387', 'reneariza@galqui.com', '3062a55ab96431ab71a2198d4cf0ec0832251feesGlaqs2%', 57, 'APOYO BODEGA - TECECOR', NULL, 1),
(71, 'JULY TATIANA', 'GONZALEZ QUECAN', 62, 1, '10722704573', 'compras@tececor.com', '0581aa902453b35017129322c699211c7a5b0583sGlaqs2%', 57, 'ANALISTA DE COMPRAS - TECECOR', NULL, 1),
(72, 'WILSON ANDRES', 'PINEDA VARGAS', 61, 1, '80026318', 'wilsonpineda@tececor.com', '4a86158e8703d96b3254b968190c37c23d32bf6csGlaqs2%', 57, 'LOGISTICA - TECECOR', NULL, 1),
(73, 'NANCY LILIANA', 'PINZON GONZALEZ', 62, 1, '20760077', 'nancypinzon@galqui.com', '5c4692ee007c4ac5486d8d76148cae28cdb9741bsGlaqs2%', 57, 'GERENTE ADMINISTRATIVA Y FINANCIERA - TECECOR', NULL, 1),
(74, 'JULY PAOLA', 'SANDOVAL CARDENAS', 62, 1, '1072645861', 'analistacontable@tececor.com', 'ef18be6d335259e966dc3e312b6b00f684a63f31sGlaqs2%', 57, 'ANALISTA CONTABLE - TECECOR', NULL, 1),
(75, 'EDGAR ANDRES', 'CASTELBLANCO VARGAS', 61, 1, '9656182', 'edgarcastelblanco@giagroupsas.com', '8aaf83475c4602f4c04e7fee1f39ca193b361108sGlaqs2%', 59, 'GERENTE GERENAL GIA', NULL, 1),
(76, 'ANA CAROLINA', 'NAVARRO MARTINEZ', 62, 1, '1100629194', 'anacarolinanavarromartinez@gmail.com', 'a64db7c1417992a555d4cb9110760f1bf419ad82sGlaqs2%', 56, 'OPERARIA SERVICIO GENERAL', NULL, 1),
(77, 'JINNA PAOLA', 'VASQUEZ AREVALO', 62, 1, '1070011644', 'pao_arevalo18@hotmail.com', '7f71c2c6e92a89a571607213ad001e9941f2234dsGlaqs2%', 56, 'OPERARIA SERVICIO GENERAL', NULL, 1),
(78, 'CRISTIAN CAMILO', 'ALCALA DAZA', 61, 1, '1020803062', 'camiloalcala@telesolin.com', 'ce8ddca9b986609856553f6b26102c85269b5eddsGlaqs2%', 58, 'SOPORTE IT - TELESOLIN', 'telesolin', 1),
(79, 'CARLOS ALBERTO', 'PLAZAS ORTIZ', 61, 1, '1030659372', 'carlosplazas@telesolin.com', '48293a1ecb4f37472656165689cb8631ddbc8058sGlaqs2%', 58, 'SOPORTE IT - TELESOLIN', 'telesolin', 1);

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
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(18, 3),
(19, 3),
(20, 2),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(35, 4),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 2),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(52, 4),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(74, 3),
(75, 3),
(76, 3),
(77, 3),
(78, 2),
(79, 2);

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
(16, 304, 'Mouse Vertical', 3, 1),
(17, 305, 'Diademas', 3, 1),
(18, 306, 'Monitor', 3, 1),
(19, 501, 'Cable de datos', 5, 1),
(20, 502, 'Audifonos', 5, 1),
(21, 503, 'Protector', 5, 1),
(22, 504, 'SIM', 5, 1),
(23, 505, 'Caja', 5, 1),
(24, 506, 'Cargador', 5, 1),
(27, 601, 'Standard', 6, 1),
(28, 602, 'Home & Business', 6, 1),
(29, 604, 'Professional Plus', 6, 1),
(30, 603, 'Professional', 6, 1),
(31, 605, 'Office 365', 6, 1),
(32, 701, 'Home', 7, 1),
(33, 702, 'Pro', 7, 1),
(34, 703, 'Enterprise', 7, 1),
(35, 704, 'Standard LTSC', 6, 1),
(36, 705, 'Standard VL', 6, 1),
(38, 901, 'N/A', 9, 1),
(39, 902, 'Claro', 9, 1),
(40, 903, 'Movistar', 9, 1),
(41, 1001, 'Cita Medica', 10, 1),
(42, 1002, 'Diligencia personal', 10, 1),
(43, 1003, 'Calamidad Domestica', 10, 1),
(44, 1004, 'Compensatorio Jornada Electoral', 10, 1),
(45, 1005, 'Dia de Descanso Ley 1857 (Dia de la Familia)', 10, 1),
(46, 1006, 'Trabajo en Casa', 10, 1),
(47, 1007, 'Licencia No Remunerada', 10, 1),
(48, 1008, 'Otro', 10, 1),
(49, 1101, 'Chia - Cundinamarca', 11, 1),
(50, 1102, 'Madrid - Cundinamarca', 11, 1),
(51, 1201, 'Administrativo', 12, 1),
(52, 1202, 'Proyectos', 12, 1),
(53, 1203, 'Abastecimiento y Logistica', 12, 1),
(54, 1204, 'Financiero y Contable', 12, 1),
(55, 1205, 'Innovacion y Desarrollo', 12, 1),
(56, 1206, 'Power Services', 12, 1),
(57, 1207, 'Tececor', 12, 1),
(58, 1208, 'Telesolin', 12, 1),
(59, 1209, 'GIA', 12, 1),
(60, 403, 'Tececor', 4, 1),
(61, 1301, 'Masculino', 13, 1),
(62, 1302, 'Femenino', 13, 1);

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
-- Indices de la tabla `jefxper`
--
ALTER TABLE `jefxper`
  ADD KEY `idper` (`idper`),
  ADD KEY `idjef` (`idjef`);

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
-- Indices de la tabla `pefxmod`
--
ALTER TABLE `pefxmod`
  ADD KEY `idmod` (`idmod`),
  ADD KEY `idpef` (`idpef`),
  ADD KEY `idpag` (`idpag`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idpef`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idprm`),
  ADD KEY `idjef` (`idjef`),
  ADD KEY `idvtprm` (`idvtprm`),
  ADD KEY `idper` (`idper`),
  ADD KEY `idvubi` (`idvubi`),
  ADD KEY `idrev` (`idrev`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idper`),
  ADD KEY `idvsex` (`idvsex`),
  ADD KEY `idvtpd` (`idvtpd`),
  ADD KEY `idvdpt` (`idvdpt`);

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
  MODIFY `iddom` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequ` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmod` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `idpag` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idpef` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idprm` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `idtaj` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `valor`
--
ALTER TABLE `valor`
  MODIFY `idval` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
-- Filtros para la tabla `jefxper`
--
ALTER TABLE `jefxper`
  ADD CONSTRAINT `jefxper_ibfk_1` FOREIGN KEY (`idper`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `jefxper_ibfk_2` FOREIGN KEY (`idjef`) REFERENCES `persona` (`idper`);

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
-- Filtros para la tabla `pefxmod`
--
ALTER TABLE `pefxmod`
  ADD CONSTRAINT `pefxmod_ibfk_1` FOREIGN KEY (`idmod`) REFERENCES `modulo` (`idmod`),
  ADD CONSTRAINT `pefxmod_ibfk_2` FOREIGN KEY (`idpef`) REFERENCES `perfil` (`idpef`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`idjef`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `permiso_ibfk_3` FOREIGN KEY (`idrev`) REFERENCES `persona` (`idper`);

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
