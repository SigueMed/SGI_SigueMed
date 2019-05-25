/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Constanzo Basurto
 * Created: 28/11/2018
 */

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
-- Indices de la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  ADD PRIMARY KEY (`IdDiagnostico`);

--
-- Indices de la tabla `diagnosticonotamedica`
--
ALTER TABLE `diagnosticonotamedica`
  ADD KEY `IdNotaMedica` (`IdNotaMedica`),
  ADD KEY `IdDiagnostico` (`IdDiagnostico`);

--
-- Indices de la tabla `productosnotamedica`
--
ALTER TABLE `productosnotamedica`
  ADD KEY `IdProducto` (`IdProducto`),
  ADD KEY `IdNotaMedica` (`IdNotaMedica`);

--
-- AUTO_INCREMENT de la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  MODIFY `IdDiagnostico` int(11) NOT NULL AUTO_INCREMENT;

--
-- Filtros para la tabla `diagnosticonotamedica`
--
ALTER TABLE `diagnosticonotamedica`
  ADD CONSTRAINT `diagnosticonotamedica_ibfk_1` FOREIGN KEY (`IdDiagnostico`) REFERENCES `catalogodiagnosticos` (`IdDiagnostico`),
  ADD CONSTRAINT `diagnosticonotamedica_ibfk_2` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`);

-- Filtros para la tabla `productosnotamedica`
--
ALTER TABLE `productosnotamedica`
  ADD CONSTRAINT `productosnotamedica_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `catalogoproductos` (`IdProducto`),
  ADD CONSTRAINT `productosnotamedica_ibfk_2` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`);
