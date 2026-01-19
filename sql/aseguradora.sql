-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2026 a las 15:35:29
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
-- Base de datos: `aseguradora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accidentes`
--

CREATE TABLE `accidentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `poliza_id` bigint(20) UNSIGNED NOT NULL,
  `persona_id` bigint(20) UNSIGNED NOT NULL,
  `vehiculo_id` bigint(20) UNSIGNED NOT NULL,
  `municipio_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_accidente` date NOT NULL,
  `hora_accidente` time NOT NULL,
  `descripcion` text NOT NULL,
  `gravedad` enum('leve','moderado','grave') NOT NULL,
  `monto_danios` decimal(10,2) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `accidentes`
--

INSERT INTO `accidentes` (`id`, `poliza_id`, `persona_id`, `vehiculo_id`, `municipio_id`, `fecha_accidente`, `hora_accidente`, `descripcion`, `gravedad`, `monto_danios`, `ubicacion`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 4, '2025-07-06', '21:00:00', 'Accidente de tránsito en zona urbana', 'grave', 39228.00, 'Calle 7 x 31', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(2, 3, 3, 3, 2, '2025-04-12', '15:00:00', 'Accidente de tránsito en zona urbana', 'moderado', 25026.00, 'Calle 91 x 26', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(3, 3, 3, 3, 1, '2025-09-14', '17:00:00', 'Accidente de tránsito en zona urbana', 'leve', 16207.00, 'Calle 12 x 19', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(4, 3, 3, 3, 7, '2025-07-27', '05:00:00', 'Accidente de tránsito en zona urbana', 'moderado', 35567.00, 'Calle 41 x 84', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(6, 5, 5, 5, 8, '2025-07-22', '13:00:00', 'Accidente de tránsito en zona urbana', 'moderado', 8586.00, 'Calle 1 x 45', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(7, 5, 5, 5, 1, '2025-09-12', '07:57:00', 'Accidente en hora pico', 'moderado', 5620.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(8, 3, 3, 3, 1, '2025-10-25', '20:51:00', 'Accidente en hora pico', 'leve', 7332.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(9, 2, 2, 2, 1, '2025-08-05', '20:47:00', 'Accidente en hora pico', 'moderado', 3990.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(11, 2, 2, 2, 1, '2025-09-03', '07:34:00', 'Accidente en hora pico', 'leve', 9005.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(12, 2, 2, 2, 1, '2025-10-01', '18:30:00', 'Accidente en hora pico', 'moderado', 14117.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(13, 5, 5, 5, 1, '2025-10-08', '18:35:00', 'Accidente en hora pico', 'leve', 12504.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(14, 3, 3, 3, 1, '2025-08-15', '07:18:00', 'Accidente en hora pico', 'leve', 14255.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(15, 1, 1, 1, 1, '2025-11-29', '14:18:00', 'Accidente en hora pico', 'leve', 20987.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(16, 1, 1, 1, 1, '2025-08-17', '14:43:00', 'Accidente en hora pico', 'moderado', 16627.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(17, 3, 3, 3, 1, '2025-11-13', '18:28:00', 'Accidente en hora pico', 'leve', 4087.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(18, 1, 1, 1, 1, '2025-12-28', '08:53:00', 'Accidente en hora pico', 'leve', 15416.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(19, 4, 4, 4, 1, '2026-01-10', '08:06:00', 'Accidente en hora pico', 'leve', 20656.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(20, 5, 5, 5, 1, '2025-09-20', '07:15:00', 'Accidente en hora pico', 'leve', 12575.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(21, 2, 2, 2, 1, '2025-10-07', '18:16:00', 'Accidente en hora pico', 'leve', 17474.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(22, 3, 3, 3, 1, '2025-10-17', '08:07:00', 'Accidente en hora pico', 'moderado', 23148.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(23, 2, 2, 2, 1, '2025-12-15', '19:38:00', 'Accidente en hora pico', 'leve', 23390.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(24, 1, 1, 1, 1, '2025-09-01', '08:35:00', 'Accidente en hora pico', 'moderado', 21731.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(25, 5, 5, 5, 1, '2025-11-06', '18:21:00', 'Accidente en hora pico', 'leve', 3427.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(26, 3, 3, 3, 1, '2025-11-08', '19:04:00', 'Accidente en hora pico', 'moderado', 24646.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(27, 4, 4, 4, 1, '2025-12-25', '14:07:00', 'Accidente en hora pico', 'moderado', 25000.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(28, 3, 3, 3, 1, '2025-10-02', '08:45:00', 'Accidente en hora pico', 'moderado', 19941.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(29, 4, 4, 4, 1, '2025-11-05', '14:02:00', 'Accidente en hora pico', 'leve', 17341.00, 'Periférico de Mérida', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(30, 1, 1, 1, 1, '2025-08-20', '14:09:00', 'Accidente en hora pico', 'moderado', 15256.00, 'Periférico de Mérida', '2026-01-16 02:50:48', '2026-01-16 02:50:48'),
(31, 1, 1, 1, 1, '2025-12-11', '20:26:00', 'Accidente en hora pico', 'moderado', 9382.00, 'Periférico de Mérida', '2026-01-16 02:50:48', '2026-01-16 02:50:48'),
(32, 3, 3, 3, 1, '2025-08-05', '08:43:00', 'Accidente en hora pico', 'leve', 20680.00, 'Periférico de Mérida', '2026-01-16 02:50:48', '2026-01-16 02:50:48'),
(33, 4, 4, 4, 1, '2025-07-29', '08:15:00', 'Accidente en hora pico', 'moderado', 4105.00, 'Periférico de Mérida', '2026-01-16 02:50:48', '2026-01-16 02:50:48'),
(34, 1, 1, 1, 1, '2025-08-04', '08:52:00', 'Accidente en hora pico', 'moderado', 16183.00, 'Periférico de Mérida', '2026-01-16 02:50:48', '2026-01-16 02:50:48'),
(35, 4, 4, 4, 1, '2025-11-04', '18:40:00', 'Accidente en hora pico', 'moderado', 18001.00, 'Periférico de Mérida', '2026-01-16 02:50:48', '2026-01-16 02:50:48'),
(36, 3, 3, 3, 1, '2025-11-04', '14:54:00', 'Accidente en hora pico', 'moderado', 7150.00, 'Periférico de Mérida', '2026-01-16 02:50:48', '2026-01-16 02:50:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@correo.com|127.0.0.1', 'i:1;', 1768510326),
('laravel-cache-admin@correo.com|127.0.0.1:timer', 'i:1768510326;', 1768510326);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_15_150027_personas', 1),
(5, '2026_01_15_150057_municipios', 1),
(6, '2026_01_15_151553_vehiculos', 1),
(7, '2026_01_15_151834_polizas', 1),
(8, '2026_01_15_151929_accidentes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Mérida', 'Yucatán', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(2, 'Valladolid', 'Yucatán', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(3, 'Tizimín', 'Yucatán', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(4, 'Progreso', 'Yucatán', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(6, 'Umán', 'Yucatán', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(7, 'Ticul', 'Yucatán', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(8, 'Motul', 'Yucatán', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(9, 'Ciudad del Carmen', 'Campeche', '2026-01-19 20:33:53', '2026-01-19 20:33:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `created_at`, `updated_at`) VALUES
(1, 'Juan', 'Pérez García', 'juan.perez@example.com', '9991234567', 'Calle 60 x 47, Centro, Mérida', '1985-05-15', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(2, 'María', 'López Hernández', 'maria.lopez@example.com', '9992345678', 'Calle 21 x 30, García Ginerés, Mérida', '1990-08-22', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(3, 'Carlos', 'Martínez Sosa', 'carlos.martinez@example.com', '9993456789', 'Calle 15 x 22, Itzimná, Mérida', '1982-12-10', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(4, 'Ana', 'Rodríguez Chan', 'ana.rodriguez@example.com', '9994567890', 'Av. Colón x 18, Centro, Mérida', '1995-03-18', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(5, 'Luis', 'González Pech', 'luis.gonzalez@example.com', '9995678901', 'Calle 42 x 35, Fraccionamiento del Norte, Mérida', '1988-07-25', '2026-01-16 02:50:47', '2026-01-16 02:50:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizas`
--

CREATE TABLE `polizas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_poliza` varchar(255) NOT NULL,
  `persona_id` bigint(20) UNSIGNED NOT NULL,
  `vehiculo_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `monto_cobertura` decimal(10,2) NOT NULL,
  `prima_mensual` decimal(8,2) NOT NULL,
  `tipo_cobertura` enum('basica','intermedia','completa') NOT NULL,
  `estado` enum('activa','vencida','cancelada') NOT NULL DEFAULT 'activa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `polizas`
--

INSERT INTO `polizas` (`id`, `numero_poliza`, `persona_id`, `vehiculo_id`, `fecha_compra`, `fecha_vencimiento`, `monto_cobertura`, `prima_mensual`, `tipo_cobertura`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'POL-2026-000000', 1, 1, '2024-09-15', '2025-09-15', 249015.00, 2144.00, 'basica', 'activa', '2026-01-16 02:50:47', '2026-01-19 20:31:30'),
(2, 'POL-2026-000002', 2, 2, '2024-01-15', '2025-01-15', 272475.00, 1215.00, 'intermedia', 'activa', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(3, 'POL-2026-000003', 3, 3, '2024-10-15', '2025-10-15', 206703.00, 1260.00, 'basica', 'activa', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(4, 'POL-2026-000004', 4, 4, '2025-05-15', '2026-05-15', 59172.00, 563.00, 'intermedia', 'activa', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(5, 'POL-2026-000005', 5, 5, '2024-09-15', '2025-09-15', 234058.00, 2333.00, 'basica', 'activa', '2026-01-16 02:50:47', '2026-01-16 02:50:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('yG9QiR3pDiCmgE6lGNqGWW7HLZlcaMAbt27Aouua', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN3VOMUd5MHNDaDJOa2kxMFVCalFCSjhNbTBmbzNoN3p2VVZSZVYwYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1768833249);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@aseguradora.com', NULL, '$2y$12$bFEuTJm3CISL8PF4r8AkYOE5G5Zn2S8TjnVw0WUz0MrbMGz8uHVoS', NULL, '2026-01-16 02:50:47', '2026-01-16 02:50:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `persona_id` bigint(20) UNSIGNED NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `anio` int(11) NOT NULL,
  `placa` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `numero_serie` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `persona_id`, `marca`, `modelo`, `anio`, `placa`, `color`, `numero_serie`, `created_at`, `updated_at`) VALUES
(1, 1, 'Volkswagen', 'Civic', 2021, 'YUC-269-GM', 'Blanco', '6BAB2353F57CA79A', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(2, 2, 'Nissan', 'CX-5', 2015, 'YUC-582-CF', 'Gris', 'A9F620FFC8B76596', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(3, 3, 'Toyota', 'Corolla', 2020, 'YUC-353-HH', 'Rojo', 'D72B3AD6A7C625E2', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(4, 4, 'Mazda', 'Civic', 2023, 'YUC-911-RJ', 'Blanco', '7F5E24F34F42A9E6', '2026-01-16 02:50:47', '2026-01-16 02:50:47'),
(5, 5, 'Toyota', 'Sentra', 2015, 'YUC-851-HN', 'Rojo', '2976CD11B8AF29C0', '2026-01-16 02:50:47', '2026-01-16 02:50:47');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accidentes`
--
ALTER TABLE `accidentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accidentes_poliza_id_foreign` (`poliza_id`),
  ADD KEY `accidentes_persona_id_foreign` (`persona_id`),
  ADD KEY `accidentes_vehiculo_id_foreign` (`vehiculo_id`),
  ADD KEY `accidentes_municipio_id_foreign` (`municipio_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_email_unique` (`email`);

--
-- Indices de la tabla `polizas`
--
ALTER TABLE `polizas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `polizas_numero_poliza_unique` (`numero_poliza`),
  ADD KEY `polizas_persona_id_foreign` (`persona_id`),
  ADD KEY `polizas_vehiculo_id_foreign` (`vehiculo_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehiculos_placa_unique` (`placa`),
  ADD UNIQUE KEY `vehiculos_numero_serie_unique` (`numero_serie`),
  ADD KEY `vehiculos_persona_id_foreign` (`persona_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accidentes`
--
ALTER TABLE `accidentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `polizas`
--
ALTER TABLE `polizas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accidentes`
--
ALTER TABLE `accidentes`
  ADD CONSTRAINT `accidentes_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accidentes_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accidentes_poliza_id_foreign` FOREIGN KEY (`poliza_id`) REFERENCES `polizas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accidentes_vehiculo_id_foreign` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `polizas`
--
ALTER TABLE `polizas`
  ADD CONSTRAINT `polizas_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `polizas_vehiculo_id_foreign` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
