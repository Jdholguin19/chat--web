-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2025 a las 21:43:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chat-web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `accesos`:
--

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`id`, `user_id`, `fecha`, `ip`) VALUES
(1, 1, '2025-07-19 22:43:13', '::1'),
(2, 2, '2025-07-19 22:52:27', '::1'),
(3, 4, '2025-07-19 22:53:34', '::1'),
(4, 2, '2025-07-19 22:53:58', '::1'),
(5, 4, '2025-07-19 22:54:05', '::1'),
(6, 4, '2025-07-19 22:54:33', '::1'),
(7, 2, '2025-07-19 23:01:11', '::1'),
(8, 4, '2025-07-19 23:01:26', '::1'),
(9, 2, '2025-07-19 23:05:10', '::1'),
(10, 1, '2025-07-19 23:05:36', '::1'),
(11, 1, '2025-07-19 23:13:23', '::1'),
(12, 2, '2025-07-19 23:16:46', '::1'),
(13, 4, '2025-07-19 23:22:30', '::1'),
(14, 5, '2025-07-19 23:23:23', '::1'),
(15, 2, '2025-07-19 23:23:58', '::1'),
(16, 1, '2025-07-19 23:27:26', '::1'),
(17, 4, '2025-07-19 23:38:13', '::1'),
(18, 4, '2025-07-19 23:39:05', '::1'),
(19, 1, '2025-07-19 23:39:21', '::1'),
(20, 1, '2025-07-19 23:41:24', '::1'),
(21, 4, '2025-07-19 23:42:32', '::1'),
(22, 1, '2025-07-20 00:04:07', '::1'),
(23, 1, '2025-07-20 00:07:51', '::1'),
(24, 1, '2025-07-20 00:11:41', '::1'),
(25, 1, '2025-07-20 00:16:08', '::1'),
(26, 1, '2025-07-20 00:17:18', '::1'),
(27, 1, '2025-07-20 00:17:25', '::1'),
(28, 1, '2025-07-20 00:17:42', '::1'),
(29, 1, '2025-07-20 00:18:58', '::1'),
(30, 1, '2025-07-20 00:19:07', '::1'),
(31, 1, '2025-07-20 00:26:21', '::1'),
(32, 1, '2025-07-20 00:28:02', '::1'),
(33, 1, '2025-07-20 00:28:45', '::1'),
(34, 1, '2025-07-20 00:32:03', '::1'),
(35, 1, '2025-07-20 00:32:34', '::1'),
(36, 1, '2025-07-20 00:34:15', '::1'),
(37, 2, '2025-07-20 00:37:58', '::1'),
(38, 2, '2025-07-20 00:38:06', '::1'),
(39, 1, '2025-07-20 00:38:53', '::1'),
(40, 1, '2025-07-20 00:39:07', '::1'),
(41, 1, '2025-07-20 00:39:19', '::1'),
(42, 1, '2025-07-20 00:49:26', '::1'),
(43, 1, '2025-07-20 00:49:39', '::1'),
(44, 1, '2025-07-20 00:51:02', '::1'),
(45, 1, '2025-07-20 00:51:08', '::1'),
(46, 4, '2025-07-20 00:52:14', '::1'),
(47, 1, '2025-07-20 00:52:20', '::1'),
(48, 4, '2025-07-20 00:58:18', '::1'),
(49, 1, '2025-07-20 00:58:25', '::1'),
(50, 1, '2025-07-20 00:58:49', '::1'),
(51, 1, '2025-07-20 00:58:55', '::1'),
(52, 1, '2025-07-20 00:58:59', '::1'),
(53, 4, '2025-07-20 01:00:58', '::1'),
(54, 1, '2025-07-20 01:01:06', '::1'),
(55, 1, '2025-07-20 01:06:59', '::1'),
(56, 1, '2025-07-20 01:08:48', '::1'),
(57, 1, '2025-07-20 01:08:57', '::1'),
(58, 1, '2025-07-20 15:11:48', '::1'),
(59, 4, '2025-07-20 15:11:55', '::1'),
(60, 4, '2025-07-20 15:13:28', '::1'),
(61, 4, '2025-07-20 15:21:52', '::1'),
(62, 4, '2025-07-20 15:22:00', '::1'),
(63, 4, '2025-07-20 15:22:41', '::1'),
(64, 1, '2025-07-20 15:22:46', '::1'),
(65, 2, '2025-07-20 15:23:03', '::1'),
(66, 4, '2025-07-20 15:24:17', '::1'),
(67, 1, '2025-07-20 15:34:04', '::1'),
(68, 1, '2025-07-20 15:34:13', '::1'),
(69, 1, '2025-07-20 15:34:28', '::1'),
(70, 1, '2025-07-20 15:34:48', '::1'),
(71, 1, '2025-07-20 15:36:06', '::1'),
(72, 1, '2025-07-20 15:53:20', '::1'),
(73, 4, '2025-07-20 16:19:15', '::1'),
(74, 4, '2025-07-20 16:23:06', '::1'),
(75, 1, '2025-07-20 16:23:41', '::1'),
(76, 1, '2025-07-20 16:23:48', '::1'),
(77, 1, '2025-07-20 16:23:58', '::1'),
(78, 1, '2025-07-20 16:30:00', '::1'),
(79, 1, '2025-07-20 16:30:54', '::1'),
(80, 4, '2025-07-20 16:32:52', '::1'),
(81, 4, '2025-07-20 16:32:59', '::1'),
(82, 4, '2025-07-20 16:35:45', '::1'),
(83, 4, '2025-07-20 16:35:50', '::1'),
(84, 4, '2025-07-20 16:36:02', '::1'),
(85, 1, '2025-07-20 16:36:16', '::1'),
(86, 1, '2025-07-20 16:36:26', '::1'),
(87, 4, '2025-07-20 16:37:03', '::1'),
(88, 1, '2025-07-20 16:38:29', '::1'),
(89, 1, '2025-07-20 16:38:40', '::1'),
(90, 4, '2025-07-20 16:40:07', '::1'),
(91, 4, '2025-07-20 16:40:15', '::1'),
(92, 4, '2025-07-20 16:46:35', '::1'),
(93, 4, '2025-07-20 16:46:38', '::1'),
(94, 4, '2025-07-20 16:47:11', '::1'),
(95, 4, '2025-07-20 16:47:43', '::1'),
(96, 4, '2025-07-20 16:48:00', '::1'),
(97, 4, '2025-07-20 16:48:06', '::1'),
(98, 4, '2025-07-20 16:48:34', '::1'),
(99, 4, '2025-07-20 16:48:41', '::1'),
(100, 1, '2025-07-20 16:51:03', '::1'),
(101, 4, '2025-07-20 16:51:12', '::1'),
(102, 4, '2025-07-20 16:51:18', '::1'),
(103, 4, '2025-07-20 16:52:45', '::1'),
(104, 1, '2025-07-20 16:53:01', '::1'),
(105, 1, '2025-07-20 17:08:02', '::1'),
(106, 1, '2025-07-20 17:08:08', '::1'),
(107, 4, '2025-07-20 17:08:34', '::1'),
(108, 4, '2025-07-20 17:08:37', '::1'),
(109, 4, '2025-07-20 17:49:49', '::1'),
(110, 1, '2025-07-20 18:22:58', '::1'),
(111, 1, '2025-07-20 18:23:04', '::1'),
(112, 4, '2025-07-20 18:23:20', '::1'),
(113, 1, '2025-07-20 18:23:26', '::1'),
(114, 4, '2025-07-20 18:54:28', '::1'),
(115, 4, '2025-07-20 19:18:02', '::1'),
(116, 1, '2025-07-20 19:18:09', '::1'),
(117, 1, '2025-07-20 19:18:17', '::1'),
(118, 1, '2025-07-20 19:18:23', '::1'),
(119, 1, '2025-07-20 19:19:13', '::1'),
(120, 1, '2025-07-20 19:27:05', '::1'),
(121, 4, '2025-07-20 19:27:45', '::1'),
(122, 4, '2025-07-20 19:31:26', '::1'),
(123, 4, '2025-07-20 19:38:15', '::1'),
(124, 2, '2025-07-20 19:43:49', '::1'),
(125, 2, '2025-07-20 19:43:53', '::1'),
(126, 4, '2025-07-20 23:05:51', '::1'),
(127, 4, '2025-07-21 11:39:21', '::1'),
(128, 4, '2025-07-21 13:39:23', '::1'),
(129, 2, '2025-07-21 13:40:26', '::1'),
(130, 4, '2025-07-21 13:45:05', '::1'),
(131, 1, '2025-07-21 13:47:59', '::1'),
(132, 1, '2025-07-21 13:52:48', '::1'),
(133, 4, '2025-07-21 13:52:52', '::1'),
(134, 4, '2025-07-21 13:53:13', '::1'),
(135, 4, '2025-07-21 13:58:35', '::1'),
(136, 1, '2025-07-21 14:04:13', '::1'),
(137, 4, '2025-07-21 14:06:40', '::1'),
(138, 2, '2025-07-21 14:06:51', '::1'),
(139, 1, '2025-07-21 14:07:02', '::1'),
(140, 1, '2025-07-21 14:07:09', '::1'),
(141, 4, '2025-07-21 14:11:31', '::1'),
(142, 1, '2025-07-21 14:11:38', '::1'),
(143, 4, '2025-07-21 14:11:51', '::1'),
(144, 4, '2025-07-21 14:18:19', '::1'),
(145, 2, '2025-07-21 14:19:30', '::1'),
(146, 4, '2025-07-21 14:21:23', '::1'),
(147, 4, '2025-07-21 14:22:03', '::1'),
(148, 2, '2025-07-21 14:22:36', '::1'),
(149, 2, '2025-07-21 14:22:47', '::1'),
(150, 1, '2025-07-21 14:23:18', '::1'),
(151, 1, '2025-07-21 14:24:07', '::1'),
(152, 1, '2025-07-21 14:25:22', '::1'),
(153, 1, '2025-07-21 14:25:29', '::1'),
(154, 1, '2025-07-21 14:28:21', '::1'),
(155, 1, '2025-07-21 14:28:34', '::1'),
(156, 1, '2025-07-21 14:28:50', '::1'),
(157, 4, '2025-07-21 14:28:53', '::1'),
(158, 1, '2025-07-21 14:29:02', '::1'),
(159, 4, '2025-07-21 14:29:08', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `cliente_id` int(11) NOT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `asignaciones`:
--

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`cliente_id`, `responsable_id`, `fecha`) VALUES
(1, 4, '2025-07-19 23:35:13'),
(2, 5, '2025-07-20 00:37:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `abierto` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `chats`:
--

--
-- Volcado de datos para la tabla `chats`
--

INSERT INTO `chats` (`id`, `cliente_id`, `responsable_id`, `abierto`) VALUES
(1, 1, 4, 1),
(2, 2, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `producto` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `contactos`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) DEFAULT NULL,
  `remitente` enum('cliente','bot','resp') DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `leido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `mensajes`:
--

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `chat_id`, `remitente`, `contenido`, `fecha`, `leido`) VALUES
(1, 1, 'cliente', 'Hola, necesito ayuda con mi pedido.', '2025-07-19 21:00:22', 0),
(2, 1, 'cliente', 'Hola, necesito ayuda con mi pedido.', '2025-07-19 21:03:14', 0),
(3, 1, 'cliente', 'Hola, necesito ayuda con mi pedido.', '2025-07-19 21:04:32', 0),
(4, 1, 'cliente', 'Hola, necesito ayuda con mi pedido.', '2025-07-19 21:04:36', 0),
(5, 1, 'cliente', 'Hola, necesito ayuda con mi pedido.', '2025-07-19 21:08:37', 0),
(6, 1, 'cliente', 'Hola, necesito ayuda con mi pedido.', '2025-07-19 21:20:35', 0),
(7, 1, 'cliente', 'hola', '2025-07-19 21:38:04', 0),
(8, 1, 'cliente', 'ayuda', '2025-07-19 21:38:15', 0),
(9, 1, 'cliente', 'precio', '2025-07-19 21:39:25', 0),
(10, 1, 'cliente', 'duda', '2025-07-19 21:39:57', 0),
(11, 1, 'cliente', 'dudas', '2025-07-19 21:40:04', 0),
(12, 1, 'cliente', 'hola', '2025-07-19 21:46:20', 0),
(13, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-19 21:46:20', 0),
(14, 1, 'cliente', 'pregunta', '2025-07-19 21:46:29', 0),
(15, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-19 21:46:29', 0),
(16, 1, 'cliente', 'más', '2025-07-19 21:47:03', 0),
(17, 1, 'bot', '¿Hay algo más en lo que pueda ayudarte?', '2025-07-19 21:47:03', 0),
(18, 1, 'cliente', 'hola', '2025-07-19 22:05:36', 0),
(19, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-19 22:05:36', 1),
(20, 1, 'cliente', 'hola', '2025-07-19 23:41:24', 0),
(21, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-19 23:41:24', 1),
(22, 1, 'cliente', 'ayuda', '2025-07-20 00:04:07', 0),
(23, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:04:07', 1),
(24, 1, 'cliente', 'no se', '2025-07-20 00:07:51', 0),
(25, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:07:51', 1),
(26, 1, 'cliente', '999', '2025-07-20 00:11:41', 0),
(27, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:11:41', 1),
(28, 1, 'cliente', 'más', '2025-07-20 00:16:08', 0),
(29, 1, 'bot', '¿Hay algo más en lo que pueda ayudarte?', '2025-07-20 00:16:08', 1),
(30, 1, 'cliente', 'ayuda', '2025-07-20 00:17:18', 0),
(31, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:17:18', 1),
(32, 1, 'cliente', 'hola', '2025-07-20 00:17:25', 0),
(33, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:17:25', 1),
(34, 1, 'cliente', 'si', '2025-07-20 00:17:42', 0),
(35, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:17:42', 1),
(36, 1, 'cliente', 'd', '2025-07-20 00:18:58', 0),
(37, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:18:58', 1),
(38, 1, 'cliente', 'hola', '2025-07-20 00:19:07', 0),
(39, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:19:07', 1),
(40, 1, 'cliente', 'hola', '2025-07-20 00:26:21', 0),
(41, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:26:21', 1),
(42, 1, 'cliente', 'o no', '2025-07-20 00:28:02', 0),
(43, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:28:02', 1),
(44, 1, 'cliente', '999', '2025-07-20 00:28:45', 0),
(45, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:28:45', 1),
(46, 1, 'cliente', 'ayuda', '2025-07-20 00:32:03', 0),
(47, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:32:03', 1),
(48, 1, 'cliente', 'si', '2025-07-20 00:32:34', 0),
(49, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:32:34', 1),
(50, 1, 'cliente', 'ayuda', '2025-07-20 00:34:15', 0),
(51, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:34:15', 1),
(52, 2, 'cliente', 'hola', '2025-07-20 00:38:06', 0),
(53, 2, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:38:06', 1),
(54, 1, 'cliente', 'hola', '2025-07-20 00:39:07', 0),
(55, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:39:07', 1),
(56, 1, 'cliente', 'hola', '2025-07-20 00:39:19', 0),
(57, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:39:19', 1),
(58, 1, 'cliente', 'ayuda', '2025-07-20 00:49:26', 0),
(59, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:49:26', 1),
(60, 1, '', 'ayuda', '2025-07-20 00:49:26', 0),
(61, 1, 'cliente', 'hola', '2025-07-20 00:49:39', 0),
(62, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:49:39', 1),
(63, 1, '', 'hola', '2025-07-20 00:49:39', 0),
(64, 1, 'cliente', 'más', '2025-07-20 00:51:02', 0),
(65, 1, 'bot', '¿Hay algo más en lo que pueda ayudarte?', '2025-07-20 00:51:02', 1),
(66, 1, '', 'más', '2025-07-20 00:51:02', 0),
(67, 1, 'cliente', '999', '2025-07-20 00:51:08', 0),
(68, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:51:08', 1),
(69, 1, '', '999', '2025-07-20 00:51:08', 0),
(70, 1, 'cliente', 'ayuda', '2025-07-20 00:52:20', 0),
(71, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:52:20', 1),
(72, 1, '', 'ayuda', '2025-07-20 00:52:20', 0),
(73, 1, 'cliente', 'hola', '2025-07-20 00:58:25', 0),
(74, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:58:25', 1),
(75, 1, 'cliente', 'no se', '2025-07-20 00:58:49', 0),
(76, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:58:49', 1),
(77, 1, 'cliente', 'mmmm', '2025-07-20 00:58:55', 0),
(78, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 00:58:55', 1),
(79, 1, 'cliente', 'ayuda', '2025-07-20 00:58:59', 0),
(80, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 00:58:59', 1),
(81, 1, 'cliente', 'ayuda', '2025-07-20 01:01:06', 0),
(82, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 01:01:06', 1),
(83, 1, '', 'hola', '2025-07-20 01:06:59', 0),
(84, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 01:06:59', 1),
(85, 1, '', 'hola', '2025-07-20 01:08:48', 0),
(86, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 01:08:48', 1),
(87, 1, '', 'ayuda', '2025-07-20 01:08:57', 0),
(88, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 01:08:57', 1),
(89, 1, '', 'si', '2025-07-20 15:34:04', 0),
(90, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 15:34:04', 1),
(91, 1, '', 'no', '2025-07-20 15:34:28', 0),
(92, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 15:34:28', 1),
(93, 1, '', 'hola hola', '2025-07-20 15:34:49', 0),
(94, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 15:34:49', 1),
(95, 1, '', 'o no', '2025-07-20 15:36:06', 0),
(96, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 15:36:06', 1),
(97, 1, '', 'ayuda', '2025-07-20 15:53:20', 0),
(98, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 15:53:20', 1),
(99, 1, '', 'hola', '2025-07-20 16:19:22', 0),
(100, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:19:22', 1),
(101, 1, '', 'que tal', '2025-07-20 16:23:17', 0),
(102, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:23:17', 1),
(103, 1, 'cliente', 'hola', '2025-07-20 16:23:48', 0),
(104, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:23:48', 1),
(105, 1, 'cliente', 'no lo se tu dime', '2025-07-20 16:23:58', 0),
(106, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:23:58', 1),
(107, 1, '', 'hay', '2025-07-20 16:27:12', 0),
(108, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:27:12', 1),
(109, 1, '', 'nose', '2025-07-20 16:28:07', 0),
(110, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:28:07', 1),
(111, 1, 'cliente', 'hay', '2025-07-20 16:30:00', 0),
(112, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:30:00', 1),
(113, 1, '', 'mmm', '2025-07-20 16:30:10', 0),
(114, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:30:10', 1),
(115, 1, '', 'si', '2025-07-20 16:30:42', 0),
(116, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:30:42', 1),
(117, 1, 'cliente', 'o no', '2025-07-20 16:30:54', 0),
(118, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:30:54', 1),
(119, 3, '', 'o no', '2025-07-20 16:32:59', 0),
(120, 3, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:32:59', 1),
(121, 3, 'cliente', 'aaaa', '2025-07-20 16:35:50', 0),
(122, 3, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:35:50', 1),
(123, 3, 'cliente', 'opa', '2025-07-20 16:36:02', 0),
(124, 3, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:36:02', 1),
(125, 1, 'cliente', 'aaaa', '2025-07-20 16:36:16', 0),
(126, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:36:16', 1),
(127, 1, 'cliente', 'puede ser ps', '2025-07-20 16:36:26', 0),
(128, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:36:26', 1),
(129, 3, 'cliente', 'dios', '2025-07-20 16:37:03', 0),
(130, 3, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:37:03', 1),
(131, 1, 'cliente', 'mmm', '2025-07-20 16:38:40', 0),
(132, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:38:40', 1),
(133, 3, 'cliente', 'hola', '2025-07-20 16:40:15', 0),
(134, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:40:15', 1),
(135, 3, 'cliente', 'hola', '2025-07-20 16:46:35', 0),
(136, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:46:35', 1),
(137, 3, 'cliente', 'hola', '2025-07-20 16:46:38', 0),
(138, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:46:38', 1),
(139, 3, 'cliente', 'hola', '2025-07-20 16:47:11', 0),
(140, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:47:11', 1),
(141, 3, 'cliente', 'hola', '2025-07-20 16:47:43', 0),
(142, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:47:43', 1),
(143, 3, 'cliente', 'hola', '2025-07-20 16:48:00', 0),
(144, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:48:00', 1),
(145, 3, 'cliente', 'holaa', '2025-07-20 16:48:06', 0),
(146, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:48:06', 1),
(147, 3, 'cliente', 'holaa', '2025-07-20 16:48:34', 0),
(148, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:48:34', 1),
(149, 3, 'cliente', 'holá', '2025-07-20 16:48:41', 0),
(150, 3, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:48:41', 1),
(151, 1, 'cliente', 'aaaa', '2025-07-20 16:51:03', 0),
(152, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 16:51:03', 1),
(153, 3, 'cliente', 'hola', '2025-07-20 16:51:12', 0),
(154, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:51:12', 1),
(155, 3, 'cliente', 'hola', '2025-07-20 16:51:18', 0),
(156, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:51:18', 1),
(157, 3, 'cliente', 'hola', '2025-07-20 16:52:45', 0),
(158, 3, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:52:45', 1),
(159, 1, 'cliente', 'hola', '2025-07-20 16:53:01', 0),
(160, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 16:53:01', 1),
(161, 1, 'cliente', 'ay', '2025-07-20 17:08:08', 0),
(162, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 17:08:08', 1),
(163, 1, '', 'mmmm', '2025-07-20 17:08:45', 0),
(164, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 17:08:45', 1),
(165, 1, '', 'chamadre', '2025-07-20 17:21:47', 0),
(166, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-20 17:21:47', 1),
(167, 1, '', 'hola', '2025-07-20 18:23:04', 0),
(168, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 18:23:04', 1),
(169, 1, '', 'hola', '2025-07-20 18:23:26', 0),
(170, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 18:23:26', 1),
(171, 1, '', 'hola', '2025-07-20 19:18:09', 0),
(172, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 19:18:09', 1),
(173, 1, '', 'ayuda', '2025-07-20 19:18:23', 0),
(174, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 19:18:23', 1),
(175, 1, '', 'ayuda', '2025-07-20 19:19:13', 0),
(176, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 19:19:13', 1),
(177, 1, '', 'hola', '2025-07-20 19:27:05', 0),
(178, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 19:27:05', 1),
(179, 2, '', 'hola', '2025-07-20 19:43:53', 0),
(180, 2, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-20 19:43:53', 1),
(181, 1, '', 'hola', '2025-07-21 14:04:13', 0),
(182, 1, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-21 14:04:13', 1),
(183, 1, '', 'zi', '2025-07-21 14:07:09', 0),
(184, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-21 14:07:09', 1),
(185, 2, '', 'hola', '2025-07-21 14:22:36', 0),
(186, 2, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', '2025-07-21 14:22:36', 1),
(187, 2, '', 'no lo se tu dime', '2025-07-21 14:22:47', 0),
(188, 2, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-21 14:22:47', 1),
(189, 1, '', 'ay', '2025-07-21 14:23:18', 0),
(190, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-21 14:23:18', 1),
(191, 1, '', 'mmmm', '2025-07-21 14:24:07', 0),
(192, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-21 14:24:07', 1),
(193, 1, '', 'aaaaa', '2025-07-21 14:25:29', 0),
(194, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-21 14:25:29', 1),
(195, 1, '', 'mmm', '2025-07-21 14:28:21', 0),
(196, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-21 14:28:21', 1),
(197, 1, '', 'aver aver ', '2025-07-21 14:28:34', 0),
(198, 1, 'bot', 'Lo siento, no tengo una respuesta para eso.', '2025-07-21 14:28:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_pred`
--

CREATE TABLE `mensajes_pred` (
  `id` int(11) NOT NULL,
  `tipo` enum('cliente','bot') DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `palabras_clave` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `mensajes_pred`:
--

--
-- Volcado de datos para la tabla `mensajes_pred`
--

INSERT INTO `mensajes_pred` (`id`, `tipo`, `texto`, `palabras_clave`) VALUES
(26, 'bot', 'Hola, ¿en qué puedo ayudarte hoy?', 'hola, ayuda, pedido'),
(27, 'bot', 'Estoy aquí para resolver tus dudas.', 'dudas, problema'),
(28, 'bot', 'Por favor, proporciona más detalles sobre tu consulta.', 'detalles, consulta'),
(29, 'bot', 'Gracias por tu mensaje, un agente se comunicará contigo pronto.', 'agente, contacto'),
(30, 'bot', '¿Hay algo más en lo que pueda ayudarte?', 'más, ayuda'),
(31, 'bot', 'Para empezar, ¿podrías indicarme tu número de pedido o referencia?', 'pedido, referencia, número'),
(32, 'bot', 'Entendido. Estoy buscando información al respecto.', 'buscar, información, entendí'),
(33, 'bot', 'Parece que ha habido un error. Por favor, inténtalo de nuevo.', 'error, reintentar, problema'),
(34, 'bot', 'Para una atención más personalizada, ¿deseas hablar con un asesor?', 'asesor, hablar, personal'),
(35, 'bot', 'Tu satisfacción es nuestra prioridad. ¿Cómo evalúas mi asistencia hasta ahora?', 'satisfacción, evaluar, asistencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsables`
--

CREATE TABLE `responsables` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `responsables`:
--

--
-- Volcado de datos para la tabla `responsables`
--

INSERT INTO `responsables` (`id`, `user_id`) VALUES
(1, 4),
(2, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` char(60) DEFAULT NULL,
  `role` enum('cliente','responsable') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `users`:
--

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `email`, `pass`, `role`) VALUES
(1, 'Cliente 1', 'cliente1@costasol.com', '$2y$10$BYS1ixY9lV/w.gMOJH5r1OQxqwUnwPebq.6L3VepT0ZlY6nDTmCmC', 'cliente'),
(2, 'Cliente 2', 'cliente2@costasol.com', '$2y$10$BYS1ixY9lV/w.gMOJH5r1OQxqwUnwPebq.6L3VepT0ZlY6nDTmCmC', 'cliente'),
(3, 'Cliente 3', 'cliente3@costasol.com', '$2y$10$BYS1ixY9lV/w.gMOJH5r1OQxqwUnwPebq.6L3VepT0ZlY6nDTmCmC', 'cliente'),
(4, 'Responsable 1', 'responsable1@costasol.com', '$2y$10$BYS1ixY9lV/w.gMOJH5r1OQxqwUnwPebq.6L3VepT0ZlY6nDTmCmC', 'responsable'),
(5, 'Responsable 2', 'responsable2@costasol.com', '$2y$10$BYS1ixY9lV/w.gMOJH5r1OQxqwUnwPebq.6L3VepT0ZlY6nDTmCmC', 'responsable'),
(6, 'Responsable 3', 'responsable3@costasol.com', '$2y$10$BYS1ixY9lV/w.gMOJH5r1OQxqwUnwPebq.6L3VepT0ZlY6nDTmCmC', 'responsable');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes_pred`
--
ALTER TABLE `mensajes_pred`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `mensajes_pred`
--
ALTER TABLE `mensajes_pred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `responsables`
--
ALTER TABLE `responsables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla accesos
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'chat-web', 'accesos', '{\"sorted_col\":\"`accesos`.`fecha` DESC\"}', '2025-07-21 16:39:30');

--
-- Metadatos para la tabla asignaciones
--

--
-- Metadatos para la tabla chats
--

--
-- Metadatos para la tabla contactos
--

--
-- Metadatos para la tabla mensajes
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'chat-web', 'mensajes', '{\"sorted_col\":\"`mensajes`.`fecha` DESC\"}', '2025-07-20 06:02:44');

--
-- Metadatos para la tabla mensajes_pred
--

--
-- Metadatos para la tabla responsables
--

--
-- Metadatos para la tabla users
--

--
-- Metadatos para la base de datos chat-web
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
