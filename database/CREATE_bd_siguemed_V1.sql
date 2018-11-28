-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2018 a las 23:53:33
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_siguemed`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentenotamedica`
--

CREATE TABLE `antecedentenotamedica` (
  `IdAntecedenteNotaMedica` int(11) NOT NULL,
  `IdAntecedente` int(11) NOT NULL,
  `IdNotaMedica` int(11) NOT NULL,
  `DescripcionAntecedenteNotaMedica` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogoantecedentes`
--

CREATE TABLE `catalogoantecedentes` (
  `IdAntecedente` int(11) NOT NULL,
  `IdServicio` int(11) NOT NULL,
  `DescripcionAntecedente` text COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `catalogoantecedentes`
--

INSERT INTO `catalogoantecedentes` (`IdAntecedente`, `IdServicio`, `DescripcionAntecedente`) VALUES
(1, 1, 'Antecedentes Heredo-Familiares'),
(2, 1, 'Antecedentes Personales No Patologicos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogoestatuscita`
--

CREATE TABLE `catalogoestatuscita` (
  `IdStatusCita` int(11) NOT NULL,
  `DescripcionEstatusCita` tinytext COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `catalogoestatuscita`
--

INSERT INTO `catalogoestatuscita` (`IdStatusCita`, `DescripcionEstatusCita`) VALUES
(1, 'Agendada'),
(2, 'Confirmada'),
(3, 'Registrada'),
(4, 'Atendida'),
(5, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogoproductos`
--

CREATE TABLE `catalogoproductos` (
  `IdProducto` int(11) NOT NULL,
  `CostoProducto` int(11) DEFAULT NULL,
  `DescripcionProducto` varchar(255) DEFAULT NULL,
  `IdServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `catalogoproductos`
--

INSERT INTO `catalogoproductos` (`IdProducto`, `CostoProducto`, `DescripcionProducto`, `IdServicio`) VALUES
(1, 300, 'Consulta M.F.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citaservicio`
--

CREATE TABLE `citaservicio` (
  `IdCitaServicio` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdServicio` int(11) NOT NULL,
  `DiaCita` tinyint(4) NOT NULL,
  `MesCita` tinyint(4) NOT NULL,
  `AnioCita` int(11) NOT NULL,
  `HoraCita` time(4) NOT NULL,
  `IdStatusCita` int(11) NOT NULL,
  `IdNotaMedica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticonotamedica`
--

CREATE TABLE `diagnosticonotamedica` (
  `IdNotaMedica` int(11) DEFAULT NULL,
  `IdDiagnostico` int(11) DEFAULT NULL,
  `ObservacionesDiagostico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogodiagnosticos`
--

CREATE TABLE `catalogodiagnosticos` (
  `IdDiagnostico` int(11) NOT NULL,
  `DescripcionDiagnostico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidadservicio`
--

CREATE TABLE `disponibilidadservicio` (
  `IdDisponiblidadServicio` int(11) NOT NULL,
  `DiaDisponible` tinyint(4) NOT NULL,
  `HoraInicio` tinyint(4) NOT NULL,
  `HoraFin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `IdEmpleado` int(11) NOT NULL,
  `NombreEmpleado` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `ApellidosEmpleado` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `TelefonoEmpleado` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `IdServicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`IdEmpleado`, `NombreEmpleado`, `ApellidosEmpleado`, `TelefonoEmpleado`, `IdServicio`) VALUES
(1, 'Constanzo Manuel', 'Basurto Chipolini', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionesperfil`
--

CREATE TABLE `funcionesperfil` (
  `IdPerfil` int(11) NOT NULL,
  `IdMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `funcionesperfil`
--

INSERT INTO `funcionesperfil` (`IdPerfil`, `IdMenu`) VALUES
(2, 1),
(1, 1),
(2, 2),
(2, 5),
(3, 1),
(3, 2),
(3, 5),
(3, 6);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `IdMenu` int(11) NOT NULL,
  `DescripcionMenu` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `IdMenuPadre` int(11) DEFAULT NULL,
  `UrlMenu` tinytext COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`IdMenu`, `DescripcionMenu`, `IdMenuPadre`, `UrlMenu`) VALUES
(1, 'Agenda', NULL, ''),
(2, 'Notas Medicas', NULL, ''),
(5, 'Citas de Hoy', 1, 'Agenda/CitasHoy'),
(6, 'Manejar Agenda', 1, 'Agenda/VistaAgenda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notamedica`
--

CREATE TABLE `notamedica` (
  `IdNotaMedica` int(11) NOT NULL,
  `FechaNotaMedica` date NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdServicio` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `PesoPaciente` tinyint(4) NOT NULL,
  `TallaPaciente` tinyint(4) NOT NULL,
  `TemperaturaPaciente` tinyint(4) NOT NULL,
  `IMCPaciente` tinyint(4) NOT NULL,
  `PresionPaciente` tinyint(4) NOT NULL,
  `FrCardiacaPaciente` tinyint(4) NOT NULL,
  `FrRespiratoriaPaciente` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `IdPaciente` int(11) NOT NULL,
  `Nombre` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `Apellidos` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `Sexo` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Calle` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `Colonia` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `CP` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `EstadoCivil` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `ViveCon` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `Escolaridad` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `Religion` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `Ocupacion` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `NumCelular` tinytext COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `IdPerfil` int(11) NOT NULL,
  `DescripcionPerfil` tinytext COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`IdPerfil`, `DescripcionPerfil`) VALUES
(1, 'Enfermeria'),
(2, 'Administracion'),
(3, 'Medico');

-- --------------------------------------------------------


--
-- Estructura de tabla para la tabla `productosnotamedica`
--

CREATE TABLE `productosnotamedica` (
  `IdProducto` int(11) DEFAULT NULL,
  `CantidadProductoNM` int(11) DEFAULT NULL,
  `Descuento` int(11) DEFAULT NULL,
  `IdNotaMedica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientomedico`
--

CREATE TABLE `seguimientomedico` (
  `SecuenciaSeguimiento` varchar(25) DEFAULT NULL,
  `FechaSeguimiento` date DEFAULT NULL,
  `EstadoSeguimiento` varchar(255) DEFAULT NULL,
  `ObservacionesSeguimiento` varchar(255) DEFAULT NULL,
  `IdNotaMedica` int(11) DEFAULT NULL,
  `IdRespuestaSeguimiento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `IdServicio` int(11) NOT NULL,
  `DescripcionServicio` tinytext COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`IdServicio`, `DescripcionServicio`) VALUES
(1, 'Medicina Familiar'),
(2, 'Medicamentos'),
(3, 'Dental'),
(4, 'Toma de Muestras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `contrasena` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `IdPerfil` int(11) NOT NULL,
  `usuario` tinytext COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `IdEmpleado`, `contrasena`, `IdPerfil`, `usuario`) VALUES
(1, 1, 'MiContrasena', 3, 'mbasurto');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentenotamedica`
--
ALTER TABLE `antecedentenotamedica`
  ADD PRIMARY KEY (`IdAntecedenteNotaMedica`),
  ADD KEY `IdAntecedente` (`IdAntecedente`),
  ADD KEY `IdNotaMedica` (`IdNotaMedica`);

--
-- Indices de la tabla `catalogoantecedentes`
--
ALTER TABLE `catalogoantecedentes`
  ADD PRIMARY KEY (`IdAntecedente`),
  ADD KEY `IdServicio` (`IdServicio`);

--
-- Indices de la tabla `catalogoestatuscita`
--
ALTER TABLE `catalogoestatuscita`
  ADD PRIMARY KEY (`IdStatusCita`);

--
-- Indices de la tabla `catalogoproductos`
--
ALTER TABLE `catalogoproductos`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `IdServicio` (`IdServicio`);

--
-- Indices de la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  ADD PRIMARY KEY (`IdDiagnostico`);


--
-- Indices de la tabla `citaservicio`
--
ALTER TABLE `citaservicio`
  ADD PRIMARY KEY (`IdCitaServicio`),
  ADD KEY `IdPaciente` (`IdPaciente`),
  ADD KEY `IdServicio` (`IdServicio`),
  ADD KEY `IdStatusCita` (`IdStatusCita`),
  ADD KEY `IdNotaMedica` (`IdNotaMedica`);

--
-- Indices de la tabla `diagnosticonotamedica`
--
ALTER TABLE `diagnosticonotamedica`
  ADD KEY `IdNotaMedica` (`IdNotaMedica`),
  ADD KEY `IdDiagnostico` (`IdDiagnostico`);

--
-- Indices de la tabla `disponibilidadservicio`
--
ALTER TABLE `disponibilidadservicio`
  ADD PRIMARY KEY (`IdDisponiblidadServicio`);


--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`IdEmpleado`),
  ADD KEY `empleado_ibfk_1` (`IdServicio`);

--
-- Indices de la tabla `funcionesperfil`
--
ALTER TABLE `funcionesperfil`
  ADD KEY `funcionesperfil_ibfk_1` (`IdPerfil`),
  ADD KEY `funcionesperfil_ibfk_2` (`IdMenu`);


--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Indices de la tabla `notamedica`
--
ALTER TABLE `notamedica`
  ADD PRIMARY KEY (`IdNotaMedica`),
  ADD KEY `IdPaciente` (`IdPaciente`),
  ADD KEY `IdServicio` (`IdServicio`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`IdPaciente`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`IdPerfil`);

--
-- Indices de la tabla `productosnotamedica`
--
ALTER TABLE `productosnotamedica`
  ADD KEY `IdProducto` (`IdProducto`),
  ADD KEY `IdNotaMedica` (`IdNotaMedica`);

--
-- Indices de la tabla `seguimientomedico`
--
ALTER TABLE `seguimientomedico`
  ADD KEY `IdNotaMedica` (`IdNotaMedica`),
  ADD KEY `IdRespuestaSeguimiento` (`IdRespuestaSeguimiento`);


--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`IdServicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `usuario_ibfk_1` (`IdEmpleado`),
  ADD KEY `usuario_ibfk_2` (`IdPerfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentenotamedica`
--
ALTER TABLE `antecedentenotamedica`
  MODIFY `IdAntecedenteNotaMedica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `catalogoantecedentes`
--
ALTER TABLE `catalogoantecedentes`
  MODIFY `IdAntecedente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  MODIFY `IdDiagnostico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogoestatuscita`
--
ALTER TABLE `catalogoestatuscita`
  MODIFY `IdStatusCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `catalogoproductos`
--
ALTER TABLE `catalogoproductos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citaservicio`
--
ALTER TABLE `citaservicio`
  MODIFY `IdCitaServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `disponibilidadservicio`
--
ALTER TABLE `disponibilidadservicio`
  MODIFY `IdDisponiblidadServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;



--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `IdMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `notamedica`
--
ALTER TABLE `notamedica`
  MODIFY `IdNotaMedica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `IdPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--

-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `IdPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `IdServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedentenotamedica`
--
ALTER TABLE `antecedentenotamedica`
  ADD CONSTRAINT `antecedentenotamedica_ibfk_1` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`),
  ADD CONSTRAINT `antecedentenotamedica_ibfk_2` FOREIGN KEY (`IdAntecedente`) REFERENCES `catalogoantecedentes` (`IdAntecedente`);

--
-- Filtros para la tabla `catalogoproductos`
--
ALTER TABLE `catalogoproductos`
  ADD CONSTRAINT `catalogoproductos_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

--
-- Filtros para la tabla `citaservicio`
--
ALTER TABLE `citaservicio`
  ADD CONSTRAINT `citasservicio_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`),
  ADD CONSTRAINT `citasservicio_ibfk_2` FOREIGN KEY (`IdStatusCita`) REFERENCES `catalogoestatuscita` (`IdStatusCita`),
  ADD CONSTRAINT `citasservicio_ibfk_3` FOREIGN KEY (`IdPaciente`) REFERENCES `paciente` (`IdPaciente`),
  ADD CONSTRAINT `citasservicio_ibfk_4` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`);

--
-- Filtros para la tabla `diagnosticonotamedica`
--
ALTER TABLE `diagnosticonotamedica`
  ADD CONSTRAINT `diagnosticonotamedica_ibfk_1` FOREIGN KEY (`IdDiagnostico`) REFERENCES `catalogodiagnosticos` (`IdDiagnostico`),
  ADD CONSTRAINT `diagnosticonotamedica_ibfk_2` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);
COMMIT;

--
-- Filtros para la tabla `funcionesperfil`
--
ALTER TABLE `funcionesperfil`
  ADD CONSTRAINT `funcionesperfil_ibfk_1` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`),
  ADD CONSTRAINT `funcionesperfil_ibfk_2` FOREIGN KEY (`IdMenu`) REFERENCES `menu` (`IdMenu`);

--
-- Filtros para la tabla `notamedica`
--
ALTER TABLE `notamedica`
  ADD CONSTRAINT `notamedica_ibfk_1` FOREIGN KEY (`IdPaciente`) REFERENCES `paciente` (`IdPaciente`),
  ADD CONSTRAINT `notamedica_ibfk_2` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);
  ADD CONSTRAINT `notamedica_ibfk_3` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`);

-- Filtros para la tabla `productosnotamedica`
--
ALTER TABLE `productosnotamedica`
  ADD CONSTRAINT `productosnotamedica_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `catalogoproductos` (`IdProducto`),
  ADD CONSTRAINT `productosnotamedica_ibfk_2` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleado` (`IdEmpleado`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
