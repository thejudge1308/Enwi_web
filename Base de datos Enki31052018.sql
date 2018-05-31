-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-05-2018 a las 15:04:38
-- Versión del servidor: 5.7.22
-- Versión de PHP: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copia`
--

CREATE TABLE `copia` (
  `codigo` int(11) NOT NULL,
  `isbnlibro` varchar(256) DEFAULT NULL,
  `numerocopia` varchar(256) DEFAULT NULL,
  `estado` varchar(256) DEFAULT NULL,
  `refEstante` int(11) NOT NULL DEFAULT '-1',
  `refNivel` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `copia`
--
DELIMITER $$
CREATE TRIGGER `numcopia_libros` AFTER INSERT ON `copia` FOR EACH ROW UPDATE libro a
   SET a.ncopias = 
    (SELECT COUNT(copia.codigo) 
       FROM copia
      WHERE copia.isbnlibro = a.isbn)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estante`
--

CREATE TABLE `estante` (
  `codigo` int(11) NOT NULL,
  `intervaloInf` int(11) DEFAULT NULL,
  `intervaloSup` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `cantidadniveles` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estante`
--

INSERT INTO `estante` (`codigo`, `intervaloInf`, `intervaloSup`, `numero`, `cantidadniveles`) VALUES
(-1, 0, 1000, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lector`
--

CREATE TABLE `lector` (
  `rut` varchar(256) NOT NULL,
  `nombre` varchar(256) DEFAULT NULL,
  `apellidoPaterno` varchar(256) DEFAULT NULL,
  `apellidoMaterno` varchar(256) DEFAULT NULL,
  `direccion` varchar(256) DEFAULT NULL,
  `telefono` varchar(256) DEFAULT NULL,
  `correoElectronico` varchar(256) DEFAULT NULL,
  `observacion` varchar(256) DEFAULT NULL,
  `estado` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `isbn` varchar(256) NOT NULL,
  `titulo` varchar(256) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `edicion` varchar(256) DEFAULT NULL,
  `ncopias` int(11) DEFAULT '1',
  `autor` varchar(256) DEFAULT NULL,
  `dewey` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `codigo` int(11) NOT NULL,
  `codigoEstante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`codigo`, `codigoEstante`) VALUES
(1, -1);

--
-- Disparadores `nivel`
--
DELIMITER $$
CREATE TRIGGER `actualizarNivelesEstantes` AFTER INSERT ON `nivel` FOR EACH ROW UPDATE estante a
   SET a.cantidadniveles= 
    (SELECT COUNT(nivel.codigoEstante) 
       FROM nivel
      WHERE nivel.codigoEstante = a.codigo)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminarNiveles` AFTER DELETE ON `nivel` FOR EACH ROW UPDATE estante a
   SET a.cantidadniveles = 
    (SELECT COUNT(nivel.codigo) 
       FROM nivel
      WHERE nivel.codigoEstante = a.codigo)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `codigo` int(11) NOT NULL,
  `refLector` varchar(256) DEFAULT NULL,
  `refTrabajador` varchar(256) DEFAULT NULL,
  `fechaPrestamo` varchar(256) DEFAULT NULL,
  `fechaDevolucion` varchar(256) DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamocopia`
--

CREATE TABLE `prestamocopia` (
  `codigoPrestamo` int(11) DEFAULT NULL,
  `codigoCopia` int(11) DEFAULT NULL,
  `estado` varchar(200) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `correoElectronico` varchar(256) NOT NULL,
  `contrasena` varchar(256) DEFAULT NULL,
  `rut` varchar(256) NOT NULL,
  `nombre` varchar(256) DEFAULT NULL,
  `apellidoPaterno` varchar(256) DEFAULT NULL,
  `apellidoMaterno` varchar(256) DEFAULT NULL,
  `direccion` varchar(256) DEFAULT NULL,
  `telefono` varchar(256) DEFAULT NULL,
  `contactoEmergenciaNombre` varchar(256) DEFAULT NULL,
  `contactoEmergenciaTelefono` varchar(256) DEFAULT NULL,
  `tipo` varchar(256) DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`correoElectronico`, `contrasena`, `rut`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `direccion`, `telefono`, `contactoEmergenciaNombre`, `contactoEmergenciaTelefono`, `tipo`, `estado`) VALUES
('pato@pato.com', '1234', '18.280.632-3', 'Patricio', 'Quezada', 'Laras', 'Avenida siempre viva', '666', 'Dios', '777', 'adm', 'true');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `copia`
--
ALTER TABLE `copia`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `refEstante` (`refEstante`) USING BTREE,
  ADD KEY `refNivel` (`refNivel`);

--
-- Indices de la tabla `estante`
--
ALTER TABLE `estante`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `lector`
--
ALTER TABLE `lector`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`isbn`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`codigo`,`codigoEstante`),
  ADD KEY `codigoEstante` (`codigoEstante`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `refLector` (`refLector`),
  ADD KEY `refTrabajador` (`refTrabajador`);

--
-- Indices de la tabla `prestamocopia`
--
ALTER TABLE `prestamocopia`
  ADD KEY `codigoPrestamo` (`codigoPrestamo`),
  ADD KEY `codigoCopia` (`codigoCopia`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`rut`),
  ADD UNIQUE KEY `correoElectronico` (`correoElectronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `copia`
--
ALTER TABLE `copia`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `estante`
--
ALTER TABLE `estante`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `copia`
--
ALTER TABLE `copia`
  ADD CONSTRAINT `refEstante	` FOREIGN KEY (`refEstante`) REFERENCES `nivel` (`codigoEstante`),
  ADD CONSTRAINT `refNivel` FOREIGN KEY (`refNivel`) REFERENCES `nivel` (`codigo`);

--
-- Filtros para la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`codigoEstante`) REFERENCES `estante` (`codigo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`refLector`) REFERENCES `lector` (`rut`) ON DELETE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`refTrabajador`) REFERENCES `trabajador` (`rut`) ON DELETE CASCADE;

--
-- Filtros para la tabla `prestamocopia`
--
ALTER TABLE `prestamocopia`
  ADD CONSTRAINT `prestamocopia_ibfk_1` FOREIGN KEY (`codigoPrestamo`) REFERENCES `prestamo` (`codigo`) ON DELETE CASCADE,
  ADD CONSTRAINT `prestamocopia_ibfk_2` FOREIGN KEY (`codigoCopia`) REFERENCES `copia` (`codigo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
