-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 27-09-2021 a las 02:29:53
-- Versión del servidor: 10.3.28-MariaDB-1:10.3.28+maria~focal-log
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bases_archivo`
--

CREATE TABLE `bases_archivo` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `name_base` varchar(255) NOT NULL,
  `name_file` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `campana_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bases_archivo`
--

INSERT INTO `bases_archivo` (`id`, `created_at`, `name_base`, `name_file`, `is_active`, `campana_id`, `user_id`) VALUES
(29, '2021-08-19 12:30:24', 'base prueba 4', '2051897333.xlsx', 1, 1, 1),
(31, '2021-08-31 20:20:17', 'base prueba 15 occidente', '1977959351.xlsx', 1, 1, 1),
(33, '2021-09-08 21:05:03', 'base 15 occidente', '1024521436.xlsx', 1, 1, 1),
(34, '2021-09-08 21:05:29', 'base 16 occidente', '328225687.xlsx', 1, 1, 1),
(35, '2021-09-08 21:08:20', 'base prueba 17', '1158103229.xlsx', 1, 1, 1),
(36, '2021-09-22 15:46:29', 'base prueba 22 septimebre', '79592428.xlsx', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bases_group_job`
--

CREATE TABLE `bases_group_job` (
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(11) NOT NULL,
  `base_id` int(11) NOT NULL,
  `group_jobs_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bases_group_job`
--

INSERT INTO `bases_group_job` (`created_at`, `id`, `base_id`, `group_jobs_id`, `is_active`) VALUES
('2021-09-07 05:35:06', 8, 31, 1, 1),
('2021-09-07 05:36:57', 10, 31, 2, 1),
('2021-09-07 16:09:27', 11, 29, 2, 1),
('2021-09-07 16:09:27', 12, 29, 2, 1),
('2021-09-07 16:09:29', 13, 29, 3, 1),
('2021-09-07 16:09:32', 14, 29, 1, 1),
('2021-09-08 21:06:51', 15, 34, 3, 1),
('2021-09-10 16:38:49', 16, 35, 3, 1),
('2021-09-22 15:47:25', 18, 36, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `base_occidente`
--

CREATE TABLE `base_occidente` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `complete_name` varchar(255) NOT NULL,
  `identification` bigint(20) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `assigned` int(11) DEFAULT NULL,
  `assigned_at` datetime DEFAULT NULL,
  `processed` int(11) DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `archivo_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `user_assigned` int(11) DEFAULT NULL,
  `observation` longtext DEFAULT NULL,
  `callback` datetime DEFAULT NULL,
  `reassigned` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `base_occidente`
--

INSERT INTO `base_occidente` (`id`, `created_at`, `complete_name`, `identification`, `phone_number`, `assigned`, `assigned_at`, `processed`, `processed_at`, `status_id`, `archivo_id`, `is_active`, `user_assigned`, `observation`, `callback`, `reassigned`) VALUES
(1, '2021-08-14 18:40:04', 'reg 1', 1018506147, 3103209084, 1, '2021-08-18 04:04:57', 1, '2021-08-27 23:13:57', 2, 31, 1, 7, 'OBSERVACION PRYEBA', '2021-08-18 23:12:00', 0),
(2, '2021-08-14 18:43:29', 'reg 2', 1018506147, 3103209084, 1, '2021-08-18 14:05:02', 1, '2021-08-19 04:16:19', 2, 31, 0, 7, 'hola como vas ', '0000-00-00 00:00:00', 0),
(3, '2021-08-14 18:46:52', 'reg 3', 1018506147, 3103209084, 1, '2021-09-08 20:59:07', 0, '2021-08-19 04:14:24', NULL, 31, 1, 7, 'pbservacion prueba 2', '0000-00-00 00:00:00', 1),
(4, '2021-08-19 12:30:24', 'andres felipe alvarez', 1018506147, 3103209084, 1, '2021-08-19 21:56:53', 1, '2021-08-19 12:46:48', 5, 31, 1, 7, 'observacion desde el piloto automatico descativado ', '0000-00-00 00:00:00', 0),
(5, '2021-08-19 21:55:52', 'andres felipe alvarez', 1018506147, 3103209084, 1, '2021-09-08 20:54:43', 1, '2021-09-09 01:59:12', 4, 31, 1, 7, 'observacion de prueba', '0000-00-00 00:00:00', 1),
(6, '2021-08-31 20:20:17', 'andres felipe alvarez', 1018506147, 3103209084, 1, '2021-09-08 20:54:43', 0, '2021-08-31 20:26:01', NULL, 31, 1, 5, 'prueba', '0000-00-00 00:00:00', 1),
(7, '2021-09-02 17:07:09', 'andres felipe alvarez', 1018506147, 3103209084, 1, '2021-09-08 20:54:43', 1, '2021-09-22 15:33:06', 4, 31, 1, 7, 'asdfghjkl;', '0000-00-00 00:00:00', 1),
(8, '2021-09-08 21:05:29', 'andres felipe alvarez', 1018506147, 3103209084, 1, '2021-09-09 01:31:26', 0, NULL, NULL, 34, 1, 7, NULL, NULL, NULL),
(9, '2021-09-08 21:08:20', 'andres felipe alvarez', 1018506147, 3103209084, 1, '2021-09-09 01:35:16', 0, NULL, NULL, 35, 1, 7, NULL, NULL, NULL),
(10, '2021-09-22 15:46:29', 'andres felipe alvarez', 1018506147, 3103209084, 1, '2021-09-24 19:27:47', 0, NULL, NULL, 36, 1, 7, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campana`
--

CREATE TABLE `campana` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `prefijo` varchar(45) NOT NULL,
  `automatico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `campana`
--

INSERT INTO `campana` (`id`, `created_at`, `name`, `prefijo`, `automatico`) VALUES
(1, '2021-08-14 17:28:20', 'Banco Occidente', 'occidente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `central_risk`
--

CREATE TABLE `central_risk` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) NOT NULL,
  `identification` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `type_dwelling` varchar(255) NOT NULL,
  `income` varchar(255) NOT NULL,
  `date_birth` date NOT NULL,
  `phone_contact` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `observation` longtext DEFAULT NULL,
  `base_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `response_supervisory` int(11) DEFAULT NULL,
  `response_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `central_risk`
--

INSERT INTO `central_risk` (`id`, `created_at`, `name`, `identification`, `civil_status`, `type_dwelling`, `income`, `date_birth`, `phone_contact`, `extension`, `action`, `observation`, `base_id`, `status_id`, `user_id`, `response_supervisory`, `response_user_id`) VALUES
(1, '2021-09-02 17:14:35', 'DASD', 'ASD', 'ASD', 'ASD', 'asd', '2021-08-19', 'asd', 'asd', 'asd', 'asdfasdasd', 5, NULL, 7, 1, 1),
(2, '2021-08-20 01:49:18', 'Andres Felipe Alvarez Perea', ' 1018506147', 'Soltero', 'Familiar', '2500000', '1998-10-07', '3103209084', '101', 'TCD', 'observacion prueba', 5, 10, 7, 1, 8),
(3, '2021-08-20 01:45:38', 'Andres Felipe Alvarez Perea', ' 1018506147', 'Soltero', 'Familiar', '2500000', '1998-10-07', '3103209084', '101', 'TCD', 'prueba \r\n\r\n\r\ncomo estas\r\n\r\n\r\n\r\n', 5, 10, 7, 1, 6),
(4, '2021-08-31 20:31:14', 'Andres Felipe Alvarez Perea', ' 1018506147', 'Soltero', 'Familiar', '350000000', '1998-10-07', '3103209084', '101', 'TCD', 'asdasdasdasdas', 6, NULL, 7, 1, 1),
(5, '2021-09-02 17:26:11', 'nicolle daniela yepes perea', ' 1018506147', 'Soltero', 'Propia', '2000000', '2021-09-02', '3103209084', '101', 'TCD', 'sdfsdfs', 7, 10, 7, 1, 1),
(6, '2021-09-22 01:45:06', 'base prueba 4', ' 1018506147', 'Casado', 'Familiar', '2000000', '2021-09-08', '3103209084', '101', 'TCD', '\"qui dolorem ipsum, quia dolor sit amet consectetur adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem\".\r\n\r\n\r\n\r\n\"Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but occasionally circumstances occur in which toil and pain can procure him some great pleasure\".\r\n\r\n\r\n\"Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but occasionally circumstances occur in which toil and pain can procure him some great pleasure\".\r\n\r\n\"Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but occasionally circumstances occur in which toil and pain can procure him some great pleasure\".', 5, NULL, 7, 1, 10),
(7, '2021-09-22 15:35:18', 'nicolle daniela yepes perea', ' 1018506147', 'Casado', 'Familiar', '1234567890', '2021-09-22', '3103209084', '101', 'TCD', '123456y7890adfghjksdfghjkdsfghjm', 7, 10, 7, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `send_user_id` int(11) NOT NULL,
  `receiver_user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `read_message` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `send_user_id`, `receiver_user_id`, `message`, `created_at`, `read_message`) VALUES
(1, 1, 7, 'hola cuantas ventas llevamos en la semana?', '2021-08-23 23:57:18', 1),
(2, 7, 1, '2 ventas, 4 tcd', '2021-08-23 23:59:11', 1),
(3, 1, 7, 'super bien ', '2021-08-24 00:01:29', 1),
(4, 7, 1, 'hola ', '2021-09-07 04:04:58', 1),
(5, 1, 7, 'com vas?', '2021-09-07 06:02:23', 1),
(6, 1, 9, 'com vas?', '2021-09-07 05:56:20', 0),
(7, 7, 1, 'bien bien', '2021-09-07 16:09:36', 1),
(8, 1, 9, 'oiiono', '2021-09-07 16:09:41', 0),
(9, 1, 7, 'bhbh', '2021-09-09 01:31:14', 1),
(10, 1, 7, 'dfgdfgdfgdf', '2021-09-09 01:31:14', 1),
(11, 7, 1, 'holaa mateo ', '2021-09-10 16:39:18', 1),
(12, 10, 6, 'holaa mateo ', '2021-09-22 00:52:39', 0),
(13, 10, 7, 'hola kathe como vas en ventas', '2021-09-22 02:03:55', 1),
(14, 7, 10, 'bien bien y udted?', '2021-09-22 02:04:23', 1),
(15, 7, 10, 'asd', '2021-09-22 02:07:00', 1),
(16, 10, 7, '12312312', '2021-09-22 15:32:38', 1),
(17, 10, 7, '12312312', '2021-09-22 15:32:38', 1),
(18, 7, 11, 'hola gaendameint', '2021-09-22 15:32:36', 0),
(19, 7, 6, 'asdfghjkl;\'', '2021-09-22 15:32:45', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `details_group_jobs`
--

CREATE TABLE `details_group_jobs` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `group_jobs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `details_group_jobs`
--

INSERT INTO `details_group_jobs` (`id`, `created_at`, `group_jobs_id`, `user_id`) VALUES
(1, '2021-08-19 12:50:26', 1, 7),
(2, '2021-08-19 12:50:26', 1, 5),
(3, '2021-08-19 20:52:13', 1, 1),
(13, '2021-08-19 22:14:52', 2, 6),
(14, '2021-08-23 12:30:19', 2, 8),
(15, '2021-09-07 05:47:31', 3, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_jobs`
--

CREATE TABLE `group_jobs` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) NOT NULL,
  `campana_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `group_jobs`
--

INSERT INTO `group_jobs` (`id`, `created_at`, `name`, `campana_id`) VALUES
(1, '2021-08-25 20:56:55', 'grupo 1', 1),
(2, '2021-08-25 20:57:15', 'grupo 2', 1),
(3, '2021-08-25 20:57:15', 'grupo 3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historical_update_user`
--

CREATE TABLE `historical_update_user` (
  `id` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_upgrading` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `created_at`, `name`) VALUES
(1, '2021-08-11 15:07:21', 'asesor'),
(2, '2021-08-12 13:11:23', 'Admin'),
(3, '2021-09-08 20:57:40', 'Supervisor'),
(4, '2021-09-22 02:10:34', 'backoffice');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scheduling_occidente`
--

CREATE TABLE `scheduling_occidente` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` date NOT NULL,
  `process` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `place_visit` varchar(255) NOT NULL,
  `trip` varchar(255) NOT NULL,
  `products` varchar(255) NOT NULL,
  `purchase_portfolio` varchar(255) NOT NULL,
  `observation` varchar(255) NOT NULL,
  `central_risk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `scheduling_occidente`
--

INSERT INTO `scheduling_occidente` (`id`, `created_at`, `date`, `process`, `method`, `address`, `city`, `place_visit`, `trip`, `products`, `purchase_portfolio`, `observation`, `central_risk_id`) VALUES
(3, '2021-08-20 17:17:17', '2021-08-21', 'TCD', 'Tradicional', 'cra 5 c 92 a 27 sur ', 'bogota', 'casa', 'AM', 'tcd', 'no', 'nuiniunijk', 2),
(4, '2021-09-22 15:37:28', '2021-09-22', 'TCD', 'Digital', 'cra 5 c 92 a 27 sur ', 'bogota', 'casa', 'AM', 'tcd', 'no', 'obsertvacion prueba', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scheduling_status_occidente`
--

CREATE TABLE `scheduling_status_occidente` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `scheduling_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `scheduling_status_occidente`
--

INSERT INTO `scheduling_status_occidente` (`id`, `created_at`, `scheduling_id`, `status_id`, `current`, `user_id`, `notes`) VALUES
(1, '2021-09-22 03:20:14', 3, 12, 0, 7, 'agendado'),
(3, '2021-09-22 03:20:52', 3, 1, 0, 11, 'asdasdasdas'),
(4, '2021-09-22 03:24:22', 3, 1, 0, 11, 'asdasdasdas'),
(5, '2021-09-22 03:26:45', 3, 3, 0, 11, 'cliente ya no esta interesadooo '),
(6, '2021-09-22 03:27:32', 3, 4, 0, 11, 'sadfghjkl/;'),
(7, '2021-09-22 15:39:27', 3, 4, 0, 11, 'asdfghjk'),
(8, '2021-09-22 15:39:29', 3, 3, 1, 11, 'cliente cambio de opinion por o interesado. asdas fsdcvcdvhbdcdgbdfghn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(45) NOT NULL,
  `sector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `created_at`, `name`, `sector`) VALUES
(1, '2021-08-19 22:04:22', 'NO CONTESTA', 1),
(2, '2021-08-19 22:04:29', 'VOLVER A LLAMAR ', 1),
(3, '2021-08-19 22:04:36', 'NO INTERESADO', 1),
(4, '2021-08-19 22:04:41', 'CONSULTA', 1),
(5, '2021-08-19 22:04:47', 'NO APLICA POR PÓLITICA', 1),
(6, '2021-08-19 22:05:03', 'NUMERO ERRADO ', 1),
(7, '2021-08-20 01:25:55', 'FUERA DE SERVICIO', 1),
(8, '2021-08-20 01:25:57', 'APAGADO', 1),
(9, '2021-08-20 01:25:58', 'CLIENTE CON PRODUCTOS VIGENTES', 1),
(10, '2021-08-20 01:26:03', 'APROBADO', 2),
(11, '2021-08-20 01:26:09', 'NEGADO', 2),
(12, '2021-08-20 17:17:00', 'PREAGENDADO', 3),
(13, '2021-08-20 20:11:54', 'AGENDADO', 3),
(14, '2021-08-20 20:11:54', 'CITA OK', 3),
(15, '2021-08-20 20:12:31', 'CITA INCUMPLIDA', 3),
(16, '2021-08-20 20:12:31', 'RADICADO', 3),
(17, '2021-08-20 20:12:55', 'APROBADO', 3),
(18, '2021-08-20 20:12:55', 'NEGADO', 3),
(19, '2021-08-20 20:13:02', 'DEVUELTO', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `complete_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pasword` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `update_password` int(11) NOT NULL,
  `url_image` varchar(100) DEFAULT NULL,
  `campana_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `complete_name`, `username`, `pasword`, `role_id`, `created_at`, `update_at`, `is_active`, `update_password`, `url_image`, `campana_id`) VALUES
(1, 'Andres Alvarez', 'andres', '202cb962ac59075b964b07152d234b70', 2, '2021-08-11 14:32:07', '2021-08-19 20:52:13', 1, 0, '../imagen/usuarios/1/452437943.png', 1),
(5, 'nicolle yepes', 'nicolle yepes', '5084f19201d9dc6448f4a44efbecf49d', 1, '2021-08-14 19:58:59', '2021-08-19 02:16:01', 1, 1, '../imagen/usuarios/5/1658588427.png', 1),
(6, 'joel mateo ', 'mateo perea', 'd348098b4753e539df25ecb4242a1a41', 2, '2021-08-14 20:12:39', '2021-09-07 16:08:57', 1, 1, '../imagen/usuarios/6/830494490.png', 1),
(7, 'kathe herrera', 'kathe herrera', '4297f44b13955235245b2497399d7a93', 1, '2021-08-19 02:28:46', '2021-09-09 01:58:55', 1, 0, '../imagen/usuarios/7/1883933175.png', 1),
(8, 'federico marin', 'federico', 'e10adc3949ba59abbe56e057f20f883e', 1, '2021-08-19 22:15:35', '2021-08-23 12:30:19', 1, 1, '../imagen/usuarios/8/1349603382.png', 1),
(9, 'asd', 'asd', 'a8f5f167f44f4964e6c998dee827110c', 1, '2021-09-07 05:38:05', '2021-09-07 05:47:31', 1, 1, '../imagen/usuarios/9/1362204328.png', 1),
(10, 'andres supervisor', 'supervisor', '5084f19201d9dc6448f4a44efbecf49d', 3, '2021-09-09 01:41:13', '2021-09-22 00:50:16', 1, 0, '../imagen/usuarios/10/1080096802.png', 1),
(11, 'Agendamiento', 'Agendamiento', '5084f19201d9dc6448f4a44efbecf49d', 4, '2021-09-22 02:11:37', '2021-09-22 02:12:09', 1, 0, '../imagen/usuarios/11/1485358666.png', 1),
(12, 'nicolle daniela yepes perea', 'nicolle yepes', 'e10adc3949ba59abbe56e057f20f883e', 4, '2021-09-22 15:51:45', NULL, 1, 1, '../imagen/usuarios/12/993466138.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bases_archivo`
--
ALTER TABLE `bases_archivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `base_archivo_campana` (`campana_id`),
  ADD KEY `base_archivo_user` (`user_id`);

--
-- Indices de la tabla `bases_group_job`
--
ALTER TABLE `bases_group_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bases_group_job_bases` (`base_id`),
  ADD KEY `bases_group_job_group_job` (`group_jobs_id`);

--
-- Indices de la tabla `base_occidente`
--
ALTER TABLE `base_occidente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `base_bases_archivo` (`archivo_id`),
  ADD KEY `base_user` (`user_assigned`),
  ADD KEY `base_status` (`status_id`);

--
-- Indices de la tabla `campana`
--
ALTER TABLE `campana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `central_risk`
--
ALTER TABLE `central_risk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `central_risk_base` (`base_id`),
  ADD KEY `central_risk_status` (`status_id`),
  ADD KEY `central_risk_user` (`user_id`),
  ADD KEY `central_risk_response_user` (`response_user_id`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_send_user` (`send_user_id`),
  ADD KEY `chat_receiver_user` (`receiver_user_id`);

--
-- Indices de la tabla `details_group_jobs`
--
ALTER TABLE `details_group_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `details_group_jobs_group_jobs` (`group_jobs_id`);

--
-- Indices de la tabla `group_jobs`
--
ALTER TABLE `group_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_jobs_campana` (`campana_id`);

--
-- Indices de la tabla `historical_update_user`
--
ALTER TABLE `historical_update_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `update_user_1` (`updated_user`),
  ADD KEY `update_user_2` (`user_upgrading`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `scheduling_occidente`
--
ALTER TABLE `scheduling_occidente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scheduling_occidente_central_risk` (`central_risk_id`);

--
-- Indices de la tabla `scheduling_status_occidente`
--
ALTER TABLE `scheduling_status_occidente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scheduling_status_scheduling_occidente` (`scheduling_id`),
  ADD KEY `scheduling_status_status_occidente` (`status_id`),
  ADD KEY `scheduling_status_user_occidente` (`user_id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role` (`role_id`),
  ADD KEY `user_campana` (`campana_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bases_archivo`
--
ALTER TABLE `bases_archivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `bases_group_job`
--
ALTER TABLE `bases_group_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `base_occidente`
--
ALTER TABLE `base_occidente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `campana`
--
ALTER TABLE `campana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `central_risk`
--
ALTER TABLE `central_risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `details_group_jobs`
--
ALTER TABLE `details_group_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `group_jobs`
--
ALTER TABLE `group_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historical_update_user`
--
ALTER TABLE `historical_update_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `scheduling_occidente`
--
ALTER TABLE `scheduling_occidente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `scheduling_status_occidente`
--
ALTER TABLE `scheduling_status_occidente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bases_archivo`
--
ALTER TABLE `bases_archivo`
  ADD CONSTRAINT `base_archivo_campana` FOREIGN KEY (`campana_id`) REFERENCES `campana` (`id`),
  ADD CONSTRAINT `base_archivo_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `bases_group_job`
--
ALTER TABLE `bases_group_job`
  ADD CONSTRAINT `bases_group_job_bases` FOREIGN KEY (`base_id`) REFERENCES `bases_archivo` (`id`),
  ADD CONSTRAINT `bases_group_job_group_job` FOREIGN KEY (`group_jobs_id`) REFERENCES `group_jobs` (`id`);

--
-- Filtros para la tabla `base_occidente`
--
ALTER TABLE `base_occidente`
  ADD CONSTRAINT `base_bases_archivo` FOREIGN KEY (`archivo_id`) REFERENCES `bases_archivo` (`id`),
  ADD CONSTRAINT `base_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `base_user` FOREIGN KEY (`user_assigned`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `central_risk`
--
ALTER TABLE `central_risk`
  ADD CONSTRAINT `central_risk_base` FOREIGN KEY (`base_id`) REFERENCES `base_occidente` (`id`),
  ADD CONSTRAINT `central_risk_response_user` FOREIGN KEY (`response_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `central_risk_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `central_risk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_receiver_user` FOREIGN KEY (`receiver_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `chat_send_user` FOREIGN KEY (`send_user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `details_group_jobs`
--
ALTER TABLE `details_group_jobs`
  ADD CONSTRAINT `details_group_jobs_group_jobs` FOREIGN KEY (`group_jobs_id`) REFERENCES `group_jobs` (`id`),
  ADD CONSTRAINT `details_group_jobs_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `group_jobs`
--
ALTER TABLE `group_jobs`
  ADD CONSTRAINT `group_jobs_campana` FOREIGN KEY (`campana_id`) REFERENCES `campana` (`id`);

--
-- Filtros para la tabla `historical_update_user`
--
ALTER TABLE `historical_update_user`
  ADD CONSTRAINT `update_user_1` FOREIGN KEY (`updated_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `update_user_2` FOREIGN KEY (`user_upgrading`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `scheduling_occidente`
--
ALTER TABLE `scheduling_occidente`
  ADD CONSTRAINT `scheduling_occidente_central_risk` FOREIGN KEY (`central_risk_id`) REFERENCES `central_risk` (`id`);

--
-- Filtros para la tabla `scheduling_status_occidente`
--
ALTER TABLE `scheduling_status_occidente`
  ADD CONSTRAINT `scheduling_status_scheduling_occidente` FOREIGN KEY (`scheduling_id`) REFERENCES `scheduling_occidente` (`id`),
  ADD CONSTRAINT `scheduling_status_status_occidente` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `scheduling_status_user_occidente` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_campana` FOREIGN KEY (`campana_id`) REFERENCES `campana` (`id`),
  ADD CONSTRAINT `user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
