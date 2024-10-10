DROP DATABASE IF EXISTS glqapp;
CREATE DATABASE glqapp;
USE glqapp;
--
-- Base de datos: `glqapp`
--

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
  `idvdpt` bigint(11) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `usured` varchar(50) DEFAULT NULL,
  `actper` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idper`, `nomper`, `apeper`, `idvtpd`, `ndper`, `emaper`, `pasper`, `idvdpt`, `cargo`, `usured`, `actper`) VALUES
(1, 'JUAN DAVID', 'CHAPARRO DOMINGUEZ', 1, '1072642921', 'soporteit@galqui.com', '0cb74ff365641dc0a2a164af11a019b303452cfesGlaqs2%', 51, 'APRENDIZ SENA', 'soporteit', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idper`),
  ADD KEY `idvtpd` (`idvtpd`),
  ADD KEY `idvdpt` (`idvdpt`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;