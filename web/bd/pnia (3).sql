-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2016 a las 14:45:27
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pnia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id_pefil` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `accesos`:
--   `id_pefil`
--       `perfil` -> `id`
--   `id_menu`
--       `menus` -> `id`
--

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`id_pefil`, `id_menu`, `estado`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 2, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_transversal`
--

CREATE TABLE `accion_transversal` (
  `id_proyecto` int(11) NOT NULL,
  `id_accion_transversal` int(11) DEFAULT NULL,
  `otros` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `accion_transversal`:
--   `id_proyecto`
--       `proyecto` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id` int(11) NOT NULL,
  `id_oe` int(11) NOT NULL,
  `descripcion` varchar(3000) DEFAULT NULL,
  `indicadores` varchar(500) DEFAULT NULL,
  `medios` varchar(500) DEFAULT NULL,
  `supuestos` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `actividad`:
--   `id_oe`
--       `objetivo_especifico` -> `id`
--

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `id_oe`, `descripcion`, `indicadores`, `medios`, `supuestos`) VALUES
(1, 1, 'actividad 1', NULL, NULL, NULL),
(2, 1, 'actividad 2', NULL, NULL, NULL),
(3, 1, 'actividad 3', NULL, NULL, NULL),
(4, 1, 'actividad 4', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alianza_estrategica`
--

CREATE TABLE `alianza_estrategica` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `institucion` varchar(200) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `alianza_estrategica`:
--   `id_proyecto`
--       `proyecto` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_spanish2_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `auth_assignment`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_spanish2_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish2_ci,
  `rule_name` varchar(64) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `data` text COLLATE utf8_spanish2_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `auth_item`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_spanish2_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `auth_item_child`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_spanish2_ci NOT NULL,
  `data` text COLLATE utf8_spanish2_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `auth_rule`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `id_proyecto` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) DEFAULT NULL,
  `funcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `colaborador`:
--   `id_proyecto`
--       `proyecto` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronograma`
--

CREATE TABLE `cronograma` (
  `id_actividad` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `cronograma`:
--   `id_actividad`
--       `actividad` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cultivo_crianza`
--

CREATE TABLE `cultivo_crianza` (
  `id_proyecto` int(11) NOT NULL,
  `id_cultivo_crianza` int(11) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `cultivo_crianza`:
--   `id_proyecto`
--       `proyecto` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_investigacion`
--

CREATE TABLE `lugar_investigacion` (
  `id_proyecto` int(11) NOT NULL,
  `ubigeo` varchar(6) NOT NULL,
  `zona` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `lugar_investigacion`:
--   `id_proyecto`
--       `proyecto` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `id_padre` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `ruta` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `visible` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `menus`:
--   `id_modulo`
--       `modulo` -> `id`
--

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `id_padre`, `id_modulo`, `descripcion`, `ruta`, `visible`, `estado`) VALUES
(1, 0, 1, 'Registrar Proyecto', 'proyecto/index', 1, 1),
(2, 0, 1, 'Nuevo Proyecto', 'proyecto/nuevo', 1, 1),
(3, 0, 1, 'Guardar Proyecto', 'proyecto/guardar', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `migration`:
--

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1458574981);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `modulo`:
--

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id`, `descripcion`, `estado`) VALUES
(1, 'PROYECTOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivo_especifico`
--

CREATE TABLE `objetivo_especifico` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `indicadores` varchar(500) DEFAULT NULL,
  `medios` varchar(500) DEFAULT NULL,
  `supuestos` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `objetivo_especifico`:
--   `id_proyecto`
--       `proyecto` -> `id`
--

--
-- Volcado de datos para la tabla `objetivo_especifico`
--

INSERT INTO `objetivo_especifico` (`id`, `id_proyecto`, `descripcion`, `indicadores`, `medios`, `supuestos`) VALUES
(1, 2, 'objetivo 1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `perfil`:
--

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Investigador', 1),
(3, 'Jefe Estación', 1),
(4, 'PNIA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `titulo` varchar(500) DEFAULT NULL,
  `direccion_linea` varchar(200) DEFAULT NULL,
  `estacion_exp` varchar(200) DEFAULT NULL,
  `sub_estacion_exp` varchar(200) DEFAULT NULL,
  `id_tipo_proyecto` int(11) DEFAULT NULL,
  `desc_tipo_proy` varchar(200) DEFAULT NULL,
  `resumen_ejecutivo` varchar(9000) DEFAULT NULL,
  `relevancia` varchar(9000) DEFAULT NULL,
  `objetivo_general` varchar(4000) DEFAULT NULL,
  `plan_trabajo` varchar(8000) DEFAULT NULL,
  `resultados_esperados` varchar(8000) DEFAULT NULL,
  `presupuesto` decimal(16,2) DEFAULT NULL,
  `referencias_bibliograficas` varchar(10000) DEFAULT NULL,
  `problematica` varchar(5000) DEFAULT NULL,
  `ind_prob` varchar(500) DEFAULT NULL,
  `med_prob` varchar(500) DEFAULT NULL,
  `sup_prob` varchar(500) DEFAULT NULL,
  `proposito` varchar(5000) DEFAULT NULL,
  `ind_prop` varchar(500) DEFAULT NULL,
  `med_prop` varchar(500) DEFAULT NULL,
  `sup_prop` varchar(500) DEFAULT NULL,
  `user_propietario` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `proyecto`:
--   `user_propietario`
--       `usuarios` -> `id`
--

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `titulo`, `direccion_linea`, `estacion_exp`, `sub_estacion_exp`, `id_tipo_proyecto`, `desc_tipo_proy`, `resumen_ejecutivo`, `relevancia`, `objetivo_general`, `plan_trabajo`, `resultados_esperados`, `presupuesto`, `referencias_bibliograficas`, `problematica`, `ind_prob`, `med_prob`, `sup_prob`, `proposito`, `ind_prop`, `med_prop`, `sup_prop`, `user_propietario`, `estado`) VALUES
(1, 'proyecto 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'proyecto 2', 'linea1', 'estacion1', 'subestacion1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id_proyecto` int(11) NOT NULL,
  `nro_recurso` int(11) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `recursos`:
--   `id_proyecto`
--       `proyecto` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE `responsable` (
  `id_proyecto` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `responsable`:
--   `id_proyecto`
--       `proyecto` -> `id`
--

--
-- Volcado de datos para la tabla `responsable`
--

INSERT INTO `responsable` (`id_proyecto`, `nombres`, `apellidos`, `telefono`, `celular`, `correo`) VALUES
(2, 'Luis', 'Huapaya Rivera', '2542585', '92585', 'luis@correo.pe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo`
--

CREATE TABLE `ubigeo` (
  `id` int(11) NOT NULL,
  `department_id` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `province_id` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `district_id` varchar(6) CHARACTER SET utf8 NOT NULL,
  `pais` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `department` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `province` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `district` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `pais_id` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `district_id_standart` char(6) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- RELACIONES PARA LA TABLA `ubigeo`:
--

--
-- Volcado de datos para la tabla `ubigeo`
--

INSERT INTO `ubigeo` (`id`, `department_id`, `province_id`, `district_id`, `pais`, `department`, `province`, `district`, `pais_id`, `latitude`, `longitud`, `district_id_standart`) VALUES
(1, '01', '0101', '010101', '', 'AMAZONAS', 'CHACHAPOYAS', 'CHACHAPOYAS', '', 0, 0, ''),
(2, '01', '0101', '010102', '', 'AMAZONAS', 'CHACHAPOYAS', 'ASUNCION', '', 0, 0, ''),
(3, '01', '0101', '010103', '', 'AMAZONAS', 'CHACHAPOYAS', 'BALSAS', '', 0, 0, ''),
(4, '01', '0101', '010104', '', 'AMAZONAS', 'CHACHAPOYAS', 'CHETO', '', 0, 0, ''),
(5, '01', '0101', '010105', '', 'AMAZONAS', 'CHACHAPOYAS', 'CHILIQUIN', '', 0, 0, ''),
(6, '01', '0101', '010106', '', 'AMAZONAS', 'CHACHAPOYAS', 'CHUQUIBAMBA', '', 0, 0, ''),
(7, '01', '0101', '010107', '', 'AMAZONAS', 'CHACHAPOYAS', 'GRANADA', '', 0, 0, ''),
(8, '01', '0101', '010108', '', 'AMAZONAS', 'CHACHAPOYAS', 'HUANCAS', '', 0, 0, ''),
(9, '01', '0101', '010109', '', 'AMAZONAS', 'CHACHAPOYAS', 'LA JALCA', '', 0, 0, ''),
(10, '01', '0101', '010110', '', 'AMAZONAS', 'CHACHAPOYAS', 'LEIMEBAMBA', '', 0, 0, ''),
(11, '01', '0101', '010111', '', 'AMAZONAS', 'CHACHAPOYAS', 'LEVANTO', '', 0, 0, ''),
(12, '01', '0101', '010112', '', 'AMAZONAS', 'CHACHAPOYAS', 'MAGDALENA', '', 0, 0, ''),
(13, '01', '0101', '010113', '', 'AMAZONAS', 'CHACHAPOYAS', 'MARISCAL CASTILLA', '', 0, 0, ''),
(14, '01', '0101', '010114', '', 'AMAZONAS', 'CHACHAPOYAS', 'MOLINOPAMPA', '', 0, 0, ''),
(15, '01', '0101', '010115', '', 'AMAZONAS', 'CHACHAPOYAS', 'MONTEVIDEO', '', 0, 0, ''),
(16, '01', '0101', '010116', '', 'AMAZONAS', 'CHACHAPOYAS', 'OLLEROS', '', 0, 0, ''),
(17, '01', '0101', '010117', '', 'AMAZONAS', 'CHACHAPOYAS', 'QUINJALCA', '', 0, 0, ''),
(18, '01', '0101', '010118', '', 'AMAZONAS', 'CHACHAPOYAS', 'SAN FRANCISCO DE DAGUAS', '', 0, 0, ''),
(19, '01', '0101', '010119', '', 'AMAZONAS', 'CHACHAPOYAS', 'SAN ISIDRO DE MAINO', '', 0, 0, ''),
(20, '01', '0101', '010120', '', 'AMAZONAS', 'CHACHAPOYAS', 'SOLOCO', '', 0, 0, ''),
(21, '01', '0101', '010121', '', 'AMAZONAS', 'CHACHAPOYAS', 'SONCHE', '', 0, 0, ''),
(22, '01', '0102', '010201', '', 'AMAZONAS', 'BAGUA', 'LA PECA', '', 0, 0, ''),
(23, '01', '0102', '010202', '', 'AMAZONAS', 'BAGUA', 'ARAMANGO', '', 0, 0, ''),
(24, '01', '0102', '010203', '', 'AMAZONAS', 'BAGUA', 'COPALLIN', '', 0, 0, ''),
(25, '01', '0102', '010204', '', 'AMAZONAS', 'BAGUA', 'EL PARCO', '', 0, 0, ''),
(26, '01', '0102', '010205', '', 'AMAZONAS', 'BAGUA', 'BAGUA', '', 0, 0, ''),
(27, '01', '0102', '010206', '', 'AMAZONAS', 'BAGUA', 'IMAZA', '', 0, 0, ''),
(28, '01', '0103', '010301', '', 'AMAZONAS', 'BONGARA', 'JUMBILLA', '', 0, 0, ''),
(29, '01', '0103', '010302', '', 'AMAZONAS', 'BONGARA', 'COROSHA', '', 0, 0, ''),
(30, '01', '0103', '010303', '', 'AMAZONAS', 'BONGARA', 'CUISPES', '', 0, 0, ''),
(31, '01', '0103', '010304', '', 'AMAZONAS', 'BONGARA', 'CHISQUILLA', '', 0, 0, ''),
(32, '01', '0103', '010305', '', 'AMAZONAS', 'BONGARA', 'CHURUJA', '', 0, 0, ''),
(33, '01', '0103', '010306', '', 'AMAZONAS', 'BONGARA', 'FLORIDA', '', 0, 0, ''),
(34, '01', '0103', '010307', '', 'AMAZONAS', 'BONGARA', 'RECTA', '', 0, 0, ''),
(35, '01', '0103', '010308', '', 'AMAZONAS', 'BONGARA', 'SAN CARLOS', '', 0, 0, ''),
(36, '01', '0103', '010309', '', 'AMAZONAS', 'BONGARA', 'SHIPASBAMBA', '', 0, 0, ''),
(37, '01', '0103', '010310', '', 'AMAZONAS', 'BONGARA', 'VALERA', '', 0, 0, ''),
(38, '01', '0103', '010311', '', 'AMAZONAS', 'BONGARA', 'YAMBRASBAMBA', '', 0, 0, ''),
(39, '01', '0103', '010312', '', 'AMAZONAS', 'BONGARA', 'JAZAN', '', 0, 0, ''),
(40, '01', '0104', '010401', '', 'AMAZONAS', 'LUYA', 'LAMUD', '', 0, 0, ''),
(41, '01', '0104', '010402', '', 'AMAZONAS', 'LUYA', 'CAMPORREDONDO', '', 0, 0, ''),
(42, '01', '0104', '010403', '', 'AMAZONAS', 'LUYA', 'COCABAMBA', '', 0, 0, ''),
(43, '01', '0104', '010404', '', 'AMAZONAS', 'LUYA', 'COLCAMAR', '', 0, 0, ''),
(44, '01', '0104', '010405', '', 'AMAZONAS', 'LUYA', 'CONILA', '', 0, 0, ''),
(45, '01', '0104', '010406', '', 'AMAZONAS', 'LUYA', 'INGUILPATA', '', 0, 0, ''),
(46, '01', '0104', '010407', '', 'AMAZONAS', 'LUYA', 'LONGUITA', '', 0, 0, ''),
(47, '01', '0104', '010408', '', 'AMAZONAS', 'LUYA', 'LONYA CHICO', '', 0, 0, ''),
(48, '01', '0104', '010409', '', 'AMAZONAS', 'LUYA', 'LUYA', '', 0, 0, ''),
(49, '01', '0104', '010410', '', 'AMAZONAS', 'LUYA', 'LUYA VIEJO', '', 0, 0, ''),
(50, '01', '0104', '010411', '', 'AMAZONAS', 'LUYA', 'MARIA', '', 0, 0, ''),
(51, '01', '0104', '010412', '', 'AMAZONAS', 'LUYA', 'OCALLI', '', 0, 0, ''),
(52, '01', '0104', '010413', '', 'AMAZONAS', 'LUYA', 'OCUMAL', '', 0, 0, ''),
(53, '01', '0104', '010414', '', 'AMAZONAS', 'LUYA', 'PISUQUIA', '', 0, 0, ''),
(54, '01', '0104', '010415', '', 'AMAZONAS', 'LUYA', 'SAN CRISTOBAL', '', 0, 0, ''),
(55, '01', '0104', '010416', '', 'AMAZONAS', 'LUYA', 'SAN FRANCISCO DE YESO', '', 0, 0, ''),
(56, '01', '0104', '010417', '', 'AMAZONAS', 'LUYA', 'SAN JERONIMO', '', 0, 0, ''),
(57, '01', '0104', '010418', '', 'AMAZONAS', 'LUYA', 'SAN JUAN DE LOPECANCHA', '', 0, 0, ''),
(58, '01', '0104', '010419', '', 'AMAZONAS', 'LUYA', 'SANTA CATALINA', '', 0, 0, ''),
(59, '01', '0104', '010420', '', 'AMAZONAS', 'LUYA', 'SANTO TOMAS', '', 0, 0, ''),
(60, '01', '0104', '010421', '', 'AMAZONAS', 'LUYA', 'TINGO', '', 0, 0, ''),
(61, '01', '0104', '010422', '', 'AMAZONAS', 'LUYA', 'TRITA', '', 0, 0, ''),
(62, '01', '0104', '010423', '', 'AMAZONAS', 'LUYA', 'PROVIDENCIA', '', 0, 0, ''),
(63, '01', '0105', '010501', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'SAN NICOLAS', '', 0, 0, ''),
(64, '01', '0105', '010502', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'COCHAMAL', '', 0, 0, ''),
(65, '01', '0105', '010503', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'CHIRIMOTO', '', 0, 0, ''),
(66, '01', '0105', '010504', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'HUAMBO', '', 0, 0, ''),
(67, '01', '0105', '010505', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'LIMABAMBA', '', 0, 0, ''),
(68, '01', '0105', '010506', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'LONGAR', '', 0, 0, ''),
(69, '01', '0105', '010507', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'MILPUCC', '', 0, 0, ''),
(70, '01', '0105', '010508', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'MARISCAL BENAVIDES', '', 0, 0, ''),
(71, '01', '0105', '010509', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'OMIA', '', 0, 0, ''),
(72, '01', '0105', '010510', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'SANTA ROSA', '', 0, 0, ''),
(73, '01', '0105', '010511', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'TOTORA', '', 0, 0, ''),
(74, '01', '0105', '010512', '', 'AMAZONAS', 'RODRIGUEZ DE MENDOZA', 'VISTA ALEGRE', '', 0, 0, ''),
(75, '01', '0106', '010601', '', 'AMAZONAS', 'CONDORCANQUI', 'NIEVA', '', 0, 0, ''),
(76, '01', '0106', '010602', '', 'AMAZONAS', 'CONDORCANQUI', 'RIO SANTIAGO', '', 0, 0, ''),
(77, '01', '0106', '010603', '', 'AMAZONAS', 'CONDORCANQUI', 'EL CENEPA', '', 0, 0, ''),
(78, '01', '0107', '010701', '', 'AMAZONAS', 'UTCUBAMBA', 'BAGUA GRANDE', '', 0, 0, ''),
(79, '01', '0107', '010702', '', 'AMAZONAS', 'UTCUBAMBA', 'CAJARURO', '', 0, 0, ''),
(80, '01', '0107', '010703', '', 'AMAZONAS', 'UTCUBAMBA', 'CUMBA', '', 0, 0, ''),
(81, '01', '0107', '010704', '', 'AMAZONAS', 'UTCUBAMBA', 'EL MILAGRO', '', 0, 0, ''),
(82, '01', '0107', '010705', '', 'AMAZONAS', 'UTCUBAMBA', 'JAMALCA', '', 0, 0, ''),
(83, '01', '0107', '010706', '', 'AMAZONAS', 'UTCUBAMBA', 'LONYA GRANDE', '', 0, 0, ''),
(84, '01', '0107', '010707', '', 'AMAZONAS', 'UTCUBAMBA', 'YAMON', '', 0, 0, ''),
(85, '02', '0201', '020101', '', 'ANCASH', 'HUARAZ', 'HUARAZ', '', 0, 0, ''),
(86, '02', '0201', '020102', '', 'ANCASH', 'HUARAZ', 'INDEPENDENCIA', '', 0, 0, ''),
(87, '02', '0201', '020103', '', 'ANCASH', 'HUARAZ', 'COCHABAMBA', '', 0, 0, ''),
(88, '02', '0201', '020104', '', 'ANCASH', 'HUARAZ', 'COLCABAMBA', '', 0, 0, ''),
(89, '02', '0201', '020105', '', 'ANCASH', 'HUARAZ', 'HUANCHAY', '', 0, 0, ''),
(90, '02', '0201', '020106', '', 'ANCASH', 'HUARAZ', 'JANGAS', '', 0, 0, ''),
(91, '02', '0201', '020107', '', 'ANCASH', 'HUARAZ', 'LA LIBERTAD', '', 0, 0, ''),
(92, '02', '0201', '020108', '', 'ANCASH', 'HUARAZ', 'OLLEROS', '', 0, 0, ''),
(93, '02', '0201', '020109', '', 'ANCASH', 'HUARAZ', 'PAMPAS GRANDE', '', 0, 0, ''),
(94, '02', '0201', '020110', '', 'ANCASH', 'HUARAZ', 'PARIACOTO', '', 0, 0, ''),
(95, '02', '0201', '020111', '', 'ANCASH', 'HUARAZ', 'PIRA', '', 0, 0, ''),
(96, '02', '0201', '020112', '', 'ANCASH', 'HUARAZ', 'TARICA', '', 0, 0, ''),
(97, '02', '0202', '020201', '', 'ANCASH', 'AIJA', 'AIJA', '', 0, 0, ''),
(98, '02', '0202', '020203', '', 'ANCASH', 'AIJA', 'CORIS', '', 0, 0, ''),
(99, '02', '0202', '020205', '', 'ANCASH', 'AIJA', 'HUACLLAN', '', 0, 0, ''),
(100, '02', '0202', '020206', '', 'ANCASH', 'AIJA', 'LA MERCED', '', 0, 0, ''),
(101, '02', '0202', '020208', '', 'ANCASH', 'AIJA', 'SUCCHA', '', 0, 0, ''),
(102, '02', '0203', '020301', '', 'ANCASH', 'BOLOGNESI', 'CHIQUIAN', '', 0, 0, ''),
(103, '02', '0203', '020302', '', 'ANCASH', 'BOLOGNESI', 'ABELARDO PARDO LEZAMETA', '', 0, 0, ''),
(104, '02', '0203', '020304', '', 'ANCASH', 'BOLOGNESI', 'AQUIA', '', 0, 0, ''),
(105, '02', '0203', '020305', '', 'ANCASH', 'BOLOGNESI', 'CAJACAY', '', 0, 0, ''),
(106, '02', '0203', '020310', '', 'ANCASH', 'BOLOGNESI', 'HUAYLLACAYAN', '', 0, 0, ''),
(107, '02', '0203', '020311', '', 'ANCASH', 'BOLOGNESI', 'HUASTA', '', 0, 0, ''),
(108, '02', '0203', '020313', '', 'ANCASH', 'BOLOGNESI', 'MANGAS', '', 0, 0, ''),
(109, '02', '0203', '020315', '', 'ANCASH', 'BOLOGNESI', 'PACLLON', '', 0, 0, ''),
(110, '02', '0203', '020317', '', 'ANCASH', 'BOLOGNESI', 'SAN MIGUEL DE CORPANQUI', '', 0, 0, ''),
(111, '02', '0203', '020320', '', 'ANCASH', 'BOLOGNESI', 'TICLLOS', '', 0, 0, ''),
(112, '02', '0203', '020321', '', 'ANCASH', 'BOLOGNESI', 'ANTONIO RAIMONDI', '', 0, 0, ''),
(113, '02', '0203', '020322', '', 'ANCASH', 'BOLOGNESI', 'CANIS', '', 0, 0, ''),
(114, '02', '0203', '020323', '', 'ANCASH', 'BOLOGNESI', 'COLQUIOC', '', 0, 0, ''),
(115, '02', '0203', '020324', '', 'ANCASH', 'BOLOGNESI', 'LA PRIMAVERA', '', 0, 0, ''),
(116, '02', '0203', '020325', '', 'ANCASH', 'BOLOGNESI', 'HUALLANCA', '', 0, 0, ''),
(117, '02', '0204', '020401', '', 'ANCASH', 'CARHUAZ', 'CARHUAZ', '', 0, 0, ''),
(118, '02', '0204', '020402', '', 'ANCASH', 'CARHUAZ', 'ACOPAMPA', '', 0, 0, ''),
(119, '02', '0204', '020403', '', 'ANCASH', 'CARHUAZ', 'AMASHCA', '', 0, 0, ''),
(120, '02', '0204', '020404', '', 'ANCASH', 'CARHUAZ', 'ANTA', '', 0, 0, ''),
(121, '02', '0204', '020405', '', 'ANCASH', 'CARHUAZ', 'ATAQUERO', '', 0, 0, ''),
(122, '02', '0204', '020406', '', 'ANCASH', 'CARHUAZ', 'MARCARA', '', 0, 0, ''),
(123, '02', '0204', '020407', '', 'ANCASH', 'CARHUAZ', 'PARIAHUANCA', '', 0, 0, ''),
(124, '02', '0204', '020408', '', 'ANCASH', 'CARHUAZ', 'SAN MIGUEL DE ACO', '', 0, 0, ''),
(125, '02', '0204', '020409', '', 'ANCASH', 'CARHUAZ', 'SHILLA', '', 0, 0, ''),
(126, '02', '0204', '020410', '', 'ANCASH', 'CARHUAZ', 'TINCO', '', 0, 0, ''),
(127, '02', '0204', '020411', '', 'ANCASH', 'CARHUAZ', 'YUNGAR', '', 0, 0, ''),
(128, '02', '0205', '020501', '', 'ANCASH', 'CASMA', 'CASMA', '', 0, 0, ''),
(129, '02', '0205', '020502', '', 'ANCASH', 'CASMA', 'BUENA VISTA ALTA', '', 0, 0, ''),
(130, '02', '0205', '020503', '', 'ANCASH', 'CASMA', 'COMANDANTE NOEL', '', 0, 0, ''),
(131, '02', '0205', '020505', '', 'ANCASH', 'CASMA', 'YAUTAN', '', 0, 0, ''),
(132, '02', '0206', '020601', '', 'ANCASH', 'CORONGO', 'CORONGO', '', 0, 0, ''),
(133, '02', '0206', '020602', '', 'ANCASH', 'CORONGO', 'ACO', '', 0, 0, ''),
(134, '02', '0206', '020603', '', 'ANCASH', 'CORONGO', 'BAMBAS', '', 0, 0, ''),
(135, '02', '0206', '020604', '', 'ANCASH', 'CORONGO', 'CUSCA', '', 0, 0, ''),
(136, '02', '0206', '020605', '', 'ANCASH', 'CORONGO', 'LA PAMPA', '', 0, 0, ''),
(137, '02', '0206', '020606', '', 'ANCASH', 'CORONGO', 'YANAC', '', 0, 0, ''),
(138, '02', '0206', '020607', '', 'ANCASH', 'CORONGO', 'YUPAN', '', 0, 0, ''),
(139, '02', '0207', '020701', '', 'ANCASH', 'HUAYLAS', 'CARAZ', '', 0, 0, ''),
(140, '02', '0207', '020702', '', 'ANCASH', 'HUAYLAS', 'HUALLANCA', '', 0, 0, ''),
(141, '02', '0207', '020703', '', 'ANCASH', 'HUAYLAS', 'HUATA', '', 0, 0, ''),
(142, '02', '0207', '020704', '', 'ANCASH', 'HUAYLAS', 'HUAYLAS', '', 0, 0, ''),
(143, '02', '0207', '020705', '', 'ANCASH', 'HUAYLAS', 'MATO', '', 0, 0, ''),
(144, '02', '0207', '020706', '', 'ANCASH', 'HUAYLAS', 'PAMPAROMAS', '', 0, 0, ''),
(145, '02', '0207', '020707', '', 'ANCASH', 'HUAYLAS', 'PUEBLO LIBRE', '', 0, 0, ''),
(146, '02', '0207', '020708', '', 'ANCASH', 'HUAYLAS', 'SANTA CRUZ', '', 0, 0, ''),
(147, '02', '0207', '020709', '', 'ANCASH', 'HUAYLAS', 'YURACMARCA', '', 0, 0, ''),
(148, '02', '0207', '020710', '', 'ANCASH', 'HUAYLAS', 'SANTO TORIBIO', '', 0, 0, ''),
(149, '02', '0208', '020801', '', 'ANCASH', 'HUARI', 'HUARI', '', 0, 0, ''),
(150, '02', '0208', '020802', '', 'ANCASH', 'HUARI', 'CAJAY', '', 0, 0, ''),
(151, '02', '0208', '020803', '', 'ANCASH', 'HUARI', 'CHAVIN DE HUANTAR', '', 0, 0, ''),
(152, '02', '0208', '020804', '', 'ANCASH', 'HUARI', 'HUACACHI', '', 0, 0, ''),
(153, '02', '0208', '020805', '', 'ANCASH', 'HUARI', 'HUACHIS', '', 0, 0, ''),
(154, '02', '0208', '020806', '', 'ANCASH', 'HUARI', 'HUACCHIS', '', 0, 0, ''),
(155, '02', '0208', '020807', '', 'ANCASH', 'HUARI', 'HUANTAR', '', 0, 0, ''),
(156, '02', '0208', '020808', '', 'ANCASH', 'HUARI', 'MASIN', '', 0, 0, ''),
(157, '02', '0208', '020809', '', 'ANCASH', 'HUARI', 'PAUCAS', '', 0, 0, ''),
(158, '02', '0208', '020810', '', 'ANCASH', 'HUARI', 'PONTO', '', 0, 0, ''),
(159, '02', '0208', '020811', '', 'ANCASH', 'HUARI', 'RAHUAPAMPA', '', 0, 0, ''),
(160, '02', '0208', '020812', '', 'ANCASH', 'HUARI', 'RAPAYAN', '', 0, 0, ''),
(161, '02', '0208', '020813', '', 'ANCASH', 'HUARI', 'SAN MARCOS', '', 0, 0, ''),
(162, '02', '0208', '020814', '', 'ANCASH', 'HUARI', 'SAN PEDRO DE CHANA', '', 0, 0, ''),
(163, '02', '0208', '020815', '', 'ANCASH', 'HUARI', 'UCO', '', 0, 0, ''),
(164, '02', '0208', '020816', '', 'ANCASH', 'HUARI', 'ANRA', '', 0, 0, ''),
(165, '02', '0209', '020901', '', 'ANCASH', 'MARISCAL LUZURIAGA', 'PISCOBAMBA', '', 0, 0, ''),
(166, '02', '0209', '020902', '', 'ANCASH', 'MARISCAL LUZURIAGA', 'CASCA', '', 0, 0, ''),
(167, '02', '0209', '020903', '', 'ANCASH', 'MARISCAL LUZURIAGA', 'LUCMA', '', 0, 0, ''),
(168, '02', '0209', '020904', '', 'ANCASH', 'MARISCAL LUZURIAGA', 'FIDEL OLIVAS ESCUDERO', '', 0, 0, ''),
(169, '02', '0209', '020905', '', 'ANCASH', 'MARISCAL LUZURIAGA', 'LLAMA', '', 0, 0, ''),
(170, '02', '0209', '020906', '', 'ANCASH', 'MARISCAL LUZURIAGA', 'LLUMPA', '', 0, 0, ''),
(171, '02', '0209', '020907', '', 'ANCASH', 'MARISCAL LUZURIAGA', 'MUSGA', '', 0, 0, ''),
(172, '02', '0209', '020908', '', 'ANCASH', 'MARISCAL LUZURIAGA', 'ELEAZAR GUZMAN BARRON', '', 0, 0, ''),
(173, '02', '0210', '021001', '', 'ANCASH', 'PALLASCA', 'CABANA', '', 0, 0, ''),
(174, '02', '0210', '021002', '', 'ANCASH', 'PALLASCA', 'BOLOGNESI', '', 0, 0, ''),
(175, '02', '0210', '021003', '', 'ANCASH', 'PALLASCA', 'CONCHUCOS', '', 0, 0, ''),
(176, '02', '0210', '021004', '', 'ANCASH', 'PALLASCA', 'HUACASCHUQUE', '', 0, 0, ''),
(177, '02', '0210', '021005', '', 'ANCASH', 'PALLASCA', 'HUANDOVAL', '', 0, 0, ''),
(178, '02', '0210', '021006', '', 'ANCASH', 'PALLASCA', 'LACABAMBA', '', 0, 0, ''),
(179, '02', '0210', '021007', '', 'ANCASH', 'PALLASCA', 'LLAPO', '', 0, 0, ''),
(180, '02', '0210', '021008', '', 'ANCASH', 'PALLASCA', 'PALLASCA', '', 0, 0, ''),
(181, '02', '0210', '021009', '', 'ANCASH', 'PALLASCA', 'PAMPAS', '', 0, 0, ''),
(182, '02', '0210', '021010', '', 'ANCASH', 'PALLASCA', 'SANTA ROSA', '', 0, 0, ''),
(183, '02', '0210', '021011', '', 'ANCASH', 'PALLASCA', 'TAUCA', '', 0, 0, ''),
(184, '02', '0211', '021101', '', 'ANCASH', 'POMABAMBA', 'POMABAMBA', '', 0, 0, ''),
(185, '02', '0211', '021102', '', 'ANCASH', 'POMABAMBA', 'HUAYLLAN', '', 0, 0, ''),
(186, '02', '0211', '021103', '', 'ANCASH', 'POMABAMBA', 'PAROBAMBA', '', 0, 0, ''),
(187, '02', '0211', '021104', '', 'ANCASH', 'POMABAMBA', 'QUINUABAMBA', '', 0, 0, ''),
(188, '02', '0212', '021201', '', 'ANCASH', 'RECUAY', 'RECUAY', '', 0, 0, ''),
(189, '02', '0212', '021202', '', 'ANCASH', 'RECUAY', 'COTAPARACO', '', 0, 0, ''),
(190, '02', '0212', '021203', '', 'ANCASH', 'RECUAY', 'HUAYLLAPAMPA', '', 0, 0, ''),
(191, '02', '0212', '021204', '', 'ANCASH', 'RECUAY', 'MARCA', '', 0, 0, ''),
(192, '02', '0212', '021205', '', 'ANCASH', 'RECUAY', 'PAMPAS CHICO', '', 0, 0, ''),
(193, '02', '0212', '021206', '', 'ANCASH', 'RECUAY', 'PARARIN', '', 0, 0, ''),
(194, '02', '0212', '021207', '', 'ANCASH', 'RECUAY', 'TAPACOCHA', '', 0, 0, ''),
(195, '02', '0212', '021208', '', 'ANCASH', 'RECUAY', 'TICAPAMPA', '', 0, 0, ''),
(196, '02', '0212', '021209', '', 'ANCASH', 'RECUAY', 'LLACLLIN', '', 0, 0, ''),
(197, '02', '0212', '021210', '', 'ANCASH', 'RECUAY', 'CATAC', '', 0, 0, ''),
(198, '02', '0213', '021301', '', 'ANCASH', 'SANTA', 'CHIMBOTE', '', 0, 0, ''),
(199, '02', '0213', '021302', '', 'ANCASH', 'SANTA', 'CACERES DEL PERU', '', 0, 0, ''),
(200, '02', '0213', '021303', '', 'ANCASH', 'SANTA', 'MACATE', '', 0, 0, ''),
(201, '02', '0213', '021304', '', 'ANCASH', 'SANTA', 'MORO', '', 0, 0, ''),
(202, '02', '0213', '021305', '', 'ANCASH', 'SANTA', 'NEPEÑA', '', 0, 0, ''),
(203, '02', '0213', '021306', '', 'ANCASH', 'SANTA', 'SAMANCO', '', 0, 0, ''),
(204, '02', '0213', '021307', '', 'ANCASH', 'SANTA', 'SANTA', '', 0, 0, ''),
(205, '02', '0213', '021308', '', 'ANCASH', 'SANTA', 'COISHCO', '', 0, 0, ''),
(206, '02', '0213', '021309', '', 'ANCASH', 'SANTA', 'NUEVO CHIMBOTE', '', 0, 0, ''),
(207, '02', '0214', '021401', '', 'ANCASH', 'SIHUAS', 'SIHUAS', '', 0, 0, ''),
(208, '02', '0214', '021402', '', 'ANCASH', 'SIHUAS', 'ALFONSO UGARTE', '', 0, 0, ''),
(209, '02', '0214', '021403', '', 'ANCASH', 'SIHUAS', 'CHINGALPO', '', 0, 0, ''),
(210, '02', '0214', '021404', '', 'ANCASH', 'SIHUAS', 'HUAYLLABAMBA', '', 0, 0, ''),
(211, '02', '0214', '021405', '', 'ANCASH', 'SIHUAS', 'QUICHES', '', 0, 0, ''),
(212, '02', '0214', '021406', '', 'ANCASH', 'SIHUAS', 'SICSIBAMBA', '', 0, 0, ''),
(213, '02', '0214', '021407', '', 'ANCASH', 'SIHUAS', 'ACOBAMBA', '', 0, 0, ''),
(214, '02', '0214', '021408', '', 'ANCASH', 'SIHUAS', 'CASHAPAMPA', '', 0, 0, ''),
(215, '02', '0214', '021409', '', 'ANCASH', 'SIHUAS', 'RAGASH', '', 0, 0, ''),
(216, '02', '0214', '021410', '', 'ANCASH', 'SIHUAS', 'SAN JUAN', '', 0, 0, ''),
(217, '02', '0215', '021501', '', 'ANCASH', 'YUNGAY', 'YUNGAY', '', 0, 0, ''),
(218, '02', '0215', '021502', '', 'ANCASH', 'YUNGAY', 'CASCAPARA', '', 0, 0, ''),
(219, '02', '0215', '021503', '', 'ANCASH', 'YUNGAY', 'MANCOS', '', 0, 0, ''),
(220, '02', '0215', '021504', '', 'ANCASH', 'YUNGAY', 'MATACOTO', '', 0, 0, ''),
(221, '02', '0215', '021505', '', 'ANCASH', 'YUNGAY', 'QUILLO', '', 0, 0, ''),
(222, '02', '0215', '021506', '', 'ANCASH', 'YUNGAY', 'RANRAHIRCA', '', 0, 0, ''),
(223, '02', '0215', '021507', '', 'ANCASH', 'YUNGAY', 'SHUPLUY', '', 0, 0, ''),
(224, '02', '0215', '021508', '', 'ANCASH', 'YUNGAY', 'YANAMA', '', 0, 0, ''),
(225, '02', '0216', '021601', '', 'ANCASH', 'ANTONIO RAYMONDI', 'LLAMELLIN', '', 0, 0, ''),
(226, '02', '0216', '021602', '', 'ANCASH', 'ANTONIO RAYMONDI', 'ACZO', '', 0, 0, ''),
(227, '02', '0216', '021603', '', 'ANCASH', 'ANTONIO RAYMONDI', 'CHACCHO', '', 0, 0, ''),
(228, '02', '0216', '021604', '', 'ANCASH', 'ANTONIO RAYMONDI', 'CHINGAS', '', 0, 0, ''),
(229, '02', '0216', '021605', '', 'ANCASH', 'ANTONIO RAYMONDI', 'MIRGAS', '', 0, 0, ''),
(230, '02', '0216', '021606', '', 'ANCASH', 'ANTONIO RAYMONDI', 'SAN JUAN DE RONTOY', '', 0, 0, ''),
(231, '02', '0217', '021701', '', 'ANCASH', 'CARLOS FERMIN FITZCARRALD', 'SAN LUIS', '', 0, 0, ''),
(232, '02', '0217', '021702', '', 'ANCASH', 'CARLOS FERMIN FITZCARRALD', 'YAUYA', '', 0, 0, ''),
(233, '02', '0217', '021703', '', 'ANCASH', 'CARLOS FERMIN FITZCARRALD', 'SAN NICOLAS', '', 0, 0, ''),
(234, '02', '0218', '021801', '', 'ANCASH', 'ASUNCION', 'CHACAS', '', 0, 0, ''),
(235, '02', '0218', '021802', '', 'ANCASH', 'ASUNCION', 'ACOCHACA', '', 0, 0, ''),
(236, '02', '0219', '021901', '', 'ANCASH', 'HUARMEY', 'HUARMEY', '', 0, 0, ''),
(237, '02', '0219', '021902', '', 'ANCASH', 'HUARMEY', 'COCHAPETI', '', 0, 0, ''),
(238, '02', '0219', '021903', '', 'ANCASH', 'HUARMEY', 'HUAYAN', '', 0, 0, ''),
(239, '02', '0219', '021904', '', 'ANCASH', 'HUARMEY', 'MALVAS', '', 0, 0, ''),
(240, '02', '0219', '021905', '', 'ANCASH', 'HUARMEY', 'CULEBRAS', '', 0, 0, ''),
(241, '02', '0220', '022001', '', 'ANCASH', 'OCROS', 'ACAS', '', 0, 0, ''),
(242, '02', '0220', '022002', '', 'ANCASH', 'OCROS', 'CAJAMARQUILLA', '', 0, 0, ''),
(243, '02', '0220', '022003', '', 'ANCASH', 'OCROS', 'CARHUAPAMPA', '', 0, 0, ''),
(244, '02', '0220', '022004', '', 'ANCASH', 'OCROS', 'COCHAS', '', 0, 0, ''),
(245, '02', '0220', '022005', '', 'ANCASH', 'OCROS', 'CONGAS', '', 0, 0, ''),
(246, '02', '0220', '022006', '', 'ANCASH', 'OCROS', 'LLIPA', '', 0, 0, ''),
(247, '02', '0220', '022007', '', 'ANCASH', 'OCROS', 'OCROS', '', 0, 0, ''),
(248, '02', '0220', '022008', '', 'ANCASH', 'OCROS', 'SAN CRISTOBAL DE RAJAN', '', 0, 0, ''),
(249, '02', '0220', '022009', '', 'ANCASH', 'OCROS', 'SAN PEDRO', '', 0, 0, ''),
(250, '02', '0220', '022010', '', 'ANCASH', 'OCROS', 'SANTIAGO DE CHILCAS', '', 0, 0, ''),
(251, '03', '0301', '030101', '', 'APURIMAC', 'ABANCAY', 'ABANCAY', '', 0, 0, ''),
(252, '03', '0301', '030102', '', 'APURIMAC', 'ABANCAY', 'CIRCA', '', 0, 0, ''),
(253, '03', '0301', '030103', '', 'APURIMAC', 'ABANCAY', 'CURAHUASI', '', 0, 0, ''),
(254, '03', '0301', '030104', '', 'APURIMAC', 'ABANCAY', 'CHACOCHE', '', 0, 0, ''),
(255, '03', '0301', '030105', '', 'APURIMAC', 'ABANCAY', 'HUANIPACA', '', 0, 0, ''),
(256, '03', '0301', '030106', '', 'APURIMAC', 'ABANCAY', 'LAMBRAMA', '', 0, 0, ''),
(257, '03', '0301', '030107', '', 'APURIMAC', 'ABANCAY', 'PICHIRHUA', '', 0, 0, ''),
(258, '03', '0301', '030108', '', 'APURIMAC', 'ABANCAY', 'SAN PEDRO DE CACHORA', '', 0, 0, ''),
(259, '03', '0301', '030109', '', 'APURIMAC', 'ABANCAY', 'TAMBURCO', '', 0, 0, ''),
(260, '03', '0302', '030201', '', 'APURIMAC', 'AYMARAES', 'CHALHUANCA', '', 0, 0, ''),
(261, '03', '0302', '030202', '', 'APURIMAC', 'AYMARAES', 'CAPAYA', '', 0, 0, ''),
(262, '03', '0302', '030203', '', 'APURIMAC', 'AYMARAES', 'CARAYBAMBA', '', 0, 0, ''),
(263, '03', '0302', '030204', '', 'APURIMAC', 'AYMARAES', 'COLCABAMBA', '', 0, 0, ''),
(264, '03', '0302', '030205', '', 'APURIMAC', 'AYMARAES', 'COTARUSE', '', 0, 0, ''),
(265, '03', '0302', '030206', '', 'APURIMAC', 'AYMARAES', 'CHAPIMARCA', '', 0, 0, ''),
(266, '03', '0302', '030207', '', 'APURIMAC', 'AYMARAES', 'HUAYLLO', '', 0, 0, ''),
(267, '03', '0302', '030208', '', 'APURIMAC', 'AYMARAES', 'LUCRE', '', 0, 0, ''),
(268, '03', '0302', '030209', '', 'APURIMAC', 'AYMARAES', 'POCOHUANCA', '', 0, 0, ''),
(269, '03', '0302', '030210', '', 'APURIMAC', 'AYMARAES', 'SA', '', 0, 0, ''),
(270, '03', '0302', '030211', '', 'APURIMAC', 'AYMARAES', 'SORAYA', '', 0, 0, ''),
(271, '03', '0302', '030212', '', 'APURIMAC', 'AYMARAES', 'TAPAIRIHUA', '', 0, 0, ''),
(272, '03', '0302', '030213', '', 'APURIMAC', 'AYMARAES', 'TINTAY', '', 0, 0, ''),
(273, '03', '0302', '030214', '', 'APURIMAC', 'AYMARAES', 'TORAYA', '', 0, 0, ''),
(274, '03', '0302', '030215', '', 'APURIMAC', 'AYMARAES', 'YANACA', '', 0, 0, ''),
(275, '03', '0302', '030216', '', 'APURIMAC', 'AYMARAES', 'SAN JUAN DE CHAC', '', 0, 0, ''),
(276, '03', '0302', '030217', '', 'APURIMAC', 'AYMARAES', 'JUSTO APU SAHUARAURA', '', 0, 0, ''),
(277, '03', '0303', '030301', '', 'APURIMAC', 'ANDAHUAYLAS', 'ANDAHUAYLAS', '', 0, 0, ''),
(278, '03', '0303', '030302', '', 'APURIMAC', 'ANDAHUAYLAS', 'ANDARAPA', '', 0, 0, ''),
(279, '03', '0303', '030303', '', 'APURIMAC', 'ANDAHUAYLAS', 'CHIARA', '', 0, 0, ''),
(280, '03', '0303', '030304', '', 'APURIMAC', 'ANDAHUAYLAS', 'HUANCARAMA', '', 0, 0, ''),
(281, '03', '0303', '030305', '', 'APURIMAC', 'ANDAHUAYLAS', 'HUANCARAY', '', 0, 0, ''),
(282, '03', '0303', '030306', '', 'APURIMAC', 'ANDAHUAYLAS', 'KISHUARA', '', 0, 0, ''),
(283, '03', '0303', '030307', '', 'APURIMAC', 'ANDAHUAYLAS', 'PACOBAMBA', '', 0, 0, ''),
(284, '03', '0303', '030308', '', 'APURIMAC', 'ANDAHUAYLAS', 'PAMPACHIRI', '', 0, 0, ''),
(285, '03', '0303', '030309', '', 'APURIMAC', 'ANDAHUAYLAS', 'SAN ANTONIO DE CACHI', '', 0, 0, ''),
(286, '03', '0303', '030310', '', 'APURIMAC', 'ANDAHUAYLAS', 'SAN JERONIMO', '', 0, 0, ''),
(287, '03', '0303', '030311', '', 'APURIMAC', 'ANDAHUAYLAS', 'TALAVERA', '', 0, 0, ''),
(288, '03', '0303', '030312', '', 'APURIMAC', 'ANDAHUAYLAS', 'TURPO', '', 0, 0, ''),
(289, '03', '0303', '030313', '', 'APURIMAC', 'ANDAHUAYLAS', 'PACUCHA', '', 0, 0, ''),
(290, '03', '0303', '030314', '', 'APURIMAC', 'ANDAHUAYLAS', 'POMACOCHA', '', 0, 0, ''),
(291, '03', '0303', '030315', '', 'APURIMAC', 'ANDAHUAYLAS', 'SANTA MARIA DE CHICMO', '', 0, 0, ''),
(292, '03', '0303', '030316', '', 'APURIMAC', 'ANDAHUAYLAS', 'TUMAY HUARACA', '', 0, 0, ''),
(293, '03', '0303', '030317', '', 'APURIMAC', 'ANDAHUAYLAS', 'HUAYANA', '', 0, 0, ''),
(294, '03', '0303', '030318', '', 'APURIMAC', 'ANDAHUAYLAS', 'SAN MIGUEL DE CHACCRAMPA', '', 0, 0, ''),
(295, '03', '0303', '030319', '', 'APURIMAC', 'ANDAHUAYLAS', 'KAQUIABAMBA', '', 0, 0, ''),
(296, '03', '0304', '030401', '', 'APURIMAC', 'ANTABAMBA', 'ANTABAMBA', '', 0, 0, ''),
(297, '03', '0304', '030402', '', 'APURIMAC', 'ANTABAMBA', 'EL ORO', '', 0, 0, ''),
(298, '03', '0304', '030403', '', 'APURIMAC', 'ANTABAMBA', 'HUAQUIRCA', '', 0, 0, ''),
(299, '03', '0304', '030404', '', 'APURIMAC', 'ANTABAMBA', 'JUAN ESPINOZA MEDRANO', '', 0, 0, ''),
(300, '03', '0304', '030405', '', 'APURIMAC', 'ANTABAMBA', 'OROPESA', '', 0, 0, ''),
(301, '03', '0304', '030406', '', 'APURIMAC', 'ANTABAMBA', 'PACHACONAS', '', 0, 0, ''),
(302, '03', '0304', '030407', '', 'APURIMAC', 'ANTABAMBA', 'SABAINO', '', 0, 0, ''),
(303, '03', '0305', '030501', '', 'APURIMAC', 'COTABAMBAS', 'TAMBOBAMBA', '', 0, 0, ''),
(304, '03', '0305', '030502', '', 'APURIMAC', 'COTABAMBAS', 'COYLLURQUI', '', 0, 0, ''),
(305, '03', '0305', '030503', '', 'APURIMAC', 'COTABAMBAS', 'COTABAMBAS', '', 0, 0, ''),
(306, '03', '0305', '030504', '', 'APURIMAC', 'COTABAMBAS', 'HAQUIRA', '', 0, 0, ''),
(307, '03', '0305', '030505', '', 'APURIMAC', 'COTABAMBAS', 'MARA', '', 0, 0, ''),
(308, '03', '0305', '030506', '', 'APURIMAC', 'COTABAMBAS', 'CHALLHUAHUACHO', '', 0, 0, ''),
(309, '03', '0306', '030601', '', 'APURIMAC', 'GRAU', 'CHUQUIBAMBILLA', '', 0, 0, ''),
(310, '03', '0306', '030602', '', 'APURIMAC', 'GRAU', 'CURPAHUASI', '', 0, 0, ''),
(311, '03', '0306', '030603', '', 'APURIMAC', 'GRAU', 'HUAILLATI', '', 0, 0, ''),
(312, '03', '0306', '030604', '', 'APURIMAC', 'GRAU', 'MAMARA', '', 0, 0, ''),
(313, '03', '0306', '030605', '', 'APURIMAC', 'GRAU', 'MARISCAL GAMARRA', '', 0, 0, ''),
(314, '03', '0306', '030606', '', 'APURIMAC', 'GRAU', 'MICAELA BASTIDAS', '', 0, 0, ''),
(315, '03', '0306', '030607', '', 'APURIMAC', 'GRAU', 'PROGRESO', '', 0, 0, ''),
(316, '03', '0306', '030608', '', 'APURIMAC', 'GRAU', 'PATAYPAMPA', '', 0, 0, ''),
(317, '03', '0306', '030609', '', 'APURIMAC', 'GRAU', 'SAN ANTONIO', '', 0, 0, ''),
(318, '03', '0306', '030610', '', 'APURIMAC', 'GRAU', 'TURPAY', '', 0, 0, ''),
(319, '03', '0306', '030611', '', 'APURIMAC', 'GRAU', 'VILCABAMBA', '', 0, 0, ''),
(320, '03', '0306', '030612', '', 'APURIMAC', 'GRAU', 'VIRUNDO', '', 0, 0, ''),
(321, '03', '0306', '030613', '', 'APURIMAC', 'GRAU', 'SANTA ROSA', '', 0, 0, ''),
(322, '03', '0306', '030614', '', 'APURIMAC', 'GRAU', 'CURASCO', '', 0, 0, ''),
(323, '03', '0307', '030701', '', 'APURIMAC', 'CHINCHEROS', 'CHINCHEROS', '', 0, 0, ''),
(324, '03', '0307', '030702', '', 'APURIMAC', 'CHINCHEROS', 'ONGOY', '', 0, 0, ''),
(325, '03', '0307', '030703', '', 'APURIMAC', 'CHINCHEROS', 'OCOBAMBA', '', 0, 0, ''),
(326, '03', '0307', '030704', '', 'APURIMAC', 'CHINCHEROS', 'COCHARCAS', '', 0, 0, ''),
(327, '03', '0307', '030705', '', 'APURIMAC', 'CHINCHEROS', 'ANCO HUALLO', '', 0, 0, ''),
(328, '03', '0307', '030706', '', 'APURIMAC', 'CHINCHEROS', 'HUACCANA', '', 0, 0, ''),
(329, '03', '0307', '030707', '', 'APURIMAC', 'CHINCHEROS', 'URANMARCA', '', 0, 0, ''),
(330, '03', '0307', '030708', '', 'APURIMAC', 'CHINCHEROS', 'RANRACANCHA', '', 0, 0, ''),
(331, '04', '0401', '040101', '', 'AREQUIPA', 'AREQUIPA', 'AREQUIPA', '', 0, 0, ''),
(332, '04', '0401', '040102', '', 'AREQUIPA', 'AREQUIPA', 'CAYMA', '', 0, 0, ''),
(333, '04', '0401', '040103', '', 'AREQUIPA', 'AREQUIPA', 'CERRO COLORADO', '', 0, 0, ''),
(334, '04', '0401', '040104', '', 'AREQUIPA', 'AREQUIPA', 'CHARACATO', '', 0, 0, ''),
(335, '04', '0401', '040105', '', 'AREQUIPA', 'AREQUIPA', 'CHIGUATA', '', 0, 0, ''),
(336, '04', '0401', '040106', '', 'AREQUIPA', 'AREQUIPA', 'LA JOYA', '', 0, 0, ''),
(337, '04', '0401', '040107', '', 'AREQUIPA', 'AREQUIPA', 'MIRAFLORES', '', 0, 0, ''),
(338, '04', '0401', '040108', '', 'AREQUIPA', 'AREQUIPA', 'MOLLEBAYA', '', 0, 0, ''),
(339, '04', '0401', '040109', '', 'AREQUIPA', 'AREQUIPA', 'PAUCARPATA', '', 0, 0, ''),
(340, '04', '0401', '040110', '', 'AREQUIPA', 'AREQUIPA', 'POCSI', '', 0, 0, ''),
(341, '04', '0401', '040111', '', 'AREQUIPA', 'AREQUIPA', 'POLOBAYA', '', 0, 0, ''),
(342, '04', '0401', '040112', '', 'AREQUIPA', 'AREQUIPA', 'QUEQUE', '', 0, 0, ''),
(343, '04', '0401', '040113', '', 'AREQUIPA', 'AREQUIPA', 'SABANDIA', '', 0, 0, ''),
(344, '04', '0401', '040114', '', 'AREQUIPA', 'AREQUIPA', 'SACHACA', '', 0, 0, ''),
(345, '04', '0401', '040115', '', 'AREQUIPA', 'AREQUIPA', 'SAN JUAN DE SIGUAS', '', 0, 0, ''),
(346, '04', '0401', '040116', '', 'AREQUIPA', 'AREQUIPA', 'SAN JUAN DE TARUCANI', '', 0, 0, ''),
(347, '04', '0401', '040117', '', 'AREQUIPA', 'AREQUIPA', 'SANTA ISABEL DE SIGUAS', '', 0, 0, ''),
(348, '04', '0401', '040118', '', 'AREQUIPA', 'AREQUIPA', 'SANTA RITA DE SIHUAS', '', 0, 0, ''),
(349, '04', '0401', '040119', '', 'AREQUIPA', 'AREQUIPA', 'SOCABAYA', '', 0, 0, ''),
(350, '04', '0401', '040120', '', 'AREQUIPA', 'AREQUIPA', 'TIABAYA', '', 0, 0, ''),
(351, '04', '0401', '040121', '', 'AREQUIPA', 'AREQUIPA', 'UCHUMAYO', '', 0, 0, ''),
(352, '04', '0401', '040122', '', 'AREQUIPA', 'AREQUIPA', 'VITOR', '', 0, 0, ''),
(353, '04', '0401', '040123', '', 'AREQUIPA', 'AREQUIPA', 'YANAHUARA', '', 0, 0, ''),
(354, '04', '0401', '040124', '', 'AREQUIPA', 'AREQUIPA', 'YARABAMBA', '', 0, 0, ''),
(355, '04', '0401', '040125', '', 'AREQUIPA', 'AREQUIPA', 'YURA', '', 0, 0, ''),
(356, '04', '0401', '040126', '', 'AREQUIPA', 'AREQUIPA', 'MARIANO MELGAR', '', 0, 0, ''),
(357, '04', '0401', '040127', '', 'AREQUIPA', 'AREQUIPA', 'JACOBO HUNTER', '', 0, 0, ''),
(358, '04', '0401', '040128', '', 'AREQUIPA', 'AREQUIPA', 'ALTO SELVA ALEGRE', '', 0, 0, ''),
(359, '04', '0401', '040129', '', 'AREQUIPA', 'AREQUIPA', 'JOSE LUIS BUSTAMANTE Y RIVERO', '', 0, 0, ''),
(360, '04', '0402', '040201', '', 'AREQUIPA', 'CAYLLOMA', 'CHIVAY', '', 0, 0, ''),
(361, '04', '0402', '040202', '', 'AREQUIPA', 'CAYLLOMA', 'ACHOMA', '', 0, 0, ''),
(362, '04', '0402', '040203', '', 'AREQUIPA', 'CAYLLOMA', 'CABANACONDE', '', 0, 0, ''),
(363, '04', '0402', '040204', '', 'AREQUIPA', 'CAYLLOMA', 'CAYLLOMA', '', 0, 0, ''),
(364, '04', '0402', '040205', '', 'AREQUIPA', 'CAYLLOMA', 'CALLALLI', '', 0, 0, ''),
(365, '04', '0402', '040206', '', 'AREQUIPA', 'CAYLLOMA', 'COPORAQUE', '', 0, 0, ''),
(366, '04', '0402', '040207', '', 'AREQUIPA', 'CAYLLOMA', 'HUAMBO', '', 0, 0, ''),
(367, '04', '0402', '040208', '', 'AREQUIPA', 'CAYLLOMA', 'HUANCA', '', 0, 0, ''),
(368, '04', '0402', '040209', '', 'AREQUIPA', 'CAYLLOMA', 'ICHUPAMPA', '', 0, 0, ''),
(369, '04', '0402', '040210', '', 'AREQUIPA', 'CAYLLOMA', 'LARI', '', 0, 0, ''),
(370, '04', '0402', '040211', '', 'AREQUIPA', 'CAYLLOMA', 'LLUTA', '', 0, 0, ''),
(371, '04', '0402', '040212', '', 'AREQUIPA', 'CAYLLOMA', 'MACA', '', 0, 0, ''),
(372, '04', '0402', '040213', '', 'AREQUIPA', 'CAYLLOMA', 'MADRIGAL', '', 0, 0, ''),
(373, '04', '0402', '040214', '', 'AREQUIPA', 'CAYLLOMA', 'SAN ANTONIO DE CHUCA', '', 0, 0, ''),
(374, '04', '0402', '040215', '', 'AREQUIPA', 'CAYLLOMA', 'SIBAYO', '', 0, 0, ''),
(375, '04', '0402', '040216', '', 'AREQUIPA', 'CAYLLOMA', 'TAPAY', '', 0, 0, ''),
(376, '04', '0402', '040217', '', 'AREQUIPA', 'CAYLLOMA', 'TISCO', '', 0, 0, ''),
(377, '04', '0402', '040218', '', 'AREQUIPA', 'CAYLLOMA', 'TUTI', '', 0, 0, ''),
(378, '04', '0402', '040219', '', 'AREQUIPA', 'CAYLLOMA', 'YANQUE', '', 0, 0, ''),
(379, '04', '0402', '040220', '', 'AREQUIPA', 'CAYLLOMA', 'MAJES', '', 0, 0, ''),
(380, '04', '0403', '040301', '', 'AREQUIPA', 'CAMANA', 'CAMANA', '', 0, 0, ''),
(381, '04', '0403', '040302', '', 'AREQUIPA', 'CAMANA', 'JOSE MARIA QUIMPER', '', 0, 0, ''),
(382, '04', '0403', '040303', '', 'AREQUIPA', 'CAMANA', 'MARIANO NICOLAS VALCARCEL', '', 0, 0, ''),
(383, '04', '0403', '040304', '', 'AREQUIPA', 'CAMANA', 'MARISCAL CACERES', '', 0, 0, ''),
(384, '04', '0403', '040305', '', 'AREQUIPA', 'CAMANA', 'NICOLAS DE PIEROLA', '', 0, 0, ''),
(385, '04', '0403', '040306', '', 'AREQUIPA', 'CAMANA', 'OCO', '', 0, 0, ''),
(386, '04', '0403', '040307', '', 'AREQUIPA', 'CAMANA', 'QUILCA', '', 0, 0, ''),
(387, '04', '0403', '040308', '', 'AREQUIPA', 'CAMANA', 'SAMUEL PASTOR', '', 0, 0, ''),
(388, '04', '0404', '040401', '', 'AREQUIPA', 'CARAVELI', 'CARAVELI', '', 0, 0, ''),
(389, '04', '0404', '040402', '', 'AREQUIPA', 'CARAVELI', 'ACARI', '', 0, 0, ''),
(390, '04', '0404', '040403', '', 'AREQUIPA', 'CARAVELI', 'ATICO', '', 0, 0, ''),
(391, '04', '0404', '040404', '', 'AREQUIPA', 'CARAVELI', 'ATIQUIPA', '', 0, 0, ''),
(392, '04', '0404', '040405', '', 'AREQUIPA', 'CARAVELI', 'BELLA UNION', '', 0, 0, ''),
(393, '04', '0404', '040406', '', 'AREQUIPA', 'CARAVELI', 'CAHUACHO', '', 0, 0, ''),
(394, '04', '0404', '040407', '', 'AREQUIPA', 'CARAVELI', 'CHALA', '', 0, 0, ''),
(395, '04', '0404', '040408', '', 'AREQUIPA', 'CARAVELI', 'CHAPARRA', '', 0, 0, ''),
(396, '04', '0404', '040409', '', 'AREQUIPA', 'CARAVELI', 'HUANUHUANU', '', 0, 0, ''),
(397, '04', '0404', '040410', '', 'AREQUIPA', 'CARAVELI', 'JAQUI', '', 0, 0, ''),
(398, '04', '0404', '040411', '', 'AREQUIPA', 'CARAVELI', 'LOMAS', '', 0, 0, ''),
(399, '04', '0404', '040412', '', 'AREQUIPA', 'CARAVELI', 'QUICACHA', '', 0, 0, ''),
(400, '04', '0404', '040413', '', 'AREQUIPA', 'CARAVELI', 'YAUCA', '', 0, 0, ''),
(401, '04', '0405', '040501', '', 'AREQUIPA', 'CASTILLA', 'APLAO', '', 0, 0, ''),
(402, '04', '0405', '040502', '', 'AREQUIPA', 'CASTILLA', 'ANDAGUA', '', 0, 0, ''),
(403, '04', '0405', '040503', '', 'AREQUIPA', 'CASTILLA', 'AYO', '', 0, 0, ''),
(404, '04', '0405', '040504', '', 'AREQUIPA', 'CASTILLA', 'CHACHAS', '', 0, 0, ''),
(405, '04', '0405', '040505', '', 'AREQUIPA', 'CASTILLA', 'CHILCAYMARCA', '', 0, 0, ''),
(406, '04', '0405', '040506', '', 'AREQUIPA', 'CASTILLA', 'CHOCO', '', 0, 0, ''),
(407, '04', '0405', '040507', '', 'AREQUIPA', 'CASTILLA', 'HUANCARQUI', '', 0, 0, ''),
(408, '04', '0405', '040508', '', 'AREQUIPA', 'CASTILLA', 'MACHAGUAY', '', 0, 0, ''),
(409, '04', '0405', '040509', '', 'AREQUIPA', 'CASTILLA', 'ORCOPAMPA', '', 0, 0, ''),
(410, '04', '0405', '040510', '', 'AREQUIPA', 'CASTILLA', 'PAMPACOLCA', '', 0, 0, ''),
(411, '04', '0405', '040511', '', 'AREQUIPA', 'CASTILLA', 'TIPAN', '', 0, 0, ''),
(412, '04', '0405', '040512', '', 'AREQUIPA', 'CASTILLA', 'URACA', '', 0, 0, ''),
(413, '04', '0405', '040513', '', 'AREQUIPA', 'CASTILLA', 'U', '', 0, 0, ''),
(414, '04', '0405', '040514', '', 'AREQUIPA', 'CASTILLA', 'VIRACO', '', 0, 0, ''),
(415, '04', '0406', '040601', '', 'AREQUIPA', 'CONDESUYOS', 'CHUQUIBAMBA', '', 0, 0, ''),
(416, '04', '0406', '040602', '', 'AREQUIPA', 'CONDESUYOS', 'ANDARAY', '', 0, 0, ''),
(417, '04', '0406', '040603', '', 'AREQUIPA', 'CONDESUYOS', 'CAYARANI', '', 0, 0, ''),
(418, '04', '0406', '040604', '', 'AREQUIPA', 'CONDESUYOS', 'CHICHAS', '', 0, 0, ''),
(419, '04', '0406', '040605', '', 'AREQUIPA', 'CONDESUYOS', 'IRAY', '', 0, 0, ''),
(420, '04', '0406', '040606', '', 'AREQUIPA', 'CONDESUYOS', 'SALAMANCA', '', 0, 0, ''),
(421, '04', '0406', '040607', '', 'AREQUIPA', 'CONDESUYOS', 'YANAQUIHUA', '', 0, 0, ''),
(422, '04', '0406', '040608', '', 'AREQUIPA', 'CONDESUYOS', 'RIO GRANDE', '', 0, 0, ''),
(423, '04', '0407', '040701', '', 'AREQUIPA', 'ISLAY', 'MOLLENDO', '', 0, 0, ''),
(424, '04', '0407', '040702', '', 'AREQUIPA', 'ISLAY', 'COCACHACRA', '', 0, 0, ''),
(425, '04', '0407', '040703', '', 'AREQUIPA', 'ISLAY', 'DEAN VALDIVIA', '', 0, 0, ''),
(426, '04', '0407', '040704', '', 'AREQUIPA', 'ISLAY', 'ISLAY', '', 0, 0, ''),
(427, '04', '0407', '040705', '', 'AREQUIPA', 'ISLAY', 'MEJIA', '', 0, 0, ''),
(428, '04', '0407', '040706', '', 'AREQUIPA', 'ISLAY', 'PUNTA DE BOMBON', '', 0, 0, ''),
(429, '04', '0408', '040801', '', 'AREQUIPA', 'LA UNION', 'COTAHUASI', '', 0, 0, ''),
(430, '04', '0408', '040802', '', 'AREQUIPA', 'LA UNION', 'ALCA', '', 0, 0, ''),
(431, '04', '0408', '040803', '', 'AREQUIPA', 'LA UNION', 'CHARCANA', '', 0, 0, ''),
(432, '04', '0408', '040804', '', 'AREQUIPA', 'LA UNION', 'HUAYNACOTAS', '', 0, 0, ''),
(433, '04', '0408', '040805', '', 'AREQUIPA', 'LA UNION', 'PAMPAMARCA', '', 0, 0, ''),
(434, '04', '0408', '040806', '', 'AREQUIPA', 'LA UNION', 'PUYCA', '', 0, 0, ''),
(435, '04', '0408', '040807', '', 'AREQUIPA', 'LA UNION', 'QUECHUALLA', '', 0, 0, ''),
(436, '04', '0408', '040808', '', 'AREQUIPA', 'LA UNION', 'SAYLA', '', 0, 0, ''),
(437, '04', '0408', '040809', '', 'AREQUIPA', 'LA UNION', 'TAURIA', '', 0, 0, ''),
(438, '04', '0408', '040810', '', 'AREQUIPA', 'LA UNION', 'TOMEPAMPA', '', 0, 0, ''),
(439, '04', '0408', '040811', '', 'AREQUIPA', 'LA UNION', 'TORO', '', 0, 0, ''),
(440, '05', '0501', '050101', '', 'AYACUCHO', 'HUAMANGA', 'AYACUCHO', '', 0, 0, ''),
(441, '05', '0501', '050102', '', 'AYACUCHO', 'HUAMANGA', 'ACOS VINCHOS', '', 0, 0, ''),
(442, '05', '0501', '050103', '', 'AYACUCHO', 'HUAMANGA', 'CARMEN ALTO', '', 0, 0, ''),
(443, '05', '0501', '050104', '', 'AYACUCHO', 'HUAMANGA', 'CHIARA', '', 0, 0, ''),
(444, '05', '0501', '050105', '', 'AYACUCHO', 'HUAMANGA', 'QUINUA', '', 0, 0, ''),
(445, '05', '0501', '050106', '', 'AYACUCHO', 'HUAMANGA', 'SAN JOSE DE TICLLAS', '', 0, 0, ''),
(446, '05', '0501', '050107', '', 'AYACUCHO', 'HUAMANGA', 'SAN JUAN BAUTISTA', '', 0, 0, ''),
(447, '05', '0501', '050108', '', 'AYACUCHO', 'HUAMANGA', 'SANTIAGO DE PISCHA', '', 0, 0, ''),
(448, '05', '0501', '050109', '', 'AYACUCHO', 'HUAMANGA', 'VINCHOS', '', 0, 0, ''),
(449, '05', '0501', '050110', '', 'AYACUCHO', 'HUAMANGA', 'TAMBILLO', '', 0, 0, ''),
(450, '05', '0501', '050111', '', 'AYACUCHO', 'HUAMANGA', 'ACOCRO', '', 0, 0, ''),
(451, '05', '0501', '050112', '', 'AYACUCHO', 'HUAMANGA', 'SOCOS', '', 0, 0, ''),
(452, '05', '0501', '050113', '', 'AYACUCHO', 'HUAMANGA', 'OCROS', '', 0, 0, ''),
(453, '05', '0501', '050114', '', 'AYACUCHO', 'HUAMANGA', 'PACAYCASA', '', 0, 0, ''),
(454, '05', '0501', '050115', '', 'AYACUCHO', 'HUAMANGA', 'JESUS NAZARENO', '', 0, 0, ''),
(455, '05', '0502', '050201', '', 'AYACUCHO', 'CANGALLO', 'CANGALLO', '', 0, 0, ''),
(456, '05', '0502', '050204', '', 'AYACUCHO', 'CANGALLO', 'CHUSCHI', '', 0, 0, ''),
(457, '05', '0502', '050206', '', 'AYACUCHO', 'CANGALLO', 'LOS MOROCHUCOS', '', 0, 0, ''),
(458, '05', '0502', '050207', '', 'AYACUCHO', 'CANGALLO', 'PARAS', '', 0, 0, ''),
(459, '05', '0502', '050208', '', 'AYACUCHO', 'CANGALLO', 'TOTOS', '', 0, 0, ''),
(460, '05', '0502', '050211', '', 'AYACUCHO', 'CANGALLO', 'MARIA PARADO DE BELLIDO', '', 0, 0, ''),
(461, '05', '0503', '050301', '', 'AYACUCHO', 'HUANTA', 'HUANTA', '', 0, 0, ''),
(462, '05', '0503', '050302', '', 'AYACUCHO', 'HUANTA', 'AYAHUANCO', '', 0, 0, ''),
(463, '05', '0503', '050303', '', 'AYACUCHO', 'HUANTA', 'HUAMANGUILLA', '', 0, 0, ''),
(464, '05', '0503', '050304', '', 'AYACUCHO', 'HUANTA', 'IGUAIN', '', 0, 0, ''),
(465, '05', '0503', '050305', '', 'AYACUCHO', 'HUANTA', 'LURICOCHA', '', 0, 0, ''),
(466, '05', '0503', '050307', '', 'AYACUCHO', 'HUANTA', 'SANTILLANA', '', 0, 0, ''),
(467, '05', '0503', '050308', '', 'AYACUCHO', 'HUANTA', 'SIVIA', '', 0, 0, ''),
(468, '05', '0503', '050309', '', 'AYACUCHO', 'HUANTA', 'LLOCHEGUA', '', 0, 0, ''),
(469, '05', '0504', '050401', '', 'AYACUCHO', 'LA MAR', 'SAN MIGUEL', '', 0, 0, ''),
(470, '05', '0504', '050402', '', 'AYACUCHO', 'LA MAR', 'ANCO', '', 0, 0, ''),
(471, '05', '0504', '050403', '', 'AYACUCHO', 'LA MAR', 'AYNA', '', 0, 0, ''),
(472, '05', '0504', '050404', '', 'AYACUCHO', 'LA MAR', 'CHILCAS', '', 0, 0, ''),
(473, '05', '0504', '050405', '', 'AYACUCHO', 'LA MAR', 'CHUNGUI', '', 0, 0, ''),
(474, '05', '0504', '050406', '', 'AYACUCHO', 'LA MAR', 'TAMBO', '', 0, 0, ''),
(475, '05', '0504', '050407', '', 'AYACUCHO', 'LA MAR', 'LUIS CARRANZA', '', 0, 0, ''),
(476, '05', '0504', '050408', '', 'AYACUCHO', 'LA MAR', 'SANTA ROSA', '', 0, 0, ''),
(477, '05', '0504', '050409', '', 'AYACUCHO', 'LA MAR', 'SAMUGARI', '', 0, 0, ''),
(478, '05', '0505', '050501', '', 'AYACUCHO', 'LUCANAS', 'PUQUIO', '', 0, 0, ''),
(479, '05', '0505', '050502', '', 'AYACUCHO', 'LUCANAS', 'AUCARA', '', 0, 0, ''),
(480, '05', '0505', '050503', '', 'AYACUCHO', 'LUCANAS', 'CABANA', '', 0, 0, ''),
(481, '05', '0505', '050504', '', 'AYACUCHO', 'LUCANAS', 'CARMEN SALCEDO', '', 0, 0, ''),
(482, '05', '0505', '050506', '', 'AYACUCHO', 'LUCANAS', 'CHAVI', '', 0, 0, ''),
(483, '05', '0505', '050508', '', 'AYACUCHO', 'LUCANAS', 'CHIPAO', '', 0, 0, ''),
(484, '05', '0505', '050510', '', 'AYACUCHO', 'LUCANAS', 'HUAC-HUAS', '', 0, 0, ''),
(485, '05', '0505', '050511', '', 'AYACUCHO', 'LUCANAS', 'LARAMATE', '', 0, 0, ''),
(486, '05', '0505', '050512', '', 'AYACUCHO', 'LUCANAS', 'LEONCIO PRADO', '', 0, 0, ''),
(487, '05', '0505', '050513', '', 'AYACUCHO', 'LUCANAS', 'LUCANAS', '', 0, 0, ''),
(488, '05', '0505', '050514', '', 'AYACUCHO', 'LUCANAS', 'LLAUTA', '', 0, 0, ''),
(489, '05', '0505', '050516', '', 'AYACUCHO', 'LUCANAS', 'OCA', '', 0, 0, ''),
(490, '05', '0505', '050517', '', 'AYACUCHO', 'LUCANAS', 'OTOCA', '', 0, 0, ''),
(491, '05', '0505', '050520', '', 'AYACUCHO', 'LUCANAS', 'SANCOS', '', 0, 0, ''),
(492, '05', '0505', '050521', '', 'AYACUCHO', 'LUCANAS', 'SAN JUAN', '', 0, 0, ''),
(493, '05', '0505', '050522', '', 'AYACUCHO', 'LUCANAS', 'SAN PEDRO', '', 0, 0, ''),
(494, '05', '0505', '050524', '', 'AYACUCHO', 'LUCANAS', 'SANTA ANA DE HUAYCAHUACHO', '', 0, 0, ''),
(495, '05', '0505', '050525', '', 'AYACUCHO', 'LUCANAS', 'SANTA LUCIA', '', 0, 0, ''),
(496, '05', '0505', '050529', '', 'AYACUCHO', 'LUCANAS', 'SAISA', '', 0, 0, ''),
(497, '05', '0505', '050531', '', 'AYACUCHO', 'LUCANAS', 'SAN PEDRO DE PALCO', '', 0, 0, ''),
(498, '05', '0505', '050532', '', 'AYACUCHO', 'LUCANAS', 'SAN CRISTOBAL', '', 0, 0, ''),
(499, '05', '0506', '050601', '', 'AYACUCHO', 'PARINACOCHAS', 'CORACORA', '', 0, 0, ''),
(500, '05', '0506', '050604', '', 'AYACUCHO', 'PARINACOCHAS', 'CORONEL CASTA', '', 0, 0, ''),
(501, '05', '0506', '050605', '', 'AYACUCHO', 'PARINACOCHAS', 'CHUMPI', '', 0, 0, ''),
(502, '05', '0506', '050608', '', 'AYACUCHO', 'PARINACOCHAS', 'PACAPAUSA', '', 0, 0, ''),
(503, '05', '0506', '050611', '', 'AYACUCHO', 'PARINACOCHAS', 'PULLO', '', 0, 0, ''),
(504, '05', '0506', '050612', '', 'AYACUCHO', 'PARINACOCHAS', 'PUYUSCA', '', 0, 0, ''),
(505, '05', '0506', '050615', '', 'AYACUCHO', 'PARINACOCHAS', 'SAN FRANCISCO DE RAVACAYCO', '', 0, 0, ''),
(506, '05', '0506', '050616', '', 'AYACUCHO', 'PARINACOCHAS', 'UPAHUACHO', '', 0, 0, ''),
(507, '05', '0507', '050701', '', 'AYACUCHO', 'VICTOR FAJARDO', 'HUANCAPI', '', 0, 0, ''),
(508, '05', '0507', '050702', '', 'AYACUCHO', 'VICTOR FAJARDO', 'ALCAMENCA', '', 0, 0, ''),
(509, '05', '0507', '050703', '', 'AYACUCHO', 'VICTOR FAJARDO', 'APONGO', '', 0, 0, ''),
(510, '05', '0507', '050704', '', 'AYACUCHO', 'VICTOR FAJARDO', 'CANARIA', '', 0, 0, ''),
(511, '05', '0507', '050706', '', 'AYACUCHO', 'VICTOR FAJARDO', 'CAYARA', '', 0, 0, ''),
(512, '05', '0507', '050707', '', 'AYACUCHO', 'VICTOR FAJARDO', 'COLCA', '', 0, 0, ''),
(513, '05', '0507', '050708', '', 'AYACUCHO', 'VICTOR FAJARDO', 'HUAYA', '', 0, 0, ''),
(514, '05', '0507', '050709', '', 'AYACUCHO', 'VICTOR FAJARDO', 'HUAMANQUIQUIA', '', 0, 0, ''),
(515, '05', '0507', '050710', '', 'AYACUCHO', 'VICTOR FAJARDO', 'HUANCARAYLLA', '', 0, 0, ''),
(516, '05', '0507', '050713', '', 'AYACUCHO', 'VICTOR FAJARDO', 'SARHUA', '', 0, 0, ''),
(517, '05', '0507', '050714', '', 'AYACUCHO', 'VICTOR FAJARDO', 'VILCANCHOS', '', 0, 0, ''),
(518, '05', '0507', '050715', '', 'AYACUCHO', 'VICTOR FAJARDO', 'ASQUIPATA', '', 0, 0, ''),
(519, '05', '0508', '050801', '', 'AYACUCHO', 'HUANCA SANCOS', 'SANCOS', '', 0, 0, ''),
(520, '05', '0508', '050802', '', 'AYACUCHO', 'HUANCA SANCOS', 'SACSAMARCA', '', 0, 0, ''),
(521, '05', '0508', '050803', '', 'AYACUCHO', 'HUANCA SANCOS', 'SANTIAGO DE LUCANAMARCA', '', 0, 0, ''),
(522, '05', '0508', '050804', '', 'AYACUCHO', 'HUANCA SANCOS', 'CARAPO', '', 0, 0, ''),
(523, '05', '0509', '050901', '', 'AYACUCHO', 'VILCAS HUAMAN', 'VILCAS HUAMAN', '', 0, 0, ''),
(524, '05', '0509', '050902', '', 'AYACUCHO', 'VILCAS HUAMAN', 'VISCHONGO', '', 0, 0, ''),
(525, '05', '0509', '050903', '', 'AYACUCHO', 'VILCAS HUAMAN', 'ACCOMARCA', '', 0, 0, ''),
(526, '05', '0509', '050904', '', 'AYACUCHO', 'VILCAS HUAMAN', 'CARHUANCA', '', 0, 0, ''),
(527, '05', '0509', '050905', '', 'AYACUCHO', 'VILCAS HUAMAN', 'CONCEPCION', '', 0, 0, ''),
(528, '05', '0509', '050906', '', 'AYACUCHO', 'VILCAS HUAMAN', 'HUAMBALPA', '', 0, 0, ''),
(529, '05', '0509', '050907', '', 'AYACUCHO', 'VILCAS HUAMAN', 'SAURAMA', '', 0, 0, ''),
(530, '05', '0509', '050908', '', 'AYACUCHO', 'VILCAS HUAMAN', 'INDEPENDENCIA', '', 0, 0, ''),
(531, '05', '0510', '051001', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'PAUSA', '', 0, 0, ''),
(532, '05', '0510', '051002', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'COLTA', '', 0, 0, ''),
(533, '05', '0510', '051003', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'CORCULLA', '', 0, 0, ''),
(534, '05', '0510', '051004', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'LAMPA', '', 0, 0, ''),
(535, '05', '0510', '051005', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'MARCABAMBA', '', 0, 0, ''),
(536, '05', '0510', '051006', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'OYOLO', '', 0, 0, ''),
(537, '05', '0510', '051007', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'PARARCA', '', 0, 0, ''),
(538, '05', '0510', '051008', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'SAN JAVIER DE ALPABAMBA', '', 0, 0, ''),
(539, '05', '0510', '051009', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'SAN JOSE DE USHUA', '', 0, 0, ''),
(540, '05', '0510', '051010', '', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'SARA SARA', '', 0, 0, ''),
(541, '05', '0511', '051101', '', 'AYACUCHO', 'SUCRE', 'QUEROBAMBA', '', 0, 0, ''),
(542, '05', '0511', '051102', '', 'AYACUCHO', 'SUCRE', 'BELEN', '', 0, 0, ''),
(543, '05', '0511', '051103', '', 'AYACUCHO', 'SUCRE', 'CHALCOS', '', 0, 0, ''),
(544, '05', '0511', '051104', '', 'AYACUCHO', 'SUCRE', 'SAN SALVADOR DE QUIJE', '', 0, 0, ''),
(545, '05', '0511', '051105', '', 'AYACUCHO', 'SUCRE', 'PAICO', '', 0, 0, ''),
(546, '05', '0511', '051106', '', 'AYACUCHO', 'SUCRE', 'SANTIAGO DE PAUCARAY', '', 0, 0, ''),
(547, '05', '0511', '051107', '', 'AYACUCHO', 'SUCRE', 'SAN PEDRO DE LARCAY', '', 0, 0, ''),
(548, '05', '0511', '051108', '', 'AYACUCHO', 'SUCRE', 'SORAS', '', 0, 0, ''),
(549, '05', '0511', '051109', '', 'AYACUCHO', 'SUCRE', 'HUACA', '', 0, 0, ''),
(550, '05', '0511', '051110', '', 'AYACUCHO', 'SUCRE', 'CHILCAYOC', '', 0, 0, ''),
(551, '05', '0511', '051111', '', 'AYACUCHO', 'SUCRE', 'MORCOLLA', '', 0, 0, ''),
(552, '06', '0601', '060101', '', 'CAJAMARCA', 'CAJAMARCA', 'CAJAMARCA', '', 0, 0, ''),
(553, '06', '0601', '060102', '', 'CAJAMARCA', 'CAJAMARCA', 'ASUNCION', '', 0, 0, ''),
(554, '06', '0601', '060103', '', 'CAJAMARCA', 'CAJAMARCA', 'COSPAN', '', 0, 0, ''),
(555, '06', '0601', '060104', '', 'CAJAMARCA', 'CAJAMARCA', 'CHETILLA', '', 0, 0, ''),
(556, '06', '0601', '060105', '', 'CAJAMARCA', 'CAJAMARCA', 'ENCAÑADA', '', 0, 0, ''),
(557, '06', '0601', '060106', '', 'CAJAMARCA', 'CAJAMARCA', 'JESUS', '', 0, 0, ''),
(558, '06', '0601', '060107', '', 'CAJAMARCA', 'CAJAMARCA', 'LOS BA', '', 0, 0, ''),
(559, '06', '0601', '060108', '', 'CAJAMARCA', 'CAJAMARCA', 'LLACANORA', '', 0, 0, ''),
(560, '06', '0601', '060109', '', 'CAJAMARCA', 'CAJAMARCA', 'MAGDALENA', '', 0, 0, ''),
(561, '06', '0601', '060110', '', 'CAJAMARCA', 'CAJAMARCA', 'MATARA', '', 0, 0, ''),
(562, '06', '0601', '060111', '', 'CAJAMARCA', 'CAJAMARCA', 'NAMORA', '', 0, 0, ''),
(563, '06', '0601', '060112', '', 'CAJAMARCA', 'CAJAMARCA', 'SAN JUAN', '', 0, 0, ''),
(564, '06', '0602', '060201', '', 'CAJAMARCA', 'CAJABAMBA', 'CAJABAMBA', '', 0, 0, ''),
(565, '06', '0602', '060202', '', 'CAJAMARCA', 'CAJABAMBA', 'CACHACHI', '', 0, 0, ''),
(566, '06', '0602', '060203', '', 'CAJAMARCA', 'CAJABAMBA', 'CONDEBAMBA', '', 0, 0, ''),
(567, '06', '0602', '060205', '', 'CAJAMARCA', 'CAJABAMBA', 'SITACOCHA', '', 0, 0, ''),
(568, '06', '0603', '060301', '', 'CAJAMARCA', 'CELENDIN', 'CELENDIN', '', 0, 0, ''),
(569, '06', '0603', '060302', '', 'CAJAMARCA', 'CELENDIN', 'CORTEGANA', '', 0, 0, ''),
(570, '06', '0603', '060303', '', 'CAJAMARCA', 'CELENDIN', 'CHUMUCH', '', 0, 0, ''),
(571, '06', '0603', '060304', '', 'CAJAMARCA', 'CELENDIN', 'HUASMIN', '', 0, 0, ''),
(572, '06', '0603', '060305', '', 'CAJAMARCA', 'CELENDIN', 'JORGE CHAVEZ', '', 0, 0, ''),
(573, '06', '0603', '060306', '', 'CAJAMARCA', 'CELENDIN', 'JOSE GALVEZ', '', 0, 0, ''),
(574, '06', '0603', '060307', '', 'CAJAMARCA', 'CELENDIN', 'MIGUEL IGLESIAS', '', 0, 0, ''),
(575, '06', '0603', '060308', '', 'CAJAMARCA', 'CELENDIN', 'OXAMARCA', '', 0, 0, ''),
(576, '06', '0603', '060309', '', 'CAJAMARCA', 'CELENDIN', 'SOROCHUCO', '', 0, 0, ''),
(577, '06', '0603', '060310', '', 'CAJAMARCA', 'CELENDIN', 'SUCRE', '', 0, 0, ''),
(578, '06', '0603', '060311', '', 'CAJAMARCA', 'CELENDIN', 'UTCO', '', 0, 0, ''),
(579, '06', '0603', '060312', '', 'CAJAMARCA', 'CELENDIN', 'LA LIBERTAD DE PALLAN', '', 0, 0, ''),
(580, '06', '0604', '060401', '', 'CAJAMARCA', 'CONTUMAZA', 'CONTUMAZA', '', 0, 0, ''),
(581, '06', '0604', '060403', '', 'CAJAMARCA', 'CONTUMAZA', 'CHILETE', '', 0, 0, ''),
(582, '06', '0604', '060404', '', 'CAJAMARCA', 'CONTUMAZA', 'GUZMANGO', '', 0, 0, ''),
(583, '06', '0604', '060405', '', 'CAJAMARCA', 'CONTUMAZA', 'SAN BENITO', '', 0, 0, ''),
(584, '06', '0604', '060406', '', 'CAJAMARCA', 'CONTUMAZA', 'CUPISNIQUE', '', 0, 0, ''),
(585, '06', '0604', '060407', '', 'CAJAMARCA', 'CONTUMAZA', 'TANTARICA', '', 0, 0, ''),
(586, '06', '0604', '060408', '', 'CAJAMARCA', 'CONTUMAZA', 'YONAN', '', 0, 0, ''),
(587, '06', '0604', '060409', '', 'CAJAMARCA', 'CONTUMAZA', 'SANTA CRUZ DE TOLED', '', 0, 0, ''),
(588, '06', '0605', '060501', '', 'CAJAMARCA', 'CUTERVO', 'CUTERVO', '', 0, 0, ''),
(589, '06', '0605', '060502', '', 'CAJAMARCA', 'CUTERVO', 'CALLAYUC', '', 0, 0, ''),
(590, '06', '0605', '060503', '', 'CAJAMARCA', 'CUTERVO', 'CUJILLO', '', 0, 0, ''),
(591, '06', '0605', '060504', '', 'CAJAMARCA', 'CUTERVO', 'CHOROS', '', 0, 0, ''),
(592, '06', '0605', '060505', '', 'CAJAMARCA', 'CUTERVO', 'LA RAMADA', '', 0, 0, ''),
(593, '06', '0605', '060506', '', 'CAJAMARCA', 'CUTERVO', 'PIMPINGOS', '', 0, 0, ''),
(594, '06', '0605', '060507', '', 'CAJAMARCA', 'CUTERVO', 'QUEROCOTILLO', '', 0, 0, '');
INSERT INTO `ubigeo` (`id`, `department_id`, `province_id`, `district_id`, `pais`, `department`, `province`, `district`, `pais_id`, `latitude`, `longitud`, `district_id_standart`) VALUES
(595, '06', '0605', '060508', '', 'CAJAMARCA', 'CUTERVO', 'SAN ANDRES DE CUTERVO', '', 0, 0, ''),
(596, '06', '0605', '060509', '', 'CAJAMARCA', 'CUTERVO', 'SAN JUAN DE CUTERVO', '', 0, 0, ''),
(597, '06', '0605', '060510', '', 'CAJAMARCA', 'CUTERVO', 'SAN LUIS DE LUCMA', '', 0, 0, ''),
(598, '06', '0605', '060511', '', 'CAJAMARCA', 'CUTERVO', 'SANTA CRUZ', '', 0, 0, ''),
(599, '06', '0605', '060512', '', 'CAJAMARCA', 'CUTERVO', 'SANTO DOMINGO DE LA CAPILLA', '', 0, 0, ''),
(600, '06', '0605', '060513', '', 'CAJAMARCA', 'CUTERVO', 'SANTO TOMAS', '', 0, 0, ''),
(601, '06', '0605', '060514', '', 'CAJAMARCA', 'CUTERVO', 'SOCOTA', '', 0, 0, ''),
(602, '06', '0605', '060515', '', 'CAJAMARCA', 'CUTERVO', 'TORIBIO CASANOVA', '', 0, 0, ''),
(603, '06', '0606', '060601', '', 'CAJAMARCA', 'CHOTA', 'CHOTA', '', 0, 0, ''),
(604, '06', '0606', '060602', '', 'CAJAMARCA', 'CHOTA', 'ANGUIA', '', 0, 0, ''),
(605, '06', '0606', '060603', '', 'CAJAMARCA', 'CHOTA', 'COCHABAMBA', '', 0, 0, ''),
(606, '06', '0606', '060604', '', 'CAJAMARCA', 'CHOTA', 'CONCHAN', '', 0, 0, ''),
(607, '06', '0606', '060605', '', 'CAJAMARCA', 'CHOTA', 'CHADIN', '', 0, 0, ''),
(608, '06', '0606', '060606', '', 'CAJAMARCA', 'CHOTA', 'CHIGUIRIP', '', 0, 0, ''),
(609, '06', '0606', '060607', '', 'CAJAMARCA', 'CHOTA', 'CHIMBAN', '', 0, 0, ''),
(610, '06', '0606', '060608', '', 'CAJAMARCA', 'CHOTA', 'HUAMBOS', '', 0, 0, ''),
(611, '06', '0606', '060609', '', 'CAJAMARCA', 'CHOTA', 'LAJAS', '', 0, 0, ''),
(612, '06', '0606', '060610', '', 'CAJAMARCA', 'CHOTA', 'LLAMA', '', 0, 0, ''),
(613, '06', '0606', '060611', '', 'CAJAMARCA', 'CHOTA', 'MIRACOSTA', '', 0, 0, ''),
(614, '06', '0606', '060612', '', 'CAJAMARCA', 'CHOTA', 'PACCHA', '', 0, 0, ''),
(615, '06', '0606', '060613', '', 'CAJAMARCA', 'CHOTA', 'PION', '', 0, 0, ''),
(616, '06', '0606', '060614', '', 'CAJAMARCA', 'CHOTA', 'QUEROCOTO', '', 0, 0, ''),
(617, '06', '0606', '060615', '', 'CAJAMARCA', 'CHOTA', 'TACABAMBA', '', 0, 0, ''),
(618, '06', '0606', '060616', '', 'CAJAMARCA', 'CHOTA', 'TOCMOCHE', '', 0, 0, ''),
(619, '06', '0606', '060617', '', 'CAJAMARCA', 'CHOTA', 'SAN JUAN DE LICUPIS', '', 0, 0, ''),
(620, '06', '0606', '060618', '', 'CAJAMARCA', 'CHOTA', 'CHOROPAMPA', '', 0, 0, ''),
(621, '06', '0606', '060619', '', 'CAJAMARCA', 'CHOTA', 'CHALAMARCA', '', 0, 0, ''),
(622, '06', '0607', '060701', '', 'CAJAMARCA', 'HUALGAYOC', 'BAMBAMARCA', '', 0, 0, ''),
(623, '06', '0607', '060702', '', 'CAJAMARCA', 'HUALGAYOC', 'CHUGUR', '', 0, 0, ''),
(624, '06', '0607', '060703', '', 'CAJAMARCA', 'HUALGAYOC', 'HUALGAYOC', '', 0, 0, ''),
(625, '06', '0608', '060801', '', 'CAJAMARCA', 'JAEN', 'JAEN', '', 0, 0, ''),
(626, '06', '0608', '060802', '', 'CAJAMARCA', 'JAEN', 'BELLAVISTA', '', 0, 0, ''),
(627, '06', '0608', '060803', '', 'CAJAMARCA', 'JAEN', 'COLASAY', '', 0, 0, ''),
(628, '06', '0608', '060804', '', 'CAJAMARCA', 'JAEN', 'CHONTALI', '', 0, 0, ''),
(629, '06', '0608', '060805', '', 'CAJAMARCA', 'JAEN', 'POMAHUACA', '', 0, 0, ''),
(630, '06', '0608', '060806', '', 'CAJAMARCA', 'JAEN', 'PUCARA', '', 0, 0, ''),
(631, '06', '0608', '060807', '', 'CAJAMARCA', 'JAEN', 'SALLIQUE', '', 0, 0, ''),
(632, '06', '0608', '060808', '', 'CAJAMARCA', 'JAEN', 'SAN FELIPE', '', 0, 0, ''),
(633, '06', '0608', '060809', '', 'CAJAMARCA', 'JAEN', 'SAN JOSE DEL ALTO', '', 0, 0, ''),
(634, '06', '0608', '060810', '', 'CAJAMARCA', 'JAEN', 'SANTA ROSA', '', 0, 0, ''),
(635, '06', '0608', '060811', '', 'CAJAMARCA', 'JAEN', 'LAS PIRIAS', '', 0, 0, ''),
(636, '06', '0608', '060812', '', 'CAJAMARCA', 'JAEN', 'HUABAL', '', 0, 0, ''),
(637, '06', '0609', '060901', '', 'CAJAMARCA', 'SANTA CRUZ', 'SANTA CRUZ', '', 0, 0, ''),
(638, '06', '0609', '060902', '', 'CAJAMARCA', 'SANTA CRUZ', 'CATACHE', '', 0, 0, ''),
(639, '06', '0609', '060903', '', 'CAJAMARCA', 'SANTA CRUZ', 'CHANCAYBAÑOS', '', 0, 0, ''),
(640, '06', '0609', '060904', '', 'CAJAMARCA', 'SANTA CRUZ', 'LA ESPERANZA', '', 0, 0, ''),
(641, '06', '0609', '060905', '', 'CAJAMARCA', 'SANTA CRUZ', 'NINABAMBA', '', 0, 0, ''),
(642, '06', '0609', '060906', '', 'CAJAMARCA', 'SANTA CRUZ', 'PULAN', '', 0, 0, ''),
(643, '06', '0609', '060907', '', 'CAJAMARCA', 'SANTA CRUZ', 'SEXI', '', 0, 0, ''),
(644, '06', '0609', '060908', '', 'CAJAMARCA', 'SANTA CRUZ', 'UTICYACU', '', 0, 0, ''),
(645, '06', '0609', '060909', '', 'CAJAMARCA', 'SANTA CRUZ', 'YAUYUCAN', '', 0, 0, ''),
(646, '06', '0609', '060910', '', 'CAJAMARCA', 'SANTA CRUZ', 'ANDABAMBA', '', 0, 0, ''),
(647, '06', '0609', '060911', '', 'CAJAMARCA', 'SANTA CRUZ', 'SAUCEPAMPA', '', 0, 0, ''),
(648, '06', '0610', '061001', '', 'CAJAMARCA', 'SAN MIGUEL', 'SAN MIGUEL', '', 0, 0, ''),
(649, '06', '0610', '061002', '', 'CAJAMARCA', 'SAN MIGUEL', 'CALQUIS', '', 0, 0, ''),
(650, '06', '0610', '061003', '', 'CAJAMARCA', 'SAN MIGUEL', 'LA FLORIDA', '', 0, 0, ''),
(651, '06', '0610', '061004', '', 'CAJAMARCA', 'SAN MIGUEL', 'LLAPA', '', 0, 0, ''),
(652, '06', '0610', '061005', '', 'CAJAMARCA', 'SAN MIGUEL', 'NANCHOC', '', 0, 0, ''),
(653, '06', '0610', '061006', '', 'CAJAMARCA', 'SAN MIGUEL', 'NIEPOS', '', 0, 0, ''),
(654, '06', '0610', '061007', '', 'CAJAMARCA', 'SAN MIGUEL', 'SAN GREGORIO', '', 0, 0, ''),
(655, '06', '0610', '061008', '', 'CAJAMARCA', 'SAN MIGUEL', 'SAN SILVESTRE DE COCHAN', '', 0, 0, ''),
(656, '06', '0610', '061009', '', 'CAJAMARCA', 'SAN MIGUEL', 'EL PRADO', '', 0, 0, ''),
(657, '06', '0610', '061010', '', 'CAJAMARCA', 'SAN MIGUEL', 'UNION AGUA BLANCA', '', 0, 0, ''),
(658, '06', '0610', '061011', '', 'CAJAMARCA', 'SAN MIGUEL', 'TONGOD', '', 0, 0, ''),
(659, '06', '0610', '061012', '', 'CAJAMARCA', 'SAN MIGUEL', 'CATILLUC', '', 0, 0, ''),
(660, '06', '0610', '061013', '', 'CAJAMARCA', 'SAN MIGUEL', 'BOLIVAR', '', 0, 0, ''),
(661, '06', '0611', '061101', '', 'CAJAMARCA', 'SAN IGNACIO', 'SAN IGNACIO', '', 0, 0, ''),
(662, '06', '0611', '061102', '', 'CAJAMARCA', 'SAN IGNACIO', 'CHIRINOS', '', 0, 0, ''),
(663, '06', '0611', '061103', '', 'CAJAMARCA', 'SAN IGNACIO', 'HUARANGO', '', 0, 0, ''),
(664, '06', '0611', '061104', '', 'CAJAMARCA', 'SAN IGNACIO', 'NAMBALLE', '', 0, 0, ''),
(665, '06', '0611', '061105', '', 'CAJAMARCA', 'SAN IGNACIO', 'LA COIPA', '', 0, 0, ''),
(666, '06', '0611', '061106', '', 'CAJAMARCA', 'SAN IGNACIO', 'SAN JOSE DE LOURDES', '', 0, 0, ''),
(667, '06', '0611', '061107', '', 'CAJAMARCA', 'SAN IGNACIO', 'TABACONAS', '', 0, 0, ''),
(668, '06', '0612', '061201', '', 'CAJAMARCA', 'SAN MARCOS', 'PEDRO GALVEZ', '', 0, 0, ''),
(669, '06', '0612', '061202', '', 'CAJAMARCA', 'SAN MARCOS', 'ICHOCAN', '', 0, 0, ''),
(670, '06', '0612', '061203', '', 'CAJAMARCA', 'SAN MARCOS', 'GREGORIO PITA', '', 0, 0, ''),
(671, '06', '0612', '061204', '', 'CAJAMARCA', 'SAN MARCOS', 'JOSE MANUEL QUIROZ', '', 0, 0, ''),
(672, '06', '0612', '061205', '', 'CAJAMARCA', 'SAN MARCOS', 'EDUARDO VILLANUEVA', '', 0, 0, ''),
(673, '06', '0612', '061206', '', 'CAJAMARCA', 'SAN MARCOS', 'JOSE SABOGAL', '', 0, 0, ''),
(674, '06', '0612', '061207', '', 'CAJAMARCA', 'SAN MARCOS', 'CHANCAY', '', 0, 0, ''),
(675, '06', '0613', '061301', '', 'CAJAMARCA', 'SAN PABLO', 'SAN PABLO', '', 0, 0, ''),
(676, '06', '0613', '061302', '', 'CAJAMARCA', 'SAN PABLO', 'SAN BERNARDINO', '', 0, 0, ''),
(677, '06', '0613', '061303', '', 'CAJAMARCA', 'SAN PABLO', 'SAN LUIS', '', 0, 0, ''),
(678, '06', '0613', '061304', '', 'CAJAMARCA', 'SAN PABLO', 'TUMBADEN', '', 0, 0, ''),
(679, '07', '0701', '070101', '', 'CUSCO', 'CUSCO', 'CUSCO', '', 0, 0, ''),
(680, '07', '0701', '070102', '', 'CUSCO', 'CUSCO', 'CCORCA', '', 0, 0, ''),
(681, '07', '0701', '070103', '', 'CUSCO', 'CUSCO', 'POROY', '', 0, 0, ''),
(682, '07', '0701', '070104', '', 'CUSCO', 'CUSCO', 'SAN JERONIMO', '', 0, 0, ''),
(683, '07', '0701', '070105', '', 'CUSCO', 'CUSCO', 'SAN SEBASTIAN', '', 0, 0, ''),
(684, '07', '0701', '070106', '', 'CUSCO', 'CUSCO', 'SANTIAGO', '', 0, 0, ''),
(685, '07', '0701', '070107', '', 'CUSCO', 'CUSCO', 'SAYLLA', '', 0, 0, ''),
(686, '07', '0701', '070108', '', 'CUSCO', 'CUSCO', 'WANCHAQ', '', 0, 0, ''),
(687, '07', '0702', '070201', '', 'CUSCO', 'ACOMAYO', 'ACOMAYO', '', 0, 0, ''),
(688, '07', '0702', '070202', '', 'CUSCO', 'ACOMAYO', 'ACOPIA', '', 0, 0, ''),
(689, '07', '0702', '070203', '', 'CUSCO', 'ACOMAYO', 'ACOS', '', 0, 0, ''),
(690, '07', '0702', '070204', '', 'CUSCO', 'ACOMAYO', 'POMACANCHI', '', 0, 0, ''),
(691, '07', '0702', '070205', '', 'CUSCO', 'ACOMAYO', 'RONDOCAN', '', 0, 0, ''),
(692, '07', '0702', '070206', '', 'CUSCO', 'ACOMAYO', 'SANGARARA', '', 0, 0, ''),
(693, '07', '0702', '070207', '', 'CUSCO', 'ACOMAYO', 'MOSOC LLACTA', '', 0, 0, ''),
(694, '07', '0703', '070301', '', 'CUSCO', 'ANTA', 'ANTA', '', 0, 0, ''),
(695, '07', '0703', '070302', '', 'CUSCO', 'ANTA', 'CHINCHAYPUJIO', '', 0, 0, ''),
(696, '07', '0703', '070303', '', 'CUSCO', 'ANTA', 'HUAROCONDO', '', 0, 0, ''),
(697, '07', '0703', '070304', '', 'CUSCO', 'ANTA', 'LIMATAMBO', '', 0, 0, ''),
(698, '07', '0703', '070305', '', 'CUSCO', 'ANTA', 'MOLLEPATA', '', 0, 0, ''),
(699, '07', '0703', '070306', '', 'CUSCO', 'ANTA', 'PUCYURA', '', 0, 0, ''),
(700, '07', '0703', '070307', '', 'CUSCO', 'ANTA', 'ZURITE', '', 0, 0, ''),
(701, '07', '0703', '070308', '', 'CUSCO', 'ANTA', 'CACHIMAYO', '', 0, 0, ''),
(702, '07', '0703', '070309', '', 'CUSCO', 'ANTA', 'ANCAHUASI', '', 0, 0, ''),
(703, '07', '0704', '070401', '', 'CUSCO', 'CALCA', 'CALCA', '', 0, 0, ''),
(704, '07', '0704', '070402', '', 'CUSCO', 'CALCA', 'COYA', '', 0, 0, ''),
(705, '07', '0704', '070403', '', 'CUSCO', 'CALCA', 'LAMAY', '', 0, 0, ''),
(706, '07', '0704', '070404', '', 'CUSCO', 'CALCA', 'LARES', '', 0, 0, ''),
(707, '07', '0704', '070405', '', 'CUSCO', 'CALCA', 'PISAC', '', 0, 0, ''),
(708, '07', '0704', '070406', '', 'CUSCO', 'CALCA', 'SAN SALVADOR', '', 0, 0, ''),
(709, '07', '0704', '070407', '', 'CUSCO', 'CALCA', 'TARAY', '', 0, 0, ''),
(710, '07', '0704', '070408', '', 'CUSCO', 'CALCA', 'YANATILE', '', 0, 0, ''),
(711, '07', '0705', '070501', '', 'CUSCO', 'CANAS', 'YANAOCA', '', 0, 0, ''),
(712, '07', '0705', '070502', '', 'CUSCO', 'CANAS', 'CHECCA', '', 0, 0, ''),
(713, '07', '0705', '070503', '', 'CUSCO', 'CANAS', 'KUNTURKANKI', '', 0, 0, ''),
(714, '07', '0705', '070504', '', 'CUSCO', 'CANAS', 'LANGUI', '', 0, 0, ''),
(715, '07', '0705', '070505', '', 'CUSCO', 'CANAS', 'LAYO', '', 0, 0, ''),
(716, '07', '0705', '070506', '', 'CUSCO', 'CANAS', 'PAMPAMARCA', '', 0, 0, ''),
(717, '07', '0705', '070507', '', 'CUSCO', 'CANAS', 'QUEHUE', '', 0, 0, ''),
(718, '07', '0705', '070508', '', 'CUSCO', 'CANAS', 'TUPAC AMARU', '', 0, 0, ''),
(719, '07', '0706', '070601', '', 'CUSCO', 'CANCHIS', 'SICUANI', '', 0, 0, ''),
(720, '07', '0706', '070602', '', 'CUSCO', 'CANCHIS', 'COMBAPATA', '', 0, 0, ''),
(721, '07', '0706', '070603', '', 'CUSCO', 'CANCHIS', 'CHECACUPE', '', 0, 0, ''),
(722, '07', '0706', '070604', '', 'CUSCO', 'CANCHIS', 'MARANGANI', '', 0, 0, ''),
(723, '07', '0706', '070605', '', 'CUSCO', 'CANCHIS', 'PITUMARCA', '', 0, 0, ''),
(724, '07', '0706', '070606', '', 'CUSCO', 'CANCHIS', 'SAN PABLO', '', 0, 0, ''),
(725, '07', '0706', '070607', '', 'CUSCO', 'CANCHIS', 'SAN PEDRO', '', 0, 0, ''),
(726, '07', '0706', '070608', '', 'CUSCO', 'CANCHIS', 'TINTA', '', 0, 0, ''),
(727, '07', '0707', '070701', '', 'CUSCO', 'CHUMBIVILCAS', 'SANTO TOMAS', '', 0, 0, ''),
(728, '07', '0707', '070702', '', 'CUSCO', 'CHUMBIVILCAS', 'CAPACMARCA', '', 0, 0, ''),
(729, '07', '0707', '070703', '', 'CUSCO', 'CHUMBIVILCAS', 'COLQUEMARCA', '', 0, 0, ''),
(730, '07', '0707', '070704', '', 'CUSCO', 'CHUMBIVILCAS', 'CHAMACA', '', 0, 0, ''),
(731, '07', '0707', '070705', '', 'CUSCO', 'CHUMBIVILCAS', 'LIVITACA', '', 0, 0, ''),
(732, '07', '0707', '070706', '', 'CUSCO', 'CHUMBIVILCAS', 'LLUSCO', '', 0, 0, ''),
(733, '07', '0707', '070707', '', 'CUSCO', 'CHUMBIVILCAS', 'QUI', '', 0, 0, ''),
(734, '07', '0707', '070708', '', 'CUSCO', 'CHUMBIVILCAS', 'VELILLE', '', 0, 0, ''),
(735, '07', '0708', '070801', '', 'CUSCO', 'ESPINAR', 'ESPINAR', '', 0, 0, ''),
(736, '07', '0708', '070802', '', 'CUSCO', 'ESPINAR', 'CONDOROMA', '', 0, 0, ''),
(737, '07', '0708', '070803', '', 'CUSCO', 'ESPINAR', 'COPORAQUE', '', 0, 0, ''),
(738, '07', '0708', '070804', '', 'CUSCO', 'ESPINAR', 'OCORURO', '', 0, 0, ''),
(739, '07', '0708', '070805', '', 'CUSCO', 'ESPINAR', 'PALLPATA', '', 0, 0, ''),
(740, '07', '0708', '070806', '', 'CUSCO', 'ESPINAR', 'PICHIGUA', '', 0, 0, ''),
(741, '07', '0708', '070807', '', 'CUSCO', 'ESPINAR', 'SUYCKUTAMBO', '', 0, 0, ''),
(742, '07', '0708', '070808', '', 'CUSCO', 'ESPINAR', 'ALTO PICHIGUA', '', 0, 0, ''),
(743, '07', '0709', '070901', '', 'CUSCO', 'LA CONVENCION', 'SANTA ANA', '', 0, 0, ''),
(744, '07', '0709', '070902', '', 'CUSCO', 'LA CONVENCION', 'ECHARATE', '', 0, 0, ''),
(745, '07', '0709', '070903', '', 'CUSCO', 'LA CONVENCION', 'HUAYOPATA', '', 0, 0, ''),
(746, '07', '0709', '070904', '', 'CUSCO', 'LA CONVENCION', 'MARANURA', '', 0, 0, ''),
(747, '07', '0709', '070905', '', 'CUSCO', 'LA CONVENCION', 'OCOBAMBA', '', 0, 0, ''),
(748, '07', '0709', '070906', '', 'CUSCO', 'LA CONVENCION', 'SANTA TERESA', '', 0, 0, ''),
(749, '07', '0709', '070907', '', 'CUSCO', 'LA CONVENCION', 'VILCABAMBA', '', 0, 0, ''),
(750, '07', '0709', '070908', '', 'CUSCO', 'LA CONVENCION', 'QUELLOUNO', '', 0, 0, ''),
(751, '07', '0709', '070909', '', 'CUSCO', 'LA CONVENCION', 'KIMBIRI', '', 0, 0, ''),
(752, '07', '0709', '070910', '', 'CUSCO', 'LA CONVENCION', 'PICHARI', '', 0, 0, ''),
(753, '07', '0710', '071001', '', 'CUSCO', 'PARURO', 'PARURO', '', 0, 0, ''),
(754, '07', '0710', '071002', '', 'CUSCO', 'PARURO', 'ACCHA', '', 0, 0, ''),
(755, '07', '0710', '071003', '', 'CUSCO', 'PARURO', 'CCAPI', '', 0, 0, ''),
(756, '07', '0710', '071004', '', 'CUSCO', 'PARURO', 'COLCHA', '', 0, 0, ''),
(757, '07', '0710', '071005', '', 'CUSCO', 'PARURO', 'HUANOQUITE', '', 0, 0, ''),
(758, '07', '0710', '071006', '', 'CUSCO', 'PARURO', 'OMACHA', '', 0, 0, ''),
(759, '07', '0710', '071007', '', 'CUSCO', 'PARURO', 'YAURISQUE', '', 0, 0, ''),
(760, '07', '0710', '071008', '', 'CUSCO', 'PARURO', 'PACCARITAMBO', '', 0, 0, ''),
(761, '07', '0710', '071009', '', 'CUSCO', 'PARURO', 'PILLPINTO', '', 0, 0, ''),
(762, '07', '0711', '071101', '', 'CUSCO', 'PAUCARTAMBO', 'PAUCARTAMBO', '', 0, 0, ''),
(763, '07', '0711', '071102', '', 'CUSCO', 'PAUCARTAMBO', 'CAICAY', '', 0, 0, ''),
(764, '07', '0711', '071103', '', 'CUSCO', 'PAUCARTAMBO', 'COLQUEPATA', '', 0, 0, ''),
(765, '07', '0711', '071104', '', 'CUSCO', 'PAUCARTAMBO', 'CHALLABAMBA', '', 0, 0, ''),
(766, '07', '0711', '071105', '', 'CUSCO', 'PAUCARTAMBO', 'KOSÑIPATA', '', 0, 0, ''),
(767, '07', '0711', '071106', '', 'CUSCO', 'PAUCARTAMBO', 'HUANCARANI', '', 0, 0, ''),
(768, '07', '0712', '071201', '', 'CUSCO', 'QUISPICANCHI', 'URCOS', '', 0, 0, ''),
(769, '07', '0712', '071202', '', 'CUSCO', 'QUISPICANCHI', 'ANDAHUAYLILLAS', '', 0, 0, ''),
(770, '07', '0712', '071203', '', 'CUSCO', 'QUISPICANCHI', 'CAMANTI', '', 0, 0, ''),
(771, '07', '0712', '071204', '', 'CUSCO', 'QUISPICANCHI', 'CCARHUAYO', '', 0, 0, ''),
(772, '07', '0712', '071205', '', 'CUSCO', 'QUISPICANCHI', 'CCATCA', '', 0, 0, ''),
(773, '07', '0712', '071206', '', 'CUSCO', 'QUISPICANCHI', 'CUSIPATA', '', 0, 0, ''),
(774, '07', '0712', '071207', '', 'CUSCO', 'QUISPICANCHI', 'HUARO', '', 0, 0, ''),
(775, '07', '0712', '071208', '', 'CUSCO', 'QUISPICANCHI', 'LUCRE', '', 0, 0, ''),
(776, '07', '0712', '071209', '', 'CUSCO', 'QUISPICANCHI', 'MARCAPATA', '', 0, 0, ''),
(777, '07', '0712', '071210', '', 'CUSCO', 'QUISPICANCHI', 'OCONGATE', '', 0, 0, ''),
(778, '07', '0712', '071211', '', 'CUSCO', 'QUISPICANCHI', 'OROPESA', '', 0, 0, ''),
(779, '07', '0712', '071212', '', 'CUSCO', 'QUISPICANCHI', 'QUIQUIJANA', '', 0, 0, ''),
(780, '07', '0713', '071301', '', 'CUSCO', 'URUBAMBA', 'URUBAMBA', '', 0, 0, ''),
(781, '07', '0713', '071302', '', 'CUSCO', 'URUBAMBA', 'CHINCHERO', '', 0, 0, ''),
(782, '07', '0713', '071303', '', 'CUSCO', 'URUBAMBA', 'HUAYLLABAMBA', '', 0, 0, ''),
(783, '07', '0713', '071304', '', 'CUSCO', 'URUBAMBA', 'MACHUPICCHU', '', 0, 0, ''),
(784, '07', '0713', '071305', '', 'CUSCO', 'URUBAMBA', 'MARAS', '', 0, 0, ''),
(785, '07', '0713', '071306', '', 'CUSCO', 'URUBAMBA', 'OLLANTAYTAMBO', '', 0, 0, ''),
(786, '07', '0713', '071307', '', 'CUSCO', 'URUBAMBA', 'YUCAY', '', 0, 0, ''),
(787, '08', '0801', '080101', '', 'HUANCAVELICA', 'HUANCAVELICA', 'HUANCAVELICA', '', 0, 0, ''),
(788, '08', '0801', '080102', '', 'HUANCAVELICA', 'HUANCAVELICA', 'ACOBAMBILLA', '', 0, 0, ''),
(789, '08', '0801', '080103', '', 'HUANCAVELICA', 'HUANCAVELICA', 'ACORIA', '', 0, 0, ''),
(790, '08', '0801', '080104', '', 'HUANCAVELICA', 'HUANCAVELICA', 'CONAYCA', '', 0, 0, ''),
(791, '08', '0801', '080105', '', 'HUANCAVELICA', 'HUANCAVELICA', 'CUENCA', '', 0, 0, ''),
(792, '08', '0801', '080106', '', 'HUANCAVELICA', 'HUANCAVELICA', 'HUACHOCOLPA', '', 0, 0, ''),
(793, '08', '0801', '080108', '', 'HUANCAVELICA', 'HUANCAVELICA', 'HUAYLLAHUARA', '', 0, 0, ''),
(794, '08', '0801', '080109', '', 'HUANCAVELICA', 'HUANCAVELICA', 'IZCUCHACA', '', 0, 0, ''),
(795, '08', '0801', '080110', '', 'HUANCAVELICA', 'HUANCAVELICA', 'LARIA', '', 0, 0, ''),
(796, '08', '0801', '080111', '', 'HUANCAVELICA', 'HUANCAVELICA', 'MANTA', '', 0, 0, ''),
(797, '08', '0801', '080112', '', 'HUANCAVELICA', 'HUANCAVELICA', 'MARISCAL CACERES', '', 0, 0, ''),
(798, '08', '0801', '080113', '', 'HUANCAVELICA', 'HUANCAVELICA', 'MOYA', '', 0, 0, ''),
(799, '08', '0801', '080114', '', 'HUANCAVELICA', 'HUANCAVELICA', 'NUEVO OCCORO', '', 0, 0, ''),
(800, '08', '0801', '080115', '', 'HUANCAVELICA', 'HUANCAVELICA', 'PALCA', '', 0, 0, ''),
(801, '08', '0801', '080116', '', 'HUANCAVELICA', 'HUANCAVELICA', 'PILCHACA', '', 0, 0, ''),
(802, '08', '0801', '080117', '', 'HUANCAVELICA', 'HUANCAVELICA', 'VILCA', '', 0, 0, ''),
(803, '08', '0801', '080118', '', 'HUANCAVELICA', 'HUANCAVELICA', 'YAULI', '', 0, 0, ''),
(804, '08', '0801', '080119', '', 'HUANCAVELICA', 'HUANCAVELICA', 'ASCENSION', '', 0, 0, ''),
(805, '08', '0801', '080120', '', 'HUANCAVELICA', 'HUANCAVELICA', 'HUANDO', '', 0, 0, ''),
(806, '08', '0802', '080201', '', 'HUANCAVELICA', 'ACOBAMBA', 'ACOBAMBA', '', 0, 0, ''),
(807, '08', '0802', '080202', '', 'HUANCAVELICA', 'ACOBAMBA', 'ANTA', '', 0, 0, ''),
(808, '08', '0802', '080203', '', 'HUANCAVELICA', 'ACOBAMBA', 'ANDABAMBA', '', 0, 0, ''),
(809, '08', '0802', '080204', '', 'HUANCAVELICA', 'ACOBAMBA', 'CAJA', '', 0, 0, ''),
(810, '08', '0802', '080205', '', 'HUANCAVELICA', 'ACOBAMBA', 'MARCAS', '', 0, 0, ''),
(811, '08', '0802', '080206', '', 'HUANCAVELICA', 'ACOBAMBA', 'PAUCARA', '', 0, 0, ''),
(812, '08', '0802', '080207', '', 'HUANCAVELICA', 'ACOBAMBA', 'POMACOCHA', '', 0, 0, ''),
(813, '08', '0802', '080208', '', 'HUANCAVELICA', 'ACOBAMBA', 'ROSARIO', '', 0, 0, ''),
(814, '08', '0803', '080301', '', 'HUANCAVELICA', 'ANGARAES', 'LIRCAY', '', 0, 0, ''),
(815, '08', '0803', '080302', '', 'HUANCAVELICA', 'ANGARAES', 'ANCHONGA', '', 0, 0, ''),
(816, '08', '0803', '080303', '', 'HUANCAVELICA', 'ANGARAES', 'CALLANMARCA', '', 0, 0, ''),
(817, '08', '0803', '080304', '', 'HUANCAVELICA', 'ANGARAES', 'CONGALLA', '', 0, 0, ''),
(818, '08', '0803', '080305', '', 'HUANCAVELICA', 'ANGARAES', 'CHINCHO', '', 0, 0, ''),
(819, '08', '0803', '080306', '', 'HUANCAVELICA', 'ANGARAES', 'HUALLAY-GRANDE', '', 0, 0, ''),
(820, '08', '0803', '080307', '', 'HUANCAVELICA', 'ANGARAES', 'HUANCA-HUANCA', '', 0, 0, ''),
(821, '08', '0803', '080308', '', 'HUANCAVELICA', 'ANGARAES', 'JULCAMARCA', '', 0, 0, ''),
(822, '08', '0803', '080309', '', 'HUANCAVELICA', 'ANGARAES', 'SAN ANTONIO DE ANTAPARCO', '', 0, 0, ''),
(823, '08', '0803', '080310', '', 'HUANCAVELICA', 'ANGARAES', 'SANTO TOMAS DE PATA', '', 0, 0, ''),
(824, '08', '0803', '080311', '', 'HUANCAVELICA', 'ANGARAES', 'SECCLLA', '', 0, 0, ''),
(825, '08', '0803', '080312', '', 'HUANCAVELICA', 'ANGARAES', 'CCOCHACCASA', '', 0, 0, ''),
(826, '08', '0804', '080401', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'CASTROVIRREYNA', '', 0, 0, ''),
(827, '08', '0804', '080402', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'ARMA', '', 0, 0, ''),
(828, '08', '0804', '080403', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'AURAHUA', '', 0, 0, ''),
(829, '08', '0804', '080405', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'CAPILLAS', '', 0, 0, ''),
(830, '08', '0804', '080406', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'COCAS', '', 0, 0, ''),
(831, '08', '0804', '080408', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'CHUPAMARCA', '', 0, 0, ''),
(832, '08', '0804', '080409', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'HUACHOS', '', 0, 0, ''),
(833, '08', '0804', '080410', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'HUAMATAMBO', '', 0, 0, ''),
(834, '08', '0804', '080414', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'MOLLEPAMPA', '', 0, 0, ''),
(835, '08', '0804', '080422', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'SAN JUAN', '', 0, 0, ''),
(836, '08', '0804', '080427', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'TANTARA', '', 0, 0, ''),
(837, '08', '0804', '080428', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'TICRAPO', '', 0, 0, ''),
(838, '08', '0804', '080429', '', 'HUANCAVELICA', 'CASTROVIRREYNA', 'SANTA ANA', '', 0, 0, ''),
(839, '08', '0805', '080501', '', 'HUANCAVELICA', 'TAYACAJA', 'PAMPAS', '', 0, 0, ''),
(840, '08', '0805', '080502', '', 'HUANCAVELICA', 'TAYACAJA', 'ACOSTAMBO', '', 0, 0, ''),
(841, '08', '0805', '080503', '', 'HUANCAVELICA', 'TAYACAJA', 'ACRAQUIA', '', 0, 0, ''),
(842, '08', '0805', '080504', '', 'HUANCAVELICA', 'TAYACAJA', 'AHUAYCHA', '', 0, 0, ''),
(843, '08', '0805', '080506', '', 'HUANCAVELICA', 'TAYACAJA', 'COLCABAMBA', '', 0, 0, ''),
(844, '08', '0805', '080509', '', 'HUANCAVELICA', 'TAYACAJA', 'DANIEL HERNANDEZ', '', 0, 0, ''),
(845, '08', '0805', '080511', '', 'HUANCAVELICA', 'TAYACAJA', 'HUACHOCOLPA', '', 0, 0, ''),
(846, '08', '0805', '080512', '', 'HUANCAVELICA', 'TAYACAJA', 'HUARIBAMBA', '', 0, 0, ''),
(847, '08', '0805', '080515', '', 'HUANCAVELICA', 'TAYACAJA', 'ÑAHUIMPUQUIO', '', 0, 0, ''),
(848, '08', '0805', '080517', '', 'HUANCAVELICA', 'TAYACAJA', 'PAZOS', '', 0, 0, ''),
(849, '08', '0805', '080518', '', 'HUANCAVELICA', 'TAYACAJA', 'QUISHUAR', '', 0, 0, ''),
(850, '08', '0805', '080519', '', 'HUANCAVELICA', 'TAYACAJA', 'SALCABAMBA', '', 0, 0, ''),
(851, '08', '0805', '080520', '', 'HUANCAVELICA', 'TAYACAJA', 'SAN MARCOS DE ROCCHAC', '', 0, 0, ''),
(852, '08', '0805', '080523', '', 'HUANCAVELICA', 'TAYACAJA', 'SURCUBAMBA', '', 0, 0, ''),
(853, '08', '0805', '080525', '', 'HUANCAVELICA', 'TAYACAJA', 'TINTAY PUNCU', '', 0, 0, ''),
(854, '08', '0805', '080526', '', 'HUANCAVELICA', 'TAYACAJA', 'SALCAHUASI', '', 0, 0, ''),
(855, '08', '0806', '080601', '', 'HUANCAVELICA', 'HUAYTARA', 'AYAVI', '', 0, 0, ''),
(856, '08', '0806', '080602', '', 'HUANCAVELICA', 'HUAYTARA', 'CORDOVA', '', 0, 0, ''),
(857, '08', '0806', '080603', '', 'HUANCAVELICA', 'HUAYTARA', 'HUAYACUNDO ARMA', '', 0, 0, ''),
(858, '08', '0806', '080604', '', 'HUANCAVELICA', 'HUAYTARA', 'HUAYTARA', '', 0, 0, ''),
(859, '08', '0806', '080605', '', 'HUANCAVELICA', 'HUAYTARA', 'LARAMARCA', '', 0, 0, ''),
(860, '08', '0806', '080606', '', 'HUANCAVELICA', 'HUAYTARA', 'OCOYO', '', 0, 0, ''),
(861, '08', '0806', '080607', '', 'HUANCAVELICA', 'HUAYTARA', 'PILPICHACA', '', 0, 0, ''),
(862, '08', '0806', '080608', '', 'HUANCAVELICA', 'HUAYTARA', 'QUERCO', '', 0, 0, ''),
(863, '08', '0806', '080609', '', 'HUANCAVELICA', 'HUAYTARA', 'QUITO ARMA', '', 0, 0, ''),
(864, '08', '0806', '080610', '', 'HUANCAVELICA', 'HUAYTARA', 'SAN ANTONIO DE CUSICANCHA', '', 0, 0, ''),
(865, '08', '0806', '080611', '', 'HUANCAVELICA', 'HUAYTARA', 'SAN FRANCISCO DE SANGAYAICO', '', 0, 0, ''),
(866, '08', '0806', '080612', '', 'HUANCAVELICA', 'HUAYTARA', 'SAN ISIDRO', '', 0, 0, ''),
(867, '08', '0806', '080613', '', 'HUANCAVELICA', 'HUAYTARA', 'SANTIAGO DE CHOCORVOS', '', 0, 0, ''),
(868, '08', '0806', '080614', '', 'HUANCAVELICA', 'HUAYTARA', 'SANTIAGO DE QUIRAHUARA', '', 0, 0, ''),
(869, '08', '0806', '080615', '', 'HUANCAVELICA', 'HUAYTARA', 'SANTO DOMINGO DE CAPILLAS', '', 0, 0, ''),
(870, '08', '0806', '080616', '', 'HUANCAVELICA', 'HUAYTARA', 'TAMBO', '', 0, 0, ''),
(871, '08', '0807', '080701', '', 'HUANCAVELICA', 'CHURCAMPA', 'CHURCAMPA', '', 0, 0, ''),
(872, '08', '0807', '080702', '', 'HUANCAVELICA', 'CHURCAMPA', 'ANCO', '', 0, 0, ''),
(873, '08', '0807', '080703', '', 'HUANCAVELICA', 'CHURCAMPA', 'CHINCHIHUASI', '', 0, 0, ''),
(874, '08', '0807', '080704', '', 'HUANCAVELICA', 'CHURCAMPA', 'EL CARMEN', '', 0, 0, ''),
(875, '08', '0807', '080705', '', 'HUANCAVELICA', 'CHURCAMPA', 'LA MERCED', '', 0, 0, ''),
(876, '08', '0807', '080706', '', 'HUANCAVELICA', 'CHURCAMPA', 'LOCROJA', '', 0, 0, ''),
(877, '08', '0807', '080707', '', 'HUANCAVELICA', 'CHURCAMPA', 'PAUCARBAMBA', '', 0, 0, ''),
(878, '08', '0807', '080708', '', 'HUANCAVELICA', 'CHURCAMPA', 'SAN MIGUEL DE MAYOCC', '', 0, 0, ''),
(879, '08', '0807', '080709', '', 'HUANCAVELICA', 'CHURCAMPA', 'SAN PEDRO DE CORIS', '', 0, 0, ''),
(880, '08', '0807', '080710', '', 'HUANCAVELICA', 'CHURCAMPA', 'PACHAMARCA', '', 0, 0, ''),
(881, '08', '0807', '080711', '', 'HUANCAVELICA', 'CHURCAMPA', 'COSME', '', 0, 0, ''),
(882, '09', '0901', '090101', '', 'HUANUCO', 'HUANUCO', 'HUANUCO', '', 0, 0, ''),
(883, '09', '0901', '090102', '', 'HUANUCO', 'HUANUCO', 'CHINCHAO', '', 0, 0, ''),
(884, '09', '0901', '090103', '', 'HUANUCO', 'HUANUCO', 'CHURUBAMBA', '', 0, 0, ''),
(885, '09', '0901', '090104', '', 'HUANUCO', 'HUANUCO', 'MARGOS', '', 0, 0, ''),
(886, '09', '0901', '090105', '', 'HUANUCO', 'HUANUCO', 'QUISQUI', '', 0, 0, ''),
(887, '09', '0901', '090106', '', 'HUANUCO', 'HUANUCO', 'SAN FRANCISCO DE CAYRAN', '', 0, 0, ''),
(888, '09', '0901', '090107', '', 'HUANUCO', 'HUANUCO', 'SAN PEDRO DE CHAULAN', '', 0, 0, ''),
(889, '09', '0901', '090108', '', 'HUANUCO', 'HUANUCO', 'SANTA MARIA DEL VALLE', '', 0, 0, ''),
(890, '09', '0901', '090109', '', 'HUANUCO', 'HUANUCO', 'YARUMAYO', '', 0, 0, ''),
(891, '09', '0901', '090110', '', 'HUANUCO', 'HUANUCO', 'AMARILIS', '', 0, 0, ''),
(892, '09', '0901', '090111', '', 'HUANUCO', 'HUANUCO', 'PILLCO MARCA', '', 0, 0, ''),
(893, '09', '0901', '090112', '', 'HUANUCO', 'HUANUCO', 'YACUS', '', 0, 0, ''),
(894, '09', '0902', '090201', '', 'HUANUCO', 'AMBO', 'AMBO', '', 0, 0, ''),
(895, '09', '0902', '090202', '', 'HUANUCO', 'AMBO', 'CAYNA', '', 0, 0, ''),
(896, '09', '0902', '090203', '', 'HUANUCO', 'AMBO', 'COLPAS', '', 0, 0, ''),
(897, '09', '0902', '090204', '', 'HUANUCO', 'AMBO', 'CONCHAMARCA', '', 0, 0, ''),
(898, '09', '0902', '090205', '', 'HUANUCO', 'AMBO', 'HUACAR', '', 0, 0, ''),
(899, '09', '0902', '090206', '', 'HUANUCO', 'AMBO', 'SAN FRANCISCO', '', 0, 0, ''),
(900, '09', '0902', '090207', '', 'HUANUCO', 'AMBO', 'SAN RAFAEL', '', 0, 0, ''),
(901, '09', '0902', '090208', '', 'HUANUCO', 'AMBO', 'TOMAY-KICHWA', '', 0, 0, ''),
(902, '09', '0903', '090301', '', 'HUANUCO', 'DOS DE MAYO', 'LA UNION', '', 0, 0, ''),
(903, '09', '0903', '090307', '', 'HUANUCO', 'DOS DE MAYO', 'CHUQUIS', '', 0, 0, ''),
(904, '09', '0903', '090312', '', 'HUANUCO', 'DOS DE MAYO', 'MARIAS', '', 0, 0, ''),
(905, '09', '0903', '090314', '', 'HUANUCO', 'DOS DE MAYO', 'PACHAS', '', 0, 0, ''),
(906, '09', '0903', '090316', '', 'HUANUCO', 'DOS DE MAYO', 'QUIVILLA', '', 0, 0, ''),
(907, '09', '0903', '090317', '', 'HUANUCO', 'DOS DE MAYO', 'RIPAN', '', 0, 0, ''),
(908, '09', '0903', '090321', '', 'HUANUCO', 'DOS DE MAYO', 'SHUNQUI', '', 0, 0, ''),
(909, '09', '0903', '090322', '', 'HUANUCO', 'DOS DE MAYO', 'SILLAPATA', '', 0, 0, ''),
(910, '09', '0903', '090323', '', 'HUANUCO', 'DOS DE MAYO', 'YANAS', '', 0, 0, ''),
(911, '09', '0904', '090401', '', 'HUANUCO', 'HUAMALIES', 'LLATA', '', 0, 0, ''),
(912, '09', '0904', '090402', '', 'HUANUCO', 'HUAMALIES', 'ARANCAY', '', 0, 0, ''),
(913, '09', '0904', '090403', '', 'HUANUCO', 'HUAMALIES', 'CHAVIN DE PARIARCA', '', 0, 0, ''),
(914, '09', '0904', '090404', '', 'HUANUCO', 'HUAMALIES', 'JACAS GRANDE', '', 0, 0, ''),
(915, '09', '0904', '090405', '', 'HUANUCO', 'HUAMALIES', 'JIRCAN', '', 0, 0, ''),
(916, '09', '0904', '090406', '', 'HUANUCO', 'HUAMALIES', 'MIRAFLORES', '', 0, 0, ''),
(917, '09', '0904', '090407', '', 'HUANUCO', 'HUAMALIES', 'MONZON', '', 0, 0, ''),
(918, '09', '0904', '090408', '', 'HUANUCO', 'HUAMALIES', 'PUNCHAO', '', 0, 0, ''),
(919, '09', '0904', '090409', '', 'HUANUCO', 'HUAMALIES', 'PUÑOS', '', 0, 0, ''),
(920, '09', '0904', '090410', '', 'HUANUCO', 'HUAMALIES', 'SINGA', '', 0, 0, ''),
(921, '09', '0904', '090411', '', 'HUANUCO', 'HUAMALIES', 'TANTAMAYO', '', 0, 0, ''),
(922, '09', '0905', '090501', '', 'HUANUCO', 'MARAÑON', 'HUACRACHUCO', '', 0, 0, ''),
(923, '09', '0905', '090502', '', 'HUANUCO', 'MARAÑON', 'CHOLON', '', 0, 0, ''),
(924, '09', '0905', '090505', '', 'HUANUCO', 'MARAÑON', 'SAN BUENAVENTURA', '', 0, 0, ''),
(925, '09', '0906', '090601', '', 'HUANUCO', 'LEONCIO PRADO', 'RUPA-RUPA', '', 0, 0, ''),
(926, '09', '0906', '090602', '', 'HUANUCO', 'LEONCIO PRADO', 'DANIEL ALOMIA ROBLES', '', 0, 0, ''),
(927, '09', '0906', '090603', '', 'HUANUCO', 'LEONCIO PRADO', 'HERMILIO VALDIZAN', '', 0, 0, ''),
(928, '09', '0906', '090604', '', 'HUANUCO', 'LEONCIO PRADO', 'LUYANDO', '', 0, 0, ''),
(929, '09', '0906', '090605', '', 'HUANUCO', 'LEONCIO PRADO', 'MARIANO DAMASO BERAUN', '', 0, 0, ''),
(930, '09', '0906', '090606', '', 'HUANUCO', 'LEONCIO PRADO', 'JOSE CRESPO Y CASTILLO', '', 0, 0, ''),
(931, '09', '0907', '090701', '', 'HUANUCO', 'PACHITEA', 'PANAO', '', 0, 0, ''),
(932, '09', '0907', '090702', '', 'HUANUCO', 'PACHITEA', 'CHAGLLA', '', 0, 0, ''),
(933, '09', '0907', '090704', '', 'HUANUCO', 'PACHITEA', 'MOLINO', '', 0, 0, ''),
(934, '09', '0907', '090706', '', 'HUANUCO', 'PACHITEA', 'UMARI', '', 0, 0, ''),
(935, '09', '0908', '090801', '', 'HUANUCO', 'PUERTO INCA', 'HONORIA', '', 0, 0, ''),
(936, '09', '0908', '090802', '', 'HUANUCO', 'PUERTO INCA', 'PUERTO INCA', '', 0, 0, ''),
(937, '09', '0908', '090803', '', 'HUANUCO', 'PUERTO INCA', 'CODO DEL POZUZO', '', 0, 0, ''),
(938, '09', '0908', '090804', '', 'HUANUCO', 'PUERTO INCA', 'TOURNAVISTA', '', 0, 0, ''),
(939, '09', '0908', '090805', '', 'HUANUCO', 'PUERTO INCA', 'YUYAPICHIS', '', 0, 0, ''),
(940, '09', '0909', '090901', '', 'HUANUCO', 'HUACAYBAMBA', 'HUACAYBAMBA', '', 0, 0, ''),
(941, '09', '0909', '090902', '', 'HUANUCO', 'HUACAYBAMBA', 'PINRA', '', 0, 0, ''),
(942, '09', '0909', '090903', '', 'HUANUCO', 'HUACAYBAMBA', 'CANCHABAMBA', '', 0, 0, ''),
(943, '09', '0909', '090904', '', 'HUANUCO', 'HUACAYBAMBA', 'COCHABAMBA', '', 0, 0, ''),
(944, '09', '0910', '091001', '', 'HUANUCO', 'LAURICOCHA', 'JESUS', '', 0, 0, ''),
(945, '09', '0910', '091002', '', 'HUANUCO', 'LAURICOCHA', 'BA', '', 0, 0, ''),
(946, '09', '0910', '091003', '', 'HUANUCO', 'LAURICOCHA', 'SAN FRANCISCO DE ASIS', '', 0, 0, ''),
(947, '09', '0910', '091004', '', 'HUANUCO', 'LAURICOCHA', 'QUEROPALCA', '', 0, 0, ''),
(948, '09', '0910', '091005', '', 'HUANUCO', 'LAURICOCHA', 'SAN MIGUEL DE CAURI', '', 0, 0, ''),
(949, '09', '0910', '091006', '', 'HUANUCO', 'LAURICOCHA', 'RONDOS', '', 0, 0, ''),
(950, '09', '0910', '091007', '', 'HUANUCO', 'LAURICOCHA', 'JIVIA', '', 0, 0, ''),
(951, '09', '0911', '091101', '', 'HUANUCO', 'YAROWILCA', 'CHAVINILLO', '', 0, 0, ''),
(952, '09', '0911', '091102', '', 'HUANUCO', 'YAROWILCA', 'APARICIO POMARES', '', 0, 0, ''),
(953, '09', '0911', '091103', '', 'HUANUCO', 'YAROWILCA', 'CAHUAC', '', 0, 0, ''),
(954, '09', '0911', '091104', '', 'HUANUCO', 'YAROWILCA', 'CHACABAMBA', '', 0, 0, ''),
(955, '09', '0911', '091105', '', 'HUANUCO', 'YAROWILCA', 'JACAS CHICO', '', 0, 0, ''),
(956, '09', '0911', '091106', '', 'HUANUCO', 'YAROWILCA', 'OBAS', '', 0, 0, ''),
(957, '09', '0911', '091107', '', 'HUANUCO', 'YAROWILCA', 'PAMPAMARCA', '', 0, 0, ''),
(958, '09', '0911', '091108', '', 'HUANUCO', 'YAROWILCA', 'CHORAS', '', 0, 0, ''),
(959, '10', '1001', '100101', '', 'ICA', 'ICA', 'ICA', '', 0, 0, ''),
(960, '10', '1001', '100102', '', 'ICA', 'ICA', 'LA TINGUI', '', 0, 0, ''),
(961, '10', '1001', '100103', '', 'ICA', 'ICA', 'LOS AQUIJES', '', 0, 0, ''),
(962, '10', '1001', '100104', '', 'ICA', 'ICA', 'PARCONA', '', 0, 0, ''),
(963, '10', '1001', '100105', '', 'ICA', 'ICA', 'PUEBLO NUEVO', '', 0, 0, ''),
(964, '10', '1001', '100106', '', 'ICA', 'ICA', 'SALAS', '', 0, 0, ''),
(965, '10', '1001', '100107', '', 'ICA', 'ICA', 'SAN JOSE DE LOS MOLINOS', '', 0, 0, ''),
(966, '10', '1001', '100108', '', 'ICA', 'ICA', 'SAN JUAN BAUTISTA', '', 0, 0, ''),
(967, '10', '1001', '100109', '', 'ICA', 'ICA', 'SANTIAGO', '', 0, 0, ''),
(968, '10', '1001', '100110', '', 'ICA', 'ICA', 'SUBTANJALLA', '', 0, 0, ''),
(969, '10', '1001', '100111', '', 'ICA', 'ICA', 'YAUCA DEL ROSARIO', '', 0, 0, ''),
(970, '10', '1001', '100112', '', 'ICA', 'ICA', 'TATE', '', 0, 0, ''),
(971, '10', '1001', '100113', '', 'ICA', 'ICA', 'PACHACUTEC', '', 0, 0, ''),
(972, '10', '1001', '100114', '', 'ICA', 'ICA', 'OCUCAJE', '', 0, 0, ''),
(973, '10', '1002', '100201', '', 'ICA', 'CHINCHA', 'CHINCHA ALTA', '', 0, 0, ''),
(974, '10', '1002', '100202', '', 'ICA', 'CHINCHA', 'CHAVIN', '', 0, 0, ''),
(975, '10', '1002', '100203', '', 'ICA', 'CHINCHA', 'CHINCHA BAJA', '', 0, 0, ''),
(976, '10', '1002', '100204', '', 'ICA', 'CHINCHA', 'EL CARMEN', '', 0, 0, ''),
(977, '10', '1002', '100205', '', 'ICA', 'CHINCHA', 'GROCIO PRADO', '', 0, 0, ''),
(978, '10', '1002', '100206', '', 'ICA', 'CHINCHA', 'SAN PEDRO DE HUACARPANA', '', 0, 0, ''),
(979, '10', '1002', '100207', '', 'ICA', 'CHINCHA', 'SUNAMPE', '', 0, 0, ''),
(980, '10', '1002', '100208', '', 'ICA', 'CHINCHA', 'TAMBO DE MORA', '', 0, 0, ''),
(981, '10', '1002', '100209', '', 'ICA', 'CHINCHA', 'ALTO LARAN', '', 0, 0, ''),
(982, '10', '1002', '100210', '', 'ICA', 'CHINCHA', 'PUEBLO NUEVO', '', 0, 0, ''),
(983, '10', '1002', '100211', '', 'ICA', 'CHINCHA', 'SAN JUAN DE YANAC', '', 0, 0, ''),
(984, '10', '1003', '100301', '', 'ICA', 'NAZCA', 'NAZCA', '', 0, 0, ''),
(985, '10', '1003', '100302', '', 'ICA', 'NAZCA', 'CHANGUILLO', '', 0, 0, ''),
(986, '10', '1003', '100303', '', 'ICA', 'NAZCA', 'EL INGENIO', '', 0, 0, ''),
(987, '10', '1003', '100304', '', 'ICA', 'NAZCA', 'MARCONA', '', 0, 0, ''),
(988, '10', '1003', '100305', '', 'ICA', 'NAZCA', 'VISTA ALEGRE', '', 0, 0, ''),
(989, '10', '1004', '100401', '', 'ICA', 'PISCO', 'PISCO', '', 0, 0, ''),
(990, '10', '1004', '100402', '', 'ICA', 'PISCO', 'HUANCANO', '', 0, 0, ''),
(991, '10', '1004', '100403', '', 'ICA', 'PISCO', 'HUMAY', '', 0, 0, ''),
(992, '10', '1004', '100404', '', 'ICA', 'PISCO', 'INDEPENDENCIA', '', 0, 0, ''),
(993, '10', '1004', '100405', '', 'ICA', 'PISCO', 'PARACAS', '', 0, 0, ''),
(994, '10', '1004', '100406', '', 'ICA', 'PISCO', 'SAN ANDRES', '', 0, 0, ''),
(995, '10', '1004', '100407', '', 'ICA', 'PISCO', 'SAN CLEMENTE', '', 0, 0, ''),
(996, '10', '1004', '100408', '', 'ICA', 'PISCO', 'TUPAC AMARU INCA', '', 0, 0, ''),
(997, '10', '1005', '100501', '', 'ICA', 'PALPA', 'PALPA', '', 0, 0, ''),
(998, '10', '1005', '100502', '', 'ICA', 'PALPA', 'LLIPATA', '', 0, 0, ''),
(999, '10', '1005', '100503', '', 'ICA', 'PALPA', 'RIO GRANDE', '', 0, 0, ''),
(1000, '10', '1005', '100504', '', 'ICA', 'PALPA', 'SANTA CRUZ', '', 0, 0, ''),
(1001, '10', '1005', '100505', '', 'ICA', 'PALPA', 'TIBILLO', '', 0, 0, ''),
(1002, '11', '1101', '110101', '', 'JUNIN', 'HUANCAYO', 'HUANCAYO', '', 0, 0, ''),
(1003, '11', '1101', '110103', '', 'JUNIN', 'HUANCAYO', 'CARHUACALLANGA', '', 0, 0, ''),
(1004, '11', '1101', '110104', '', 'JUNIN', 'HUANCAYO', 'COLCA', '', 0, 0, ''),
(1005, '11', '1101', '110105', '', 'JUNIN', 'HUANCAYO', 'CULLHUAS', '', 0, 0, ''),
(1006, '11', '1101', '110106', '', 'JUNIN', 'HUANCAYO', 'CHACAPAMPA', '', 0, 0, ''),
(1007, '11', '1101', '110107', '', 'JUNIN', 'HUANCAYO', 'CHICCHE', '', 0, 0, ''),
(1008, '11', '1101', '110108', '', 'JUNIN', 'HUANCAYO', 'CHILCA', '', 0, 0, ''),
(1009, '11', '1101', '110109', '', 'JUNIN', 'HUANCAYO', 'CHONGOS ALTO', '', 0, 0, ''),
(1010, '11', '1101', '110112', '', 'JUNIN', 'HUANCAYO', 'CHUPURO', '', 0, 0, ''),
(1011, '11', '1101', '110113', '', 'JUNIN', 'HUANCAYO', 'EL TAMBO', '', 0, 0, ''),
(1012, '11', '1101', '110114', '', 'JUNIN', 'HUANCAYO', 'HUACRAPUQUIO', '', 0, 0, ''),
(1013, '11', '1101', '110116', '', 'JUNIN', 'HUANCAYO', 'HUALHUAS', '', 0, 0, ''),
(1014, '11', '1101', '110118', '', 'JUNIN', 'HUANCAYO', 'HUANCAN', '', 0, 0, ''),
(1015, '11', '1101', '110119', '', 'JUNIN', 'HUANCAYO', 'HUASICANCHA', '', 0, 0, ''),
(1016, '11', '1101', '110120', '', 'JUNIN', 'HUANCAYO', 'HUAYUCACHI', '', 0, 0, ''),
(1017, '11', '1101', '110121', '', 'JUNIN', 'HUANCAYO', 'INGENIO', '', 0, 0, ''),
(1018, '11', '1101', '110122', '', 'JUNIN', 'HUANCAYO', 'PARIAHUANCA', '', 0, 0, ''),
(1019, '11', '1101', '110123', '', 'JUNIN', 'HUANCAYO', 'PILCOMAYO', '', 0, 0, ''),
(1020, '11', '1101', '110124', '', 'JUNIN', 'HUANCAYO', 'PUCARA', '', 0, 0, ''),
(1021, '11', '1101', '110125', '', 'JUNIN', 'HUANCAYO', 'QUICHUAY', '', 0, 0, ''),
(1022, '11', '1101', '110126', '', 'JUNIN', 'HUANCAYO', 'QUILCAS', '', 0, 0, ''),
(1023, '11', '1101', '110127', '', 'JUNIN', 'HUANCAYO', 'SAN AGUSTIN', '', 0, 0, ''),
(1024, '11', '1101', '110128', '', 'JUNIN', 'HUANCAYO', 'SAN JERONIMO DE TUNAN', '', 0, 0, ''),
(1025, '11', '1101', '110131', '', 'JUNIN', 'HUANCAYO', 'SANTO DOMINGO DE ACOBAMBA', '', 0, 0, ''),
(1026, '11', '1101', '110132', '', 'JUNIN', 'HUANCAYO', 'SAÑO', '', 0, 0, ''),
(1027, '11', '1101', '110133', '', 'JUNIN', 'HUANCAYO', 'SAPALLANGA', '', 0, 0, ''),
(1028, '11', '1101', '110134', '', 'JUNIN', 'HUANCAYO', 'SICAYA', '', 0, 0, ''),
(1029, '11', '1101', '110136', '', 'JUNIN', 'HUANCAYO', 'VIQUES', '', 0, 0, ''),
(1030, '11', '1102', '110201', '', 'JUNIN', 'CONCEPCION', 'CONCEPCION', '', 0, 0, ''),
(1031, '11', '1102', '110202', '', 'JUNIN', 'CONCEPCION', 'ACO', '', 0, 0, ''),
(1032, '11', '1102', '110203', '', 'JUNIN', 'CONCEPCION', 'ANDAMARCA', '', 0, 0, ''),
(1033, '11', '1102', '110204', '', 'JUNIN', 'CONCEPCION', 'COMAS', '', 0, 0, ''),
(1034, '11', '1102', '110205', '', 'JUNIN', 'CONCEPCION', 'COCHAS', '', 0, 0, ''),
(1035, '11', '1102', '110206', '', 'JUNIN', 'CONCEPCION', 'CHAMBARA', '', 0, 0, ''),
(1036, '11', '1102', '110207', '', 'JUNIN', 'CONCEPCION', 'HEROINAS TOLEDO', '', 0, 0, ''),
(1037, '11', '1102', '110208', '', 'JUNIN', 'CONCEPCION', 'MANZANARES', '', 0, 0, ''),
(1038, '11', '1102', '110209', '', 'JUNIN', 'CONCEPCION', 'MARISCAL CASTILLA', '', 0, 0, ''),
(1039, '11', '1102', '110210', '', 'JUNIN', 'CONCEPCION', 'MATAHUASI', '', 0, 0, ''),
(1040, '11', '1102', '110211', '', 'JUNIN', 'CONCEPCION', 'MITO', '', 0, 0, ''),
(1041, '11', '1102', '110212', '', 'JUNIN', 'CONCEPCION', 'NUEVE DE JULIO', '', 0, 0, ''),
(1042, '11', '1102', '110213', '', 'JUNIN', 'CONCEPCION', 'ORCOTUNA', '', 0, 0, ''),
(1043, '11', '1102', '110214', '', 'JUNIN', 'CONCEPCION', 'SANTA ROSA DE OCOPA', '', 0, 0, ''),
(1044, '11', '1102', '110215', '', 'JUNIN', 'CONCEPCION', 'SAN JOSE DE QUERO', '', 0, 0, ''),
(1045, '11', '1103', '110301', '', 'JUNIN', 'JAUJA', 'JAUJA', '', 0, 0, ''),
(1046, '11', '1103', '110302', '', 'JUNIN', 'JAUJA', 'ACOLLA', '', 0, 0, ''),
(1047, '11', '1103', '110303', '', 'JUNIN', 'JAUJA', 'APATA', '', 0, 0, ''),
(1048, '11', '1103', '110304', '', 'JUNIN', 'JAUJA', 'ATAURA', '', 0, 0, ''),
(1049, '11', '1103', '110305', '', 'JUNIN', 'JAUJA', 'CANCHAYLLO', '', 0, 0, ''),
(1050, '11', '1103', '110306', '', 'JUNIN', 'JAUJA', 'EL MANTARO', '', 0, 0, ''),
(1051, '11', '1103', '110307', '', 'JUNIN', 'JAUJA', 'HUAMALI', '', 0, 0, ''),
(1052, '11', '1103', '110308', '', 'JUNIN', 'JAUJA', 'HUARIPAMPA', '', 0, 0, ''),
(1053, '11', '1103', '110309', '', 'JUNIN', 'JAUJA', 'HUERTAS', '', 0, 0, ''),
(1054, '11', '1103', '110310', '', 'JUNIN', 'JAUJA', 'JANJAILLO', '', 0, 0, ''),
(1055, '11', '1103', '110311', '', 'JUNIN', 'JAUJA', 'JULCAN', '', 0, 0, ''),
(1056, '11', '1103', '110312', '', 'JUNIN', 'JAUJA', 'LEONOR ORDO', '', 0, 0, ''),
(1057, '11', '1103', '110313', '', 'JUNIN', 'JAUJA', 'LLOCLLAPAMPA', '', 0, 0, ''),
(1058, '11', '1103', '110314', '', 'JUNIN', 'JAUJA', 'MARCO', '', 0, 0, ''),
(1059, '11', '1103', '110315', '', 'JUNIN', 'JAUJA', 'MASMA', '', 0, 0, ''),
(1060, '11', '1103', '110316', '', 'JUNIN', 'JAUJA', 'MOLINOS', '', 0, 0, ''),
(1061, '11', '1103', '110317', '', 'JUNIN', 'JAUJA', 'MONOBAMBA', '', 0, 0, ''),
(1062, '11', '1103', '110318', '', 'JUNIN', 'JAUJA', 'MUQUI', '', 0, 0, ''),
(1063, '11', '1103', '110319', '', 'JUNIN', 'JAUJA', 'MUQUIYAUYO', '', 0, 0, ''),
(1064, '11', '1103', '110320', '', 'JUNIN', 'JAUJA', 'PACA', '', 0, 0, ''),
(1065, '11', '1103', '110321', '', 'JUNIN', 'JAUJA', 'PACCHA', '', 0, 0, ''),
(1066, '11', '1103', '110322', '', 'JUNIN', 'JAUJA', 'PANCAN', '', 0, 0, ''),
(1067, '11', '1103', '110323', '', 'JUNIN', 'JAUJA', 'PARCO', '', 0, 0, ''),
(1068, '11', '1103', '110324', '', 'JUNIN', 'JAUJA', 'POMACANCHA', '', 0, 0, ''),
(1069, '11', '1103', '110325', '', 'JUNIN', 'JAUJA', 'RICRAN', '', 0, 0, ''),
(1070, '11', '1103', '110326', '', 'JUNIN', 'JAUJA', 'SAN LORENZO', '', 0, 0, ''),
(1071, '11', '1103', '110327', '', 'JUNIN', 'JAUJA', 'SAN PEDRO DE CHUNAN', '', 0, 0, ''),
(1072, '11', '1103', '110328', '', 'JUNIN', 'JAUJA', 'SINCOS', '', 0, 0, ''),
(1073, '11', '1103', '110329', '', 'JUNIN', 'JAUJA', 'TUNAN MARCA', '', 0, 0, ''),
(1074, '11', '1103', '110330', '', 'JUNIN', 'JAUJA', 'YAULI', '', 0, 0, ''),
(1075, '11', '1103', '110331', '', 'JUNIN', 'JAUJA', 'CURICACA', '', 0, 0, ''),
(1076, '11', '1103', '110332', '', 'JUNIN', 'JAUJA', 'MASMA CHICCHE', '', 0, 0, ''),
(1077, '11', '1103', '110333', '', 'JUNIN', 'JAUJA', 'SAUSA', '', 0, 0, ''),
(1078, '11', '1103', '110334', '', 'JUNIN', 'JAUJA', 'YAUYOS', '', 0, 0, ''),
(1079, '11', '1104', '110401', '', 'JUNIN', 'JUNIN', 'JUNIN', '', 0, 0, ''),
(1080, '11', '1104', '110402', '', 'JUNIN', 'JUNIN', 'CARHUAMAYO', '', 0, 0, ''),
(1081, '11', '1104', '110403', '', 'JUNIN', 'JUNIN', 'ONDORES', '', 0, 0, ''),
(1082, '11', '1104', '110404', '', 'JUNIN', 'JUNIN', 'ULCUMAYO', '', 0, 0, ''),
(1083, '11', '1105', '110501', '', 'JUNIN', 'TARMA', 'TARMA', '', 0, 0, ''),
(1084, '11', '1105', '110502', '', 'JUNIN', 'TARMA', 'ACOBAMBA', '', 0, 0, ''),
(1085, '11', '1105', '110503', '', 'JUNIN', 'TARMA', 'HUARICOLCA', '', 0, 0, ''),
(1086, '11', '1105', '110504', '', 'JUNIN', 'TARMA', 'HUASAHUASI', '', 0, 0, ''),
(1087, '11', '1105', '110505', '', 'JUNIN', 'TARMA', 'LA UNION', '', 0, 0, ''),
(1088, '11', '1105', '110506', '', 'JUNIN', 'TARMA', 'PALCA', '', 0, 0, ''),
(1089, '11', '1105', '110507', '', 'JUNIN', 'TARMA', 'PALCAMAYO', '', 0, 0, ''),
(1090, '11', '1105', '110508', '', 'JUNIN', 'TARMA', 'SAN PEDRO DE CAJAS', '', 0, 0, ''),
(1091, '11', '1105', '110509', '', 'JUNIN', 'TARMA', 'TAPO', '', 0, 0, ''),
(1092, '11', '1106', '110601', '', 'JUNIN', 'YAULI', 'LA OROYA', '', 0, 0, ''),
(1093, '11', '1106', '110602', '', 'JUNIN', 'YAULI', 'CHACAPALPA', '', 0, 0, ''),
(1094, '11', '1106', '110603', '', 'JUNIN', 'YAULI', 'HUAY HUAY', '', 0, 0, ''),
(1095, '11', '1106', '110604', '', 'JUNIN', 'YAULI', 'MARCAPOMACOCHA', '', 0, 0, ''),
(1096, '11', '1106', '110605', '', 'JUNIN', 'YAULI', 'MOROCOCHA', '', 0, 0, ''),
(1097, '11', '1106', '110606', '', 'JUNIN', 'YAULI', 'PACCHA', '', 0, 0, ''),
(1098, '11', '1106', '110607', '', 'JUNIN', 'YAULI', 'SANTA BARBARA DE CARHUACAYAN', '', 0, 0, ''),
(1099, '11', '1106', '110608', '', 'JUNIN', 'YAULI', 'SUITUCANCHA', '', 0, 0, ''),
(1100, '11', '1106', '110609', '', 'JUNIN', 'YAULI', 'YAULI', '', 0, 0, ''),
(1101, '11', '1106', '110610', '', 'JUNIN', 'YAULI', 'SANTA ROSA DE SACCO', '', 0, 0, ''),
(1102, '11', '1107', '110701', '', 'JUNIN', 'SATIPO', 'SATIPO', '', 0, 0, ''),
(1103, '11', '1107', '110702', '', 'JUNIN', 'SATIPO', 'COVIRIALI', '', 0, 0, ''),
(1104, '11', '1107', '110703', '', 'JUNIN', 'SATIPO', 'LLAYLLA', '', 0, 0, ''),
(1105, '11', '1107', '110704', '', 'JUNIN', 'SATIPO', 'MAZAMARI', '', 0, 0, ''),
(1106, '11', '1107', '110705', '', 'JUNIN', 'SATIPO', 'PAMPA HERMOSA', '', 0, 0, ''),
(1107, '11', '1107', '110706', '', 'JUNIN', 'SATIPO', 'PANGOA', '', 0, 0, ''),
(1108, '11', '1107', '110707', '', 'JUNIN', 'SATIPO', 'RIO NEGRO', '', 0, 0, ''),
(1109, '11', '1107', '110708', '', 'JUNIN', 'SATIPO', 'RIO TAMBO', '', 0, 0, ''),
(1110, '11', '1108', '110801', '', 'JUNIN', 'CHANCHAMAYO', 'CHANCHAMAYO', '', 0, 0, ''),
(1111, '11', '1108', '110802', '', 'JUNIN', 'CHANCHAMAYO', 'SAN RAMON', '', 0, 0, ''),
(1112, '11', '1108', '110803', '', 'JUNIN', 'CHANCHAMAYO', 'VITOC', '', 0, 0, ''),
(1113, '11', '1108', '110804', '', 'JUNIN', 'CHANCHAMAYO', 'SAN LUIS DE SHUARO', '', 0, 0, ''),
(1114, '11', '1108', '110805', '', 'JUNIN', 'CHANCHAMAYO', 'PICHANAQUI', '', 0, 0, ''),
(1115, '11', '1108', '110806', '', 'JUNIN', 'CHANCHAMAYO', 'PERENE', '', 0, 0, ''),
(1116, '11', '1109', '110901', '', 'JUNIN', 'CHUPACA', 'CHUPACA', '', 0, 0, ''),
(1117, '11', '1109', '110902', '', 'JUNIN', 'CHUPACA', 'AHUAC', '', 0, 0, ''),
(1118, '11', '1109', '110903', '', 'JUNIN', 'CHUPACA', 'CHONGOS BAJO', '', 0, 0, ''),
(1119, '11', '1109', '110904', '', 'JUNIN', 'CHUPACA', 'HUACHAC', '', 0, 0, ''),
(1120, '11', '1109', '110905', '', 'JUNIN', 'CHUPACA', 'HUAMANCACA CHICO', '', 0, 0, ''),
(1121, '11', '1109', '110906', '', 'JUNIN', 'CHUPACA', 'SAN JUAN DE YSCOS', '', 0, 0, ''),
(1122, '11', '1109', '110907', '', 'JUNIN', 'CHUPACA', 'SAN JUAN DE JARPA', '', 0, 0, ''),
(1123, '11', '1109', '110908', '', 'JUNIN', 'CHUPACA', 'TRES DE DICIEMBRE', '', 0, 0, ''),
(1124, '11', '1109', '110909', '', 'JUNIN', 'CHUPACA', 'YANACANCHA', '', 0, 0, ''),
(1125, '12', '1201', '120101', '', 'LA LIBERTAD', 'TRUJILLO', 'TRUJILLO', '', 0, 0, ''),
(1126, '12', '1201', '120102', '', 'LA LIBERTAD', 'TRUJILLO', 'HUANCHACO', '', 0, 0, ''),
(1127, '12', '1201', '120103', '', 'LA LIBERTAD', 'TRUJILLO', 'LAREDO', '', 0, 0, ''),
(1128, '12', '1201', '120104', '', 'LA LIBERTAD', 'TRUJILLO', 'MOCHE', '', 0, 0, ''),
(1129, '12', '1201', '120105', '', 'LA LIBERTAD', 'TRUJILLO', 'SALAVERRY', '', 0, 0, ''),
(1130, '12', '1201', '120106', '', 'LA LIBERTAD', 'TRUJILLO', 'SIMBAL', '', 0, 0, ''),
(1131, '12', '1201', '120107', '', 'LA LIBERTAD', 'TRUJILLO', 'VICTOR LARCO HERRERA', '', 0, 0, ''),
(1132, '12', '1201', '120109', '', 'LA LIBERTAD', 'TRUJILLO', 'POROTO', '', 0, 0, ''),
(1133, '12', '1201', '120110', '', 'LA LIBERTAD', 'TRUJILLO', 'EL PORVENIR', '', 0, 0, ''),
(1134, '12', '1201', '120111', '', 'LA LIBERTAD', 'TRUJILLO', 'LA ESPERANZA', '', 0, 0, ''),
(1135, '12', '1201', '120112', '', 'LA LIBERTAD', 'TRUJILLO', 'FLORENCIA DE MORA', '', 0, 0, ''),
(1136, '12', '1202', '120201', '', 'LA LIBERTAD', 'BOLIVAR', 'BOLIVAR', '', 0, 0, ''),
(1137, '12', '1202', '120202', '', 'LA LIBERTAD', 'BOLIVAR', 'BAMBAMARCA', '', 0, 0, ''),
(1138, '12', '1202', '120203', '', 'LA LIBERTAD', 'BOLIVAR', 'CONDORMARCA', '', 0, 0, ''),
(1139, '12', '1202', '120204', '', 'LA LIBERTAD', 'BOLIVAR', 'LONGOTEA', '', 0, 0, ''),
(1140, '12', '1202', '120205', '', 'LA LIBERTAD', 'BOLIVAR', 'UCUNCHA', '', 0, 0, ''),
(1141, '12', '1202', '120206', '', 'LA LIBERTAD', 'BOLIVAR', 'UCHUMARCA', '', 0, 0, ''),
(1142, '12', '1203', '120301', '', 'LA LIBERTAD', 'SANCHEZ CARRION', 'HUAMACHUCO', '', 0, 0, ''),
(1143, '12', '1203', '120302', '', 'LA LIBERTAD', 'SANCHEZ CARRION', 'COCHORCO', '', 0, 0, ''),
(1144, '12', '1203', '120303', '', 'LA LIBERTAD', 'SANCHEZ CARRION', 'CURGOS', '', 0, 0, ''),
(1145, '12', '1203', '120304', '', 'LA LIBERTAD', 'SANCHEZ CARRION', 'CHUGAY', '', 0, 0, ''),
(1146, '12', '1203', '120305', '', 'LA LIBERTAD', 'SANCHEZ CARRION', 'MARCABAL', '', 0, 0, ''),
(1147, '12', '1203', '120306', '', 'LA LIBERTAD', 'SANCHEZ CARRION', 'SANAGORAN', '', 0, 0, ''),
(1148, '12', '1203', '120307', '', 'LA LIBERTAD', 'SANCHEZ CARRION', 'SARIN', '', 0, 0, ''),
(1149, '12', '1203', '120308', '', 'LA LIBERTAD', 'SANCHEZ CARRION', 'SARTIMBAMBA', '', 0, 0, ''),
(1150, '12', '1204', '120401', '', 'LA LIBERTAD', 'OTUZCO', 'OTUZCO', '', 0, 0, ''),
(1151, '12', '1204', '120402', '', 'LA LIBERTAD', 'OTUZCO', 'AGALLPAMPA', '', 0, 0, ''),
(1152, '12', '1204', '120403', '', 'LA LIBERTAD', 'OTUZCO', 'CHARAT', '', 0, 0, ''),
(1153, '12', '1204', '120404', '', 'LA LIBERTAD', 'OTUZCO', 'HUARANCHAL', '', 0, 0, ''),
(1154, '12', '1204', '120405', '', 'LA LIBERTAD', 'OTUZCO', 'LA CUESTA', '', 0, 0, ''),
(1155, '12', '1204', '120408', '', 'LA LIBERTAD', 'OTUZCO', 'PARANDAY', '', 0, 0, ''),
(1156, '12', '1204', '120409', '', 'LA LIBERTAD', 'OTUZCO', 'SALPO', '', 0, 0, ''),
(1157, '12', '1204', '120410', '', 'LA LIBERTAD', 'OTUZCO', 'SINSICAP', '', 0, 0, ''),
(1158, '12', '1204', '120411', '', 'LA LIBERTAD', 'OTUZCO', 'USQUIL', '', 0, 0, ''),
(1159, '12', '1204', '120413', '', 'LA LIBERTAD', 'OTUZCO', 'MACHE', '', 0, 0, ''),
(1160, '12', '1205', '120501', '', 'LA LIBERTAD', 'PACASMAYO', 'SAN PEDRO DE LLOC', '', 0, 0, ''),
(1161, '12', '1205', '120503', '', 'LA LIBERTAD', 'PACASMAYO', 'GUADALUPE', '', 0, 0, ''),
(1162, '12', '1205', '120504', '', 'LA LIBERTAD', 'PACASMAYO', 'JEQUETEPEQUE', '', 0, 0, ''),
(1163, '12', '1205', '120506', '', 'LA LIBERTAD', 'PACASMAYO', 'PACASMAYO', '', 0, 0, ''),
(1164, '12', '1205', '120508', '', 'LA LIBERTAD', 'PACASMAYO', 'SAN JOSE', '', 0, 0, ''),
(1165, '12', '1206', '120601', '', 'LA LIBERTAD', 'PATAZ', 'TAYABAMBA', '', 0, 0, ''),
(1166, '12', '1206', '120602', '', 'LA LIBERTAD', 'PATAZ', 'BULDIBUYO', '', 0, 0, ''),
(1167, '12', '1206', '120603', '', 'LA LIBERTAD', 'PATAZ', 'CHILLIA', '', 0, 0, ''),
(1168, '12', '1206', '120604', '', 'LA LIBERTAD', 'PATAZ', 'HUAYLILLAS', '', 0, 0, ''),
(1169, '12', '1206', '120605', '', 'LA LIBERTAD', 'PATAZ', 'HUANCASPATA', '', 0, 0, ''),
(1170, '12', '1206', '120606', '', 'LA LIBERTAD', 'PATAZ', 'HUAYO', '', 0, 0, ''),
(1171, '12', '1206', '120607', '', 'LA LIBERTAD', 'PATAZ', 'ONGON', '', 0, 0, ''),
(1172, '12', '1206', '120608', '', 'LA LIBERTAD', 'PATAZ', 'PARCOY', '', 0, 0, ''),
(1173, '12', '1206', '120609', '', 'LA LIBERTAD', 'PATAZ', 'PATAZ', '', 0, 0, ''),
(1174, '12', '1206', '120610', '', 'LA LIBERTAD', 'PATAZ', 'PIAS', '', 0, 0, ''),
(1175, '12', '1206', '120611', '', 'LA LIBERTAD', 'PATAZ', 'TAURIJA', '', 0, 0, ''),
(1176, '12', '1206', '120612', '', 'LA LIBERTAD', 'PATAZ', 'URPAY', '', 0, 0, ''),
(1177, '12', '1206', '120613', '', 'LA LIBERTAD', 'PATAZ', 'SANTIAGO DE CHALLAS', '', 0, 0, ''),
(1178, '12', '1207', '120701', '', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'SANTIAGO DE CHUCO', '', 0, 0, ''),
(1179, '12', '1207', '120702', '', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'CACHICADAN', '', 0, 0, ''),
(1180, '12', '1207', '120703', '', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'MOLLEBAMBA', '', 0, 0, ''),
(1181, '12', '1207', '120704', '', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'MOLLEPATA', '', 0, 0, ''),
(1182, '12', '1207', '120705', '', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'QUIRUVILCA', '', 0, 0, ''),
(1183, '12', '1207', '120706', '', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'SANTA CRUZ DE CHUCA', '', 0, 0, ''),
(1184, '12', '1207', '120707', '', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'SITABAMBA', '', 0, 0, ''),
(1185, '12', '1207', '120708', '', 'LA LIBERTAD', 'SANTIAGO DE CHUCO', 'ANGASMARCA', '', 0, 0, ''),
(1186, '12', '1208', '120801', '', 'LA LIBERTAD', 'ASCOPE', 'ASCOPE', '', 0, 0, '');
INSERT INTO `ubigeo` (`id`, `department_id`, `province_id`, `district_id`, `pais`, `department`, `province`, `district`, `pais_id`, `latitude`, `longitud`, `district_id_standart`) VALUES
(1187, '12', '1208', '120802', '', 'LA LIBERTAD', 'ASCOPE', 'CHICAMA', '', 0, 0, ''),
(1188, '12', '1208', '120803', '', 'LA LIBERTAD', 'ASCOPE', 'CHOCOPE', '', 0, 0, ''),
(1189, '12', '1208', '120804', '', 'LA LIBERTAD', 'ASCOPE', 'SANTIAGO DE CAO', '', 0, 0, ''),
(1190, '12', '1208', '120805', '', 'LA LIBERTAD', 'ASCOPE', 'MAGDALENA DE CAO', '', 0, 0, ''),
(1191, '12', '1208', '120806', '', 'LA LIBERTAD', 'ASCOPE', 'PAIJAN', '', 0, 0, ''),
(1192, '12', '1208', '120807', '', 'LA LIBERTAD', 'ASCOPE', 'RAZURI', '', 0, 0, ''),
(1193, '12', '1208', '120808', '', 'LA LIBERTAD', 'ASCOPE', 'CASA GRANDE', '', 0, 0, ''),
(1194, '12', '1209', '120901', '', 'LA LIBERTAD', 'CHEPEN', 'CHEPEN', '', 0, 0, ''),
(1195, '12', '1209', '120902', '', 'LA LIBERTAD', 'CHEPEN', 'PACANGA', '', 0, 0, ''),
(1196, '12', '1209', '120903', '', 'LA LIBERTAD', 'CHEPEN', 'PUEBLO NUEVO', '', 0, 0, ''),
(1197, '12', '1210', '121001', '', 'LA LIBERTAD', 'JULCAN', 'JULCAN', '', 0, 0, ''),
(1198, '12', '1210', '121002', '', 'LA LIBERTAD', 'JULCAN', 'CARABAMBA', '', 0, 0, ''),
(1199, '12', '1210', '121003', '', 'LA LIBERTAD', 'JULCAN', 'CALAMARCA', '', 0, 0, ''),
(1200, '12', '1210', '121004', '', 'LA LIBERTAD', 'JULCAN', 'HUASO', '', 0, 0, ''),
(1201, '12', '1211', '121101', '', 'LA LIBERTAD', 'GRAN CHIMU', 'CASCAS', '', 0, 0, ''),
(1202, '12', '1211', '121102', '', 'LA LIBERTAD', 'GRAN CHIMU', 'LUCMA', '', 0, 0, ''),
(1203, '12', '1211', '121103', '', 'LA LIBERTAD', 'GRAN CHIMU', 'MARMOT', '', 0, 0, ''),
(1204, '12', '1211', '121104', '', 'LA LIBERTAD', 'GRAN CHIMU', 'SAYAPULLO', '', 0, 0, ''),
(1205, '12', '1212', '121201', '', 'LA LIBERTAD', 'VIRU', 'VIRU', '', 0, 0, ''),
(1206, '12', '1212', '121202', '', 'LA LIBERTAD', 'VIRU', 'CHAO', '', 0, 0, ''),
(1207, '12', '1212', '121203', '', 'LA LIBERTAD', 'VIRU', 'GUADALUPITO', '', 0, 0, ''),
(1208, '13', '1301', '130101', '', 'LAMBAYEQUE', 'CHICLAYO', 'CHICLAYO', '', 0, 0, ''),
(1209, '13', '1301', '130102', '', 'LAMBAYEQUE', 'CHICLAYO', 'CHONGOYAPE', '', 0, 0, ''),
(1210, '13', '1301', '130103', '', 'LAMBAYEQUE', 'CHICLAYO', 'ETEN', '', 0, 0, ''),
(1211, '13', '1301', '130104', '', 'LAMBAYEQUE', 'CHICLAYO', 'ETEN PUERTO', '', 0, 0, ''),
(1212, '13', '1301', '130105', '', 'LAMBAYEQUE', 'CHICLAYO', 'LAGUNAS', '', 0, 0, ''),
(1213, '13', '1301', '130106', '', 'LAMBAYEQUE', 'CHICLAYO', 'MONSEFU', '', 0, 0, ''),
(1214, '13', '1301', '130107', '', 'LAMBAYEQUE', 'CHICLAYO', 'NUEVA ARICA', '', 0, 0, ''),
(1215, '13', '1301', '130108', '', 'LAMBAYEQUE', 'CHICLAYO', 'OYOTUN', '', 0, 0, ''),
(1216, '13', '1301', '130109', '', 'LAMBAYEQUE', 'CHICLAYO', 'PICSI', '', 0, 0, ''),
(1217, '13', '1301', '130110', '', 'LAMBAYEQUE', 'CHICLAYO', 'PIMENTEL', '', 0, 0, ''),
(1218, '13', '1301', '130111', '', 'LAMBAYEQUE', 'CHICLAYO', 'REQUE', '', 0, 0, ''),
(1219, '13', '1301', '130112', '', 'LAMBAYEQUE', 'CHICLAYO', 'JOSE LEONARDO ORTIZ', '', 0, 0, ''),
(1220, '13', '1301', '130113', '', 'LAMBAYEQUE', 'CHICLAYO', 'SANTA ROSA', '', 0, 0, ''),
(1221, '13', '1301', '130114', '', 'LAMBAYEQUE', 'CHICLAYO', 'SAÑA', '', 0, 0, ''),
(1222, '13', '1301', '130115', '', 'LAMBAYEQUE', 'CHICLAYO', 'LA VICTORIA', '', 0, 0, ''),
(1223, '13', '1301', '130116', '', 'LAMBAYEQUE', 'CHICLAYO', 'CAYALTI', '', 0, 0, ''),
(1224, '13', '1301', '130117', '', 'LAMBAYEQUE', 'CHICLAYO', 'PATAPO', '', 0, 0, ''),
(1225, '13', '1301', '130118', '', 'LAMBAYEQUE', 'CHICLAYO', 'POMALCA', '', 0, 0, ''),
(1226, '13', '1301', '130119', '', 'LAMBAYEQUE', 'CHICLAYO', 'PUCALA', '', 0, 0, ''),
(1227, '13', '1301', '130120', '', 'LAMBAYEQUE', 'CHICLAYO', 'TUMAN', '', 0, 0, ''),
(1228, '13', '1302', '130201', '', 'LAMBAYEQUE', 'FERREÑAFE', 'FERREÑAFE', '', 0, 0, ''),
(1229, '13', '1302', '130202', '', 'LAMBAYEQUE', 'FERREÑAFE', 'INCAHUASI', '', 0, 0, ''),
(1230, '13', '1302', '130203', '', 'LAMBAYEQUE', 'FERREÑAFE', 'CAÑARIS', '', 0, 0, ''),
(1231, '13', '1302', '130204', '', 'LAMBAYEQUE', 'FERREÑAFE', 'PITIPO', '', 0, 0, ''),
(1232, '13', '1302', '130205', '', 'LAMBAYEQUE', 'FERREÑAFE', 'PUEBLO NUEVO', '', 0, 0, ''),
(1233, '13', '1302', '130206', '', 'LAMBAYEQUE', 'FERREÑAFE', 'MANUEL ANTONIO MESONES MURO', '', 0, 0, ''),
(1234, '13', '1303', '130301', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'LAMBAYEQUE', '', 0, 0, ''),
(1235, '13', '1303', '130302', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'CHOCHOPE', '', 0, 0, ''),
(1236, '13', '1303', '130303', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'ILLIMO', '', 0, 0, ''),
(1237, '13', '1303', '130304', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'JAYANCA', '', 0, 0, ''),
(1238, '13', '1303', '130305', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'MOCHUMI', '', 0, 0, ''),
(1239, '13', '1303', '130306', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'MORROPE', '', 0, 0, ''),
(1240, '13', '1303', '130307', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'MOTUPE', '', 0, 0, ''),
(1241, '13', '1303', '130308', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'OLMOS', '', 0, 0, ''),
(1242, '13', '1303', '130309', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'PACORA', '', 0, 0, ''),
(1243, '13', '1303', '130310', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'SALAS', '', 0, 0, ''),
(1244, '13', '1303', '130311', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'SAN JOSE', '', 0, 0, ''),
(1245, '13', '1303', '130312', '', 'LAMBAYEQUE', 'LAMBAYEQUE', 'TUCUME', '', 0, 0, ''),
(1246, '14', '1401', '140101', '', 'LIMA', 'LIMA', 'LIMA', '', 0, 0, ''),
(1247, '14', '1401', '140102', '', 'LIMA', 'LIMA', 'ANCON', '', 0, 0, ''),
(1248, '14', '1401', '140103', '', 'LIMA', 'LIMA', 'ATE', '', 0, 0, ''),
(1249, '14', '1401', '140104', '', 'LIMA', 'LIMA', 'BRE', '', 0, 0, ''),
(1250, '14', '1401', '140105', '', 'LIMA', 'LIMA', 'CARABAYLLO', '', 0, 0, ''),
(1251, '14', '1401', '140106', '', 'LIMA', 'LIMA', 'COMAS', '', 0, 0, ''),
(1252, '14', '1401', '140107', '', 'LIMA', 'LIMA', 'CHACLACAYO', '', 0, 0, ''),
(1253, '14', '1401', '140108', '', 'LIMA', 'LIMA', 'CHORRILLOS', '', 0, 0, ''),
(1254, '14', '1401', '140109', '', 'LIMA', 'LIMA', 'LA VICTORIA', '', 0, 0, ''),
(1255, '14', '1401', '140110', '', 'LIMA', 'LIMA', 'LA MOLINA', '', 0, 0, ''),
(1256, '14', '1401', '140111', '', 'LIMA', 'LIMA', 'LINCE', '', 0, 0, ''),
(1257, '14', '1401', '140112', '', 'LIMA', 'LIMA', 'LURIGANCHO', '', 0, 0, ''),
(1258, '14', '1401', '140113', '', 'LIMA', 'LIMA', 'LURIN', '', 0, 0, ''),
(1259, '14', '1401', '140114', '', 'LIMA', 'LIMA', 'MAGDALENA DEL MAR', '', 0, 0, ''),
(1260, '14', '1401', '140115', '', 'LIMA', 'LIMA', 'MIRAFLORES', '', 0, 0, ''),
(1261, '14', '1401', '140116', '', 'LIMA', 'LIMA', 'PACHACAMAC', '', 0, 0, ''),
(1262, '14', '1401', '140117', '', 'LIMA', 'LIMA', 'PUEBLO LIBRE', '', 0, 0, ''),
(1263, '14', '1401', '140118', '', 'LIMA', 'LIMA', 'PUCUSANA', '', 0, 0, ''),
(1264, '14', '1401', '140119', '', 'LIMA', 'LIMA', 'PUENTE PIEDRA', '', 0, 0, ''),
(1265, '14', '1401', '140120', '', 'LIMA', 'LIMA', 'PUNTA HERMOSA', '', 0, 0, ''),
(1266, '14', '1401', '140121', '', 'LIMA', 'LIMA', 'PUNTA NEGRA', '', 0, 0, ''),
(1267, '14', '1401', '140122', '', 'LIMA', 'LIMA', 'RIMAC', '', 0, 0, ''),
(1268, '14', '1401', '140123', '', 'LIMA', 'LIMA', 'SAN BARTOLO', '', 0, 0, ''),
(1269, '14', '1401', '140124', '', 'LIMA', 'LIMA', 'SAN ISIDRO', '', 0, 0, ''),
(1270, '14', '1401', '140125', '', 'LIMA', 'LIMA', 'BARRANCO', '', 0, 0, ''),
(1271, '14', '1401', '140126', '', 'LIMA', 'LIMA', 'SAN MARTIN DE PORRES', '', 0, 0, ''),
(1272, '14', '1401', '140127', '', 'LIMA', 'LIMA', 'SAN MIGUEL', '', 0, 0, ''),
(1273, '14', '1401', '140128', '', 'LIMA', 'LIMA', 'SANTA MARIA DEL MAR', '', 0, 0, ''),
(1274, '14', '1401', '140129', '', 'LIMA', 'LIMA', 'SANTA ROSA', '', 0, 0, ''),
(1275, '14', '1401', '140130', '', 'LIMA', 'LIMA', 'SANTIAGO DE SURCO', '', 0, 0, ''),
(1276, '14', '1401', '140131', '', 'LIMA', 'LIMA', 'SURQUILLO', '', 0, 0, ''),
(1277, '14', '1401', '140132', '', 'LIMA', 'LIMA', 'VILLA MARIA DEL TRIUNFO', '', 0, 0, ''),
(1278, '14', '1401', '140133', '', 'LIMA', 'LIMA', 'JESUS MARIA', '', 0, 0, ''),
(1279, '14', '1401', '140134', '', 'LIMA', 'LIMA', 'INDEPENDENCIA', '', 0, 0, ''),
(1280, '14', '1401', '140135', '', 'LIMA', 'LIMA', 'EL AGUSTINO', '', 0, 0, ''),
(1281, '14', '1401', '140136', '', 'LIMA', 'LIMA', 'SAN JUAN DE MIRAFLORES', '', 0, 0, ''),
(1282, '14', '1401', '140137', '', 'LIMA', 'LIMA', 'SAN JUAN DE LURIGANCHO', '', 0, 0, ''),
(1283, '14', '1401', '140138', '', 'LIMA', 'LIMA', 'SAN LUIS', '', 0, 0, ''),
(1284, '14', '1401', '140139', '', 'LIMA', 'LIMA', 'CIENEGUILLA', '', 0, 0, ''),
(1285, '14', '1401', '140140', '', 'LIMA', 'LIMA', 'SAN BORJA', '', 0, 0, ''),
(1286, '14', '1401', '140141', '', 'LIMA', 'LIMA', 'VILLA EL SALVADOR', '', 0, 0, ''),
(1287, '14', '1401', '140142', '', 'LIMA', 'LIMA', 'LOS OLIVOS', '', 0, 0, ''),
(1288, '14', '1401', '140143', '', 'LIMA', 'LIMA', 'SANTA ANITA', '', 0, 0, ''),
(1289, '14', '1402', '140201', '', 'LIMA', 'CAJATAMBO', 'CAJATAMBO', '', 0, 0, ''),
(1290, '14', '1402', '140205', '', 'LIMA', 'CAJATAMBO', 'COPA', '', 0, 0, ''),
(1291, '14', '1402', '140206', '', 'LIMA', 'CAJATAMBO', 'GORGOR', '', 0, 0, ''),
(1292, '14', '1402', '140207', '', 'LIMA', 'CAJATAMBO', 'HUANCAPON', '', 0, 0, ''),
(1293, '14', '1402', '140208', '', 'LIMA', 'CAJATAMBO', 'MANAS', '', 0, 0, ''),
(1294, '14', '1403', '140301', '', 'LIMA', 'CANTA', 'CANTA', '', 0, 0, ''),
(1295, '14', '1403', '140302', '', 'LIMA', 'CANTA', 'ARAHUAY', '', 0, 0, ''),
(1296, '14', '1403', '140303', '', 'LIMA', 'CANTA', 'HUAMANTANGA', '', 0, 0, ''),
(1297, '14', '1403', '140304', '', 'LIMA', 'CANTA', 'HUAROS', '', 0, 0, ''),
(1298, '14', '1403', '140305', '', 'LIMA', 'CANTA', 'LACHAQUI', '', 0, 0, ''),
(1299, '14', '1403', '140306', '', 'LIMA', 'CANTA', 'SAN BUENAVENTURA', '', 0, 0, ''),
(1300, '14', '1403', '140307', '', 'LIMA', 'CANTA', 'SANTA ROSA DE QUIVES', '', 0, 0, ''),
(1301, '14', '1404', '140401', '', 'LIMA', 'CAÑETE', 'SAN VICENTE DE CA', '', 0, 0, ''),
(1302, '14', '1404', '140402', '', 'LIMA', 'CAÑETE', 'CALANGO', '', 0, 0, ''),
(1303, '14', '1404', '140403', '', 'LIMA', 'CAÑETE', 'CERRO AZUL', '', 0, 0, ''),
(1304, '14', '1404', '140404', '', 'LIMA', 'CAÑETE', 'COAYLLO', '', 0, 0, ''),
(1305, '14', '1404', '140405', '', 'LIMA', 'CAÑETE', 'CHILCA', '', 0, 0, ''),
(1306, '14', '1404', '140406', '', 'LIMA', 'CAÑETE', 'IMPERIAL', '', 0, 0, ''),
(1307, '14', '1404', '140407', '', 'LIMA', 'CAÑETE', 'LUNAHUANA', '', 0, 0, ''),
(1308, '14', '1404', '140408', '', 'LIMA', 'CAÑETE', 'MALA', '', 0, 0, ''),
(1309, '14', '1404', '140409', '', 'LIMA', 'CAÑETE', 'NUEVO IMPERIAL', '', 0, 0, ''),
(1310, '14', '1404', '140410', '', 'LIMA', 'CAÑETE', 'PACARAN', '', 0, 0, ''),
(1311, '14', '1404', '140411', '', 'LIMA', 'CAÑETE', 'QUILMANA', '', 0, 0, ''),
(1312, '14', '1404', '140412', '', 'LIMA', 'CAÑETE', 'SAN ANTONIO', '', 0, 0, ''),
(1313, '14', '1404', '140413', '', 'LIMA', 'CAÑETE', 'SAN LUIS', '', 0, 0, ''),
(1314, '14', '1404', '140414', '', 'LIMA', 'CAÑETE', 'SANTA CRUZ DE FLORES', '', 0, 0, ''),
(1315, '14', '1404', '140415', '', 'LIMA', 'CAÑETE', 'ZU', '', 0, 0, ''),
(1316, '14', '1404', '140416', '', 'LIMA', 'CAÑETE', 'ASIA', '', 0, 0, ''),
(1317, '14', '1405', '140501', '', 'LIMA', 'HUAURA', 'HUACHO', '', 0, 0, ''),
(1318, '14', '1405', '140502', '', 'LIMA', 'HUAURA', 'AMBAR', '', 0, 0, ''),
(1319, '14', '1405', '140504', '', 'LIMA', 'HUAURA', 'CALETA DE CARQUIN', '', 0, 0, ''),
(1320, '14', '1405', '140505', '', 'LIMA', 'HUAURA', 'CHECRAS', '', 0, 0, ''),
(1321, '14', '1405', '140506', '', 'LIMA', 'HUAURA', 'HUALMAY', '', 0, 0, ''),
(1322, '14', '1405', '140507', '', 'LIMA', 'HUAURA', 'HUAURA', '', 0, 0, ''),
(1323, '14', '1405', '140508', '', 'LIMA', 'HUAURA', 'LEONCIO PRADO', '', 0, 0, ''),
(1324, '14', '1405', '140509', '', 'LIMA', 'HUAURA', 'PACCHO', '', 0, 0, ''),
(1325, '14', '1405', '140511', '', 'LIMA', 'HUAURA', 'SANTA LEONOR', '', 0, 0, ''),
(1326, '14', '1405', '140512', '', 'LIMA', 'HUAURA', 'SANTA MARIA', '', 0, 0, ''),
(1327, '14', '1405', '140513', '', 'LIMA', 'HUAURA', 'SAYAN', '', 0, 0, ''),
(1328, '14', '1405', '140516', '', 'LIMA', 'HUAURA', 'VEGUETA', '', 0, 0, ''),
(1329, '14', '1406', '140601', '', 'LIMA', 'HUAROCHIRI', 'MATUCANA', '', 0, 0, ''),
(1330, '14', '1406', '140602', '', 'LIMA', 'HUAROCHIRI', 'ANTIOQUIA', '', 0, 0, ''),
(1331, '14', '1406', '140603', '', 'LIMA', 'HUAROCHIRI', 'CALLAHUANCA', '', 0, 0, ''),
(1332, '14', '1406', '140604', '', 'LIMA', 'HUAROCHIRI', 'CARAMPOMA', '', 0, 0, ''),
(1333, '14', '1406', '140605', '', 'LIMA', 'HUAROCHIRI', 'CASTA', '', 0, 0, ''),
(1334, '14', '1406', '140606', '', 'LIMA', 'HUAROCHIRI', 'SAN JOSE DE LOS CHORRILLOS', '', 0, 0, ''),
(1335, '14', '1406', '140607', '', 'LIMA', 'HUAROCHIRI', 'CHICLA', '', 0, 0, ''),
(1336, '14', '1406', '140608', '', 'LIMA', 'HUAROCHIRI', 'HUANZA', '', 0, 0, ''),
(1337, '14', '1406', '140609', '', 'LIMA', 'HUAROCHIRI', 'HUAROCHIRI', '', 0, 0, ''),
(1338, '14', '1406', '140610', '', 'LIMA', 'HUAROCHIRI', 'LAHUAYTAMBO', '', 0, 0, ''),
(1339, '14', '1406', '140611', '', 'LIMA', 'HUAROCHIRI', 'LANGA', '', 0, 0, ''),
(1340, '14', '1406', '140612', '', 'LIMA', 'HUAROCHIRI', 'MARIATANA', '', 0, 0, ''),
(1341, '14', '1406', '140613', '', 'LIMA', 'HUAROCHIRI', 'RICARDO PALMA', '', 0, 0, ''),
(1342, '14', '1406', '140614', '', 'LIMA', 'HUAROCHIRI', 'SAN ANDRES DE TUPICOCHA', '', 0, 0, ''),
(1343, '14', '1406', '140615', '', 'LIMA', 'HUAROCHIRI', 'SAN ANTONIO', '', 0, 0, ''),
(1344, '14', '1406', '140616', '', 'LIMA', 'HUAROCHIRI', 'SAN BARTOLOME', '', 0, 0, ''),
(1345, '14', '1406', '140617', '', 'LIMA', 'HUAROCHIRI', 'SAN DAMIAN', '', 0, 0, ''),
(1346, '14', '1406', '140618', '', 'LIMA', 'HUAROCHIRI', 'SANGALLAYA', '', 0, 0, ''),
(1347, '14', '1406', '140619', '', 'LIMA', 'HUAROCHIRI', 'SAN JUAN DE TANTARANCHE', '', 0, 0, ''),
(1348, '14', '1406', '140620', '', 'LIMA', 'HUAROCHIRI', 'SAN LORENZO DE QUINTI', '', 0, 0, ''),
(1349, '14', '1406', '140621', '', 'LIMA', 'HUAROCHIRI', 'SAN MATEO', '', 0, 0, ''),
(1350, '14', '1406', '140622', '', 'LIMA', 'HUAROCHIRI', 'SAN MATEO DE OTAO', '', 0, 0, ''),
(1351, '14', '1406', '140623', '', 'LIMA', 'HUAROCHIRI', 'SAN PEDRO DE HUANCAYRE', '', 0, 0, ''),
(1352, '14', '1406', '140624', '', 'LIMA', 'HUAROCHIRI', 'SANTA CRUZ DE COCACHACRA', '', 0, 0, ''),
(1353, '14', '1406', '140625', '', 'LIMA', 'HUAROCHIRI', 'SANTA EULALIA', '', 0, 0, ''),
(1354, '14', '1406', '140626', '', 'LIMA', 'HUAROCHIRI', 'SANTIAGO DE ANCHUCAYA', '', 0, 0, ''),
(1355, '14', '1406', '140627', '', 'LIMA', 'HUAROCHIRI', 'SANTIAGO DE TUNA', '', 0, 0, ''),
(1356, '14', '1406', '140628', '', 'LIMA', 'HUAROCHIRI', 'SANTO DOMINGO DE LOS OLLEROS', '', 0, 0, ''),
(1357, '14', '1406', '140629', '', 'LIMA', 'HUAROCHIRI', 'SURCO', '', 0, 0, ''),
(1358, '14', '1406', '140630', '', 'LIMA', 'HUAROCHIRI', 'HUACHUPAMPA', '', 0, 0, ''),
(1359, '14', '1406', '140631', '', 'LIMA', 'HUAROCHIRI', 'LARAOS', '', 0, 0, ''),
(1360, '14', '1406', '140632', '', 'LIMA', 'HUAROCHIRI', 'SAN JUAN DE IRIS', '', 0, 0, ''),
(1361, '14', '1407', '140701', '', 'LIMA', 'YAUYOS', 'YAUYOS', '', 0, 0, ''),
(1362, '14', '1407', '140702', '', 'LIMA', 'YAUYOS', 'ALIS', '', 0, 0, ''),
(1363, '14', '1407', '140703', '', 'LIMA', 'YAUYOS', 'ALLAUCA', '', 0, 0, ''),
(1364, '14', '1407', '140704', '', 'LIMA', 'YAUYOS', 'AYAVIRI', '', 0, 0, ''),
(1365, '14', '1407', '140705', '', 'LIMA', 'YAUYOS', 'AZANGARO', '', 0, 0, ''),
(1366, '14', '1407', '140706', '', 'LIMA', 'YAUYOS', 'CACRA', '', 0, 0, ''),
(1367, '14', '1407', '140707', '', 'LIMA', 'YAUYOS', 'CARANIA', '', 0, 0, ''),
(1368, '14', '1407', '140708', '', 'LIMA', 'YAUYOS', 'COCHAS', '', 0, 0, ''),
(1369, '14', '1407', '140709', '', 'LIMA', 'YAUYOS', 'COLONIA', '', 0, 0, ''),
(1370, '14', '1407', '140710', '', 'LIMA', 'YAUYOS', 'CHOCOS', '', 0, 0, ''),
(1371, '14', '1407', '140711', '', 'LIMA', 'YAUYOS', 'HUAMPARA', '', 0, 0, ''),
(1372, '14', '1407', '140712', '', 'LIMA', 'YAUYOS', 'HUANCAYA', '', 0, 0, ''),
(1373, '14', '1407', '140713', '', 'LIMA', 'YAUYOS', 'HUANGASCAR', '', 0, 0, ''),
(1374, '14', '1407', '140714', '', 'LIMA', 'YAUYOS', 'HUANTAN', '', 0, 0, ''),
(1375, '14', '1407', '140715', '', 'LIMA', 'YAUYOS', 'HUA', '', 0, 0, ''),
(1376, '14', '1407', '140716', '', 'LIMA', 'YAUYOS', 'LARAOS', '', 0, 0, ''),
(1377, '14', '1407', '140717', '', 'LIMA', 'YAUYOS', 'LINCHA', '', 0, 0, ''),
(1378, '14', '1407', '140718', '', 'LIMA', 'YAUYOS', 'MIRAFLORES', '', 0, 0, ''),
(1379, '14', '1407', '140719', '', 'LIMA', 'YAUYOS', 'OMAS', '', 0, 0, ''),
(1380, '14', '1407', '140720', '', 'LIMA', 'YAUYOS', 'QUINCHES', '', 0, 0, ''),
(1381, '14', '1407', '140721', '', 'LIMA', 'YAUYOS', 'QUINOCAY', '', 0, 0, ''),
(1382, '14', '1407', '140722', '', 'LIMA', 'YAUYOS', 'SAN JOAQUIN', '', 0, 0, ''),
(1383, '14', '1407', '140723', '', 'LIMA', 'YAUYOS', 'SAN PEDRO DE PILAS', '', 0, 0, ''),
(1384, '14', '1407', '140724', '', 'LIMA', 'YAUYOS', 'TANTA', '', 0, 0, ''),
(1385, '14', '1407', '140725', '', 'LIMA', 'YAUYOS', 'TAURIPAMPA', '', 0, 0, ''),
(1386, '14', '1407', '140726', '', 'LIMA', 'YAUYOS', 'TUPE', '', 0, 0, ''),
(1387, '14', '1407', '140727', '', 'LIMA', 'YAUYOS', 'TOMAS', '', 0, 0, ''),
(1388, '14', '1407', '140728', '', 'LIMA', 'YAUYOS', 'VI', '', 0, 0, ''),
(1389, '14', '1407', '140729', '', 'LIMA', 'YAUYOS', 'VITIS', '', 0, 0, ''),
(1390, '14', '1407', '140730', '', 'LIMA', 'YAUYOS', 'HONGOS', '', 0, 0, ''),
(1391, '14', '1407', '140731', '', 'LIMA', 'YAUYOS', 'MADEAN', '', 0, 0, ''),
(1392, '14', '1407', '140732', '', 'LIMA', 'YAUYOS', 'PUTINZA', '', 0, 0, ''),
(1393, '14', '1407', '140733', '', 'LIMA', 'YAUYOS', 'CATAHUASI', '', 0, 0, ''),
(1394, '14', '1408', '140801', '', 'LIMA', 'HUARAL', 'HUARAL', '', 0, 0, ''),
(1395, '14', '1408', '140802', '', 'LIMA', 'HUARAL', 'ATAVILLOS ALTO', '', 0, 0, ''),
(1396, '14', '1408', '140803', '', 'LIMA', 'HUARAL', 'ATAVILLOS BAJO', '', 0, 0, ''),
(1397, '14', '1408', '140804', '', 'LIMA', 'HUARAL', 'AUCALLAMA', '', 0, 0, ''),
(1398, '14', '1408', '140805', '', 'LIMA', 'HUARAL', 'CHANCAY', '', 0, 0, ''),
(1399, '14', '1408', '140806', '', 'LIMA', 'HUARAL', 'IHUARI', '', 0, 0, ''),
(1400, '14', '1408', '140807', '', 'LIMA', 'HUARAL', 'LAMPIAN', '', 0, 0, ''),
(1401, '14', '1408', '140808', '', 'LIMA', 'HUARAL', 'PACARAOS', '', 0, 0, ''),
(1402, '14', '1408', '140809', '', 'LIMA', 'HUARAL', 'SAN MIGUEL DE ACOS', '', 0, 0, ''),
(1403, '14', '1408', '140810', '', 'LIMA', 'HUARAL', 'VEINTISIETE DE NOVIEMBRE', '', 0, 0, ''),
(1404, '14', '1408', '140811', '', 'LIMA', 'HUARAL', 'SANTA CRUZ DE ANDAMARCA', '', 0, 0, ''),
(1405, '14', '1408', '140812', '', 'LIMA', 'HUARAL', 'SUMBILCA', '', 0, 0, ''),
(1406, '14', '1409', '140901', '', 'LIMA', 'BARRANCA', 'BARRANCA', '', 0, 0, ''),
(1407, '14', '1409', '140902', '', 'LIMA', 'BARRANCA', 'PARAMONGA', '', 0, 0, ''),
(1408, '14', '1409', '140903', '', 'LIMA', 'BARRANCA', 'PATIVILCA', '', 0, 0, ''),
(1409, '14', '1409', '140904', '', 'LIMA', 'BARRANCA', 'SUPE', '', 0, 0, ''),
(1410, '14', '1409', '140905', '', 'LIMA', 'BARRANCA', 'SUPE PUERTO', '', 0, 0, ''),
(1411, '14', '1410', '141001', '', 'LIMA', 'OYON', 'OYON', '', 0, 0, ''),
(1412, '14', '1410', '141002', '', 'LIMA', 'OYON', 'NAVAN', '', 0, 0, ''),
(1413, '14', '1410', '141003', '', 'LIMA', 'OYON', 'CAUJUL', '', 0, 0, ''),
(1414, '14', '1410', '141004', '', 'LIMA', 'OYON', 'ANDAJES', '', 0, 0, ''),
(1415, '14', '1410', '141005', '', 'LIMA', 'OYON', 'PACHANGARA', '', 0, 0, ''),
(1416, '14', '1410', '141006', '', 'LIMA', 'OYON', 'COCHAMARCA', '', 0, 0, ''),
(1819, '14', '1411', '141101', '', 'LIMA', 'CALLAO', 'CALLAO', '', 0, 0, ''),
(1820, '14', '1411', '141102', '', 'LIMA', 'CALLAO', 'BELLAVISTA', '', 0, 0, ''),
(1821, '14', '1411', '141103', '', 'LIMA', 'CALLAO', 'LA PUNTA', '', 0, 0, ''),
(1822, '14', '1411', '141104', '', 'LIMA', 'CALLAO', 'CARMEN DE LA LEGUA-REYNOSO', '', 0, 0, ''),
(1823, '14', '1411', '141105', '', 'LIMA', 'CALLAO', 'LA PERLA', '', 0, 0, ''),
(1824, '14', '1411', '141106', '', 'LIMA', 'CALLAO', 'VENTANILLA', '', 0, 0, ''),
(1417, '15', '1501', '150101', '', 'LORETO', 'MAYNAS', 'IQUITOS', '', 0, 0, ''),
(1418, '15', '1501', '150102', '', 'LORETO', 'MAYNAS', 'ALTO NANAY', '', 0, 0, ''),
(1419, '15', '1501', '150103', '', 'LORETO', 'MAYNAS', 'FERNANDO LORES', '', 0, 0, ''),
(1420, '15', '1501', '150104', '', 'LORETO', 'MAYNAS', 'LAS AMAZONAS', '', 0, 0, ''),
(1421, '15', '1501', '150105', '', 'LORETO', 'MAYNAS', 'MAZAN', '', 0, 0, ''),
(1422, '15', '1501', '150106', '', 'LORETO', 'MAYNAS', 'NAPO', '', 0, 0, ''),
(1423, '15', '1501', '150107', '', 'LORETO', 'MAYNAS', 'PUTUMAYO', '', 0, 0, ''),
(1424, '15', '1501', '150108', '', 'LORETO', 'MAYNAS', 'TORRES CAUSANA', '', 0, 0, ''),
(1425, '15', '1501', '150110', '', 'LORETO', 'MAYNAS', 'INDIANA', '', 0, 0, ''),
(1426, '15', '1501', '150111', '', 'LORETO', 'MAYNAS', 'PUNCHANA', '', 0, 0, ''),
(1427, '15', '1501', '150112', '', 'LORETO', 'MAYNAS', 'BELEN', '', 0, 0, ''),
(1428, '15', '1501', '150113', '', 'LORETO', 'MAYNAS', 'SAN JUAN BAUTISTA', '', 0, 0, ''),
(1429, '15', '1501', '150114', '', 'LORETO', 'MAYNAS', 'TENIENTE MANUEL CLAVERO', '', 0, 0, ''),
(1430, '15', '1502', '150201', '', 'LORETO', 'ALTO AMAZONAS', 'YURIMAGUAS', '', 0, 0, ''),
(1431, '15', '1502', '150202', '', 'LORETO', 'ALTO AMAZONAS', 'BALSAPUERTO', '', 0, 0, ''),
(1432, '15', '1502', '150205', '', 'LORETO', 'ALTO AMAZONAS', 'JEBEROS', '', 0, 0, ''),
(1433, '15', '1502', '150206', '', 'LORETO', 'ALTO AMAZONAS', 'LAGUNAS', '', 0, 0, ''),
(1434, '15', '1502', '150210', '', 'LORETO', 'ALTO AMAZONAS', 'SANTA CRUZ', '', 0, 0, ''),
(1435, '15', '1502', '150211', '', 'LORETO', 'ALTO AMAZONAS', 'TENIENTE CESAR LOPEZ ROJAS', '', 0, 0, ''),
(1436, '15', '1503', '150301', '', 'LORETO', 'LORETO', 'NAUTA', '', 0, 0, ''),
(1437, '15', '1503', '150302', '', 'LORETO', 'LORETO', 'PARINARI', '', 0, 0, ''),
(1438, '15', '1503', '150303', '', 'LORETO', 'LORETO', 'TIGRE', '', 0, 0, ''),
(1439, '15', '1503', '150304', '', 'LORETO', 'LORETO', 'URARINAS', '', 0, 0, ''),
(1440, '15', '1503', '150305', '', 'LORETO', 'LORETO', 'TROMPETEROS', '', 0, 0, ''),
(1441, '15', '1504', '150401', '', 'LORETO', 'REQUENA', 'REQUENA', '', 0, 0, ''),
(1442, '15', '1504', '150402', '', 'LORETO', 'REQUENA', 'ALTO TAPICHE', '', 0, 0, ''),
(1443, '15', '1504', '150403', '', 'LORETO', 'REQUENA', 'CAPELO', '', 0, 0, ''),
(1444, '15', '1504', '150404', '', 'LORETO', 'REQUENA', 'EMILIO SAN MARTIN', '', 0, 0, ''),
(1445, '15', '1504', '150405', '', 'LORETO', 'REQUENA', 'MAQUIA', '', 0, 0, ''),
(1446, '15', '1504', '150406', '', 'LORETO', 'REQUENA', 'PUINAHUA', '', 0, 0, ''),
(1447, '15', '1504', '150407', '', 'LORETO', 'REQUENA', 'SAQUENA', '', 0, 0, ''),
(1448, '15', '1504', '150408', '', 'LORETO', 'REQUENA', 'SOPLIN', '', 0, 0, ''),
(1449, '15', '1504', '150409', '', 'LORETO', 'REQUENA', 'TAPICHE', '', 0, 0, ''),
(1450, '15', '1504', '150410', '', 'LORETO', 'REQUENA', 'JENARO HERRERA', '', 0, 0, ''),
(1451, '15', '1504', '150411', '', 'LORETO', 'REQUENA', 'YAQUERANA', '', 0, 0, ''),
(1452, '15', '1505', '150501', '', 'LORETO', 'UCAYALI', 'CONTAMANA', '', 0, 0, ''),
(1453, '15', '1505', '150502', '', 'LORETO', 'UCAYALI', 'VARGAS GUERRA', '', 0, 0, ''),
(1454, '15', '1505', '150503', '', 'LORETO', 'UCAYALI', 'PADRE MARQUEZ', '', 0, 0, ''),
(1455, '15', '1505', '150504', '', 'LORETO', 'UCAYALI', 'PAMPA HERMOSA', '', 0, 0, ''),
(1456, '15', '1505', '150505', '', 'LORETO', 'UCAYALI', 'SARAYACU', '', 0, 0, ''),
(1457, '15', '1505', '150506', '', 'LORETO', 'UCAYALI', 'INAHUAYA', '', 0, 0, ''),
(1458, '15', '1506', '150601', '', 'LORETO', 'MARISCAL RAMON CASTILLA', 'RAMON CASTILLA', '', 0, 0, ''),
(1459, '15', '1506', '150602', '', 'LORETO', 'MARISCAL RAMON CASTILLA', 'PEBAS', '', 0, 0, ''),
(1460, '15', '1506', '150603', '', 'LORETO', 'MARISCAL RAMON CASTILLA', 'YAVARI', '', 0, 0, ''),
(1461, '15', '1506', '150604', '', 'LORETO', 'MARISCAL RAMON CASTILLA', 'SAN PABLO', '', 0, 0, ''),
(1462, '15', '1507', '150701', '', 'LORETO', 'DATEM DEL MARAÑON', 'BARRANCA', '', 0, 0, ''),
(1463, '15', '1507', '150702', '', 'LORETO', 'DATEM DEL MARAÑON', 'ANDOAS', '', 0, 0, ''),
(1464, '15', '1507', '150703', '', 'LORETO', 'DATEM DEL MARAÑON', 'CAHUAPANAS', '', 0, 0, ''),
(1465, '15', '1507', '150704', '', 'LORETO', 'DATEM DEL MARAÑON', 'MANSERICHE', '', 0, 0, ''),
(1466, '15', '1507', '150705', '', 'LORETO', 'DATEM DEL MARAÑON', 'MORONA', '', 0, 0, ''),
(1467, '15', '1507', '150706', '', 'LORETO', 'DATEM DEL MARAÑON', 'PASTAZA', '', 0, 0, ''),
(1468, '16', '1601', '160101', '', 'MADRE DE DIOS', 'TAMBOPATA', 'TAMBOPATA', '', 0, 0, ''),
(1469, '16', '1601', '160102', '', 'MADRE DE DIOS', 'TAMBOPATA', 'INAMBARI', '', 0, 0, ''),
(1470, '16', '1601', '160103', '', 'MADRE DE DIOS', 'TAMBOPATA', 'LAS PIEDRAS', '', 0, 0, ''),
(1471, '16', '1601', '160104', '', 'MADRE DE DIOS', 'TAMBOPATA', 'LABERINTO', '', 0, 0, ''),
(1472, '16', '1602', '160201', '', 'MADRE DE DIOS', 'MANU', 'MANU', '', 0, 0, ''),
(1473, '16', '1602', '160202', '', 'MADRE DE DIOS', 'MANU', 'FITZCARRALD', '', 0, 0, ''),
(1474, '16', '1602', '160203', '', 'MADRE DE DIOS', 'MANU', 'MADRE DE DIOS', '', 0, 0, ''),
(1475, '16', '1602', '160204', '', 'MADRE DE DIOS', 'MANU', 'HUEPETUHE', '', 0, 0, ''),
(1476, '16', '1603', '160301', '', 'MADRE DE DIOS', 'TAHUAMANU', 'I', '', 0, 0, ''),
(1477, '16', '1603', '160302', '', 'MADRE DE DIOS', 'TAHUAMANU', 'IBERIA', '', 0, 0, ''),
(1478, '16', '1603', '160303', '', 'MADRE DE DIOS', 'TAHUAMANU', 'TAHUAMANU', '', 0, 0, ''),
(1479, '17', '1701', '170101', '', 'MOQUEGUA', 'MARISCAL NIETO', 'MOQUEGUA', '', 0, 0, ''),
(1480, '17', '1701', '170102', '', 'MOQUEGUA', 'MARISCAL NIETO', 'CARUMAS', '', 0, 0, ''),
(1481, '17', '1701', '170103', '', 'MOQUEGUA', 'MARISCAL NIETO', 'CUCHUMBAYA', '', 0, 0, ''),
(1482, '17', '1701', '170104', '', 'MOQUEGUA', 'MARISCAL NIETO', 'SAN CRISTOBAL', '', 0, 0, ''),
(1483, '17', '1701', '170105', '', 'MOQUEGUA', 'MARISCAL NIETO', 'TORATA', '', 0, 0, ''),
(1484, '17', '1701', '170106', '', 'MOQUEGUA', 'MARISCAL NIETO', 'SAMEGUA', '', 0, 0, ''),
(1485, '17', '1702', '170201', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'OMATE', '', 0, 0, ''),
(1486, '17', '1702', '170202', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'COALAQUE', '', 0, 0, ''),
(1487, '17', '1702', '170203', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'CHOJATA', '', 0, 0, ''),
(1488, '17', '1702', '170204', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'ICHUÑA', '', 0, 0, ''),
(1489, '17', '1702', '170205', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'LA CAPILLA', '', 0, 0, ''),
(1490, '17', '1702', '170206', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'LLOQUE', '', 0, 0, ''),
(1491, '17', '1702', '170207', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'MATALAQUE', '', 0, 0, ''),
(1492, '17', '1702', '170208', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'PUQUINA', '', 0, 0, ''),
(1493, '17', '1702', '170209', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'QUINISTAQUILLAS', '', 0, 0, ''),
(1494, '17', '1702', '170210', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'UBINAS', '', 0, 0, ''),
(1495, '17', '1702', '170211', '', 'MOQUEGUA', 'GENERAL SANCHEZ CERRO', 'YUNGA', '', 0, 0, ''),
(1496, '17', '1703', '170301', '', 'MOQUEGUA', 'ILO', 'ILO', '', 0, 0, ''),
(1497, '17', '1703', '170302', '', 'MOQUEGUA', 'ILO', 'EL ALGARROBAL', '', 0, 0, ''),
(1498, '17', '1703', '170303', '', 'MOQUEGUA', 'ILO', 'PACOCHA', '', 0, 0, ''),
(1499, '18', '1801', '180101', '', 'PASCO', 'PASCO', 'CHAUPIMARCA', '', 0, 0, ''),
(1500, '18', '1801', '180103', '', 'PASCO', 'PASCO', 'HUACHON', '', 0, 0, ''),
(1501, '18', '1801', '180104', '', 'PASCO', 'PASCO', 'HUARIACA', '', 0, 0, ''),
(1502, '18', '1801', '180105', '', 'PASCO', 'PASCO', 'HUAYLLAY', '', 0, 0, ''),
(1503, '18', '1801', '180106', '', 'PASCO', 'PASCO', 'NINACACA', '', 0, 0, ''),
(1504, '18', '1801', '180107', '', 'PASCO', 'PASCO', 'PALLANCHACRA', '', 0, 0, ''),
(1505, '18', '1801', '180108', '', 'PASCO', 'PASCO', 'PAUCARTAMBO', '', 0, 0, ''),
(1506, '18', '1801', '180109', '', 'PASCO', 'PASCO', 'SAN FCO DE ASIS DE YARUSYACAN', '', 0, 0, ''),
(1507, '18', '1801', '180110', '', 'PASCO', 'PASCO', 'SIMON BOLIVAR', '', 0, 0, ''),
(1508, '18', '1801', '180111', '', 'PASCO', 'PASCO', 'TICLACAYAN', '', 0, 0, ''),
(1509, '18', '1801', '180112', '', 'PASCO', 'PASCO', 'TINYAHUARCO', '', 0, 0, ''),
(1510, '18', '1801', '180113', '', 'PASCO', 'PASCO', 'VICCO', '', 0, 0, ''),
(1511, '18', '1801', '180114', '', 'PASCO', 'PASCO', 'YANACANCHA', '', 0, 0, ''),
(1512, '18', '1802', '180201', '', 'PASCO', 'DANIEL ALCIDES CARRION', 'YANAHUANCA', '', 0, 0, ''),
(1513, '18', '1802', '180202', '', 'PASCO', 'DANIEL ALCIDES CARRION', 'CHACAYAN', '', 0, 0, ''),
(1514, '18', '1802', '180203', '', 'PASCO', 'DANIEL ALCIDES CARRION', 'GOYLLARISQUIZGA', '', 0, 0, ''),
(1515, '18', '1802', '180204', '', 'PASCO', 'DANIEL ALCIDES CARRION', 'PAUCAR', '', 0, 0, ''),
(1516, '18', '1802', '180205', '', 'PASCO', 'DANIEL ALCIDES CARRION', 'SAN PEDRO DE PILLAO', '', 0, 0, ''),
(1517, '18', '1802', '180206', '', 'PASCO', 'DANIEL ALCIDES CARRION', 'SANTA ANA DE TUSI', '', 0, 0, ''),
(1518, '18', '1802', '180207', '', 'PASCO', 'DANIEL ALCIDES CARRION', 'TAPUC', '', 0, 0, ''),
(1519, '18', '1802', '180208', '', 'PASCO', 'DANIEL ALCIDES CARRION', 'VILCABAMBA', '', 0, 0, ''),
(1520, '18', '1803', '180301', '', 'PASCO', 'OXAPAMPA', 'OXAPAMPA', '', 0, 0, ''),
(1521, '18', '1803', '180302', '', 'PASCO', 'OXAPAMPA', 'CHONTABAMBA', '', 0, 0, ''),
(1522, '18', '1803', '180303', '', 'PASCO', 'OXAPAMPA', 'HUANCABAMBA', '', 0, 0, ''),
(1523, '18', '1803', '180304', '', 'PASCO', 'OXAPAMPA', 'PUERTO BERMUDEZ', '', 0, 0, ''),
(1524, '18', '1803', '180305', '', 'PASCO', 'OXAPAMPA', 'VILLA RICA', '', 0, 0, ''),
(1525, '18', '1803', '180306', '', 'PASCO', 'OXAPAMPA', 'POZUZO', '', 0, 0, ''),
(1526, '18', '1803', '180307', '', 'PASCO', 'OXAPAMPA', 'PALCAZU', '', 0, 0, ''),
(1527, '18', '1803', '180308', '', 'PASCO', 'OXAPAMPA', 'CONSTITUCION', '', 0, 0, ''),
(1528, '19', '1901', '190101', '', 'PIURA', 'PIURA', 'PIURA', '', 0, 0, ''),
(1529, '19', '1901', '190103', '', 'PIURA', 'PIURA', 'CASTILLA', '', 0, 0, ''),
(1530, '19', '1901', '190104', '', 'PIURA', 'PIURA', 'CATACAOS', '', 0, 0, ''),
(1531, '19', '1901', '190105', '', 'PIURA', 'PIURA', 'LA ARENA', '', 0, 0, ''),
(1532, '19', '1901', '190106', '', 'PIURA', 'PIURA', 'LA UNION', '', 0, 0, ''),
(1533, '19', '1901', '190107', '', 'PIURA', 'PIURA', 'LAS LOMAS', '', 0, 0, ''),
(1534, '19', '1901', '190109', '', 'PIURA', 'PIURA', 'TAMBO GRANDE', '', 0, 0, ''),
(1535, '19', '1901', '190113', '', 'PIURA', 'PIURA', 'CURA MORI', '', 0, 0, ''),
(1536, '19', '1901', '190114', '', 'PIURA', 'PIURA', 'EL TALLAN', '', 0, 0, ''),
(1537, '19', '1901', '190115', '', 'PIURA', 'PIURA', 'VEINTISEIS DE OCTUBRE', '', 0, 0, ''),
(1538, '19', '1902', '190201', '', 'PIURA', 'AYABACA', 'AYABACA', '', 0, 0, ''),
(1539, '19', '1902', '190202', '', 'PIURA', 'AYABACA', 'FRIAS', '', 0, 0, ''),
(1540, '19', '1902', '190203', '', 'PIURA', 'AYABACA', 'LAGUNAS', '', 0, 0, ''),
(1541, '19', '1902', '190204', '', 'PIURA', 'AYABACA', 'MONTERO', '', 0, 0, ''),
(1542, '19', '1902', '190205', '', 'PIURA', 'AYABACA', 'PACAIPAMPA', '', 0, 0, ''),
(1543, '19', '1902', '190206', '', 'PIURA', 'AYABACA', 'SAPILLICA', '', 0, 0, ''),
(1544, '19', '1902', '190207', '', 'PIURA', 'AYABACA', 'SICCHEZ', '', 0, 0, ''),
(1545, '19', '1902', '190208', '', 'PIURA', 'AYABACA', 'SUYO', '', 0, 0, ''),
(1546, '19', '1902', '190209', '', 'PIURA', 'AYABACA', 'JILILI', '', 0, 0, ''),
(1547, '19', '1902', '190210', '', 'PIURA', 'AYABACA', 'PAIMAS', '', 0, 0, ''),
(1548, '19', '1903', '190301', '', 'PIURA', 'HUANCABAMBA', 'HUANCABAMBA', '', 0, 0, ''),
(1549, '19', '1903', '190302', '', 'PIURA', 'HUANCABAMBA', 'CANCHAQUE', '', 0, 0, ''),
(1550, '19', '1903', '190303', '', 'PIURA', 'HUANCABAMBA', 'HUARMACA', '', 0, 0, ''),
(1551, '19', '1903', '190304', '', 'PIURA', 'HUANCABAMBA', 'SONDOR', '', 0, 0, ''),
(1552, '19', '1903', '190305', '', 'PIURA', 'HUANCABAMBA', 'SONDORILLO', '', 0, 0, ''),
(1553, '19', '1903', '190306', '', 'PIURA', 'HUANCABAMBA', 'EL CARMEN DE LA FRONTERA', '', 0, 0, ''),
(1554, '19', '1903', '190307', '', 'PIURA', 'HUANCABAMBA', 'SAN MIGUEL DE EL FAIQUE', '', 0, 0, ''),
(1555, '19', '1903', '190308', '', 'PIURA', 'HUANCABAMBA', 'LALAQUIZ', '', 0, 0, ''),
(1556, '19', '1904', '190401', '', 'PIURA', 'MORROPON', 'CHULUCANAS', '', 0, 0, ''),
(1557, '19', '1904', '190402', '', 'PIURA', 'MORROPON', 'BUENOS AIRES', '', 0, 0, ''),
(1558, '19', '1904', '190403', '', 'PIURA', 'MORROPON', 'CHALACO', '', 0, 0, ''),
(1559, '19', '1904', '190404', '', 'PIURA', 'MORROPON', 'MORROPON', '', 0, 0, ''),
(1560, '19', '1904', '190405', '', 'PIURA', 'MORROPON', 'SALITRAL', '', 0, 0, ''),
(1561, '19', '1904', '190406', '', 'PIURA', 'MORROPON', 'SANTA CATALINA DE MOSSA', '', 0, 0, ''),
(1562, '19', '1904', '190407', '', 'PIURA', 'MORROPON', 'SANTO DOMINGO', '', 0, 0, ''),
(1563, '19', '1904', '190408', '', 'PIURA', 'MORROPON', 'LA MATANZA', '', 0, 0, ''),
(1564, '19', '1904', '190409', '', 'PIURA', 'MORROPON', 'YAMANGO', '', 0, 0, ''),
(1565, '19', '1904', '190410', '', 'PIURA', 'MORROPON', 'SAN JUAN DE BIGOTE', '', 0, 0, ''),
(1566, '19', '1905', '190501', '', 'PIURA', 'PAITA', 'PAITA', '', 0, 0, ''),
(1567, '19', '1905', '190502', '', 'PIURA', 'PAITA', 'AMOTAPE', '', 0, 0, ''),
(1568, '19', '1905', '190503', '', 'PIURA', 'PAITA', 'ARENAL', '', 0, 0, ''),
(1569, '19', '1905', '190504', '', 'PIURA', 'PAITA', 'LA HUACA', '', 0, 0, ''),
(1570, '19', '1905', '190505', '', 'PIURA', 'PAITA', 'COLAN', '', 0, 0, ''),
(1571, '19', '1905', '190506', '', 'PIURA', 'PAITA', 'TAMARINDO', '', 0, 0, ''),
(1572, '19', '1905', '190507', '', 'PIURA', 'PAITA', 'VICHAYAL', '', 0, 0, ''),
(1573, '19', '1906', '190601', '', 'PIURA', 'SULLANA', 'SULLANA', '', 0, 0, ''),
(1574, '19', '1906', '190602', '', 'PIURA', 'SULLANA', 'BELLAVISTA', '', 0, 0, ''),
(1575, '19', '1906', '190603', '', 'PIURA', 'SULLANA', 'LANCONES', '', 0, 0, ''),
(1576, '19', '1906', '190604', '', 'PIURA', 'SULLANA', 'MARCAVELICA', '', 0, 0, ''),
(1577, '19', '1906', '190605', '', 'PIURA', 'SULLANA', 'MIGUEL CHECA', '', 0, 0, ''),
(1578, '19', '1906', '190606', '', 'PIURA', 'SULLANA', 'QUERECOTILLO', '', 0, 0, ''),
(1579, '19', '1906', '190607', '', 'PIURA', 'SULLANA', 'SALITRAL', '', 0, 0, ''),
(1580, '19', '1906', '190608', '', 'PIURA', 'SULLANA', 'IGNACIO ESCUDERO', '', 0, 0, ''),
(1581, '19', '1907', '190701', '', 'PIURA', 'TALARA', 'PARIÑAS', '', 0, 0, ''),
(1582, '19', '1907', '190702', '', 'PIURA', 'TALARA', 'EL ALTO', '', 0, 0, ''),
(1583, '19', '1907', '190703', '', 'PIURA', 'TALARA', 'LA BREA', '', 0, 0, ''),
(1584, '19', '1907', '190704', '', 'PIURA', 'TALARA', 'LOBITOS', '', 0, 0, ''),
(1585, '19', '1907', '190705', '', 'PIURA', 'TALARA', 'MANCORA', '', 0, 0, ''),
(1586, '19', '1907', '190706', '', 'PIURA', 'TALARA', 'LOS ORGANOS', '', 0, 0, ''),
(1587, '19', '1908', '190801', '', 'PIURA', 'SECHURA', 'SECHURA', '', 0, 0, ''),
(1588, '19', '1908', '190802', '', 'PIURA', 'SECHURA', 'VICE', '', 0, 0, ''),
(1589, '19', '1908', '190803', '', 'PIURA', 'SECHURA', 'BERNAL', '', 0, 0, ''),
(1590, '19', '1908', '190804', '', 'PIURA', 'SECHURA', 'BELLAVISTA DE LA UNION', '', 0, 0, ''),
(1591, '19', '1908', '190805', '', 'PIURA', 'SECHURA', 'CRISTO NOS VALGA', '', 0, 0, ''),
(1592, '19', '1908', '190806', '', 'PIURA', 'SECHURA', 'RINCONADA-LLICUAR', '', 0, 0, ''),
(1593, '20', '2001', '200101', '', 'PUNO', 'PUNO', 'PUNO', '', 0, 0, ''),
(1594, '20', '2001', '200102', '', 'PUNO', 'PUNO', 'ACORA', '', 0, 0, ''),
(1595, '20', '2001', '200103', '', 'PUNO', 'PUNO', 'ATUNCOLLA', '', 0, 0, ''),
(1596, '20', '2001', '200104', '', 'PUNO', 'PUNO', 'CAPACHICA', '', 0, 0, ''),
(1597, '20', '2001', '200105', '', 'PUNO', 'PUNO', 'COATA', '', 0, 0, ''),
(1598, '20', '2001', '200106', '', 'PUNO', 'PUNO', 'CHUCUITO', '', 0, 0, ''),
(1599, '20', '2001', '200107', '', 'PUNO', 'PUNO', 'HUATA', '', 0, 0, ''),
(1600, '20', '2001', '200108', '', 'PUNO', 'PUNO', 'MAÑAZO', '', 0, 0, ''),
(1601, '20', '2001', '200109', '', 'PUNO', 'PUNO', 'PAUCARCOLLA', '', 0, 0, ''),
(1602, '20', '2001', '200110', '', 'PUNO', 'PUNO', 'PICHACANI', '', 0, 0, ''),
(1603, '20', '2001', '200111', '', 'PUNO', 'PUNO', 'SAN ANTONIO', '', 0, 0, ''),
(1604, '20', '2001', '200112', '', 'PUNO', 'PUNO', 'TIQUILLACA', '', 0, 0, ''),
(1605, '20', '2001', '200113', '', 'PUNO', 'PUNO', 'VILQUE', '', 0, 0, ''),
(1606, '20', '2001', '200114', '', 'PUNO', 'PUNO', 'PLATERIA', '', 0, 0, ''),
(1607, '20', '2001', '200115', '', 'PUNO', 'PUNO', 'AMANTANI', '', 0, 0, ''),
(1608, '20', '2002', '200201', '', 'PUNO', 'AZANGARO', 'AZANGARO', '', 0, 0, ''),
(1609, '20', '2002', '200202', '', 'PUNO', 'AZANGARO', 'ACHAYA', '', 0, 0, ''),
(1610, '20', '2002', '200203', '', 'PUNO', 'AZANGARO', 'ARAPA', '', 0, 0, ''),
(1611, '20', '2002', '200204', '', 'PUNO', 'AZANGARO', 'ASILLO', '', 0, 0, ''),
(1612, '20', '2002', '200205', '', 'PUNO', 'AZANGARO', 'CAMINACA', '', 0, 0, ''),
(1613, '20', '2002', '200206', '', 'PUNO', 'AZANGARO', 'CHUPA', '', 0, 0, ''),
(1614, '20', '2002', '200207', '', 'PUNO', 'AZANGARO', 'JOSE DOMINGO CHOQUEHUANCA', '', 0, 0, ''),
(1615, '20', '2002', '200208', '', 'PUNO', 'AZANGARO', 'MUÑANI', '', 0, 0, ''),
(1616, '20', '2002', '200210', '', 'PUNO', 'AZANGARO', 'POTONI', '', 0, 0, ''),
(1617, '20', '2002', '200212', '', 'PUNO', 'AZANGARO', 'SAMAN', '', 0, 0, ''),
(1618, '20', '2002', '200213', '', 'PUNO', 'AZANGARO', 'SAN ANTON', '', 0, 0, ''),
(1619, '20', '2002', '200214', '', 'PUNO', 'AZANGARO', 'SAN JOSE', '', 0, 0, ''),
(1620, '20', '2002', '200215', '', 'PUNO', 'AZANGARO', 'SAN JUAN DE SALINAS', '', 0, 0, ''),
(1621, '20', '2002', '200216', '', 'PUNO', 'AZANGARO', 'SANTIAGO DE PUPUJA', '', 0, 0, ''),
(1622, '20', '2002', '200217', '', 'PUNO', 'AZANGARO', 'TIRAPATA', '', 0, 0, ''),
(1623, '20', '2003', '200301', '', 'PUNO', 'CARABAYA', 'MACUSANI', '', 0, 0, ''),
(1624, '20', '2003', '200302', '', 'PUNO', 'CARABAYA', 'AJOYANI', '', 0, 0, ''),
(1625, '20', '2003', '200303', '', 'PUNO', 'CARABAYA', 'AYAPATA', '', 0, 0, ''),
(1626, '20', '2003', '200304', '', 'PUNO', 'CARABAYA', 'COASA', '', 0, 0, ''),
(1627, '20', '2003', '200305', '', 'PUNO', 'CARABAYA', 'CORANI', '', 0, 0, ''),
(1628, '20', '2003', '200306', '', 'PUNO', 'CARABAYA', 'CRUCERO', '', 0, 0, ''),
(1629, '20', '2003', '200307', '', 'PUNO', 'CARABAYA', 'ITUATA', '', 0, 0, ''),
(1630, '20', '2003', '200308', '', 'PUNO', 'CARABAYA', 'OLLACHEA', '', 0, 0, ''),
(1631, '20', '2003', '200309', '', 'PUNO', 'CARABAYA', 'SAN GABAN', '', 0, 0, ''),
(1632, '20', '2003', '200310', '', 'PUNO', 'CARABAYA', 'USICAYOS', '', 0, 0, ''),
(1633, '20', '2004', '200401', '', 'PUNO', 'CHUCUITO', 'JULI', '', 0, 0, ''),
(1634, '20', '2004', '200402', '', 'PUNO', 'CHUCUITO', 'DESAGUADERO', '', 0, 0, ''),
(1635, '20', '2004', '200403', '', 'PUNO', 'CHUCUITO', 'HUACULLANI', '', 0, 0, ''),
(1636, '20', '2004', '200406', '', 'PUNO', 'CHUCUITO', 'PISACOMA', '', 0, 0, ''),
(1637, '20', '2004', '200407', '', 'PUNO', 'CHUCUITO', 'POMATA', '', 0, 0, ''),
(1638, '20', '2004', '200410', '', 'PUNO', 'CHUCUITO', 'ZEPITA', '', 0, 0, ''),
(1639, '20', '2004', '200412', '', 'PUNO', 'CHUCUITO', 'KELLUYO', '', 0, 0, ''),
(1640, '20', '2005', '200501', '', 'PUNO', 'HUANCANE', 'HUANCANE', '', 0, 0, ''),
(1641, '20', '2005', '200502', '', 'PUNO', 'HUANCANE', 'COJATA', '', 0, 0, ''),
(1642, '20', '2005', '200504', '', 'PUNO', 'HUANCANE', 'INCHUPALLA', '', 0, 0, ''),
(1643, '20', '2005', '200506', '', 'PUNO', 'HUANCANE', 'PUSI', '', 0, 0, ''),
(1644, '20', '2005', '200507', '', 'PUNO', 'HUANCANE', 'ROSASPATA', '', 0, 0, ''),
(1645, '20', '2005', '200508', '', 'PUNO', 'HUANCANE', 'TARACO', '', 0, 0, ''),
(1646, '20', '2005', '200509', '', 'PUNO', 'HUANCANE', 'VILQUE CHICO', '', 0, 0, ''),
(1647, '20', '2005', '200511', '', 'PUNO', 'HUANCANE', 'HUATASANI', '', 0, 0, ''),
(1648, '20', '2006', '200601', '', 'PUNO', 'LAMPA', 'LAMPA', '', 0, 0, ''),
(1649, '20', '2006', '200602', '', 'PUNO', 'LAMPA', 'CABANILLA', '', 0, 0, ''),
(1650, '20', '2006', '200603', '', 'PUNO', 'LAMPA', 'CALAPUJA', '', 0, 0, ''),
(1651, '20', '2006', '200604', '', 'PUNO', 'LAMPA', 'NICASIO', '', 0, 0, ''),
(1652, '20', '2006', '200605', '', 'PUNO', 'LAMPA', 'OCUVIRI', '', 0, 0, ''),
(1653, '20', '2006', '200606', '', 'PUNO', 'LAMPA', 'PALCA', '', 0, 0, ''),
(1654, '20', '2006', '200607', '', 'PUNO', 'LAMPA', 'PARATIA', '', 0, 0, ''),
(1655, '20', '2006', '200608', '', 'PUNO', 'LAMPA', 'PUCARA', '', 0, 0, ''),
(1656, '20', '2006', '200609', '', 'PUNO', 'LAMPA', 'SANTA LUCIA', '', 0, 0, ''),
(1657, '20', '2006', '200610', '', 'PUNO', 'LAMPA', 'VILAVILA', '', 0, 0, ''),
(1658, '20', '2007', '200701', '', 'PUNO', 'MELGAR', 'AYAVIRI', '', 0, 0, ''),
(1659, '20', '2007', '200702', '', 'PUNO', 'MELGAR', 'ANTAUTA', '', 0, 0, ''),
(1660, '20', '2007', '200703', '', 'PUNO', 'MELGAR', 'CUPI', '', 0, 0, ''),
(1661, '20', '2007', '200704', '', 'PUNO', 'MELGAR', 'LLALLI', '', 0, 0, ''),
(1662, '20', '2007', '200705', '', 'PUNO', 'MELGAR', 'MACARI', '', 0, 0, ''),
(1663, '20', '2007', '200706', '', 'PUNO', 'MELGAR', 'NU', '', 0, 0, ''),
(1664, '20', '2007', '200707', '', 'PUNO', 'MELGAR', 'ORURILLO', '', 0, 0, ''),
(1665, '20', '2007', '200708', '', 'PUNO', 'MELGAR', 'SANTA ROSA', '', 0, 0, ''),
(1666, '20', '2007', '200709', '', 'PUNO', 'MELGAR', 'UMACHIRI', '', 0, 0, ''),
(1667, '20', '2008', '200801', '', 'PUNO', 'SANDIA', 'SANDIA', '', 0, 0, ''),
(1668, '20', '2008', '200803', '', 'PUNO', 'SANDIA', 'CUYOCUYO', '', 0, 0, ''),
(1669, '20', '2008', '200804', '', 'PUNO', 'SANDIA', 'LIMBANI', '', 0, 0, ''),
(1670, '20', '2008', '200805', '', 'PUNO', 'SANDIA', 'PHARA', '', 0, 0, ''),
(1671, '20', '2008', '200806', '', 'PUNO', 'SANDIA', 'PATAMBUCO', '', 0, 0, ''),
(1672, '20', '2008', '200807', '', 'PUNO', 'SANDIA', 'QUIACA', '', 0, 0, ''),
(1673, '20', '2008', '200808', '', 'PUNO', 'SANDIA', 'SAN JUAN DEL ORO', '', 0, 0, ''),
(1674, '20', '2008', '200810', '', 'PUNO', 'SANDIA', 'YANAHUAYA', '', 0, 0, ''),
(1675, '20', '2008', '200811', '', 'PUNO', 'SANDIA', 'ALTO INAMBARI', '', 0, 0, ''),
(1676, '20', '2008', '200812', '', 'PUNO', 'SANDIA', 'SAN PEDRO DE PUTINA PUNCO', '', 0, 0, ''),
(1677, '20', '2009', '200901', '', 'PUNO', 'SAN ROMAN', 'JULIACA', '', 0, 0, ''),
(1678, '20', '2009', '200902', '', 'PUNO', 'SAN ROMAN', 'CABANA', '', 0, 0, ''),
(1679, '20', '2009', '200903', '', 'PUNO', 'SAN ROMAN', 'CABANILLAS', '', 0, 0, ''),
(1680, '20', '2009', '200904', '', 'PUNO', 'SAN ROMAN', 'CARACOTO', '', 0, 0, ''),
(1681, '20', '2010', '201001', '', 'PUNO', 'YUNGUYO', 'YUNGUYO', '', 0, 0, ''),
(1682, '20', '2010', '201002', '', 'PUNO', 'YUNGUYO', 'UNICACHI', '', 0, 0, ''),
(1683, '20', '2010', '201003', '', 'PUNO', 'YUNGUYO', 'ANAPIA', '', 0, 0, ''),
(1684, '20', '2010', '201004', '', 'PUNO', 'YUNGUYO', 'COPANI', '', 0, 0, ''),
(1685, '20', '2010', '201005', '', 'PUNO', 'YUNGUYO', 'CUTURAPI', '', 0, 0, ''),
(1686, '20', '2010', '201006', '', 'PUNO', 'YUNGUYO', 'OLLARAYA', '', 0, 0, ''),
(1687, '20', '2010', '201007', '', 'PUNO', 'YUNGUYO', 'TINICACHI', '', 0, 0, ''),
(1688, '20', '2011', '201101', '', 'PUNO', 'SAN ANTONIO DE PUTINA', 'PUTINA', '', 0, 0, ''),
(1689, '20', '2011', '201102', '', 'PUNO', 'SAN ANTONIO DE PUTINA', 'PEDRO VILCA APAZA', '', 0, 0, ''),
(1690, '20', '2011', '201103', '', 'PUNO', 'SAN ANTONIO DE PUTINA', 'QUILCAPUNCU', '', 0, 0, ''),
(1691, '20', '2011', '201104', '', 'PUNO', 'SAN ANTONIO DE PUTINA', 'ANANEA', '', 0, 0, ''),
(1692, '20', '2011', '201105', '', 'PUNO', 'SAN ANTONIO DE PUTINA', 'SINA', '', 0, 0, ''),
(1693, '20', '2012', '201201', '', 'PUNO', 'EL COLLAO', 'ILAVE', '', 0, 0, ''),
(1694, '20', '2012', '201202', '', 'PUNO', 'EL COLLAO', 'PILCUYO', '', 0, 0, ''),
(1695, '20', '2012', '201203', '', 'PUNO', 'EL COLLAO', 'SANTA ROSA', '', 0, 0, ''),
(1696, '20', '2012', '201204', '', 'PUNO', 'EL COLLAO', 'CAPASO', '', 0, 0, ''),
(1697, '20', '2012', '201205', '', 'PUNO', 'EL COLLAO', 'CONDURIRI', '', 0, 0, ''),
(1698, '20', '2013', '201301', '', 'PUNO', 'MOHO', 'MOHO', '', 0, 0, ''),
(1699, '20', '2013', '201302', '', 'PUNO', 'MOHO', 'CONIMA', '', 0, 0, ''),
(1700, '20', '2013', '201303', '', 'PUNO', 'MOHO', 'TILALI', '', 0, 0, ''),
(1701, '20', '2013', '201304', '', 'PUNO', 'MOHO', 'HUAYRAPATA', '', 0, 0, ''),
(1702, '21', '2101', '210101', '', 'SAN MARTIN', 'MOYOBAMBA', 'MOYOBAMBA', '', 0, 0, ''),
(1703, '21', '2101', '210102', '', 'SAN MARTIN', 'MOYOBAMBA', 'CALZADA', '', 0, 0, ''),
(1704, '21', '2101', '210103', '', 'SAN MARTIN', 'MOYOBAMBA', 'HABANA', '', 0, 0, ''),
(1705, '21', '2101', '210104', '', 'SAN MARTIN', 'MOYOBAMBA', 'JEPELACIO', '', 0, 0, ''),
(1706, '21', '2101', '210105', '', 'SAN MARTIN', 'MOYOBAMBA', 'SORITOR', '', 0, 0, ''),
(1707, '21', '2101', '210106', '', 'SAN MARTIN', 'MOYOBAMBA', 'YANTALO', '', 0, 0, ''),
(1708, '21', '2102', '210201', '', 'SAN MARTIN', 'HUALLAGA', 'SAPOSOA', '', 0, 0, ''),
(1709, '21', '2102', '210202', '', 'SAN MARTIN', 'HUALLAGA', 'PISCOYACU', '', 0, 0, ''),
(1710, '21', '2102', '210203', '', 'SAN MARTIN', 'HUALLAGA', 'SACANCHE', '', 0, 0, ''),
(1711, '21', '2102', '210204', '', 'SAN MARTIN', 'HUALLAGA', 'TINGO DE SAPOSOA', '', 0, 0, ''),
(1712, '21', '2102', '210205', '', 'SAN MARTIN', 'HUALLAGA', 'ALTO SAPOSOA', '', 0, 0, ''),
(1713, '21', '2102', '210206', '', 'SAN MARTIN', 'HUALLAGA', 'EL ESLABON', '', 0, 0, ''),
(1714, '21', '2103', '210301', '', 'SAN MARTIN', 'LAMAS', 'LAMAS', '', 0, 0, ''),
(1715, '21', '2103', '210303', '', 'SAN MARTIN', 'LAMAS', 'BARRANQUITA', '', 0, 0, ''),
(1716, '21', '2103', '210304', '', 'SAN MARTIN', 'LAMAS', 'CAYNARACHI', '', 0, 0, ''),
(1717, '21', '2103', '210305', '', 'SAN MARTIN', 'LAMAS', 'CU', '', 0, 0, ''),
(1718, '21', '2103', '210306', '', 'SAN MARTIN', 'LAMAS', 'PINTO RECODO', '', 0, 0, ''),
(1719, '21', '2103', '210307', '', 'SAN MARTIN', 'LAMAS', 'RUMISAPA', '', 0, 0, ''),
(1720, '21', '2103', '210311', '', 'SAN MARTIN', 'LAMAS', 'SHANAO', '', 0, 0, ''),
(1721, '21', '2103', '210313', '', 'SAN MARTIN', 'LAMAS', 'TABALOSOS', '', 0, 0, ''),
(1722, '21', '2103', '210314', '', 'SAN MARTIN', 'LAMAS', 'ZAPATERO', '', 0, 0, ''),
(1723, '21', '2103', '210315', '', 'SAN MARTIN', 'LAMAS', 'ALONSO DE ALVARADO', '', 0, 0, ''),
(1724, '21', '2103', '210316', '', 'SAN MARTIN', 'LAMAS', 'SAN ROQUE DE CUMBAZA', '', 0, 0, ''),
(1725, '21', '2104', '210401', '', 'SAN MARTIN', 'MARISCAL CACERES', 'JUANJUI', '', 0, 0, ''),
(1726, '21', '2104', '210402', '', 'SAN MARTIN', 'MARISCAL CACERES', 'CAMPANILLA', '', 0, 0, ''),
(1727, '21', '2104', '210403', '', 'SAN MARTIN', 'MARISCAL CACERES', 'HUICUNGO', '', 0, 0, ''),
(1728, '21', '2104', '210404', '', 'SAN MARTIN', 'MARISCAL CACERES', 'PACHIZA', '', 0, 0, ''),
(1729, '21', '2104', '210405', '', 'SAN MARTIN', 'MARISCAL CACERES', 'PAJARILLO', '', 0, 0, ''),
(1730, '21', '2105', '210501', '', 'SAN MARTIN', 'RIOJA', 'RIOJA', '', 0, 0, ''),
(1731, '21', '2105', '210502', '', 'SAN MARTIN', 'RIOJA', 'POSIC', '', 0, 0, ''),
(1732, '21', '2105', '210503', '', 'SAN MARTIN', 'RIOJA', 'YORONGOS', '', 0, 0, ''),
(1733, '21', '2105', '210504', '', 'SAN MARTIN', 'RIOJA', 'YURACYACU', '', 0, 0, ''),
(1734, '21', '2105', '210505', '', 'SAN MARTIN', 'RIOJA', 'NUEVA CAJAMARCA', '', 0, 0, ''),
(1735, '21', '2105', '210506', '', 'SAN MARTIN', 'RIOJA', 'ELIAS SOPLIN VARGAS', '', 0, 0, ''),
(1736, '21', '2105', '210507', '', 'SAN MARTIN', 'RIOJA', 'SAN FERNANDO', '', 0, 0, ''),
(1737, '21', '2105', '210508', '', 'SAN MARTIN', 'RIOJA', 'PARDO MIGUEL', '', 0, 0, ''),
(1738, '21', '2105', '210509', '', 'SAN MARTIN', 'RIOJA', 'AWAJUN', '', 0, 0, ''),
(1739, '21', '2106', '210601', '', 'SAN MARTIN', 'SAN MARTIN', 'TARAPOTO', '', 0, 0, ''),
(1740, '21', '2106', '210602', '', 'SAN MARTIN', 'SAN MARTIN', 'ALBERTO LEVEAU', '', 0, 0, ''),
(1741, '21', '2106', '210604', '', 'SAN MARTIN', 'SAN MARTIN', 'CACATACHI', '', 0, 0, ''),
(1742, '21', '2106', '210606', '', 'SAN MARTIN', 'SAN MARTIN', 'CHAZUTA', '', 0, 0, ''),
(1743, '21', '2106', '210607', '', 'SAN MARTIN', 'SAN MARTIN', 'CHIPURANA', '', 0, 0, ''),
(1744, '21', '2106', '210608', '', 'SAN MARTIN', 'SAN MARTIN', 'EL PORVENIR', '', 0, 0, ''),
(1745, '21', '2106', '210609', '', 'SAN MARTIN', 'SAN MARTIN', 'HUIMBAYOC', '', 0, 0, ''),
(1746, '21', '2106', '210610', '', 'SAN MARTIN', 'SAN MARTIN', 'JUAN GUERRA', '', 0, 0, ''),
(1747, '21', '2106', '210611', '', 'SAN MARTIN', 'SAN MARTIN', 'MORALES', '', 0, 0, ''),
(1748, '21', '2106', '210612', '', 'SAN MARTIN', 'SAN MARTIN', 'PAPAPLAYA', '', 0, 0, ''),
(1749, '21', '2106', '210616', '', 'SAN MARTIN', 'SAN MARTIN', 'SAN ANTONIO', '', 0, 0, ''),
(1750, '21', '2106', '210619', '', 'SAN MARTIN', 'SAN MARTIN', 'SAUCE', '', 0, 0, ''),
(1751, '21', '2106', '210620', '', 'SAN MARTIN', 'SAN MARTIN', 'SHAPAJA', '', 0, 0, ''),
(1752, '21', '2106', '210621', '', 'SAN MARTIN', 'SAN MARTIN', 'LA BANDA DE SHILCAYO', '', 0, 0, ''),
(1753, '21', '2107', '210701', '', 'SAN MARTIN', 'BELLAVISTA', 'BELLAVISTA', '', 0, 0, ''),
(1754, '21', '2107', '210702', '', 'SAN MARTIN', 'BELLAVISTA', 'SAN RAFAEL', '', 0, 0, ''),
(1755, '21', '2107', '210703', '', 'SAN MARTIN', 'BELLAVISTA', 'SAN PABLO', '', 0, 0, ''),
(1756, '21', '2107', '210704', '', 'SAN MARTIN', 'BELLAVISTA', 'ALTO BIAVO', '', 0, 0, ''),
(1757, '21', '2107', '210705', '', 'SAN MARTIN', 'BELLAVISTA', 'HUALLAGA', '', 0, 0, ''),
(1758, '21', '2107', '210706', '', 'SAN MARTIN', 'BELLAVISTA', 'BAJO BIAVO', '', 0, 0, ''),
(1759, '21', '2108', '210801', '', 'SAN MARTIN', 'TOCACHE', 'TOCACHE', '', 0, 0, ''),
(1760, '21', '2108', '210802', '', 'SAN MARTIN', 'TOCACHE', 'NUEVO PROGRESO', '', 0, 0, ''),
(1761, '21', '2108', '210803', '', 'SAN MARTIN', 'TOCACHE', 'POLVORA', '', 0, 0, ''),
(1762, '21', '2108', '210804', '', 'SAN MARTIN', 'TOCACHE', 'SHUNTE', '', 0, 0, ''),
(1763, '21', '2108', '210805', '', 'SAN MARTIN', 'TOCACHE', 'UCHIZA', '', 0, 0, ''),
(1764, '21', '2109', '210901', '', 'SAN MARTIN', 'PICOTA', 'PICOTA', '', 0, 0, ''),
(1765, '21', '2109', '210902', '', 'SAN MARTIN', 'PICOTA', 'BUENOS AIRES', '', 0, 0, ''),
(1766, '21', '2109', '210903', '', 'SAN MARTIN', 'PICOTA', 'CASPIZAPA', '', 0, 0, ''),
(1767, '21', '2109', '210904', '', 'SAN MARTIN', 'PICOTA', 'PILLUANA', '', 0, 0, ''),
(1768, '21', '2109', '210905', '', 'SAN MARTIN', 'PICOTA', 'PUCACACA', '', 0, 0, ''),
(1769, '21', '2109', '210906', '', 'SAN MARTIN', 'PICOTA', 'SAN CRISTOBAL', '', 0, 0, ''),
(1770, '21', '2109', '210907', '', 'SAN MARTIN', 'PICOTA', 'SAN HILARION', '', 0, 0, ''),
(1771, '21', '2109', '210908', '', 'SAN MARTIN', 'PICOTA', 'TINGO DE PONASA', '', 0, 0, ''),
(1772, '21', '2109', '210909', '', 'SAN MARTIN', 'PICOTA', 'TRES UNIDOS', '', 0, 0, ''),
(1773, '21', '2109', '210910', '', 'SAN MARTIN', 'PICOTA', 'SHAMBOYACU', '', 0, 0, ''),
(1774, '21', '2110', '211001', '', 'SAN MARTIN', 'EL DORADO', 'SAN JOSE DE SISA', '', 0, 0, ''),
(1775, '21', '2110', '211002', '', 'SAN MARTIN', 'EL DORADO', 'AGUA BLANCA', '', 0, 0, ''),
(1776, '21', '2110', '211003', '', 'SAN MARTIN', 'EL DORADO', 'SHATOJA', '', 0, 0, ''),
(1777, '21', '2110', '211004', '', 'SAN MARTIN', 'EL DORADO', 'SAN MARTIN', '', 0, 0, ''),
(1778, '21', '2110', '211005', '', 'SAN MARTIN', 'EL DORADO', 'SANTA ROSA', '', 0, 0, ''),
(1779, '22', '2201', '220101', '', 'TACNA', 'TACNA', 'TACNA', '', 0, 0, '');
INSERT INTO `ubigeo` (`id`, `department_id`, `province_id`, `district_id`, `pais`, `department`, `province`, `district`, `pais_id`, `latitude`, `longitud`, `district_id_standart`) VALUES
(1780, '22', '2201', '220102', '', 'TACNA', 'TACNA', 'CALANA', '', 0, 0, ''),
(1781, '22', '2201', '220104', '', 'TACNA', 'TACNA', 'INCLAN', '', 0, 0, ''),
(1782, '22', '2201', '220107', '', 'TACNA', 'TACNA', 'PACHIA', '', 0, 0, ''),
(1783, '22', '2201', '220108', '', 'TACNA', 'TACNA', 'PALCA', '', 0, 0, ''),
(1784, '22', '2201', '220109', '', 'TACNA', 'TACNA', 'POCOLLAY', '', 0, 0, ''),
(1785, '22', '2201', '220110', '', 'TACNA', 'TACNA', 'SAMA', '', 0, 0, ''),
(1786, '22', '2201', '220111', '', 'TACNA', 'TACNA', 'ALTO DE LA ALIANZA', '', 0, 0, ''),
(1787, '22', '2201', '220112', '', 'TACNA', 'TACNA', 'CIUDAD NUEVA', '', 0, 0, ''),
(1788, '22', '2201', '220113', '', 'TACNA', 'TACNA', 'CORONEL GREGORIO ALBARRACIN L.', '', 0, 0, ''),
(1789, '22', '2202', '220201', '', 'TACNA', 'TARATA', 'TARATA', '', 0, 0, ''),
(1790, '22', '2202', '220205', '', 'TACNA', 'TARATA', 'HEROES ALBARRACIN', '', 0, 0, ''),
(1791, '22', '2202', '220206', '', 'TACNA', 'TARATA', 'ESTIQUE', '', 0, 0, ''),
(1792, '22', '2202', '220207', '', 'TACNA', 'TARATA', 'ESTIQUE PAMPA', '', 0, 0, ''),
(1793, '22', '2202', '220210', '', 'TACNA', 'TARATA', 'SITAJARA', '', 0, 0, ''),
(1794, '22', '2202', '220211', '', 'TACNA', 'TARATA', 'SUSAPAYA', '', 0, 0, ''),
(1795, '22', '2202', '220212', '', 'TACNA', 'TARATA', 'TARUCACHI', '', 0, 0, ''),
(1796, '22', '2202', '220213', '', 'TACNA', 'TARATA', 'TICACO', '', 0, 0, ''),
(1797, '22', '2203', '220301', '', 'TACNA', 'JORGE BASADRE', 'LOCUMBA', '', 0, 0, ''),
(1798, '22', '2203', '220302', '', 'TACNA', 'JORGE BASADRE', 'ITE', '', 0, 0, ''),
(1799, '22', '2203', '220303', '', 'TACNA', 'JORGE BASADRE', 'ILABAYA', '', 0, 0, ''),
(1800, '22', '2204', '220401', '', 'TACNA', 'CANDARAVE', 'CANDARAVE', '', 0, 0, ''),
(1801, '22', '2204', '220402', '', 'TACNA', 'CANDARAVE', 'CAIRANI', '', 0, 0, ''),
(1802, '22', '2204', '220403', '', 'TACNA', 'CANDARAVE', 'CURIBAYA', '', 0, 0, ''),
(1803, '22', '2204', '220404', '', 'TACNA', 'CANDARAVE', 'HUANUARA', '', 0, 0, ''),
(1804, '22', '2204', '220405', '', 'TACNA', 'CANDARAVE', 'QUILAHUANI', '', 0, 0, ''),
(1805, '22', '2204', '220406', '', 'TACNA', 'CANDARAVE', 'CAMILACA', '', 0, 0, ''),
(1806, '23', '2301', '230101', '', 'TUMBES', 'TUMBES', 'TUMBES', '', 0, 0, ''),
(1807, '23', '2301', '230102', '', 'TUMBES', 'TUMBES', 'CORRALES', '', 0, 0, ''),
(1808, '23', '2301', '230103', '', 'TUMBES', 'TUMBES', 'LA CRUZ', '', 0, 0, ''),
(1809, '23', '2301', '230104', '', 'TUMBES', 'TUMBES', 'PAMPAS DE HOSPITAL', '', 0, 0, ''),
(1810, '23', '2301', '230105', '', 'TUMBES', 'TUMBES', 'SAN JACINTO', '', 0, 0, ''),
(1811, '23', '2301', '230106', '', 'TUMBES', 'TUMBES', 'SAN JUAN DE LA VIRGEN', '', 0, 0, ''),
(1812, '23', '2302', '230201', '', 'TUMBES', 'CONTRALMIRANTE VILLAR', 'ZORRITOS', '', 0, 0, ''),
(1813, '23', '2302', '230202', '', 'TUMBES', 'CONTRALMIRANTE VILLAR', 'CASITAS', '', 0, 0, ''),
(1814, '23', '2302', '230203', '', 'TUMBES', 'CONTRALMIRANTE VILLAR', 'CANOAS DE PUNTA SAL', '', 0, 0, ''),
(1815, '23', '2303', '230301', '', 'TUMBES', 'ZARUMILLA', 'ZARUMILLA', '', 0, 0, ''),
(1816, '23', '2303', '230302', '', 'TUMBES', 'ZARUMILLA', 'MATAPALO', '', 0, 0, ''),
(1817, '23', '2303', '230303', '', 'TUMBES', 'ZARUMILLA', 'PAPAYAL', '', 0, 0, ''),
(1818, '23', '2303', '230304', '', 'TUMBES', 'ZARUMILLA', 'AGUAS VERDES', '', 0, 0, ''),
(1825, '25', '2501', '250101', '', 'UCAYALI', 'CORONEL PORTILLO', 'CALLERIA', '', 0, 0, ''),
(1826, '25', '2501', '250102', '', 'UCAYALI', 'CORONEL PORTILLO', 'YARINACOCHA', '', 0, 0, ''),
(1827, '25', '2501', '250103', '', 'UCAYALI', 'CORONEL PORTILLO', 'MASISEA', '', 0, 0, ''),
(1828, '25', '2501', '250104', '', 'UCAYALI', 'CORONEL PORTILLO', 'CAMPOVERDE', '', 0, 0, ''),
(1829, '25', '2501', '250105', '', 'UCAYALI', 'CORONEL PORTILLO', 'IPARIA', '', 0, 0, ''),
(1830, '25', '2501', '250106', '', 'UCAYALI', 'CORONEL PORTILLO', 'NUEVA REQUENA', '', 0, 0, ''),
(1831, '25', '2501', '250107', '', 'UCAYALI', 'CORONEL PORTILLO', 'MANANTAY', '', 0, 0, ''),
(1832, '25', '2502', '250201', '', 'UCAYALI', 'PADRE ABAD', 'PADRE ABAD', '', 0, 0, ''),
(1833, '25', '2502', '250202', '', 'UCAYALI', 'PADRE ABAD', 'IRAZOLA', '', 0, 0, ''),
(1834, '25', '2502', '250203', '', 'UCAYALI', 'PADRE ABAD', 'CURIMANA', '', 0, 0, ''),
(1835, '25', '2503', '250301', '', 'UCAYALI', 'ATALAYA', 'RAYMONDI', '', 0, 0, ''),
(1836, '25', '2503', '250302', '', 'UCAYALI', 'ATALAYA', 'TAHUANIA', '', 0, 0, ''),
(1837, '25', '2503', '250303', '', 'UCAYALI', 'ATALAYA', 'YURUA', '', 0, 0, ''),
(1838, '25', '2503', '250304', '', 'UCAYALI', 'ATALAYA', 'SEPAHUA', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(1) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `id_perfil` int(1) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `usuarios`:
--   `id_perfil`
--       `perfil` -> `id`
--

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Name`, `username`, `password`, `id_perfil`, `img`, `estado`) VALUES
(1, 'Adminsitrador', 'admin', '123456', 1, 'admin.jpg', 1),
(2, 'Investigador 1', 'investigador1', '123456', 2, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id_pefil`,`id_menu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `accion_transversal`
--
ALTER TABLE `accion_transversal`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_oe_act` (`id_oe`),
  ADD KEY `nro_actividad` (`id`);

--
-- Indices de la tabla `alianza_estrategica`
--
ALTER TABLE `alianza_estrategica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alianza_proy` (`id_proyecto`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `cronograma`
--
ALTER TABLE `cronograma`
  ADD PRIMARY KEY (`id_actividad`,`mes`),
  ADD KEY `fk_cr_act` (`id_actividad`);

--
-- Indices de la tabla `cultivo_crianza`
--
ALTER TABLE `cultivo_crianza`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `lugar_investigacion`
--
ALTER TABLE `lugar_investigacion`
  ADD PRIMARY KEY (`id_proyecto`,`ubigeo`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objetivo_especifico`
--
ALTER TABLE `objetivo_especifico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nro_objetivo` (`id`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_proy` (`user_propietario`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id_proyecto`,`nro_recurso`);

--
-- Indices de la tabla `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `ubigeo`
--
ALTER TABLE `ubigeo`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_perfil_user` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `alianza_estrategica`
--
ALTER TABLE `alianza_estrategica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `objetivo_especifico`
--
ALTER TABLE `objetivo_especifico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD CONSTRAINT `accesos_ibfk_1` FOREIGN KEY (`id_pefil`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `accesos_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id`);

--
-- Filtros para la tabla `accion_transversal`
--
ALTER TABLE `accion_transversal`
  ADD CONSTRAINT `fk_acc_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `fk_act_proy` FOREIGN KEY (`id_oe`) REFERENCES `objetivo_especifico` (`id`);

--
-- Filtros para la tabla `alianza_estrategica`
--
ALTER TABLE `alianza_estrategica`
  ADD CONSTRAINT `fk_alianza_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `fk_col_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `cronograma`
--
ALTER TABLE `cronograma`
  ADD CONSTRAINT `fk_cro_act` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id`);

--
-- Filtros para la tabla `cultivo_crianza`
--
ALTER TABLE `cultivo_crianza`
  ADD CONSTRAINT `fk_cc_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `lugar_investigacion`
--
ALTER TABLE `lugar_investigacion`
  ADD CONSTRAINT `fk_lt_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`);

--
-- Filtros para la tabla `objetivo_especifico`
--
ALTER TABLE `objetivo_especifico`
  ADD CONSTRAINT `fk_oe_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fk_user_proy` FOREIGN KEY (`user_propietario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `fk_rp_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `responsable`
--
ALTER TABLE `responsable`
  ADD CONSTRAINT `fk_rep_proy` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_perfil_user` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
