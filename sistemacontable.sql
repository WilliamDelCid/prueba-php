-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2020 a las 16:25:34
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemacontable`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `nivel` int(11) NOT NULL,
  `saldo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`codigo`, `nombre`, `tipo`, `nivel`, `saldo`) VALUES
('1', 'ACTIVO', '1', 1, '1'),
('11', 'ACTIVO CORRIENTE', '1', 2, '1'),
('1101', 'EFECTIVO Y EQUIVALENTE DE EFECTIVO', '1', 3, '1'),
('110101', 'CAJA ', '1', 4, '1'),
('11010101', 'CAJA GENERAL', '1', 5, '1'),
('11010102', 'CAJA CHICA', '1', 5, '1'),
('110102', 'BANCOS', '1', 4, '1'),
('11010201', 'CUENTAS CORRIENTES', '1', 5, '1'),
('1101020101', 'BANCO AGRICOLA', '1', 6, '1'),
('1105', 'CUENTAS Y DOCUMENTOS POR COBRAR', '1', 3, '1'),
('110501', 'CUENTAS POR COBRAR', '1', 4, '1'),
('110503', 'ANTICIPO A PROVEEDORES', '1', 4, '1'),
('110504', 'PRESTAMOS Y ANTICIPOS AL PERSONAL', '1', 4, '1'),
('110505', 'DEUDORES DIVERSOS', '1', 4, '1'),
('110506', 'OTRAS CUENTAS POR COBRAR', '1', 4, '1'),
('1106R', 'ESTIMACIÓN PARA CUENTAS INCOBRABLES (CR)', '2', 3, '2'),
('1107', 'INVENTARIOS', '3', 3, '2'),
('1109', 'IVA-CREDITO FISCAL', '1', 3, '1'),
('1113', 'PAGOS ANTICIPADOS', '1', 3, '1'),
('111301', 'SUMINISTROS DE OFICINA', '1', 4, '1'),
('111302', 'MANTENIMIENTO', '1', 4, '1'),
('111303', 'SEGUROS', '1', 4, '1'),
('111304', 'ALQUILERES', '1', 4, '1'),
('111305', 'PUBLICIDAD Y PROPAGANDA', '1', 4, '1'),
('111306', 'BENEFICIOS O PRESTACIONES A EMPLEADOS', '1', 4, '1'),
('111307', 'GASTOS DE ORGANIZACIÓN ', '1', 4, '1'),
('111308', 'PAGO A CUENTA IMPUESTO SOBRE LA RENTA', '1', 4, '1'),
('111309', 'OTROS PAGOS ANTICIPADOS', '1', 4, '1'),
('12', 'ACTIVO NO CORRIENTE', '1', 2, '1'),
('1202', 'PROPIEDAD PLANTA Y EQUIPO', '1', 3, '1'),
('120201', 'TERRENOS', '1', 4, '1'),
('120202', 'EDIFICIOS', '1', 4, '1'),
('120203 ', 'INSTALACIONES', '1', 3, '1'),
('120204', 'PROPIEDAD PLANTA Y EQUIPO', '1', 4, '1'),
('120205', 'EQUIPO DE TRANSPORTE', '1', 4, '1'),
('120206', 'EXHIBIDORES ', '1', 4, '1'),
('120207', 'OTROS BIENES', '1', 4, '1'),
('1205', 'DEPRECIACION ACUMULADA PROPIEDAD PLANTA Y EQUIPO (CR)', '2', 3, '2'),
('120503', 'DEPRECIACIÓN DE MOBILIARIO Y EQUIPO', '2', 4, '1'),
('120504', 'DEPRECIACIÓN DE EQUIPO DE TRANSPORTE', '2', 4, '1'),
('1209', 'ACTIVOS INTANGIBLES', '1', 3, '1'),
('120902', 'PATENTES Y MARCAS', '1', 4, '1'),
('1211', 'CUENTAS Y DOCUMENTOS POR COBRAR A LARGO PLAZO', '1', 3, '1'),
('1217', 'PAPELERIA Y UTILES ', '1', 3, '1'),
('2', 'PASIVO ', '2', 1, '2'),
('21', 'PASIVO CORRIENTE', '2', 2, '2'),
('2101', 'CUENTAS Y DOCUMENTOS POR PAGAR', '2', 3, '2'),
('210101', 'PROVEEDORES', '2', 4, '2'),
('210103', 'DOCUMENTOS POR PAGAR', '2', 4, '2'),
('21010305', 'ACREEDORES DIVERSOS', '2', 5, '2'),
('2102', 'PRESTAMOS Y SOBREGIROS BANCARIOS', '2', 3, '2'),
('210201', 'SOBREGIROS BANCARIOS', '2', 4, '2'),
('210202', 'PRESTAMOS A LARGO PLAZO', '2', 4, '2'),
('2104', 'RETENCIONES Y DESCUENTOS', '2', 3, '2'),
('210401', 'COTIZACIONES AL SEGURO SOCIAL SALUD', '2', 4, '2'),
('210402', 'COTIZACIONES A FONDO DE PENSIONES', '2', 4, '2'),
('210403', 'RENTA', '2', 4, '2'),
('2105', 'IVA - DEBITO FISCAL', '2', 3, '2'),
('2108', 'IMPUESTO POR PAGAR', '2', 3, '2'),
('2109', 'DIVIDENDOS POR PAGAR', '2', 3, '2'), 
('220101', 'CUENTAS POR PAGAR', '2', 4, '2'),
('220102', 'DOCUMENTOS POR PAGAR', '2', 4, '2'),
('22010201', 'LETRAS DE CAMBIO', '2', 5, '2'),
('22010202', 'PAGARES', '2', 5, '2'),
('3', 'PATRIMONIO DE LOS ACCIONISTAS', '3', 1, '2'),
('31', 'CAPITAL SOCIAL', '3', 2, '2'),
('3101', 'CAPITAL SOCIAL', '3', 3, '2'),
('310101', 'CAPITAL SOCIAL SUSCRITO', '3', 4, '2'),
('31010101', 'CAPITAL SOCIAL PAGADO', '3', 5, '2'),
('31010102', 'CAPITAL SOCIAL NO PAGADO', '3', 5, '2'),
('3102', 'RESERVA LEGAL', '3', 3, '2'),
('3105', 'UTILIDAD DEL EJERCICIO', '3', 3, '2'),
('32', 'RESERVA Y SUPERAVIT', '3', 2, '2'),
('3201', 'RESERVA DE CAPITAL', '3', 3, '2'),
('320101', 'RESERVA LEGAL', '3', 4, '2'),
('320102', 'OTRAS RESERVAS', '3', 4, '2'),
('3202', 'SUPERAVIT POR REVALUACIONES', '3', 3, '2'),
('320201', 'SUPERAVIT POR REVALUACION PROPIEDAD PLANTA Y EQUIPO', '3', 4, '2'),
('32020101', 'REVALUACION DE TERRENOS', '3', 5, '2'),
('4', 'CUENTAS DE RESULTADO DEUDORAS', '4', 1, '1'),
('41', 'COSTOS Y GASTOS DE OPERACIÓN ', '4', 2, '1'),
('4101', 'COMPRAS', '4', 3, '1'),
('4102', 'GASTOS SOBRE COMPRA', '4', 3, '1'),
('4103', 'COSTO DE VENTA', '4', 3, '1'),
('4104', 'DEVOLUCIONES SOBRE VENTAS', '4', 3, '1'),
('4105', 'REBAJAS SOBRE VENTA', '4', 3, '1'),
('4106', 'GASTOS DE VENTA', '4', 3, '1'),
('410601', 'SALARIOS', '4', 4, '1'),
('410602', 'HORAS EXTRAS', '4', 4, '1'),
('410603', 'COMISIONES', '4', 4, '1'),
('410604', 'VACACIONES', '4', 4, '1'),
('410609', 'SEGURO SOCIAL', '4', 4, '1'),
('410610', 'AFP', '4', 4, '1'),
('410611', 'VIÁTICOS ', '4', 4, '1'),
('410612', 'COMUNICACIONES', '4', 4, '1'),
('410614', 'ALQUILERES', '4', 4, '1'),
('410615', 'GASTOS DE VIAJE', '4', 4, '1'),
('410616', 'EQUIPO DE OFICINA', '4', 4, '1'),
('410619', 'LUZ Y AGUA', '4', 4, '1'),
('410620', 'COMBUSTIBLES Y LUBRICANTES', '4', 4, '1'),
('410621', 'MANTENIMIENTO DE VEHÍCULOS', '4', 4, '1'),
('410622', 'SEGUROS DE VEHÍCULOS', '4', 4, '1'),
('410623R', 'CUENTAS INCOBRABLES', '4', 4, '1'),
('410626', 'SEGUROS', '4', 4, '1'),
('410627', 'PUBLICIDAD Y PROPAGANDA', '4', 4, '1'),
('410628', 'PAPELERÍA Y ÚTILES ', '4', 4, '1'),
('410629', 'MATERIAL DE LIMPIEZA ', '4', 4, '1'),
('410630', 'MANTENIMIENTO', '4', 4, '1'),
('410631R', 'DEPRECIACIÓN ', '4', 4, '1'),
('410632', 'AMORTIZACIÓN', '4', 4, '1'),
('410699', 'OTROS', '4', 4, '1'),
('4107', 'GASTOS DE ADMINISTRACIÓN ', '4', 3, '1'),
('410701', 'SUELDOS', '4', 4, '1'),
('410702', 'HORAS EXTRAS', '4', 4, '1'),
('410703', 'SERVICIOS PROFESIONALES', '4', 4, '1'),
('410704', 'CUOTA INSAFORP', '4', 4, '1'),
('410705', 'VACACIONES', '4', 4, '1'),
('410706', 'AGUINALDO ', '4', 4, '1'),
('410707', 'BONIFICACIONES', '4', 4, '1'),
('410708', 'CAPACITACIONES', '4', 4, '1'),
('410709', 'SEGURO SOCIAL', '4', 4, '1'),
('410710', 'AFP', '4', 4, '1'),
('410711', 'VIÁTICOS ', '4', 4, '1'),
('410714', 'COMUNICACIONES', '4', 4, '1'),
('410715', 'EQUIPO DE OFICINA', '4', 4, '1'),
('410716', 'PAPELERÍA Y ÚTILES ', '4', 4, '1'),
('410717', 'CUOTA Y SUSCRIPCIONES', '4', 4, '1'),
('410718', 'EQUIPO DE TRANSPORTE', '4', 4, '1'),
('410719', 'SEGUROS', '4', 4, '1'),
('410722', 'ALQUILERES', '4', 4, '1'),
('410724', 'TELÉFONO', '4', 4, '1'),
('410726', 'LUZ Y AGUA', '4', 4, '1'),
('410736R', 'DEPRECIACIÓN ', '4', 4, '1'),
('410737', 'AMORTIZACIÓN', '4', 4, '1'),
('410799', 'OTROS', '4', 4, '1'),
('4108', 'OTROS GASTOS OPERATIVOS', '4', 4, '1'),
('4109', 'GASTOS FINANCIEROS', '4', 3, '1'),
('410901', 'INTERESES ', '4', 4, '1'),
('410902', 'COMISIONES BANCARIAS', '4', 4, '1'),
('5', 'CUENTAS DE RESULTADO ACREEDORAS', '5', 1, '2'),
('51', 'INGRESOS DE OPERACIÓN ', '5', 3, '2'),
('5101', 'VENTAS', '5', 3, '2'),
('5102', 'REBAJAS SOBRE COMPRAS', '5', 3, '2'),
('5103', 'DEVOLUCIONES SOBRE COMPRAS', '5', 3, '2'),
('5201', 'INGRESOS FINANCIEROS ', '5', 3, '2'),
('5202', 'OTROS INGRESOS', '5', 3, '2'),
('6', 'CUENTA LIQUIDADORA', '6', 1, '1'),
('61', 'CUENTA DE CIERRE', '6', 2, '1'),
('6101', 'PERDIDAS Y GANANCIAS', '6', 3, '1'),
('7', 'CUENTAS DE ORDEN', '7', 1, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallediario`
--

CREATE TABLE `detallediario` (
  `codigo` varchar(20) NOT NULL,
  `idpartida` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `movimiento` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallediario`
--

INSERT INTO `detallediario` (`codigo`, `idpartida`, `monto`, `movimiento`) VALUES
('11010101', 1, '55000.00', 'CARGO'),
('1101020101', 1, '587000.00', 'CARGO'),
('1107', 1, '436000.00', 'CARGO'),
('110505', 1, '16000.00', 'CARGO'),
('120204', 1, '25000.00', 'CARGO'),
('120205', 1, '186000.00', 'CARGO'),
('120201', 1, '125000.00', 'CARGO'),
('210101', 1, '567000.00', 'ABONO'),
('3101', 1, '863000.00', 'ABONO'),
('410703', 2, '7500.00', 'CARGO'),
('1109', 2, '975.00', 'CARGO'),
('1101020101', 2, '7725.00', 'ABONO'),
('210403', 2, '750.00', 'ABONO'),
('410614', 3, '8800.00', 'CARGO'),
('410722', 3, '13200.00', 'CARGO'),
('1109', 3, '2860.00', 'CARGO'),
('1101020101', 3, '24860.00', 'ABONO'),
('4101', 4, '82000.00', 'CARGO'),
('1109', 4, '10660.00', 'CARGO'),
('1101020101', 4, '37064.00', 'ABONO'),
('210101', 4, '55596.00', 'ABONO'),
('1217', 5, '12000.00', 'CARGO'),
('1109', 5, '1560.00', 'CARGO'),
('11010101', 5, '4068.00', 'ABONO'),
('1101020101', 5, '9492.00', 'ABONO'),
('120204', 6, '1800.00', 'CARGO'),
('1109', 6, '234.00', 'CARGO'),
('11010101', 6, '2034.00', 'ABONO'),
('120204', 7, '4800.00', 'CARGO'),
('1109', 7, '624.00', 'CARGO'),
('21010305', 7, '5424.00', 'ABONO'),
('1101020101', 8, '220350.00', 'CARGO'),
('110501', 8, '73450.00', 'CARGO'),
('5101', 8, '260000.00', 'ABONO'),
('2105', 8, '33800.00', 'ABONO'),
('11010102', 9, '1500.00', 'CARGO'),
('1101020101', 9, '1500.00', 'ABONO'),
('410701', 10, '3760.00', 'CARGO'),
('410601', 10, '2150.00', 'CARGO'),
('1101020101', 10, '4965.49', 'ABONO'),
('210401', 10, '165.30', 'ABONO'),
('210402', 10, '428.49', 'ABONO'),
('210403', 10, '350.72', 'ABONO'),
('2105', 11, '33800.00', 'CARGO'),
('1109', 11, '16913.00', 'ABONO'),
('2108', 11, '16887.00', 'ABONO'),
('410628', 12, '500.00', 'CARGO'),
('410716', 12, '500.00', 'CARGO'),
('1217', 12, '1000.00', 'ABONO'),
('410715', 13, '520.83', 'CARGO'),
('410616', 13, '520.83', 'CARGO'),
('120503', 13, '1041.66', 'ABONO'),
('410718', 14, '3875.00', 'CARGO'),
('120504', 14, '3875.00', 'ABONO'),
('2108', 15, '16887.00', 'CARGO'),
('1101020101', 15, '16887.00', 'ABONO'),
('210403', 16, '750.00', 'CARGO'),
('1101020101', 16, '750.00', 'ABONO'),
('410722', 17, '13200.00', 'CARGO'),
('410614', 17, '8800.00', 'CARGO'),
('1109', 17, '2860.00', 'CARGO'),
('1101020101', 17, '24860.00', 'ABONO'),
('110501', 18, '10170.00', 'CARGO'),
('5101', 18, '9000.00', 'ABONO'),
('2105', 18, '1170.00', 'ABONO'),
('210401', 19, '165.30', 'CARGO'),
('210402', 19, '428.49', 'CARGO'),
('210403', 19, '350.72', 'CARGO'),
('410709', 19, '267.00', 'CARGO'),
('410710', 19, '291.41', 'CARGO'),
('410609', 19, '146.25', 'CARGO'),
('410610', 19, '166.63', 'CARGO'),
('1101020101', 19, '1815.80', 'ABONO'),
('4105', 20, '2550.00', 'CARGO'),
('2105', 20, '331.50', 'CARGO'),
('110501', 20, '2881.50', 'ABONO'),
('410701', 21, '3760.00', 'CARGO'),
('410601', 21, '2150.00', 'CARGO'),
('1101020101', 21, '4965.49', 'ABONO'),
('210401', 21, '165.30', 'ABONO'),
('210402', 21, '428.49', 'ABONO'),
('210403', 21, '350.72', 'ABONO'),
('4101', 22, '498000.00', 'CARGO'),
('1109', 22, '64740.00', 'CARGO'),
('210101', 22, '562740.00', 'ABONO'),
('2105', 23, '838.50', 'CARGO'),
('1109', 23, '838.50', 'ABONO'),
('410716', 24, '500.00', 'CARGO'),
('410628', 24, '500.00', 'CARGO'),
('1217', 24, '1000.00', 'ABONO'),
('410715', 25, '520.83', 'CARGO'),
('410616', 25, '520.83', 'CARGO'),
('120503', 25, '1041.66', 'ABONO'),
('410718', 26, '3875.00', 'CARGO'),
('120504', 26, '3875.00', 'ABONO'),
('410715', 27, '275.00', 'CARGO'),
('120503', 27, '275.00', 'ABONO'),
('410722', 28, '13200.00', 'CARGO'),
('410614', 28, '8800.00', 'CARGO'),
('1109', 28, '2860.00', 'CARGO'),
('1101020101', 28, '24860.00', 'ABONO'),
('1101020101', 29, '130515.00', 'CARGO'),
('110501', 29, '55935.00', 'CARGO'),
('5101', 29, '165000.00', 'ABONO'),
('2105', 29, '21450.00', 'ABONO'),
('210101', 30, '2542.50', 'CARGO'),
('5103', 30, '2250.00', 'ABONO'),
('1109', 30, '292.50', 'ABONO'),
('21010305', 31, '5424.00', 'CARGO'),
('1101020101', 31, '5424.00', 'ABONO'),
('210401', 32, '165.30', 'CARGO'),
('210402', 32, '428.49', 'CARGO'),
('210403', 32, '350.72', 'CARGO'),
('410709', 32, '267.00', 'CARGO'),
('410710', 32, '291.41', 'CARGO'),
('410609', 32, '146.25', 'CARGO'),
('410610', 32, '166.63', 'CARGO'),
('1101020101', 32, '1815.80', 'ABONO'),
('410611', 33, '960.00', 'CARGO'),
('11010101', 33, '960.00', 'ABONO'),
('410701', 34, '3760.00', 'CARGO'),
('410601', 34, '2150.00', 'CARGO'),
('1101020101', 34, '4965.49', 'ABONO'),
('210401', 34, '165.30', 'ABONO'),
('210402', 34, '428.49', 'ABONO'),
('210403', 34, '350.72', 'ABONO'),
('2105', 35, '21450.00', 'CARGO'),
('1109', 35, '21450.00', 'ABONO'),
('410716', 36, '500.00', 'CARGO'),
('410628', 36, '500.00', 'CARGO'),
('1217', 36, '1000.00', 'ABONO'),
('410715', 37, '520.83', 'CARGO'),
('410616', 37, '520.83', 'CARGO'),
('120503', 37, '1041.66', 'ABONO'),
('410718', 38, '3875.00', 'CARGO'),
('120504', 38, '3875.00', 'ABONO'),
('410715', 39, '275.00', 'CARGO'),
('120503', 39, '275.00', 'ABONO'),
('4101', 40, '7000.00', 'CARGO'),
('1109', 40, '910.00', 'CARGO'),
('11010101', 40, '7910.00', 'ABONO'),
('110501', 41, '9040.00', 'CARGO'),
('5101', 41, '8000.00', 'ABONO'),
('2105', 41, '1040.00', 'ABONO'),
('410722', 42, '13200.00', 'CARGO'),
('410614', 42, '8800.00', 'CARGO'),
('1109', 42, '2860.00', 'CARGO'),
('1101020101', 42, '24860.00', 'ABONO'),
('210101', 43, '2034.00', 'CARGO'),
('5102', 43, '1800.00', 'ABONO'),
('1109', 43, '234.00', 'ABONO'),
('410726', 44, '1470.00', 'CARGO'),
('410619', 44, '980.00', 'CARGO'),
('1109', 44, '195.00', 'CARGO'),
('1101020101', 44, '2645.00', 'ABONO'),
('4105', 45, '990.00', 'CARGO'),
('2105', 45, '128.70', 'CARGO'),
('110501', 45, '1118.70', 'ABONO'),
('210401', 46, '165.30', 'CARGO'),
('210402', 46, '428.49', 'CARGO'),
('210403', 46, '350.72', 'CARGO'),
('410709', 46, '267.00', 'CARGO'),
('410710', 46, '291.41', 'CARGO'),
('410609', 46, '146.25', 'CARGO'),
('410610', 46, '166.63', 'CARGO'),
('1101020101', 46, '1815.80', 'ABONO'),
('410714', 47, '855.00', 'CARGO'),
('410612', 47, '1045.00', 'CARGO'),
('1109', 47, '247.00', 'CARGO'),
('1101020101', 47, '2147.00', 'ABONO'),
('410708', 48, '750.00', 'CARGO'),
('1109', 48, '97.50', 'CARGO'),
('11010101', 48, '847.50', 'ABONO'),
('410701', 49, '3760.00', 'CARGO'),
('410601', 49, '2150.00', 'CARGO'),
('1101020101', 49, '4965.49', 'ABONO'),
('210401', 49, '165.30', 'ABONO'),
('210402', 49, '428.49', 'ABONO'),
('210403', 49, '350.72', 'ABONO'),
('2105', 50, '911.30', 'CARGO'),
('1109', 50, '911.30', 'ABONO'),
('410716', 51, '500.00', 'CARGO'),
('410628', 51, '500.00', 'CARGO'),
('1217', 51, '1000.00', 'ABONO'),
('410715', 52, '520.83', 'CARGO'),
('410616', 52, '520.83', 'CARGO'),
('120503', 52, '1041.66', 'ABONO'),
('410718', 53, '3875.00', 'CARGO'),
('120504', 53, '3875.00', 'ABONO'),
('410715', 54, '275.00', 'CARGO'),
('120503', 54, '275.00', 'ABONO'),
('210101', 55, '23000.00', 'CARGO'),
('1101020101', 55, '23000.00', 'ABONO'),
('410722', 56, '13200.00', 'CARGO'),
('410614', 56, '8800.00', 'CARGO'),
('1109', 56, '2860.00', 'CARGO'),
('1101020101', 56, '24860.00', 'ABONO'),
('4101', 57, '38000.00', 'CARGO'),
('4102', 57, '1500.00', 'CARGO'),
('1109', 57, '5135.00', 'CARGO'),
('1101020101', 57, '44635.00', 'ABONO'),
('210401', 58, '165.30', 'CARGO'),
('210402', 58, '428.49', 'CARGO'),
('210403', 58, '350.72', 'CARGO'),
('410709', 58, '267.00', 'CARGO'),
('410710', 58, '291.41', 'CARGO'),
('410609', 58, '146.25', 'CARGO'),
('410610', 58, '166.63', 'CARGO'),
('1101020101', 58, '1815.80', 'ABONO'),
('410701', 59, '3760.00', 'CARGO'),
('410601', 59, '2150.00', 'CARGO'),
('1101020101', 59, '4965.49', 'ABONO'),
('210401', 59, '165.30', 'ABONO'),
('210402', 59, '428.49', 'ABONO'),
('210403', 59, '350.72', 'ABONO'),
('410716', 60, '500.00', 'CARGO'),
('410628', 60, '500.00', 'CARGO'),
('1217', 60, '1000.00', 'ABONO'),
('410715', 61, '520.83', 'CARGO'),
('410616', 61, '520.83', 'CARGO'),
('120503', 61, '1041.66', 'ABONO'),
('410718', 62, '3875.00', 'CARGO'),
('120504', 62, '3875.00', 'ABONO'),
('410715', 63, '275.00', 'CARGO'),
('120503', 63, '275.00', 'ABONO'),
('410722', 64, '13200.00', 'CARGO'),
('410614', 64, '8800.00', 'CARGO'),
('1109', 64, '2860.00', 'CARGO'),
('1101020101', 64, '24860.00', 'ABONO'),
('410703', 65, '5500.00', 'CARGO'),
('1109', 65, '715.00', 'CARGO'),
('1101020101', 65, '5665.00', 'ABONO'),
('210403', 65, '550.00', 'ABONO'),
('210101', 66, '18000.00', 'CARGO'),
('1101020101', 66, '18000.00', 'ABONO'),
('210401', 67, '165.30', 'CARGO'),
('210402', 67, '428.49', 'CARGO'),
('210403', 67, '350.72', 'CARGO'),
('410709', 67, '267.00', 'CARGO'),
('410710', 67, '291.41', 'CARGO'),
('410609', 67, '146.25', 'CARGO'),
('410610', 67, '166.63', 'CARGO'),
('1101020101', 67, '1815.80', 'ABONO'),
('1101020101', 68, '42940.00', 'CARGO'),
('5101', 68, '38000.00', 'ABONO'),
('2105', 68, '4940.00', 'ABONO'),
('410701', 69, '3760.00', 'CARGO'),
('410601', 69, '2150.00', 'CARGO'),
('1101020101', 69, '4965.49', 'ABONO'),
('210401', 69, '165.30', 'ABONO'),
('210402', 69, '428.49', 'ABONO'),
('210403', 69, '350.72', 'ABONO'),
('2105', 70, '4940.00', 'CARGO'),
('1109', 70, '4940.00', 'ABONO'),
('410716', 71, '500.00', 'CARGO'),
('410628', 71, '500.00', 'CARGO'),
('1217', 71, '1000.00', 'ABONO'),
('410715', 72, '520.83', 'CARGO'),
('410616', 72, '520.83', 'CARGO'),
('120503', 72, '1041.66', 'ABONO'),
('410718', 73, '3875.00', 'CARGO'),
('120504', 73, '3875.00', 'ABONO'),
('410715', 74, '275.00', 'CARGO'),
('120503', 74, '275.00', 'ABONO'),
('210403', 75, '550.00', 'CARGO'),
('1101020101', 75, '550.00', 'ABONO'),
('410621', 76, '3000.00', 'CARGO'),
('1109', 76, '390.00', 'CARGO'),
('1101020101', 76, '3390.00', 'ABONO'),
('410716', 77, '80.00', 'CARGO'),
('1109', 77, '10.40', 'CARGO'),
('1101020101', 77, '90.40', 'ABONO'),
('410722', 78, '13200.00', 'CARGO'),
('410614', 78, '8800.00', 'CARGO'),
('1109', 78, '2860.00', 'CARGO'),
('1101020101', 78, '24860.00', 'ABONO'),
('210401', 79, '165.30', 'CARGO'),
('210402', 79, '428.49', 'CARGO'),
('210403', 79, '350.72', 'CARGO'),
('410709', 79, '267.00', 'CARGO'),
('410710', 79, '291.41', 'CARGO'),
('410609', 79, '146.25', 'CARGO'),
('410610', 79, '166.63', 'CARGO'),
('1101020101', 79, '1815.80', 'ABONO'),
('410701', 80, '3760.00', 'CARGO'),
('410601', 80, '2150.00', 'CARGO'),
('1101020101', 80, '4965.49', 'ABONO'),
('210401', 80, '165.30', 'ABONO'),
('210402', 80, '428.49', 'ABONO'),
('210403', 80, '350.72', 'ABONO'),
('410716', 81, '500.00', 'CARGO'),
('410628', 81, '500.00', 'CARGO'),
('1217', 81, '1000.00', 'ABONO'),
('410715', 82, '520.83', 'CARGO'),
('410616', 82, '520.83', 'CARGO'),
('120503', 82, '1041.66', 'ABONO'),
('410718', 83, '3875.00', 'CARGO'),
('120504', 83, '3875.00', 'ABONO'),
('410715', 84, '275.00', 'CARGO'),
('120503', 84, '275.00', 'ABONO'),
('1101020101', 85, '282500.00', 'CARGO'),
('5101', 85, '250000.00', 'ABONO'),
('2105', 85, '32500.00', 'ABONO'),
('410726', 86, '1050.00', 'CARGO'),
('410619', 86, '1050.00', 'CARGO'),
('1109', 86, '156.00', 'CARGO'),
('1101020101', 86, '2256.00', 'ABONO'),
('410714', 87, '750.00', 'CARGO'),
('410612', 87, '500.00', 'CARGO'),
('1109', 87, '162.50', 'CARGO'),
('1101020101', 87, '1412.50', 'ABONO'),
('410722', 88, '13200.00', 'CARGO'),
('410614', 88, '8800.00', 'CARGO'),
('1109', 88, '2860.00', 'CARGO'),
('1101020101', 88, '24860.00', 'ABONO'),
('210401', 89, '165.30', 'CARGO'),
('210402', 89, '428.49', 'CARGO'),
('210403', 89, '350.72', 'CARGO'),
('410709', 89, '267.00', 'CARGO'),
('410710', 89, '291.41', 'CARGO'),
('410609', 89, '146.25', 'CARGO'),
('410610', 89, '166.63', 'CARGO'),
('1101020101', 89, '1815.80', 'ABONO'),
('410701', 90, '3760.00', 'CARGO'),
('410601', 90, '2150.00', 'CARGO'),
('1101020101', 90, '4965.49', 'ABONO'),
('210401', 90, '165.30', 'ABONO'),
('210402', 90, '428.49', 'ABONO'),
('210403', 90, '350.72', 'ABONO'),
('2105', 91, '32500.00', 'CARGO'),
('1109', 91, '32500.00', 'ABONO'),
('410716', 92, '500.00', 'CARGO'),
('410628', 92, '500.00', 'CARGO'),
('1217', 92, '1000.00', 'ABONO'),
('410715', 93, '520.83', 'CARGO'),
('410616', 93, '520.83', 'CARGO'),
('120503', 93, '1041.66', 'ABONO'),
('410718', 94, '3875.00', 'CARGO'),
('120504', 94, '3875.00', 'ABONO'),
('410715', 95, '275.00', 'CARGO'),
('120503', 95, '275.00', 'ABONO'),
('410722', 96, '13200.00', 'CARGO'),
('410614', 96, '8800.00', 'CARGO'),
('1109', 96, '2860.00', 'CARGO'),
('1101020101', 96, '24860.00', 'ABONO'),
('410716', 97, '1950.00', 'CARGO'),
('1109', 97, '253.50', 'CARGO'),
('1101020101', 97, '2203.50', 'ABONO'),
('4101', 98, '255000.00', 'CARGO'),
('1109', 98, '33150.00', 'CARGO'),
('210101', 98, '288150.00', 'ABONO'),
('410709', 99, '267.00', 'CARGO'),
('410710', 99, '291.41', 'CARGO'),
('410609', 99, '146.25', 'CARGO'),
('410610', 99, '166.63', 'CARGO'),
('1101020101', 99, '1815.80', 'ABONO'),
('210401', 99, '165.30', 'CARGO'),
('210402', 99, '428.49', 'CARGO'),
('210403', 99, '350.72', 'CARGO'),
('410701', 100, '3760.00', 'CARGO'),
('410601', 100, '2150.00', 'CARGO'),
('1101020101', 100, '4965.49', 'ABONO'),
('210401', 100, '165.30', 'ABONO'),
('210402', 100, '428.49', 'ABONO'),
('210403', 100, '350.72', 'ABONO'),
('410716', 101, '500.00', 'CARGO'),
('410628', 101, '500.00', 'CARGO'),
('1217', 101, '1000.00', 'ABONO'),
('410715', 102, '520.83', 'CARGO'),
('410616', 102, '520.83', 'CARGO'),
('120503', 102, '1041.66', 'ABONO'),
('410718', 103, '3875.00', 'CARGO'),
('120504', 103, '3875.00', 'ABONO'),
('410715', 104, '275.00', 'CARGO'),
('120503', 104, '275.00', 'ABONO'),
('410722', 105, '13200.00', 'CARGO'),
('410614', 105, '8800.00', 'CARGO'),
('1109', 105, '2860.00', 'CARGO'),
('1101020101', 105, '24860.00', 'ABONO'),
('410611', 106, '925.00', 'CARGO'),
('410620', 106, '775.00', 'CARGO'),
('1101020101', 106, '9035.00', 'CARGO'),
('5101', 106, '9500.00', 'ABONO'),
('2105', 106, '1235.00', 'ABONO'),
('210401', 107, '165.30', 'CARGO'),
('210402', 107, '428.49', 'CARGO'),
('210403', 107, '350.72', 'CARGO'),
('410709', 107, '267.00', 'CARGO'),
('410710', 107, '291.41', 'CARGO'),
('410609', 107, '146.25', 'CARGO'),
('410610', 107, '166.63', 'CARGO'),
('1101020101', 107, '1815.80', 'ABONO'),
('2105', 108, '1235.00', 'CARGO'),
('1109', 108, '1235.00', 'ABONO'),
('410701', 109, '3760.00', 'CARGO'),
('410601', 109, '2150.00', 'CARGO'),
('1101020101', 109, '4965.49', 'ABONO'),
('210401', 109, '165.30', 'ABONO'),
('210402', 109, '428.49', 'ABONO'),
('210403', 109, '350.72', 'ABONO'),
('410716', 110, '500.00', 'CARGO'),
('410628', 110, '500.00', 'CARGO'),
('1217', 110, '1000.00', 'ABONO'),
('410715', 111, '520.83', 'CARGO'),
('410616', 111, '520.83', 'CARGO'),
('120503', 111, '1041.66', 'ABONO'),
('410718', 112, '3875.00', 'CARGO'),
('120504', 112, '3875.00', 'ABONO'),
('410715', 113, '275.00', 'CARGO'),
('120503', 113, '275.00', 'ABONO'),
('410722', 114, '13200.00', 'CARGO'),
('410614', 114, '8800.00', 'CARGO'),
('1109', 114, '2860.00', 'CARGO'),
('1101020101', 114, '24860.00', 'ABONO'),
('210401', 115, '165.30', 'CARGO'),
('210402', 115, '428.49', 'CARGO'),
('210403', 115, '350.72', 'CARGO'),
('410709', 115, '267.00', 'CARGO'),
('410710', 115, '291.41', 'CARGO'),
('410609', 115, '146.25', 'CARGO'),
('410610', 115, '166.63', 'CARGO'),
('1101020101', 115, '1815.80', 'ABONO'),
('4101', 116, '12000.00', 'CARGO'),
('1109', 116, '1560.00', 'CARGO'),
('210101', 116, '5424.00', 'ABONO'),
('1101020101', 116, '8136.00', 'ABONO'),
('1101020101', 117, '223740.00', 'CARGO'),
('5101', 117, '198000.00', 'ABONO'),
('2105', 117, '25740.00', 'ABONO'),
('1101020101', 118, '450644.00', 'CARGO'),
('5101', 118, '398800.00', 'ABONO'),
('2105', 118, '51844.00', 'ABONO'),
('410701', 119, '3760.00', 'CARGO'),
('410601', 119, '2150.00', 'CARGO'),
('1101020101', 119, '4965.49', 'ABONO'),
('210401', 119, '165.30', 'ABONO'),
('210402', 119, '428.49', 'ABONO'),
('210403', 119, '350.72', 'ABONO'),
('2105', 120, '77584.00', 'CARGO'),
('1109', 120, '73920.60', 'ABONO'),
('2108', 120, '3663.40', 'ABONO'),
('410716', 121, '500.00', 'CARGO'),
('410628', 121, '500.00', 'CARGO'),
('1217', 121, '1000.00', 'ABONO'),
('410715', 122, '520.83', 'CARGO'),
('410616', 122, '520.83', 'CARGO'),
('120503', 122, '1041.66', 'ABONO'),
('410718', 123, '3875.00', 'CARGO'),
('120504', 123, '3875.00', 'ABONO'),
('410715', 124, '275.00', 'CARGO'),
('120503', 124, '275.00', 'ABONO'),
('2108', 125, '3663.40', 'CARGO'),
('1101020101', 125, '3663.40', 'ABONO'),
('410722', 126, '13200.00', 'CARGO'),
('410614', 126, '8800.00', 'CARGO'),
('1109', 126, '2860.00', 'CARGO'),
('1101020101', 126, '24860.00', 'ABONO'),
('210101', 127, '250000.00', 'CARGO'),
('1101020101', 127, '250000.00', 'ABONO'),
('1101020101', 128, '450418.00', 'CARGO'),
('5101', 128, '398600.00', 'ABONO'),
('2105', 128, '51818.00', 'ABONO'),
('210401', 129, '165.30', 'CARGO'),
('210402', 129, '428.49', 'CARGO'),
('210403', 129, '350.72', 'CARGO'),
('410709', 129, '267.00', 'CARGO'),
('410710', 129, '291.41', 'CARGO'),
('410609', 129, '146.25', 'CARGO'),
('410610', 129, '166.63', 'CARGO'),
('1101020101', 129, '1815.80', 'ABONO'),
('410701', 130, '3760.00', 'CARGO'),
('410601', 130, '2150.00', 'CARGO'),
('1101020101', 130, '4965.49', 'ABONO'),
('210401', 130, '165.30', 'ABONO'),
('210402', 130, '428.49', 'ABONO'),
('210403', 130, '350.72', 'ABONO'),
('2105', 131, '51818.00', 'CARGO'),
('1109', 131, '2860.00', 'ABONO'),
('2108', 131, '48958.00', 'ABONO'),
('410716', 132, '500.00', 'CARGO'),
('410628', 132, '500.00', 'CARGO'),
('1217', 132, '1000.00', 'ABONO'),
('410715', 133, '520.83', 'CARGO'),
('410616', 133, '520.83', 'CARGO'),
('120503', 133, '1041.66', 'ABONO'),
('410718', 134, '3875.00', 'CARGO'),
('120504', 134, '3875.00', 'ABONO'),
('410715', 135, '275.00', 'CARGO'),
('120503', 135, '275.00', 'ABONO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `idpartida` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `cierre` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`idpartida`, `fecha`, `descripcion`, `cierre`, `estado`) VALUES
(1, '2020-01-01', 'INICIO DE OPERACIONES ', 0, 1),
(2, '2020-01-03', 'PAGO DE ABOGADOS ', 0, 1),
(3, '2020-01-03', 'PAGO DE ALQUILER DE OFICINA  ', 0, 1),
(4, '2020-01-04', 'COMPRA DE MERCADERIA ', 0, 1),
(5, '2020-01-04', 'COMPRA DE PAPELERIA Y UTILES ', 0, 1),
(6, '2020-01-22', 'COMPRA DE 30 SILLAS ', 0, 1),
(7, '2020-01-22', 'COMPRA DE 4 ESCRITORIOS ', 0, 1),
(8, '2020-01-24', 'VENTA DE MERCADERIA ', 0, 1),
(9, '2020-01-24', 'APERTURA DE CAJA CHICA ', 0, 1),
(10, '2020-01-31', 'PAGO DE SALARIOS Y PROVISIONES ', 0, 1),
(11, '2020-01-31', 'LIQUIDACION DE IVA  ', 0, 1),
(12, '2020-01-31', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(13, '2020-01-31', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(14, '2020-01-31', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(15, '2020-02-05', 'PAGO DE IMPUESTO IVA ', 0, 1),
(16, '2020-02-05', 'PAGO DE RETENCIONES POR HONORARIOS ', 0, 1),
(17, '2020-02-06', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(18, '2020-02-06', 'VENTA DE MERCADERIA AL CREDITO ', 0, 1),
(19, '2020-02-10', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(20, '2020-02-27', 'DEVOLUCION DE MERCADERIA  ', 0, 1),
(21, '2020-02-27', 'PAGO DE SALARIOS Y PROVISIONES ', 0, 1),
(22, '2020-02-27', 'COMPRAMOS MERCADERIA AL CREDITO ', 0, 1),
(23, '2020-02-27', 'LIQUIDACION DE IVA  ', 0, 1),
(24, '2020-02-28', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(25, '2020-02-28', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(26, '2020-02-28', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(27, '2020-02-28', 'DEPRECIACION DE SILLAS Y ESCRITORIO  ', 0, 1),
(28, '2020-03-05', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(29, '2020-03-05', 'VENTA DE MERCADERIA 70% CON CHEQUE Y 30% AL CONTADO ', 0, 1),
(30, '2020-03-07', 'DEVOLVEMOS MERCADERIA A LOS PROVEEDORES ', 0, 1),
(31, '2020-03-22', 'PAGO DE ESCRITORIOS CON PLAZO DE 60 DÃAS  ', 0, 1),
(32, '2020-03-24', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(33, '2020-03-24', 'PAGO DE VIATICOS ', 0, 1),
(34, '2020-03-30', 'PAGO DE SALARIOS Y PROVISIÃ“N ', 0, 1),
(35, '2020-03-30', 'LIQUIDACION DE IVA  ', 0, 1),
(36, '2020-03-30', 'AMOTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(37, '2020-03-30', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(38, '2020-03-30', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(39, '2020-03-30', 'DEPRECIACION DE SILLAS Y ESCRITORIOS  ', 0, 1),
(40, '2020-04-03', 'COMPRA DE MERCADERIA AL CONTADO ', 0, 1),
(41, '2020-04-07', 'VENTA DE MERCADERIA AL CREDITO ', 0, 1),
(42, '2020-04-03', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(43, '2020-04-03', 'DEVOLVEMOS MERCADERIA A LOS PROVEEDORES ', 0, 1),
(44, '2020-04-17', 'PAGO DE RECIBOS DE AGUA Y LUZ ', 0, 1),
(45, '2020-04-17', 'HACEMOS UNA REBAJA SOBRE LA VENTA ', 0, 1),
(46, '2020-04-24', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(47, '2020-04-24', 'PAGO DE TELEFONO ', 0, 1),
(48, '2020-04-29', 'PAGO DE CAPACITACIONES ', 0, 1),
(49, '2020-04-30', 'PAGO DE SALARIOS Y PROVISION ', 0, 1),
(50, '2020-04-30', 'LIQUIDACION DE IVA  ', 0, 1),
(51, '2020-04-30', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(52, '2020-04-30', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(53, '2020-04-30', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(54, '2020-04-30', 'DEPRECIACION DE SILLAS Y ESCRITORIOS  ', 0, 1),
(55, '2020-05-06', 'PAGAMOS CUENTAS A LOS PROVEEDORES ', 0, 1),
(56, '2020-05-06', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(57, '2020-05-06', 'COMPRA DE MERCADERIA Y PAGO DE ENVIO ', 0, 1),
(58, '2020-05-23', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(59, '2020-05-31', 'PAGO DE SALARIOS Y PROVISION  ', 0, 1),
(60, '2020-05-31', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(61, '2020-05-31', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(62, '2020-05-31', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(63, '2020-05-31', 'DEPRECIACION DE SILLAS Y ESCRITORIO  ', 0, 1),
(64, '2020-06-07', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(65, '2020-06-07', 'PAGO AL AUDITOR ', 0, 1),
(66, '2020-06-21', 'PAGO A LOS PROVEEDORES ', 0, 1),
(67, '2020-06-28', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(68, '2020-06-28', 'REALIZAMOS UNA VENTA ', 0, 1),
(69, '2020-06-30', 'PAGO DE SALARIOS Y PROVISIONES ', 0, 1),
(70, '2020-06-30', 'LIQUIDACION DE IVA ', 0, 1),
(71, '2020-06-30', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(72, '2020-06-30', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(73, '2020-06-30', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(74, '2020-06-30', 'DEPRECIACION DE SILLAS Y ESCRITORIOS  ', 0, 1),
(75, '2020-07-05', 'PAGO DE RETENCIONES DEL AUDITOR ', 0, 1),
(76, '2020-07-05', 'MANTENIMIENTO DE VEHICULO ', 0, 1),
(77, '2020-07-05', 'COMPRA DE CHEQUERA ', 0, 1),
(78, '2020-07-09', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(79, '2020-07-28', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(80, '2020-07-31', 'PAGO DE SALARIOS Y PROVISION ', 0, 1),
(81, '2020-07-31', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(82, '2020-07-31', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(83, '2020-07-31', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(84, '2020-07-31', 'DEPRECIACION DE SILLAS Y ESCRITORIO  ', 0, 1),
(85, '2020-08-08', 'VENTA DE MERCADERIA AL CONTADO ', 0, 1),
(86, '2020-08-08', 'PAGO DE RECIBOS DE AGUA Y LUZ ', 0, 1),
(87, '2020-08-15', 'PAGO DE TELEFONO  ', 0, 1),
(88, '2020-08-17', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(89, '2020-08-28', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(90, '2020-08-30', 'PAGO DE SALARIOS Y PROVISION ', 0, 1),
(91, '2020-08-30', 'LIQUIDACION DE IVA  ', 0, 1),
(92, '2020-08-30', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(93, '2020-08-30', 'DEPRECIACION DE COMPUTADORAS ', 0, 1),
(94, '2020-08-30', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(95, '2020-08-30', 'DEPRECIACION DE SILLAS Y ESCRITORIOS  ', 0, 1),
(96, '2020-09-06', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(97, '2020-09-10', 'COMPRA DE PAPELERIA Y UTILES ', 0, 1),
(98, '2020-09-10', 'COMPRA DE MERCADERIA ', 0, 1),
(99, '2020-09-26', 'PAGO DE CUOTA Y RETENCIONES ', 0, 1),
(100, '2020-09-30', 'PAGO DE SALARIOS Y PROVISIONES ', 0, 1),
(101, '2020-09-30', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(102, '2020-09-30', 'DEPRECIACION DE COMPUTADORA ', 0, 1),
(103, '2020-09-30', 'DEPRECIACION DE VEHICULO ', 0, 1),
(104, '2020-09-30', 'DEPRECIACION DE SILLAS Y ESCRITORIOS ', 0, 1),
(105, '2020-10-02', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(106, '2020-10-02', 'VENTA DE MERCADERIA AL CONTADO ', 0, 1),
(107, '2020-10-24', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(108, '2020-10-30', 'LIQUIDACION DE IVA  ', 0, 1),
(109, '2020-10-30', 'PAGO DE SALARIOS Y PROVISION ', 0, 1),
(110, '2020-10-30', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(111, '2020-10-30', 'DEPRECIACION DE COMPUTADORA  ', 0, 1),
(112, '2020-10-30', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(113, '2020-10-30', 'DEPRECIACION DE SILLAS Y ESCRITORIO ', 0, 1),
(114, '2020-11-07', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(115, '2020-11-07', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(116, '2020-11-07', 'COMPRA DE MERCADERIA ', 0, 1),
(117, '2020-11-24', 'VENTA DE MERCADERIA ', 0, 1),
(118, '2020-11-27', 'VENTA DE MERCADERIA  ', 0, 1),
(119, '2020-11-29', 'PAGO DE SALARIOS Y PROVISIONES ', 0, 1),
(120, '2020-11-29', 'LIQUIDACION DE IVA  ', 0, 1),
(121, '2020-11-29', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(122, '2020-11-29', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(123, '2020-11-29', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(124, '2020-11-29', 'DEPRECIACION DE SILLAS Y ESCRITORIOS  ', 0, 1),
(125, '2020-12-05', 'PAGO DE IVA ', 0, 1),
(126, '2020-12-05', 'PAGO DE ALQUILER DE OFICINA ', 0, 1),
(127, '2020-12-05', 'PAGO A LOS PROVEEDORES ', 0, 1),
(128, '2020-12-10', 'VENTA AL CONTADO ', 0, 1),
(129, '2020-12-10', 'PAGO DE RETENCIONES Y CUOTA PATRONAL ', 0, 1),
(130, '2020-12-19', 'PAGO DE SALARIOS Y PROVISIONES ', 0, 1),
(131, '2020-12-19', 'LIQUIDACION DE IVA  ', 0, 1),
(132, '2020-12-19', 'AMORTIZACION DE PAPELERIA Y UTILES  ', 0, 1),
(133, '2020-12-19', 'DEPRECIACION DE COMPUTADORAS  ', 0, 1),
(134, '2020-12-19', 'DEPRECIACION DE VEHICULO  ', 0, 1),
(135, '2020-12-19', 'DEPRECIACION DE SILLAS Y ESCRITORIOS  ', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldo`
--

CREATE TABLE `saldo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `saldo`
--

INSERT INTO `saldo` (`id`, `nombre`) VALUES
(1, 'DEUDOR'),
(2, 'ACREEDOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`) VALUES
(1, 'ACTIVO'),
(2, 'PASIVO'),
(3, 'CAPITAL'),
(4, 'GASTOS'),
(5, 'INGRESOS'),
(6, 'LIQUIDARA'),
(7, 'ORDEN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario`, `clave`) VALUES
(6, 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `detallediario`
--
ALTER TABLE `detallediario`
  ADD KEY `codigo` (`codigo`),
  ADD KEY `idpartida` (`idpartida`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`idpartida`);

--
-- Indices de la tabla `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `idpartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallediario`
--
ALTER TABLE `detallediario`
  ADD CONSTRAINT `detallediario_ibfk_1` FOREIGN KEY (`codigo`) REFERENCES `catalogo` (`codigo`),
  ADD CONSTRAINT `detallediario_ibfk_2` FOREIGN KEY (`idpartida`) REFERENCES `partida` (`idpartida`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
