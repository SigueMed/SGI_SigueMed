-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2018 a las 23:00:23
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgi_siguemedbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentenotamedica`
--

CREATE TABLE `antecedentenotamedica` (
  `IdAntecedente` int(11) DEFAULT NULL,
  `IdNotaMedica` int(11) DEFAULT NULL,
  `DescripcionAntecedenteNotaMedica` varchar(255) DEFAULT NULL,
  `IdAntecedenteNotaMedica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogoantecedentes`
--

CREATE TABLE `catalogoantecedentes` (
  `IdAntecedente` int(11) NOT NULL,
  `DescripcionAntecedente` varchar(255) DEFAULT NULL,
  `IdServicio` int(11) NOT NULL
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
-- Estructura de tabla para la tabla `catalogoestatuscita`
--

CREATE TABLE `catalogoestatuscita` (
  `IdStatusCita` int(11) NOT NULL,
  `DescripcionEstatusCita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogoproductos`
--

CREATE TABLE `catalogoproductos` (
  `IdProducto` int(11) NOT NULL AUTO_INCREMENT,
  `CostoProducto` int(11) DEFAULT NULL,
  `DescripcionProducto` varchar(255) DEFAULT NULL,
  `IdServicio` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogorespuestaseguimiento`
--

CREATE TABLE `catalogorespuestaseguimiento` (
  `IdRespuestaSeguimiento` int(11) NOT NULL,
  `DescripcionRespuestaSeguimiento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citasservicio`
--

CREATE TABLE `citasservicio` (
  `IdCitaServicio` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdServicio` int(11) NOT NULL,
  `DiaCita` varchar(50) NOT NULL,
  `HoraCita` time NOT NULL,
  `MesCita` varchar(50) NOT NULL,
  `AñoCita` int(11) NOT NULL,
  `IdStatusCita` int(11) NOT NULL,
  `IdNotaMedica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `disponibilidadservicio`
--

CREATE TABLE `disponibilidadservicio` (
  `IdDisponibilidad` int(11) NOT NULL,
  `DiaDisponible` varchar(50) NOT NULL,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL,
  `IdServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `IdEmpleado` int(11) NOT NULL,
  `NombreEmpleado` varchar(255) NOT NULL,
  `ApellidosEmpleado` varchar(255) NOT NULL,
  `TelefonoEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresapaciente`
--

CREATE TABLE `empresapaciente` (
  `IdEmpresaPaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excepciondisponibilidadservicio`
--

CREATE TABLE `excepciondisponibilidadservicio` (
  `IdExcepcion` int(11) NOT NULL,
  `FechaExcepcion` date NOT NULL,
  `HoraInicioExcepcion` time NOT NULL,
  `HoraFinExcepcion` time NOT NULL,
  `IdServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionesperfil`
--

CREATE TABLE `funcionesperfil` (
  `IdPerfil` int(11) NOT NULL,
  `IdMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `IdMedico` int(11) NOT NULL,
  `NombreMedico` varchar(50) NOT NULL,
  `ApellidoMedico` varchar(50) NOT NULL,
  `IdServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `IdMenu` int(11) NOT NULL,
  `DescripcionMenu` varchar(255) NOT NULL,
  `IdMenuPadre` int(11) DEFAULT NULL,
  `UrlMenu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notamedica`
--

CREATE TABLE `notamedica` (
  `IdNotaMedica` int(11) NOT NULL,
  `IMC` varchar(255) DEFAULT NULL,
  `FechaNotaMedica` date DEFAULT NULL,
  `DiagnosticoGeneral` varchar(255) DEFAULT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdServicio` int(11) NOT NULL,
  `IdMedico` int(11) NOT NULL,
  `PesoPaciente` int(11) NOT NULL,
  `TallaPaciente` int(11) NOT NULL,
  `TempereturaPaciente` int(11) NOT NULL,
  `PresionPaciente` int(11) NOT NULL,
  `FrCardiacaPaciente` int(11) NOT NULL,
  `FrRespiratoriaPaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `IdPaciente` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `IdTipoPaciente` int(11) DEFAULT NULL,
  `IdEmpresaPaciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `IdPerfil` int(11) NOT NULL,
  `DecripcionPerfil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `DescripcionServicio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopaciente`
--

CREATE TABLE `tipopaciente` (
  `IdTipoPaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `IdPerfil` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Contrasena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indices de la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  ADD PRIMARY KEY (`IdDiagnostico`);

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
  ADD KEY (`IdServicio`);

--
-- Indices de la tabla `catalogorespuestaseguimiento`
--
ALTER TABLE `catalogorespuestaseguimiento`
  ADD PRIMARY KEY (`IdRespuestaSeguimiento`);

--
-- Indices de la tabla `citasservicio`
--
ALTER TABLE `citasservicio`
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
  ADD PRIMARY KEY (`IdDisponibilidad`),
  ADD KEY `IdServicio` (`IdServicio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`IdEmpleado`);

--
-- Indices de la tabla `empresapaciente`
--
ALTER TABLE `empresapaciente`
  ADD PRIMARY KEY (`IdEmpresaPaciente`);

--
-- Indices de la tabla `excepciondisponibilidadservicio`
--
ALTER TABLE `excepciondisponibilidadservicio`
  ADD PRIMARY KEY (`IdExcepcion`),
  ADD KEY `IdServicio` (`IdServicio`);

--
-- Indices de la tabla `funcionesperfil`
--
ALTER TABLE `funcionesperfil`
  ADD KEY `IdPerfil` (`IdPerfil`),
  ADD KEY `IdMenu` (`IdMenu`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`IdMedico`),
  ADD KEY `IdServicio` (`IdServicio`);

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
  ADD KEY `IdMedico` (`IdMedico`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`IdPaciente`),
  ADD KEY `IdTipoPaciente` (`IdTipoPaciente`),
  ADD KEY `IdEmpresaPaciente` (`IdEmpresaPaciente`);

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
-- Indices de la tabla `tipopaciente`
--
ALTER TABLE `tipopaciente`
  ADD PRIMARY KEY (`IdTipoPaciente`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdEmpleado` (`IdEmpleado`),
  ADD KEY `IdPerfil` (`IdPerfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentenotamedica`
--
ALTER TABLE `antecedentenotamedica`
  MODIFY `IdAntecedenteNotaMedica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogoantecedentes`
--
ALTER TABLE `catalogoantecedentes`
  MODIFY `IdAntecedente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  MODIFY `IdDiagnostico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogoestatuscita`
--
ALTER TABLE `catalogoestatuscita`
  MODIFY `IdStatusCita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogoproductos`
--
ALTER TABLE `catalogoproductos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogorespuestaseguimiento`
--
ALTER TABLE `catalogorespuestaseguimiento`
  MODIFY `IdRespuestaSeguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `citasservicio`
--
ALTER TABLE `citasservicio`
  MODIFY `IdCitaServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `disponibilidadservicio`
--
ALTER TABLE `disponibilidadservicio`
  MODIFY `IdDisponibilidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresapaciente`
--
ALTER TABLE `empresapaciente`
  MODIFY `IdEmpresaPaciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `excepciondisponibilidadservicio`
--
ALTER TABLE `excepciondisponibilidadservicio`
  MODIFY `IdExcepcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `IdMedico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `IdMenu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notamedica`
--
ALTER TABLE `notamedica`
  MODIFY `IdNotaMedica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `IdPaciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `IdPerfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `IdServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipopaciente`
--
ALTER TABLE `tipopaciente`
  MODIFY `IdTipoPaciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `catalogoantecedentes`
--
ALTER TABLE `catalogoantecedentes`
  ADD CONSTRAINT `catalogoantecedentes_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

--
-- Filtros para la tabla `catalogoproductos`
--
ALTER TABLE `catalogoproductos`
  ADD CONSTRAINT `catalogoproductos_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

--
-- Filtros para la tabla `citasservicio`
--
ALTER TABLE `citasservicio`
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
-- Filtros para la tabla `disponibilidadservicio`
--
ALTER TABLE `disponibilidadservicio`
  ADD CONSTRAINT `disponibilidadservicio_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

--
-- Filtros para la tabla `excepciondisponibilidadservicio`
--
ALTER TABLE `excepciondisponibilidadservicio`
  ADD CONSTRAINT `excepciondisponibilidadservicio_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

--
-- Filtros para la tabla `funcionesperfil`
--
ALTER TABLE `funcionesperfil`
  ADD CONSTRAINT `funcionesperfil_ibfk_1` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`),
  ADD CONSTRAINT `funcionesperfil_ibfk_2` FOREIGN KEY (`IdMenu`) REFERENCES `menu` (`IdMenu`);

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

--
-- Filtros para la tabla `notamedica`
--
ALTER TABLE `notamedica`
  ADD CONSTRAINT `notamedica_ibfk_1` FOREIGN KEY (`IdPaciente`) REFERENCES `paciente` (`IdPaciente`),
  ADD CONSTRAINT `notamedica_ibfk_2` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`),
  ADD CONSTRAINT `notamedica_ibfk_3` FOREIGN KEY (`IdMedico`) REFERENCES `medico` (`IdMedico`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`IdTipoPaciente`) REFERENCES `tipopaciente` (`IdTipoPaciente`),
  ADD CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`IdEmpresaPaciente`) REFERENCES `empresapaciente` (`IdEmpresaPaciente`);

--
-- Filtros para la tabla `productosnotamedica`
--
ALTER TABLE `productosnotamedica`
  ADD CONSTRAINT `productosnotamedica_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `catalogoproductos` (`IdProducto`),
  ADD CONSTRAINT `productosnotamedica_ibfk_2` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`);

--
-- Filtros para la tabla `seguimientomedico`
--
ALTER TABLE `seguimientomedico`
  ADD CONSTRAINT `seguimientomedico_ibfk_1` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`),
  ADD CONSTRAINT `seguimientomedico_ibfk_2` FOREIGN KEY (`IdRespuestaSeguimiento`) REFERENCES `catalogorespuestaseguimiento` (`IdRespuestaSeguimiento`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleado` (`IdEmpleado`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
