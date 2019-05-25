-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2019 a las 06:55:22
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarExistenciaInventario` (IN `clinica` INT)  NO SQL
SELECT catalogoproductos.IdProducto, DescripcionProducto, IdClinica, SUM(CantidadInventario) as Existencia
FROM catalogoproductos, subproducto, existenciainventario
WHERE catalogoproductos.IdProducto = subproducto.IdProducto AND subproducto.IdCodigoSubProducto = existenciainventario.IdCodigoSubProducto
GROUP BY catalogoproductos.IdProducto,DescripcionProducto, IdClinica
HAVING Idclinica = clinica$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Inventario_ConsultaDetalleMovimientosPorProducto` (IN `ClaveProducto` INT, IN `ClaveClinica` INT)  NO SQL
SELECT movimientosinventario.*, NumeroFactura, DescripcionTipoMovimientoInventario
FROM movimientosinventario 
JOIN catalogotipomovimientoinventario ON movimientosinventario.IdTipoMovimientoInventario = catalogotipomovimientoinventario.IdTipoMovimientoInventario 
JOIN subproducto ON subproducto.IdCodigoSubProducto = movimientosinventario.IdCodigoSubproducto
LEFT JOIN facturaentradainventario ON movimientosinventario.IdFacturaEntradaInventario = facturaentradainventario.IdFacturaEntradaInventario
WHERE movimientosinventario.IdClinica =ClaveClinica AND IdProducto = ClaveProducto$$

DELIMITER ;

--
-- Estructura de tabla para la tabla `catalogestatusseguimiento`
--

CREATE TABLE `catalogestatusseguimiento` (
  `IdEstatusSeguimiento` int(11) NOT NULL,
  `DescripcionEstatusSeguimiento` tinytext COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `catalogestatusseguimiento`
--

INSERT INTO `catalogestatusseguimiento` (`IdEstatusSeguimiento`, `DescripcionEstatusSeguimiento`) VALUES
(1, 'SOLICITADO'),
(2, 'CANCELADO'),
(3, 'ATENDIDO'),
(4, 'RECHAZADO');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `catalogoproductos`
--

INSERT INTO `catalogoproductos` (`IdProducto`, `CostoProducto`, `DescripcionProducto`, `IdServicio`) VALUES
(2, 33, 'ACIDO ACETILSALICÍLICO 30 TABS 100MG', 13),
(3, 33, 'ACIDO ACETILSALICÍLICO 30 TABS 100MG', 13),
(4, 12, 'ALBENDAZOL 6 TABS 200MG', 13),
(5, 6, 'ALBENDAZOL SUSPENSIÓN 400 MG', 13),
(6, 55, 'ALOPURINOL 30 TABLETAS 300 MG', 13),
(7, 35, 'ALUMINIO/MAGNESIO/DIMETICONA SUSP DE 320ML 185/200/50MG', 13),
(8, 45, 'AMBROXOL 15MG/5ML SOL.120 ML', 13),
(9, 29, 'AMBROXOL 20 TABLETAS 30 MG', 13),
(10, 65, 'AMBROXOL/DEXTROMETORFANO 10 TABS 22.5MG', 13),
(11, 30, 'AMBROXOL/DEXTROMETORFANO SOLUCIÓN ADULTO  120ML', 13),
(12, 28, 'AMBROXOL/DEXTROMETORFANO SOLUCIÓN INFANTIL  150/113 MG 120 ML', 13),
(13, 55, 'AMLODIPINO 30 TABS 5MG', 13),
(14, 70, 'AMOXICILINA/CLAVULANICO 10 TABLETAS 500/125 MG', 13),
(15, 85, 'AMOXICILINA/CLAVULANICO JR SUSP 250/62.5 MG/5 ML 60 ML', 13),
(16, 70, 'AMOXICILINA/CLAVULANICO JR SUSP 400/57 MG/5 ML 75 ML', 13),
(17, 60, 'ATENOLOL 28 TABS 50 MG ORAL', 13),
(18, 95, 'ATORVASTATINA 10 TABLETAS 20 MG ORAL', 13),
(19, 105, 'ATORVASTATINA 20TABS 10MG', 13),
(20, 250, 'ATORVASTATINA 30 TABS 20 MG', 13),
(21, 80, 'AZITROMICINA 3 TABLETAS 500 MG ORAL', 13),
(22, 30, 'BENZONATATO 20 TABLETAS 100 MG ORAL', 13),
(23, 20, 'BETAMETASONA/GENTAMICINA/CLOTRIMAZOL  40 GRS CREMA', 13),
(24, 55, 'BEZAFIBRATO 30 TABLETAS 200 MG', 13),
(25, 100, 'BROMURO DE PINVERIO 14 TABLETAS 100 MG', 13),
(26, 37, 'BUTILHIOSCINA 10 TAB 10 MG', 13),
(27, 70, 'BUTILHIOSCINA/METAMIZOL 10 GRAGEAS 10MG/250MG', 13),
(28, 140, 'CAPTOPRIL 30 TABS 25MG', 13),
(29, 150, 'CARISOPRODOL / DICLOFENACO 20 TABLETAS 200/50 MG', 13),
(30, 85, 'CEFALEXINA 20 CAPSULAS 500 MG', 13),
(31, 70, 'CEFALEXINA SUSP  250 MG. ORAL 100 ML.', 13),
(32, 320, 'CEFIXIMA 3 CAPS 400MG', 13),
(33, 484, 'CEFIXIMA 6 CAPS 400MG', 13),
(34, 400, 'CEFIXIMA SUSPENSION 100MG/ 5ML', 13),
(35, 60, 'CEFTRIAXONA IM 1 G 3.5 ML 1 AMP', 13),
(36, 150, 'CEFTRIAXONA IV 1G 10ML 1AMP', 13),
(37, 504, 'CELECOXIB 10 CAPS 200MG', 13),
(38, 685, 'CELECOXIB 20 CAPS 200MG', 13),
(39, 55, 'CETIRIZINA 10 TABLETAS 10 MG. ORAL', 13),
(40, 57, 'CINARIZINA 60 TABS 75MG', 13),
(41, 100, 'CIPROFLOXACINO 12 TABS 500 MG ORAL', 13),
(42, 70, 'CIPROFLOXACINO 8 TABS 500 MG ORAL', 13),
(43, 110, 'CLARITROMICINA 10 TABLETAS  500 MG ORAL', 13),
(44, 150, 'CLARITROMICINA 10 TABS 250MG', 13),
(45, 80, 'CLARITROMICINA SUSP 125 MG. 60 ML.', 13),
(46, 315, 'CLARITROMICINA SUSP 250 MG. 60ML', 13),
(47, 75, 'CLINDAMICINA 16 CAPS  300 MG ORAL', 13),
(48, 105, 'CLINDAMICINA/KETOCONAZOL 7 OVÚLOS VAG', 13),
(49, 29, 'CLONIXINATO LISINA 10 TABS 250 MG', 13),
(50, 316, 'CLOPIDOGREL 28 TABS 75 MG ORAL', 13),
(51, 22, 'CLORFENAMINA 20 TABLETAS 4 MG ORAL', 13),
(52, 13, 'CLORFENAMINA JARABE 50MG/100ML', 13),
(53, 77, 'DESLORATADINA 10 TABLETAS 5MG', 13),
(54, 250, 'DEXKETOPROFENO TROMETAMOL 10 TABS 25 MG', 13),
(55, 55, 'DICLOFENACO CUTANEO 60 G.', 13),
(56, 49, 'DICLOFENACO VIT B1,B6,B12 SIMPLE 30 GRAGEAS/TABS', 13),
(57, 100, 'DICLOXACILINA 20 CAPS 500 MG.', 13),
(58, 50, 'DICLOXACILINA SUSP 250 MG. ORAL 60ML', 13),
(59, 38, 'DIFENIDOL 25 MG 30 TABLETAS', 13),
(60, 200, 'DIOSMINA HESPERIDINA 20 TABS 450 / 50 MG', 13),
(61, 249, 'DIPROPIONATO DE BECLOMETASONA AEROSOL', 13),
(62, 65, 'DULOXETINA 7 TABLETAS 30 MG. ORAL', 13),
(63, 64, 'ERITROMICINA 20 TABS 500 MG', 13),
(64, 70, 'ERITROMICINA SUSP  250 MG. 100ML', 13),
(65, 140, 'ESPUMA SATINIZANTE', 13),
(66, 36, 'FENAZOPIRIDINA 20 TABLETAS 100 MG ORAL', 13),
(67, 63, 'FENITOINA SÓDICA 50 TABLETAS 100MG', 13),
(68, 310, 'FERRANINA 1G I.M. 4 AMPULAS', 13),
(69, 140, 'FINASTERIDA 30 TABLETAS 5 MG', 13),
(70, 100, 'FLUOXETINA 14 TABLETAS 20 MG', 13),
(71, 160, 'GABAPENTINA 30 CÁPSULAS 300 MG', 13),
(72, 25, 'HIDROCLOROTIAZIDA 20 TABLETAS 25 MG.', 13),
(73, 26, 'IBUPROFENO 10 TABS 400 MG', 13),
(74, 29, 'IBUPROFENO SUSP 120 ML', 13),
(75, 1200, 'INSULINA ACCIÓN PROLONGADA 10ML (100UI/ML) GLARGINA', 13),
(76, 140, 'INTERGEL UREA', 13),
(77, 95, 'ITRACONAZOL 15 CÁPSULAS  100 MG', 13),
(78, 20, 'KETOROLACO 10 TABLETAS 10 MG', 13),
(79, 87, 'LEVOFLOXACINO 7 TABS 500 MG', 13),
(80, 183, 'LEVOFLOXACINO 7 TABS 750MG', 13),
(81, 75, 'LEVONORGESTREL 2 COMPRIMIDOS 0.75MG', 13),
(82, 16, 'LOPERAMIDA 12 TABS 2 MG', 13),
(83, 34, 'LORATADINA / AMBROXOL SOLUCIÓN 30 ML  100MG/600MG', 13),
(84, 30, 'LORATADINA 20 TABS 10 MG', 13),
(85, 29, 'LORATADINA INF/AD 60ML/ 100 MG', 13),
(86, 67, 'LOSARTAN 30 TABS  50 MG', 13),
(87, 70, 'MAGALDRATO DIMETICONA 250 ML', 13),
(88, 20, 'MECLIZINA/PIRIDOXINA 12 TABLETAS 25/50 MG. (BONADOXINA)', 13),
(89, 41, 'MELOXICAM 10 TABS 15 MG', 13),
(90, 25, 'METAMIZOL SODICO 10 TABS  500 MG', 13),
(91, 44, 'METFORMINA 30 AB 850 MG', 13),
(92, 50, 'METFORMINA/GLIBENCLAMIDA 60 TABS  500/5 MG', 13),
(93, 25, 'METOPROLOL 20 TABS  100 MG', 13),
(94, 50, 'METRONIDAZOL 20 TABS 500MG', 13),
(95, 90, 'METRONIDAZOL 30 TABS 500 MG', 13),
(96, 33, 'METRONIDAZOL SUSP 120 ML 5G', 13),
(97, 225, 'MICRODACYN 240 ML', 13),
(98, 320, 'MOMETASONA 50 MG SUSPENSION', 13),
(99, 290, 'MONTELUKAST 30 TABS 10 MG', 13),
(100, 240, 'MOXIFLOXACINO 7 TAB 400 MG', 13),
(101, 40, 'NAPROXENO 30 TABS 250 MG', 13),
(102, 32, 'NAPROXENO SUSP 100 ML 100 ML/2.5G', 13),
(103, 140, 'NAPROXENO/CARISOPRODOL 30 CAP 250/200 MG', 13),
(104, 50, 'NASALUB SPRAY  INF 30ML', 13),
(105, 56, 'NIMESULIDA 20 TABS 100 MG', 13),
(106, 20, 'NITRATO DE MICONAZOL 2% CUTANEO 20 G.', 13),
(107, 72, 'NITROFURANTOINA 40 TABS 100MG', 13),
(108, 120, 'NORFLOXACINO 10 TABS 400MG', 13),
(109, 230, 'NORFLOXACINO 20 TAB 400 MG', 13),
(110, 40, 'OMEPRAZOL 14 CAPSULAS 20MG', 13),
(111, 329, 'ONDANSETRON 10 TABS 8 MG', 13),
(112, 21, 'OXIDO DE ZINC CUTANEO 30 G.', 13),
(113, 40, 'OXIMETAZOLINA 0.05% NAS 30 ML.', 13),
(114, 35, 'PANTOPRAZOL 7 TBAS 20 MG. ORAL', 13),
(115, 20, 'PARACETAMOL 10 TABLETAS 500MG', 13),
(116, 40, 'PARACETAMOL 300MG C3 SUPOSITORIOS', 13),
(117, 21, 'PARACETAMOL GOTAS 100MG ORAL 30 ML', 13),
(118, 36, 'PARACETAMOL INFANTIL SUSP 3.2G/100ML 120 ML', 13),
(119, 31, 'PARACETAMOL/CLORFENAMINA/ FENILEFRINA 10 TABS 300/4/5 MG', 13),
(120, 40, 'PARACETAMOL/FENILEFRINA/CLORFENAMINA 20 TABS 325/5/2 MG', 13),
(121, 65, 'PARACETAMOL-BUTHILHIOSCINA 20 TABLETAS 10MG/500MG', 13),
(122, 70, 'PAROXETINA 10 TABS 20MG', 13),
(123, 150, 'PEINE NOVO HERKLIN 2000 DE ACERO INOXIDABLE', 13),
(124, 56, 'PIOGLITAZONA 7 TABS 15MG', 13),
(125, 110, 'PIOGLITAZONA 7 TABS 30MG', 13),
(126, 50, 'PIROXICAM GEL 5% 60 G', 13),
(127, 159, 'PREGABALINA 75 MG', 13),
(128, 31, 'PROPRANOLOL 30 TABS 40 MG', 13),
(129, 100, 'PRUEBA DE EMBARAZO EN ORINA', 13),
(130, 18, 'RANITIDINA 20 TABS 150MG', 13),
(131, 85, 'RANITIDINA JARABE 200ML 150MG/10ML', 13),
(132, 50, 'SALBUTAMOL AEROSOL', 13),
(133, 43, 'SILDENAFIL 1 TAB  100 MG. ORAL', 13),
(134, 150, 'TAMSULOSINA 20 CAPS 0.4 MG', 13),
(135, 150, 'TELMISARTAN 14 TABS 40 MG. ORAL', 13),
(136, 60, 'TERBINAFINA 1% CUTANEO 15 G.', 13),
(137, 90, 'TOBRAMICINA/DEXAMETASONA OFT 5ML 3/1MG', 13),
(138, 170, 'TRAMADOL CON PARACETAMOL 20 TABS 37.5 MG/ 325MG', 13),
(139, 40, 'TRIMETOPRIMA/SULFAMETAXAZOL SUSP 120 ML  40/200MG', 13),
(140, 35, 'TRIMETOPRIMA/SULFAMETOXASOL 20 TABS 80/400 MG.', 13),
(141, 95, 'VALPROATO DE MAGNESIO 40 TABS 200MG', 13),
(142, 270, 'VENLAFAXIMA 20 CAPS 75MG', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogorespuestaseguimiento`
--

CREATE TABLE `catalogorespuestaseguimiento` (
  `IdRespuestaSeguimiento` int(11) NOT NULL,
  `DescripcionRespuestaSeguimiento` tinytext COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogotipomovimientoinventario`
--

CREATE TABLE `catalogotipomovimientoinventario` (
  `IdTipoMovimientoInventario` int(11) NOT NULL,
  `DescripcionTipoMovimientoInventario` varchar(15) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `catalogotipomovimientoinventario`
--

INSERT INTO `catalogotipomovimientoinventario` (`IdTipoMovimientoInventario`, `DescripcionTipoMovimientoInventario`) VALUES
(1, 'ENT.X.COMPRA'),
(2, 'SALIDA.X.VENTA'),
(3, 'ENT.X.TRANSF'),
(4, 'SAL.X.TRANSF');

-- ------------------------------------------------------
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticonotamedica`
--

CREATE TABLE `diagnosticonotamedica` (
  `IdNotaMedica` int(11) NOT NULL,
  `IdDiagnostico` int(11) NOT NULL,
  `ObservacionesDiagostico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Estructura de tabla para la tabla `existenciainventario`
--

CREATE TABLE `existenciainventario` (
  `IdClinica` int(11) NOT NULL,
  `IdCodigoSubProducto` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `Lote` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `CantidadInventario` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Estructura de tabla para la tabla `facturaentradainventario`
--

CREATE TABLE `facturaentradainventario` (
  `IdFacturaEntradaInventario` int(11) NOT NULL,
  `IdProveedor` int(11) NOT NULL,
  `FechaFactura` date NOT NULL,
  `TotalFactura` decimal(12,2) NOT NULL,
  `NumeroFactura` varchar(15) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Estructura de tabla para la tabla `FactorPrecioInventario`
--

CREATE TABLE `factorprecioinventario` (
  `IdFactorPrecioInventario` int(11) NOT NULL,
  `FactorPrecio` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Estructura de tabla para la tabla `lotesubproducto`
--

CREATE TABLE `lotesubproducto` (
  `IdCodigoSubProducto` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `Lote` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `Costo` decimal(7,2) NOT NULL,
  `FechaCaducidad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Estructura de tabla para la tabla `movimientosinventario`
--

CREATE TABLE `movimientosinventario` (
  `IdMovimientoInventario` int(11) NOT NULL,
  `IdCodigoSubproducto` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `Lote` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `IdTipoMovimientoInventario` int(11) NOT NULL,
  `FechaMovimiento` date NOT NULL,
  `CantidadMovimiento` int(11) NOT NULL,
  `IdClinica` int(11) NOT NULL,
  `IdFacturaEntradaInventario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `IdProveedor` int(11) NOT NULL,
  `NombreProveedor` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `DireccionProveedor` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `TelefonoProveedor` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `emailProveedor` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- Estructura de tabla para la tabla `seguimientomedico`
--

CREATE TABLE `seguimientomedico` (
  `IdSeguimientoMedico` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `DescripcionSeguimiento` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `FechaSeguimiento` date NOT NULL,
  `IdEstatusSeguimiento` int(11) NOT NULL,
  `ObservacionesSeguimiento` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `IdNotaMedica` int(11) NOT NULL,
  `FechaRespuesta_1` date DEFAULT NULL,
  `IdRespuestaSeguimiento_1` int(11) DEFAULT NULL,
  `FechaRespuesta_2` date DEFAULT NULL,
  `IdRespuestaSeguimiento_2` int(11) DEFAULT NULL,
  `FechaRespuesta_3` date DEFAULT NULL,
  `IdRespuestaSeguimiento_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Estructura de tabla para la tabla `servicioclinica`
--

CREATE TABLE `servicioclinica` (
  `IdServicio` int(11) NOT NULL,
  `IdClinica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Estructura de tabla para la tabla `subproducto`
--

CREATE TABLE `subproducto` (
  `IdCodigoSubProducto` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `NombreSubProducto` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `IdProveedor` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogestatusseguimiento`
--
ALTER TABLE `catalogestatusseguimiento`
  ADD PRIMARY KEY (`IdEstatusSeguimiento`);

  --
-- Indices de la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  ADD PRIMARY KEY (`IdDiagnostico`),
  ADD KEY `CatalogoDiagnostico_ibfk1` (`IdServicio`);
  --
-- Indices de la tabla `catalogorespuestaseguimiento`
--
ALTER TABLE `catalogorespuestaseguimiento`
  ADD PRIMARY KEY (`IdRespuestaSeguimiento`);

--
-- Indices de la tabla `catalogotipomovimientoinventario`
--
ALTER TABLE `catalogotipomovimientoinventario`
  ADD PRIMARY KEY (`IdTipoMovimientoInventario`);


--
-- Indices de la tabla `diagnosticonotamedica`
--
ALTER TABLE `diagnosticonotamedica`
  ADD PRIMARY KEY (`IdNotaMedica`,`IdDiagnostico`),
  ADD KEY `IdNotaMedica` (`IdNotaMedica`),
  ADD KEY `IdDiagnostico` (`IdDiagnostico`);
  --
-- Indices de la tabla `existenciainventario`
--
ALTER TABLE `existenciainventario`
  ADD PRIMARY KEY (`IdClinica`,`IdCodigoSubProducto`,`Lote`),
  ADD KEY `ExistenciaInventario_ibfk2` (`IdCodigoSubProducto`,`Lote`);

--
-- Indices de la tabla `facturaentradainventario`
--
ALTER TABLE `facturaentradainventario`
  ADD PRIMARY KEY (`IdFacturaEntradaInventario`),
  ADD KEY `FacturaEntradaInventario_ibfk1` (`IdProveedor`);

  --
-- Indices de la tabla `lotesubproducto`
--
ALTER TABLE `lotesubproducto`
  ADD PRIMARY KEY (`IdCodigoSubProducto`,`Lote`);

--
-- Indices de la tabla `movimientosinventario`
--
ALTER TABLE `movimientosinventario`
  ADD PRIMARY KEY (`IdMovimientoInventario`),
  ADD KEY `MovimientoInventario_ibfk1` (`IdClinica`),
  ADD KEY `MovimientoInventario_ibfk2` (`IdTipoMovimientoInventario`),
  ADD KEY `MovimientoInventario_ibfk4` (`IdFacturaEntradaInventario`),
  ADD KEY `MovimientoInventario_ibfk3` (`IdCodigoSubproducto`,`Lote`);

  --
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`IdProveedor`);

--
-- Indices de la tabla `seguimientomedico`
--
ALTER TABLE `seguimientomedico`
  ADD PRIMARY KEY (`IdSeguimientoMedico`),
  ADD KEY `seguimientomedico_ibfk1` (`IdNotaMedica`),
  ADD KEY `seguimientomedico_ibfk2` (`IdRespuestaSeguimiento_1`),
  ADD KEY `seguimientimedico_ibfk3` (`IdRespuestaSeguimiento_2`),
  ADD KEY `seguimientomedico_ibfk4` (`IdRespuestaSeguimiento_3`);

--
-- Indices de la tabla `servicioclinica`
--
ALTER TABLE `servicioclinica`
  ADD PRIMARY KEY (`IdServicio`,`IdClinica`),
  ADD KEY `ServicioClinica_ibfk1` (`IdClinica`);

--
-- Indices de la tabla `subproducto`
--
ALTER TABLE `subproducto`
  ADD PRIMARY KEY (`IdCodigoSubProducto`),
  ADD KEY `subproducto_ibfk1` (`IdProveedor`),
  ADD KEY `subproducto_ibfk3` (`IdProducto`);


--
-- AUTO_INCREMENT de la tabla `catalogestatusseguimiento`
--
ALTER TABLE `catalogestatusseguimiento`
  MODIFY `IdEstatusSeguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

  --
-- AUTO_INCREMENT de la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  MODIFY `IdDiagnostico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-
-- AUTO_INCREMENT de la tabla `catalogorespuestaseguimiento`
--
ALTER TABLE `catalogorespuestaseguimiento`
  MODIFY `IdRespuestaSeguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogotipomovimientoinventario`
--
ALTER TABLE `catalogotipomovimientoinventario`
  MODIFY `IdTipoMovimientoInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


--
-- AUTO_INCREMENT de la tabla `clinicas`
--
ALTER TABLE `clinicas`
  MODIFY `IdClinica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  -
-- AUTO_INCREMENT de la tabla `facturaentradainventario`
--
ALTER TABLE `facturaentradainventario`
  MODIFY `IdFacturaEntradaInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientosinventario`
--
ALTER TABLE `movimientosinventario`
  MODIFY `IdMovimientoInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;


--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `IdProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

  --
-- AUTO_INCREMENT de la tabla `seguimientomedico`
--
ALTER TABLE `seguimientomedico`
  MODIFY `IdSeguimientoMedico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

  --
-- Filtros para la tabla `catalogodiagnosticos`
--
ALTER TABLE `catalogodiagnosticos`
  ADD CONSTRAINT `CatalogoDiagnostico_ibfk1` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

  --
-- Filtros para la tabla `citaservicio`
--
ALTER TABLE `citaservicio`
  ADD CONSTRAINT `citaservicio_ibfk_5` FOREIGN KEY (`IdClinica`) REFERENCES `clinicas` (`IdClinica`);


--
-- Filtros para la tabla `empleadoclinica`
--
ALTER TABLE `empleadoclinica`
  ADD CONSTRAINT `EmpleadoClinica_ibfk1` FOREIGN KEY (`IdClinica`) REFERENCES `clinicas` (`IdClinica`),
  ADD CONSTRAINT `EmpleadoClinica_ibfk2` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleado` (`IdEmpleado`);

--
-- Filtros para la tabla `existenciainventario`
--
ALTER TABLE `existenciainventario`
  ADD CONSTRAINT `ExistenciaInventario_ibfk1` FOREIGN KEY (`IdClinica`) REFERENCES `clinicas` (`IdClinica`),
  ADD CONSTRAINT `ExistenciaInventario_ibfk2` FOREIGN KEY (`IdCodigoSubProducto`,`Lote`) REFERENCES `lotesubproducto` (`IdCodigoSubProducto`, `Lote`);

--
-- Filtros para la tabla `facturaentradainventario`
--
ALTER TABLE `facturaentradainventario`
  ADD CONSTRAINT `FacturaEntradaInventario_ibfk1` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`IdProveedor`);

--
--
-- Filtros para la tabla `lotesubproducto`
--
ALTER TABLE `lotesubproducto`
  ADD CONSTRAINT `LoteSubProducto_ibfk1` FOREIGN KEY (`IdCodigoSubProducto`) REFERENCES `subproducto` (`IdCodigoSubProducto`);

--
-- Filtros para la tabla `movimientosinventario`
--
ALTER TABLE `movimientosinventario`
  ADD CONSTRAINT `MovimientoInventario_ibfk1` FOREIGN KEY (`IdClinica`) REFERENCES `clinicas` (`IdClinica`),
  ADD CONSTRAINT `MovimientoInventario_ibfk2` FOREIGN KEY (`IdTipoMovimientoInventario`) REFERENCES `catalogotipomovimientoinventario` (`IdTipoMovimientoInventario`),
  ADD CONSTRAINT `MovimientoInventario_ibfk3` FOREIGN KEY (`IdCodigoSubproducto`,`Lote`) REFERENCES `lotesubproducto` (`IdCodigoSubProducto`, `Lote`),
  ADD CONSTRAINT `MovimientoInventario_ibfk4` FOREIGN KEY (`IdFacturaEntradaInventario`) REFERENCES `facturaentradainventario` (`IdFacturaEntradaInventario`);


  --
-- Filtros para la tabla `seguimientomedico`
--
ALTER TABLE `seguimientomedico`
  ADD CONSTRAINT `seguimientimedico_ibfk3` FOREIGN KEY (`IdRespuestaSeguimiento_2`) REFERENCES `catalogorespuestaseguimiento` (`IdRespuestaSeguimiento`),
  ADD CONSTRAINT `seguimientomedico_ibfk1` FOREIGN KEY (`IdNotaMedica`) REFERENCES `notamedica` (`IdNotaMedica`),
  ADD CONSTRAINT `seguimientomedico_ibfk2` FOREIGN KEY (`IdRespuestaSeguimiento_1`) REFERENCES `catalogorespuestaseguimiento` (`IdRespuestaSeguimiento`),
  ADD CONSTRAINT `seguimientomedico_ibfk4` FOREIGN KEY (`IdRespuestaSeguimiento_3`) REFERENCES `catalogorespuestaseguimiento` (`IdRespuestaSeguimiento`);

--
-- Filtros para la tabla `servicioclinica`
--
ALTER TABLE `servicioclinica`
  ADD CONSTRAINT `ServicioClinica_ibfk1` FOREIGN KEY (`IdClinica`) REFERENCES `clinicas` (`IdClinica`),
  ADD CONSTRAINT `ServicioClinica_ibfk2` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

--
-- Filtros para la tabla `subproducto`
--
ALTER TABLE `subproducto`
  ADD CONSTRAINT `subproducto_ibfk1` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`IdProveedor`),
  ADD CONSTRAINT `subproducto_ibfk3` FOREIGN KEY (`IdProducto`) REFERENCES `catalogoproductos` (`IdProducto`);

COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

