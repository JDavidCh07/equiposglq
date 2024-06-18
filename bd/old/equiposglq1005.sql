DROP DATABASE IF EXISTS equiposglq;
CREATE DATABASE equiposglq;
USE equiposglq;
--
-- Base de datos: equiposglq
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla accxequi
--

CREATE TABLE accxequi (
  idacxeq bigint(11) NOT NULL,
  ideqxpr bigint(11) NOT NULL,
  idvacc bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla dominio
--

CREATE TABLE dominio (
  iddom bigint(11) NOT NULL,
  nomdom varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla dominio
--

INSERT INTO dominio (iddom, nomdom) VALUES
(1, 'T. Documento'),
(2, 'C. Almacenamiento'),
(3, 'RAM'),
(4, 'Procesador'),
(5, 'T. Equipo'),
(6, 'Office'),
(7, 'Windows'),
(8, 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla equipo
--

CREATE TABLE equipo (
  idequ bigint(11) NOT NULL,
  marca varchar(50) NOT NULL,
  modelo varchar(50) NOT NULL,
  serialeq varchar(50) NOT NULL,
  nomred varchar(50) NOT NULL,
  idvarea bigint(11) NOT NULL,
  idvtpeq bigint(11) NOT NULL,
  idvgb bigint(11) NOT NULL,
  idvram bigint(11) NOT NULL,
  idvprc bigint(11) NOT NULL,
  fecultman date DEFAULT NULL,
  fecproman date DEFAULT NULL,
  actequ tinyint(1) DEFAULT 1,
  tipcon tinyint(1) DEFAULT 1,
  contrato varchar(250) DEFAULT NULL,
  valrcont float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla asignar
--

CREATE TABLE asignar (
  ideqxpr bigint(11) NOT NULL,
  idequ bigint(11) NOT NULL,
  idperent bigint(11) NOT NULL,
  idperrec bigint(11) NOT NULL,
  fecent date DEFAULT NULL,
  fecdev date DEFAULT NULL,
  observ varchar(512) DEFAULT NULL,
  estexp tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla mantenimiento
--

CREATE TABLE mantenimiento (
  idman bigint(11) NOT NULL,
  idequ bigint(11) NOT NULL,
  idvtpm bigint(11) NOT NULL,
  fecman date DEFAULT NULL,
  observ varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla modulo
--

CREATE TABLE modulo (
  idmod int(5) NOT NULL,
  nommod varchar(100) NOT NULL,
  imgmod varchar(255) DEFAULT NULL,
  actmod tinyint(1) NOT NULL DEFAULT 1,
  idpag bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla modulo
--

INSERT INTO modulo (idmod, nommod, imgmod, actmod, idpag) VALUES
(1, 'Registro', NULL, 1, 51),
(2, 'Configuración', 'img/mod_20240509081844.png', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla pagina
--

CREATE TABLE pagina (
  idpag bigint(11) NOT NULL,
  icono varchar(255) NOT NULL,
  nompag varchar(25) NOT NULL,
  arcpag varchar(100) NOT NULL,
  ordpag int(3) NOT NULL,
  menpag varchar(30) NOT NULL,
  mospag tinyint(1) DEFAULT NULL,
  idmod int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla pagina
--

INSERT INTO pagina (idpag, icono, nompag, arcpag, ordpag, menpag, mospag, idmod) VALUES
(1, 'fa fa-solid fa-cubes', 'Módulos', 'views/vmod.php', 1, 'home.php', 1, 2),
(2, 'fa fa-regular fa-file', 'Páginas', 'views/vpag.php', 2, 'home.php', 1, 2),
(3, 'fa fa-solid fa-user', 'PagxPef', 'views/vpgxf.php', 3, 'home.php', 2, 2),
(4, 'fa fa-solid fa-address-card', 'Perfiles', 'views/vpef.php', 4, 'home.php', 1, 2),
(5, 'fa fa-solid fa-user', 'PerxPef', 'views/vperxf.php', 5, 'home.php', 2, 2),
(6, 'fa fa-solid fa-boxes-stacked', 'Dominio', 'views/vdom.php', 6, 'home.php', 1, 2),
(7, 'fa fa-solid fa-dollar-sign', 'Valor', 'views/vval.php', 7, 'home.php', 1, 2),
(51, 'fa fa-solid fa-arrows-turn-to-dots', 'Asignar', 'views/vasg.php', 51, 'home.php', 1, 1),
(52, 'fa fa-solid fa-laptop', 'Equipos', 'views/vequ.php', 52, 'home.php', 1, 1),
(53, 'fa fa-solid fa-person', 'Personas', 'views/vper.php', 53, 'home.php', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla pagxpef
--

CREATE TABLE pagxpef (
  idpag bigint(11) NOT NULL,
  idpef bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla pagxpef
--

INSERT INTO pagxpef (idpag, idpef) VALUES
(2, 1),
(4, 1),
(6, 1),
(1, 1),
(7, 1),
(3, 1),
(5, 1),
(51, 2),
(52, 2),
(53, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla perfil
--

CREATE TABLE perfil (
  idpef bigint(11) NOT NULL,
  nompef varchar(100) NOT NULL,
  idmod int(5) NOT NULL,
  idpag bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla perfil
--

INSERT INTO perfil (idpef, nompef, idmod, idpag) VALUES
(1, 'Administrador', 2, 1),
(2, 'Sistemas', 1, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla persona
--

CREATE TABLE persona (
  idper bigint(11) NOT NULL,
  nomper varchar(100) NOT NULL,
  apeper varchar(100) NOT NULL,
  idvtpd bigint(11) NOT NULL,
  ndper varchar(12) NOT NULL,
  emaper varchar(255) NOT NULL,
  pasper text DEFAULT NULL,
  cargo varchar(100) NOT NULL,
  actper tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla persona
--

INSERT INTO persona (idper, nomper, apeper, idvtpd, ndper, emaper, pasper, cargo, actper) VALUES
(1, 'David', 'Chaparro', 1, '1072642921', 'david@galqui.com', '123456', 'Aprendiz Sena', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla perxpef
--

CREATE TABLE perxpef (
  idper bigint(11) NOT NULL,
  idpef bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla perxpef
--

INSERT INTO perxpef (idper, idpef) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla prgxequi
--

CREATE TABLE prgxequi (
  idprxeq bigint(11) NOT NULL,
  idequ bigint(11) NOT NULL,
  idvprg bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tarjeta
--

CREATE TABLE tarjeta (
  idtaj bigint(11) NOT NULL,
  numtajpar varchar(100) DEFAULT NULL,
  numtajofi varchar(100) DEFAULT NULL,
  idperent bigint(11) NOT NULL,
  idperrec bigint(11) NOT NULL,
  fecent date DEFAULT NULL,
  fecdev date DEFAULT NULL,
  esttaj tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla valor
--

CREATE TABLE valor (
  idval bigint(11) NOT NULL,
  codval bigint(11) DEFAULT NULL,
  nomval varchar(70) NOT NULL,
  iddom bigint(11) NOT NULL,
  actval tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla accxequi
--
ALTER TABLE accxequi
  ADD PRIMARY KEY (idacxeq),
  ADD KEY ideqxpr (ideqxpr),
  ADD KEY idvacc (idvacc);

--
-- Indices de la tabla dominio
--
ALTER TABLE dominio
  ADD PRIMARY KEY (iddom);

--
-- Indices de la tabla equipo
--
ALTER TABLE equipo
  ADD PRIMARY KEY (idequ),
  ADD KEY idvarea (idvarea),
  ADD KEY idvtpeq (idvtpeq),
  ADD KEY idvgb (idvgb),
  ADD KEY idvram (idvram),
  ADD KEY idvprc (idvprc);

--
-- Indices de la tabla asignar
--
ALTER TABLE asignar
  ADD PRIMARY KEY (ideqxpr),
  ADD KEY idequ (idequ),
  ADD KEY idperent (idperent),
  ADD KEY idperrec (idperrec);

--
-- Indices de la tabla mantenimiento
--
ALTER TABLE mantenimiento
  ADD PRIMARY KEY (idman),
  ADD KEY idequ (idequ);

--
-- Indices de la tabla modulo
--
ALTER TABLE modulo
  ADD PRIMARY KEY (idmod);

--
-- Indices de la tabla pagina
--
ALTER TABLE pagina
  ADD PRIMARY KEY (idpag),
  ADD KEY idmod (idmod);

--
-- Indices de la tabla pagxpef
--
ALTER TABLE pagxpef
  ADD KEY idpag (idpag),
  ADD KEY idpef (idpef);

--
-- Indices de la tabla perfil
--
ALTER TABLE perfil
  ADD PRIMARY KEY (idpef),
  ADD KEY idmod (idmod),
  ADD KEY idpag (idpag);

--
-- Indices de la tabla persona
--
ALTER TABLE persona
  ADD PRIMARY KEY (idper),
  ADD KEY idvtpd (idvtpd);

--
-- Indices de la tabla perxpef
--
ALTER TABLE perxpef
  ADD KEY idper (idper),
  ADD KEY idpef (idpef);

--
-- Indices de la tabla prgxequi
--
ALTER TABLE prgxequi
  ADD PRIMARY KEY (idprxeq),
  ADD KEY idequ (idequ),
  ADD KEY idvprg (idvprg);

--
-- Indices de la tabla tarjeta
--
ALTER TABLE tarjeta
  ADD PRIMARY KEY (idtaj),
  ADD KEY idperent (idperent),
  ADD KEY idperrec (idperrec);

--
-- Indices de la tabla valor
--
ALTER TABLE valor
  ADD PRIMARY KEY (idval),
  ADD UNIQUE KEY codval (codval),
  ADD KEY iddom (iddom);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla accxequi
--
ALTER TABLE accxequi
  MODIFY idacxeq bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla dominio
--
ALTER TABLE dominio
  MODIFY iddom bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla equipo
--
ALTER TABLE equipo
  MODIFY idequ bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla asignar
--
ALTER TABLE asignar
  MODIFY ideqxpr bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla mantenimiento
--
ALTER TABLE mantenimiento
  MODIFY idman bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla modulo
--
ALTER TABLE modulo
  MODIFY idmod int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla pagina
--
ALTER TABLE pagina
  MODIFY idpag bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla pagxpef
--
ALTER TABLE pagxpef
  MODIFY idpag bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla perfil
--
ALTER TABLE perfil
  MODIFY idpef bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla persona
--
ALTER TABLE persona
  MODIFY idper bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla perxpef
--
ALTER TABLE perxpef
  MODIFY idper bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla prgxequi
--
ALTER TABLE prgxequi
  MODIFY idprxeq bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla tarjeta
--
ALTER TABLE tarjeta
  MODIFY idtaj bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla valor
--
ALTER TABLE valor
  MODIFY idval bigint(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla accxequi
--
ALTER TABLE accxequi
  ADD CONSTRAINT accxequi__ibfk_1 FOREIGN KEY (ideqxpr) REFERENCES asignar (ideqxpr);

--
-- Filtros para la tabla asignar
--
ALTER TABLE asignar
  ADD CONSTRAINT asignar_ibfk_1 FOREIGN KEY (idequ) REFERENCES equipo (idequ),
  ADD CONSTRAINT asignar_ibfk_2 FOREIGN KEY (idperent) REFERENCES persona (idper),
  ADD CONSTRAINT asignar_ibfk_3 FOREIGN KEY (idperrec) REFERENCES persona (idper);

--
-- Filtros para la tabla mantenimiento
--
ALTER TABLE mantenimiento
  ADD CONSTRAINT mantenimiento__ibfk_1 FOREIGN KEY (idequ) REFERENCES equipo (idequ);

--
-- Filtros para la tabla pagina
--
ALTER TABLE pagina
  ADD CONSTRAINT pagina_ibfk_1 FOREIGN KEY (idmod) REFERENCES modulo (idmod);

--
-- Filtros para la tabla pagxpef
--
ALTER TABLE pagxpef
  ADD CONSTRAINT pagxpef_ibfk_1 FOREIGN KEY (idpag) REFERENCES pagina (idpag),
  ADD CONSTRAINT pagxpef_ibfk_2 FOREIGN KEY (idpef) REFERENCES perfil (idpef);

--
-- Filtros para la tabla perfil
--
ALTER TABLE perfil
  ADD CONSTRAINT perfil_ibfk_1 FOREIGN KEY (idmod) REFERENCES modulo (idmod);

--
-- Filtros para la tabla perxpef
--
ALTER TABLE perxpef
  ADD CONSTRAINT perxpef_ibfk_1 FOREIGN KEY (idper) REFERENCES persona (idper),
  ADD CONSTRAINT perxpef_ibfk_2 FOREIGN KEY (idpef) REFERENCES perfil (idpef);

--
-- Filtros para la tabla prgxequi
--
ALTER TABLE prgxequi
  ADD CONSTRAINT prgxequi__ibfk_1 FOREIGN KEY (idequ) REFERENCES equipo (idequ);

--
-- Filtros para la tabla tarjeta
--
ALTER TABLE tarjeta
  ADD CONSTRAINT tarjeta_ibfk_1 FOREIGN KEY (idperent) REFERENCES persona (idper),
  ADD CONSTRAINT tarjeta_ibfk_2 FOREIGN KEY (idperrec) REFERENCES persona (idper);

--
-- Filtros para la tabla valor
--
ALTER TABLE valor
  ADD CONSTRAINT valor_ibfk_1 FOREIGN KEY (iddom) REFERENCES dominio (iddom);