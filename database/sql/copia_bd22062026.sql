/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `bd_intuitivas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `bd_intuitivas`;

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `carrito_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `carrito_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio` decimal(10,2) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `talle` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carrito_items_carrito_id_foreign` (`carrito_id`),
  KEY `carrito_items_producto_id_foreign` (`producto_id`),
  CONSTRAINT `carrito_items_carrito_id_foreign` FOREIGN KEY (`carrito_id`) REFERENCES `carritos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carrito_items_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carrito_items` (`id`, `carrito_id`, `producto_id`, `cantidad`, `precio`, `color`, `talle`, `created_at`, `updated_at`) VALUES
	(5, 32, 3, 1, 90000.00, 'celeste apagado claro', 'M', '2026-06-23 00:47:46', '2026-06-23 00:47:46'),
	(9, 38, 12, 1, 47000.00, 'azul suave', 'L', '2026-06-23 07:19:03', '2026-06-23 07:19:03'),
	(10, 39, 7, 1, 43000.00, 'blanco frío', 'S', '2026-06-23 07:31:51', '2026-06-23 07:31:51'),
	(11, 40, 4, 1, 52000.00, 'blanco', 'S', '2026-06-23 07:43:52', '2026-06-23 07:43:52'),
	(13, 41, 12, 1, 47000.00, 'blanco', 'S', '2026-06-23 08:01:56', '2026-06-23 08:01:56'),
	(16, 42, 6, 1, 62000.00, 'claro', '44', '2026-06-23 08:20:58', '2026-06-23 08:20:58'),
	(18, 43, 1, 1, 49000.00, 'bordó', 'S', '2026-06-23 08:25:51', '2026-06-23 08:25:51'),
	(19, 44, 6, 3, 62000.00, 'clásico', '40', '2026-06-23 08:59:12', '2026-06-23 08:59:12');

CREATE TABLE IF NOT EXISTS `carritos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carritos_usuario_id_foreign` (`usuario_id`),
  KEY `carritos_session_id_index` (`session_id`),
  CONSTRAINT `carritos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carritos` (`id`, `usuario_id`, `session_id`, `created_at`, `updated_at`) VALUES
	(1, NULL, '1GK5gB6URGBpExSYkuq3QhVVcyIumwPffoe1Qz5a', '2026-06-21 06:09:10', '2026-06-21 06:09:10'),
	(2, 1, NULL, '2026-06-21 06:12:51', '2026-06-21 06:12:51'),
	(3, NULL, 'ol4885KHQVtAw79eEt80r5phANrpRHjQFcKgEd0Q', '2026-06-21 07:15:29', '2026-06-21 07:15:29'),
	(4, 2, NULL, '2026-06-21 07:16:34', '2026-06-21 07:16:34'),
	(5, NULL, 'VOX16IvjAXOlaTgSzO2czrGkJVIhaM8ROJnHciXX', '2026-06-21 07:16:34', '2026-06-21 07:16:34'),
	(6, NULL, 'LwxzggzCieo4dN9jOm2PSZh7oUJzv3IVG8anZYGU', '2026-06-21 07:16:51', '2026-06-21 07:16:51'),
	(7, NULL, '3BGju4bMhOhoYKb2PAa698iOFVqQTFO1Ekp4F9DX', '2026-06-21 08:48:47', '2026-06-21 08:48:47'),
	(8, NULL, 'SlNe9a1pqGJxXWoIyuDjVsyMjGLONQceAWRX6KMA', '2026-06-22 05:15:49', '2026-06-22 05:15:49'),
	(9, 4, NULL, '2026-06-22 05:17:19', '2026-06-22 05:17:19'),
	(10, NULL, 'lr9HrifwfykJWAKfHXMg6zmweIQZx7ucBHma6qy0', '2026-06-22 05:17:19', '2026-06-22 05:17:19'),
	(11, NULL, '6jbgFMVqJNREmWvNJ3sixQdL2DEWV3btlrzLtqVr', '2026-06-22 05:25:12', '2026-06-22 05:25:12'),
	(12, NULL, '5IqtQ7VHaszLjNgTSF8HmC8uEjJlTeUo0gQsSRT9', '2026-06-22 05:30:43', '2026-06-22 05:30:43'),
	(13, NULL, 'fseyI0AFV17S0n1Q99tQSpExPwajg1h16r1BLh2T', '2026-06-22 05:30:57', '2026-06-22 05:30:57'),
	(14, NULL, 'e4SZ74pINYElbSK3lwJEOu8bdpcniKqVmpvUccl6', '2026-06-22 05:37:07', '2026-06-22 05:37:07'),
	(15, NULL, 'DOyWKH75p4tPwqpwolUoNqDjDyGNRZoGv85hnnVR', '2026-06-22 05:40:38', '2026-06-22 05:40:38'),
	(16, NULL, '7imHv3GEvjLlNd9INNTQtFjCoF3DglOMLCmd72kd', '2026-06-22 05:42:17', '2026-06-22 05:42:17'),
	(17, NULL, '5YWPQgKrqapWsRCEIN2YSxHE7E0HMyhASiqpJm6N', '2026-06-22 06:39:27', '2026-06-22 06:39:27'),
	(18, NULL, 'nGdPqw7qmGLE8lpFvvtWgnXvNK2rj96gQGa27IBx', '2026-06-22 06:55:11', '2026-06-22 06:55:11'),
	(19, NULL, 'w85ngemQlHMxcolZFKtgGKXIiIeQZLM9ikBTZhVh', '2026-06-22 07:07:52', '2026-06-22 07:07:52'),
	(20, NULL, '071XTEg0qN5pesk2rKYLKaeC6eXIYdc3eW6l1deM', '2026-06-22 07:33:11', '2026-06-22 07:33:11'),
	(21, 3, NULL, '2026-06-22 07:33:22', '2026-06-22 07:33:22'),
	(22, NULL, 'ncCXaTlddB56zo3qjDWdyKud590Ja4obcBJxThKI', '2026-06-22 07:33:23', '2026-06-22 07:33:23'),
	(23, NULL, 't6J3PuYQ4oR6rrfngNChe8CvgIhDuzzIn8AjG3nx', '2026-06-22 07:45:39', '2026-06-22 07:45:39'),
	(24, NULL, 'zE1HWnBn9F3bggiTtSO2OSmhEWPw6l7ae8uji7Nd', '2026-06-22 08:02:09', '2026-06-22 08:02:09'),
	(25, NULL, 'NoNCnJOM6ALd0b9pr7MtmIRx7DPWyRGE38Q6Pi0Z', '2026-06-22 08:02:20', '2026-06-22 08:02:20'),
	(26, NULL, 'Rpsl2VwPzI091rimqnu9Em8gQVc931Reqp2IpYoD', '2026-06-22 08:04:10', '2026-06-22 08:04:10'),
	(27, NULL, 'IAuU08TMvhu2hepNkweyXIl6ZoUvLkfSrU66992G', '2026-06-22 08:22:58', '2026-06-22 08:22:58'),
	(28, NULL, 'fm7rnTK5Sy3TuHTPRqG0IWhN1Jjz5Wz5yq8h3TrB', '2026-06-22 15:23:54', '2026-06-22 15:23:54'),
	(29, NULL, 'el5oTeCQOOOWEnFtO2eNkzTMJU4h3O3lyXKRMDNM', '2026-06-22 19:07:25', '2026-06-22 19:07:25'),
	(30, NULL, 'E6123S8y8CkBeGfV2loQcPg2Rn6oEWhw5Vm60izE', '2026-06-22 23:26:51', '2026-06-22 23:26:51'),
	(31, NULL, 'PB3Emj3t6jO1DCkxuXk95A4yYekAZorigmkD2jCe', '2026-06-22 23:32:07', '2026-06-22 23:32:07'),
	(32, NULL, 'NQcxzRz4xqVjCqONHzYScffxFw2qnuMLHWJRfG0v', '2026-06-23 00:34:07', '2026-06-23 00:34:07'),
	(33, NULL, 'mL9nHLoPCxFkh5gSCzJ8I53EOLesEn9pfjT4YvuY', '2026-06-23 01:18:13', '2026-06-23 01:18:13'),
	(34, NULL, '6MWNLv1tr2wdXlnafyrW82ZPrvOsmXnTdN2BIxk8', '2026-06-23 01:37:34', '2026-06-23 01:37:34'),
	(35, NULL, 'cawMK9YVITy42dFdTqPL7WztRhW7Cb51jVD9yWPT', '2026-06-23 02:26:08', '2026-06-23 02:26:08'),
	(36, NULL, 'iPGwXEE9JTbUAYorHowsn41JdDc11HuqFceSmhrS', '2026-06-23 02:35:21', '2026-06-23 02:35:21'),
	(37, NULL, 'Srsv8FJEpc0nhXUXCA4ErJpBken7vHUepOf8s8tO', '2026-06-23 02:37:21', '2026-06-23 02:37:21'),
	(38, NULL, 'g0VmmUgg1yIf1lxQi7BPrrCmVjwZKdopm1QQyfzR', '2026-06-23 07:18:39', '2026-06-23 07:18:39'),
	(39, NULL, '1dIGxcghxO5vUK1n0AKA11TuNQiAPWFGXcfjS1LE', '2026-06-23 07:31:40', '2026-06-23 07:31:40'),
	(40, NULL, 'He6E2W1L4AW2E0TLcWeGt1yUy1Mf4N9BnpJMjYV1', '2026-06-23 07:43:45', '2026-06-23 07:43:45'),
	(41, NULL, 'ZT9JEkHSXvLrm8vTRkOPG6f0mjNI2Yug2d3pufJU', '2026-06-23 08:01:48', '2026-06-23 08:01:48'),
	(42, NULL, 'S1xY1qdImJEPS7yk7MUOebsYJsGFAa25J0gVzLKF', '2026-06-23 08:06:06', '2026-06-23 08:06:06'),
	(43, NULL, 'ZOKQKsklXGcN7qcTKo0NJ6BIcTmqP0u7DCmpvOEf', '2026-06-23 08:25:43', '2026-06-23 08:25:43'),
	(44, NULL, 'r2mxSEN5yL7KUZ3L5qwJucEH3kJvCgwfL0wOAcoE', '2026-06-23 08:53:10', '2026-06-23 08:53:10'),
	(48, NULL, 'Jq32Zn3hCG7vGRINfBys90xBAhiBivaxvRB43uMs', '2026-06-23 09:15:32', '2026-06-23 09:15:32');

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categorias_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categorias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 'Sweater', '2026-06-21 06:29:52', '2026-06-21 06:29:52'),
	(2, 'Blazer', '2026-06-21 06:41:40', '2026-06-21 06:41:40'),
	(3, 'Pantalones', '2026-06-21 06:49:08', '2026-06-21 06:49:08'),
	(4, 'Camisa', '2026-06-21 06:56:56', '2026-06-21 06:56:56'),
	(5, 'Accesorios', '2026-06-22 06:53:35', '2026-06-22 06:53:35');

CREATE TABLE IF NOT EXISTS `colores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `hex` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `colores_nombre_hex_unique` (`nombre`,`hex`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `colores` (`id`, `nombre`, `hex`, `created_at`, `updated_at`) VALUES
	(1, 'bordó', '#500014', '2026-06-21 06:29:52', '2026-06-21 06:29:52'),
	(2, 'negro', '#000000', '2026-06-21 06:30:59', '2026-06-21 06:30:59'),
	(3, 'marrón', '#7a1f1f', '2026-06-21 06:31:40', '2026-06-21 06:31:40'),
	(4, 'teal oscuro', '#004d40', '2026-06-21 06:36:10', '2026-06-21 06:36:10'),
	(5, 'azul desaturado', '#5c7c99', '2026-06-21 06:37:14', '2026-06-21 06:37:14'),
	(6, 'azul apagado', '#4a6c8c', '2026-06-21 06:39:28', '2026-06-21 06:39:28'),
	(7, 'celeste apagado claro', '#87cbd6', '2026-06-21 06:41:40', '2026-06-21 06:41:40'),
	(8, 'blanco', '#fafafa', '2026-06-21 06:42:22', '2026-06-21 06:42:22'),
	(9, 'beige', '#f5f5dc', '2026-06-21 06:44:56', '2026-06-21 06:44:56'),
	(10, 'crema', '#fffdd0', '2026-06-21 06:45:56', '2026-06-21 06:45:56'),
	(11, 'gris oscuro', '#424242', '2026-06-21 06:49:08', '2026-06-21 06:49:08'),
	(12, 'claro', '#a8c3d8', '2026-06-21 06:52:56', '2026-06-21 06:52:56'),
	(13, 'clásico', '#4f6d8a', '2026-06-21 06:53:48', '2026-06-21 06:53:48'),
	(14, 'oscuro', '#2c4968', '2026-06-21 06:54:54', '2026-06-21 06:54:54'),
	(15, 'blanco frío', '#f5f7f8', '2026-06-21 06:56:56', '2026-06-21 06:56:56'),
	(16, 'celeste claro', '#c7d9f2', '2026-06-21 07:01:05', '2026-06-21 07:01:05'),
	(17, 'celeste clásico', '#9fbfe5', '2026-06-21 07:01:49', '2026-06-21 07:01:49'),
	(18, 'celeste oscuro', '#6f95c8', '2026-06-21 07:02:40', '2026-06-21 07:02:40'),
	(19, 'beige claro', '#e8e2d8', '2026-06-21 07:08:27', '2026-06-21 07:08:27'),
	(20, 'gris rayado', '#8a8178', '2026-06-21 07:09:19', '2026-06-21 07:09:19'),
	(21, 'marrón chocolate', '#5a2e1f', '2026-06-21 07:11:15', '2026-06-21 07:11:15'),
	(22, 'marrón cuero', '#7a3e26', '2026-06-21 07:12:04', '2026-06-21 07:12:04'),
	(23, 'azul cielo medio', '#6fa8dc', '2026-06-21 07:13:40', '2026-06-21 07:13:40'),
	(24, 'azul suave', '#7eaed6', '2026-06-21 07:14:23', '2026-06-21 07:14:23');

CREATE TABLE IF NOT EXISTS `contactos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `consulta` text NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contactos` (`id`, `nombre`, `email`, `motivo`, `consulta`, `leido`, `created_at`, `updated_at`) VALUES
	(1, 'Camila Hernandez', 'camilahernandez@gmail.com', 'Duda sobre las medidas', 'Hola! Me interesa mucho el sweater macarena, pero estoy en duda con el talle. Me podrían pasar las medidas de sisa y largo del talle S o si tienen una tabla de talles para guiarme? Gracias!', 1, '2026-06-22 08:04:01', '2026-06-22 08:08:59');

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_cache_table', 1),
	(2, '2026_05_21_000001_create_usuarios_table', 1),
	(3, '2026_05_21_000002_create_categorias_table', 1),
	(4, '2026_05_21_000003_create_colores_table', 1),
	(5, '2026_05_21_100000_create_talles_table', 1),
	(6, '2026_05_22_100001_create_productos_table', 1),
	(7, '2026_05_23_100003_create_producto_variantes_table', 1),
	(8, '2026_05_24_100002_create_producto_imagenes_table', 1),
	(9, '2026_06_11_003643_create_contactos_table', 1),
	(10, '2026_06_12_200000_create_venta_cabeceras_table', 1),
	(11, '2026_06_12_200001_create_venta_detalles_table', 1),
	(12, '2026_06_12_245522_create_carritos_table', 1),
	(13, '2026_06_12_245545_create_carrito_items_table', 1),
	(14, '2026_06_12_263955_add_unique_to_colores_table', 1),
	(15, '2026_06_21_020144_add_snapshot_fields_to_venta_detalles', 1);

CREATE TABLE IF NOT EXISTS `producto_imagenes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `path` varchar(255) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT 0,
  `principal` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_imagenes_producto_id_foreign` (`producto_id`),
  CONSTRAINT `producto_imagenes_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `producto_imagenes` (`id`, `producto_id`, `path`, `orden`, `principal`, `created_at`, `updated_at`) VALUES
	(1, 1, 'productos/mdSkYY9hT4vlhxluRWKNyiGeDvJd4hqDbPbxpJcP.jpg', 0, 1, '2026-06-21 06:29:52', '2026-06-21 06:29:52'),
	(2, 1, 'productos/agdz2zYJJLwdbgaL0R7nzCWCZxwuY1KFn7TVTWHp.jpg', 1, 0, '2026-06-21 06:29:52', '2026-06-21 06:29:52'),
	(3, 2, 'productos/bbazFzeadUPFRyHNahDk5bglqTqpuBPETfBuPFuE.jpg', 0, 1, '2026-06-21 06:36:10', '2026-06-21 06:36:10'),
	(4, 2, 'productos/79WIs89c312td0hjDn6Zf94e5gmkoYcP1AFvC7LV.jpg', 1, 0, '2026-06-21 06:36:10', '2026-06-21 06:36:10'),
	(5, 3, 'productos/hYcgsSEyRriRJOAvWf1kfaLZ3ZWpdlJNhYnFelzF.jpg', 0, 1, '2026-06-21 06:41:40', '2026-06-21 06:41:40'),
	(6, 3, 'productos/DXFOXknUU1bvSZylo18osaGozn2tJTAGrTPqXcp3.jpg', 1, 0, '2026-06-21 06:41:40', '2026-06-21 06:41:40'),
	(7, 4, 'productos/CHjPhXMOBwEU9gVynJrYC9G2ypSK20Y57V1Yw4IW.jpg', 0, 1, '2026-06-21 06:44:56', '2026-06-21 06:44:56'),
	(8, 4, 'productos/wL066kd9E1EgykU8P4AzwX0qF4nfMA1haJyNdbCK.jpg', 1, 0, '2026-06-21 06:44:56', '2026-06-21 06:44:56'),
	(9, 5, 'productos/vy2GXefSkg6ogFKRKIDB5JmEaN6YTnccDcJ5r99R.jpg', 0, 1, '2026-06-21 06:49:08', '2026-06-21 06:49:08'),
	(10, 5, 'productos/Un3LGkTwZ6ZOTUEr93HBtn1c3v3cIJUVTJJiqOqO.jpg', 1, 0, '2026-06-21 06:49:08', '2026-06-21 06:49:08'),
	(11, 6, 'productos/vYg0RAVIye1cycB6kVucJ1MOUHmW5biGtA2N4IWg.jpg', 0, 1, '2026-06-21 06:52:56', '2026-06-21 06:52:56'),
	(12, 6, 'productos/PraqqpQXGI9ZgMe043sVL7HpfuZRjTxXIwUpieu2.jpg', 1, 0, '2026-06-21 06:52:56', '2026-06-21 06:52:56'),
	(13, 7, 'productos/2bTPabM1JPwmh2ONEZIxL3pzAORG7Q5ytCqB0w9w.jpg', 0, 1, '2026-06-21 06:56:56', '2026-06-21 06:56:56'),
	(14, 7, 'productos/edXSIUTAK2I6cMyhLqTXwrvT6jO7dyKGxWOgKNqr.jpg', 1, 0, '2026-06-21 06:56:56', '2026-06-21 06:56:56'),
	(15, 8, 'productos/CSYkmPGE1QRBgH5O3RhHTNsYvzpDsCbotlpevt9U.png', 0, 1, '2026-06-21 07:01:05', '2026-06-21 07:01:05'),
	(16, 8, 'productos/Se7KcL1FMJVhBySunE40OwuGJFrLu5oVp6gc3x6V.png', 1, 0, '2026-06-21 07:01:05', '2026-06-21 07:01:05'),
	(17, 9, 'productos/2ZOEho73dIk3w2c34edxXGlLmoo3ApgDsB9NTI4Q.png', 0, 1, '2026-06-21 07:05:31', '2026-06-21 07:05:31'),
	(18, 9, 'productos/QUBXYWhrIa1vCLX2lun64YHaZx13ThFhnayMzAX3.png', 1, 0, '2026-06-21 07:05:31', '2026-06-21 07:05:31'),
	(19, 10, 'productos/H0z1mSQXh0nvWsDdf9ntENjisrmLg3NcOMzyLNrl.jpg', 0, 1, '2026-06-21 07:08:27', '2026-06-21 07:08:27'),
	(20, 10, 'productos/AugSE8bbVAigpFcAvt31XYH7xtB6G4wrJunGkqB2.jpg', 1, 0, '2026-06-21 07:08:27', '2026-06-21 07:08:27'),
	(21, 11, 'productos/LrrybcOmU1NmIloKb4HqCbhVIaqErVH8GFwkEAdg.png', 0, 1, '2026-06-21 07:11:15', '2026-06-21 07:11:15'),
	(22, 11, 'productos/G48UTEIW50O7vtmH0QgnLs3PeyI4tnkzaHj8RUsf.png', 1, 0, '2026-06-21 07:11:15', '2026-06-21 07:11:15'),
	(23, 12, 'productos/8PcfRKjqTjLGl3tgoUYmVY1wIYN1px2bznihYMpz.jpg', 0, 1, '2026-06-21 07:13:40', '2026-06-21 07:13:40'),
	(24, 12, 'productos/HPfNdUuEhpCq0okLQkVcXPY2m98aMfv9eWBabI5W.jpg', 1, 0, '2026-06-21 07:13:40', '2026-06-21 07:13:40'),
	(25, 13, 'productos/2g7EV7YMYknXNzT2llhnhN14abQWctLFkxPvosRe.jpg', 0, 1, '2026-06-22 06:53:35', '2026-06-22 06:53:35'),
	(26, 13, 'productos/Wx0K2ziNf6Za9LP58pXSQ3oQXwqoM4WFTR3ZialC.jpg', 1, 0, '2026-06-22 06:53:35', '2026-06-22 06:53:35'),
	(27, 13, 'productos/7doiGG3l9Q1sZUrkDQwgPagVltFRKa6dhNUKBHfh.jpg', 2, 0, '2026-06-22 06:53:35', '2026-06-22 06:53:35');

CREATE TABLE IF NOT EXISTS `producto_variantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `color_id` bigint(20) unsigned NOT NULL,
  `talle_id` bigint(20) unsigned NOT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `producto_variantes_producto_id_color_id_talle_id_unique` (`producto_id`,`color_id`,`talle_id`),
  KEY `producto_variantes_color_id_foreign` (`color_id`),
  KEY `producto_variantes_talle_id_foreign` (`talle_id`),
  CONSTRAINT `producto_variantes_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `producto_variantes_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `producto_variantes_talle_id_foreign` FOREIGN KEY (`talle_id`) REFERENCES `talles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `producto_variantes` (`id`, `producto_id`, `color_id`, `talle_id`, `stock`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 20, '2026-06-21 06:29:52', '2026-06-21 06:29:52'),
	(2, 1, 1, 3, 19, '2026-06-21 06:30:24', '2026-06-23 09:15:01'),
	(3, 1, 1, 4, 18, '2026-06-21 06:30:44', '2026-06-21 06:30:44'),
	(4, 1, 2, 3, 20, '2026-06-21 06:30:59', '2026-06-21 06:30:59'),
	(5, 1, 2, 4, 24, '2026-06-21 06:31:07', '2026-06-21 06:31:07'),
	(6, 1, 2, 5, 18, '2026-06-21 06:31:14', '2026-06-21 06:31:14'),
	(7, 1, 2, 6, 10, '2026-06-21 06:31:20', '2026-06-21 06:31:20'),
	(8, 1, 3, 3, 16, '2026-06-21 06:31:40', '2026-06-21 06:31:40'),
	(9, 2, 4, 1, 12, '2026-06-21 06:36:10', '2026-06-21 06:36:10'),
	(10, 2, 4, 2, 10, '2026-06-21 06:36:18', '2026-06-21 06:36:18'),
	(11, 2, 4, 3, 20, '2026-06-21 06:36:25', '2026-06-21 06:36:25'),
	(12, 2, 4, 4, 16, '2026-06-21 06:36:34', '2026-06-21 06:36:34'),
	(13, 2, 5, 3, 10, '2026-06-21 06:37:14', '2026-06-21 06:37:14'),
	(14, 2, 5, 4, 16, '2026-06-21 06:37:21', '2026-06-21 06:37:21'),
	(15, 2, 5, 5, 10, '2026-06-21 06:37:28', '2026-06-21 06:37:28'),
	(16, 2, 5, 6, 8, '2026-06-21 06:37:36', '2026-06-21 06:37:36'),
	(17, 2, 6, 4, 10, '2026-06-21 06:39:28', '2026-06-21 06:39:28'),
	(18, 2, 6, 6, 6, '2026-06-21 06:39:39', '2026-06-21 06:39:39'),
	(19, 3, 7, 3, 20, '2026-06-21 06:41:40', '2026-06-21 06:41:40'),
	(20, 3, 7, 4, 24, '2026-06-21 06:41:48', '2026-06-21 06:41:48'),
	(21, 3, 8, 3, 24, '2026-06-21 06:42:22', '2026-06-21 06:42:22'),
	(22, 3, 8, 4, 20, '2026-06-21 06:42:29', '2026-06-21 06:42:29'),
	(23, 3, 8, 5, 24, '2026-06-21 06:42:36', '2026-06-21 06:42:36'),
	(24, 3, 8, 6, 18, '2026-06-21 06:42:46', '2026-06-21 06:42:46'),
	(25, 3, 8, 7, 10, '2026-06-21 06:42:56', '2026-06-21 06:42:56'),
	(26, 4, 9, 4, 15, '2026-06-21 06:44:56', '2026-06-22 05:41:19'),
	(27, 4, 9, 5, 12, '2026-06-21 06:45:06', '2026-06-21 06:45:06'),
	(28, 4, 10, 2, 16, '2026-06-21 06:45:56', '2026-06-21 06:45:56'),
	(29, 4, 10, 3, 20, '2026-06-21 06:46:03', '2026-06-21 06:46:03'),
	(30, 4, 10, 4, 20, '2026-06-21 06:46:07', '2026-06-21 06:46:07'),
	(31, 4, 10, 5, 12, '2026-06-21 06:46:16', '2026-06-21 06:46:16'),
	(32, 4, 10, 6, 10, '2026-06-21 06:46:22', '2026-06-21 06:46:22'),
	(33, 4, 8, 3, 11, '2026-06-21 06:47:02', '2026-06-23 02:36:55'),
	(34, 4, 8, 6, 6, '2026-06-21 06:47:10', '2026-06-21 06:47:10'),
	(35, 5, 11, 10, 20, '2026-06-21 06:49:08', '2026-06-21 06:49:08'),
	(36, 5, 11, 11, 22, '2026-06-21 06:49:14', '2026-06-21 06:49:14'),
	(37, 5, 11, 12, 18, '2026-06-21 06:49:26', '2026-06-21 06:49:26'),
	(38, 5, 2, 9, 10, '2026-06-21 06:51:14', '2026-06-21 06:51:14'),
	(39, 5, 2, 11, 14, '2026-06-21 06:51:22', '2026-06-23 02:36:55'),
	(40, 6, 12, 9, 16, '2026-06-21 06:52:56', '2026-06-21 06:52:56'),
	(41, 6, 12, 10, 20, '2026-06-21 06:53:03', '2026-06-21 06:53:03'),
	(42, 6, 12, 11, 20, '2026-06-21 06:53:08', '2026-06-21 06:53:08'),
	(43, 6, 12, 13, 10, '2026-06-21 06:53:15', '2026-06-21 06:53:15'),
	(44, 6, 13, 10, 16, '2026-06-21 06:53:48', '2026-06-21 06:53:48'),
	(45, 6, 13, 11, 16, '2026-06-21 06:53:52', '2026-06-21 06:53:52'),
	(46, 6, 13, 12, 10, '2026-06-21 06:53:58', '2026-06-21 06:53:58'),
	(47, 6, 14, 11, 10, '2026-06-21 06:54:54', '2026-06-21 06:54:54'),
	(48, 6, 14, 13, 8, '2026-06-21 06:55:04', '2026-06-21 06:55:04'),
	(49, 6, 14, 14, 8, '2026-06-21 06:55:10', '2026-06-21 06:55:10'),
	(50, 7, 15, 3, 20, '2026-06-21 06:56:56', '2026-06-21 06:56:56'),
	(51, 7, 15, 4, 24, '2026-06-21 06:57:02', '2026-06-21 06:57:02'),
	(52, 7, 15, 6, 12, '2026-06-21 06:57:10', '2026-06-21 06:57:10'),
	(53, 7, 7, 4, 18, '2026-06-21 06:58:09', '2026-06-21 06:58:09'),
	(54, 7, 7, 6, 10, '2026-06-21 06:58:17', '2026-06-21 06:58:17'),
	(55, 8, 16, 2, 10, '2026-06-21 07:01:05', '2026-06-21 07:01:05'),
	(56, 8, 16, 3, 18, '2026-06-21 07:01:13', '2026-06-21 07:01:13'),
	(57, 8, 17, 3, 20, '2026-06-21 07:01:49', '2026-06-21 07:01:49'),
	(58, 8, 17, 4, 18, '2026-06-21 07:01:57', '2026-06-21 07:01:57'),
	(59, 8, 17, 5, 12, '2026-06-21 07:02:04', '2026-06-21 07:02:04'),
	(60, 8, 17, 6, 2, '2026-06-21 07:02:10', '2026-06-21 07:02:10'),
	(61, 8, 18, 5, 10, '2026-06-21 07:02:40', '2026-06-21 07:02:40'),
	(62, 8, 18, 6, 6, '2026-06-21 07:02:47', '2026-06-21 07:02:47'),
	(63, 9, 3, 3, 18, '2026-06-21 07:05:31', '2026-06-21 07:05:31'),
	(64, 9, 3, 4, 18, '2026-06-21 07:05:35', '2026-06-21 07:05:35'),
	(65, 9, 3, 5, 10, '2026-06-21 07:05:41', '2026-06-21 07:05:41'),
	(66, 9, 8, 2, 2, '2026-06-21 07:06:04', '2026-06-21 07:06:04'),
	(67, 9, 8, 3, 20, '2026-06-21 07:06:12', '2026-06-21 07:06:12'),
	(68, 9, 8, 4, 24, '2026-06-21 07:06:19', '2026-06-21 07:06:19'),
	(69, 9, 8, 6, 10, '2026-06-21 07:06:26', '2026-06-21 07:06:26'),
	(70, 10, 19, 5, 10, '2026-06-21 07:08:27', '2026-06-21 07:08:27'),
	(71, 10, 19, 6, 8, '2026-06-21 07:08:36', '2026-06-21 07:08:36'),
	(72, 10, 20, 4, 10, '2026-06-21 07:09:19', '2026-06-21 07:09:19'),
	(73, 10, 20, 5, 8, '2026-06-21 07:09:25', '2026-06-21 07:09:25'),
	(74, 10, 20, 6, 6, '2026-06-21 07:09:33', '2026-06-21 07:09:33'),
	(75, 11, 21, 3, 19, '2026-06-21 07:11:15', '2026-06-22 05:31:38'),
	(76, 11, 21, 4, 20, '2026-06-21 07:11:20', '2026-06-21 07:11:20'),
	(77, 11, 21, 5, 16, '2026-06-21 07:11:27', '2026-06-21 07:11:27'),
	(78, 11, 21, 6, 10, '2026-06-21 07:11:33', '2026-06-21 07:11:33'),
	(79, 11, 22, 4, 10, '2026-06-21 07:12:04', '2026-06-21 07:12:04'),
	(80, 11, 22, 5, 16, '2026-06-21 07:12:12', '2026-06-21 07:12:12'),
	(81, 12, 23, 3, 16, '2026-06-21 07:13:40', '2026-06-21 07:13:40'),
	(82, 12, 23, 4, 18, '2026-06-21 07:13:47', '2026-06-21 07:13:47'),
	(83, 12, 23, 5, 10, '2026-06-21 07:13:53', '2026-06-21 07:13:53'),
	(84, 12, 24, 5, 20, '2026-06-21 07:14:23', '2026-06-21 07:14:23'),
	(85, 12, 24, 6, 18, '2026-06-21 07:14:30', '2026-06-21 07:14:30'),
	(86, 12, 8, 3, 18, '2026-06-21 07:14:54', '2026-06-21 07:14:54'),
	(87, 12, 8, 4, 16, '2026-06-21 07:15:01', '2026-06-21 07:15:01'),
	(88, 12, 8, 5, 16, '2026-06-21 07:15:05', '2026-06-21 07:15:05'),
	(89, 12, 8, 6, 14, '2026-06-21 07:15:12', '2026-06-21 07:15:12'),
	(90, 13, 2, 17, 20, '2026-06-22 06:53:35', '2026-06-22 06:53:35'),
	(91, 13, 3, 17, 21, '2026-06-22 06:55:05', '2026-06-22 07:42:03');

CREATE TABLE IF NOT EXISTS `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria_id` bigint(20) unsigned NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `categoria_id`, `activo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Sweater Tania', 'Sweater cropped con diseño de rayas horizontales, cuello redondo, hombros caídos y mangas anchas de estilo relajado.', 49000.00, 1, 1, '2026-06-21 06:29:52', '2026-06-21 06:29:52', NULL),
	(2, 'Sweater Ignacia', 'Sweater de punto acanalado con cuello en V, hombros caídos y corte holgado ideal para el día a día.', 62000.00, 1, 1, '2026-06-21 06:36:10', '2026-06-21 06:36:10', NULL),
	(3, 'Blazer DeLuca', 'Blazer clásico con solapas elegantes, cierre de un solo botón y bolsillos con solapa. Ideal para looks casuales.', 90000.00, 2, 1, '2026-06-21 06:41:40', '2026-06-21 06:41:40', NULL),
	(4, 'Blazer Sastrero', 'Blazer clásico y estructurado de silueta entallada. Cuenta con solapas anchas, un solo botón frontal y bolsillos laterales.', 52000.00, 2, 1, '2026-06-21 06:44:56', '2026-06-21 06:44:56', NULL),
	(5, 'Pantalón Alis', 'Pantalones de tiro alto de corte recto con cinco bolsillos tradicionales y un favorecedor bajo desflecado.', 47000.00, 3, 1, '2026-06-21 06:49:08', '2026-06-21 06:49:08', NULL),
	(6, 'Pantalón jean Kentia', 'Pantalones vaqueros con un llamativo corte wide leg de pierna ultra ancha y tiro alto muy favorecedor.', 62000.00, 3, 1, '2026-06-21 06:52:56', '2026-06-21 06:52:56', NULL),
	(7, 'Camisa Manuela', 'Camisa con cuello clásico, abotonadura oculta, detalles plisados en el pecho y mangas abullonadas tres cuartos.', 43000.00, 4, 1, '2026-06-21 06:56:56', '2026-06-21 06:56:56', NULL),
	(8, 'Camisa Marga', 'Camisa oversize a rayas verticales, con cuello clásico, botones frontales y manga larga. Ideal para un look relajado.', 35000.00, 4, 1, '2026-06-21 07:01:05', '2026-06-21 07:01:05', NULL),
	(9, 'Sweater Macarena', 'Sweater de punto fino con textura acanalada horizontal, cuello redondo y mangas murciélago de silueta holgada y elegante.', 30000.00, 1, 1, '2026-06-21 07:05:31', '2026-06-21 07:05:31', NULL),
	(10, 'Blazer Brun', 'Blazer a rayas finas con solapas clásicas, bolsillos sutiles y mangas tres cuartos arremangadas de estilo moderno.', 47000.00, 2, 1, '2026-06-21 07:08:27', '2026-06-21 07:08:27', NULL),
	(11, 'Pantalón Africa', 'Pantalones con diseño de tiro alto, corte wide leg y bolsillos clásicos. Ideales para un look sofisticado.', 52000.00, 3, 1, '2026-06-21 07:11:15', '2026-06-21 07:11:15', NULL),
	(12, 'Camisa Tavard', 'Camisa a rayas finas de corte holgado, destacada por sus románticos apliques florales bordados y cuello clásico. Un toque sofisticado.', 47000.00, 4, 1, '2026-06-21 07:13:40', '2026-06-21 07:13:40', NULL),
	(13, 'Cinto folk', 'Cinto de efecto cuero con tachas metálicas en semicírculo y hebilla rectangular. Un toque urbano y moderno.', 42000.00, 5, 1, '2026-06-22 06:53:35', '2026-06-23 02:25:56', NULL);

CREATE TABLE IF NOT EXISTS `talles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `talles` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 'XXS', NULL, NULL),
	(2, 'XS', NULL, NULL),
	(3, 'S', NULL, NULL),
	(4, 'M', NULL, NULL),
	(5, 'L', NULL, NULL),
	(6, 'XL', NULL, NULL),
	(7, 'XXL', NULL, NULL),
	(8, 'XXXL', NULL, NULL),
	(9, '36', NULL, NULL),
	(10, '38', NULL, NULL),
	(11, '40', NULL, NULL),
	(12, '42', NULL, NULL),
	(13, '44', NULL, NULL),
	(14, '46', NULL, NULL),
	(15, '48', NULL, NULL),
	(16, '50', NULL, NULL),
	(17, '-', NULL, NULL);

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `rol` enum('admin','cliente') NOT NULL DEFAULT 'cliente',
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `usuarios` (`id`, `name`, `apellido`, `email`, `email_verified_at`, `password`, `telefono`, `direccion`, `rol`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador Principal', 'Intuitivas', 'admin@intuitivas.com', NULL, '$2y$12$1PzFUvQaw4e9KDV.glnXSOtkf5WJK5HAriUP5b2iVUPpOMrKMrEG.', '123456789', 'Oficina Central', 'admin', 'uEr1HGalVBNBRGKOPKDcuJ7rARgGUDZtvZHIknA8nZqDfRpVOrLR5G4f994h', NULL, '2026-06-21 06:09:04', '2026-06-21 06:09:04'),
	(2, 'Maria Belen', 'Garcia', 'mariabelengarcia.918@gmail.com', NULL, '$2y$12$LIgz8tAL1hQoUjtwd6fEsOtU26DJ65hdUmq5qHqmMQ7srkIsrTyjC', '3794000000', 'Calle Falsa 123', 'cliente', 'aHonJGz5cAllrR34ANgxwrJPbabTgH0hsbd7GD2RlLIvH40UdyiwdLgFpx65', NULL, '2026-06-21 06:09:05', '2026-06-21 06:09:05'),
	(3, 'Camila', 'Hernandez', 'camilahernandez@gmail.com', NULL, '$2y$12$9b9Nx1Ss5xqtu/Os7yq3A.85GTFI6pAYB8exN4SFF5rWXHEh4N6Xe', '3794000001', 'Calle Falsa 124', 'cliente', 'LSIeQ2TUk5UnosFrXU7gtl0ZZ1C8HZxxuH6XoqGmXtXFxievx7aT1ZHPJPjt', NULL, '2026-06-21 06:09:05', '2026-06-21 06:09:05'),
	(4, 'Juan Ignacio', 'Garcia', 'juanignaciogarcia_1961@hotmail.com', NULL, '$2y$12$ETzV6dMC2nd.O0xUFRUgKuIwcRamG65nwt9Hv5jde5UM9hU.hvHOe', NULL, NULL, 'cliente', NULL, NULL, '2026-06-22 05:17:19', '2026-06-22 05:17:19');

CREATE TABLE IF NOT EXISTS `venta_cabeceras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'confirmado',
  `total` decimal(10,2) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp(),
  `codigo_postal` varchar(255) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `barrio` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `metodo_pago` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_cabeceras_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `venta_cabeceras_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `venta_cabeceras` (`id`, `usuario_id`, `estado`, `total`, `fecha_venta`, `codigo_postal`, `calle`, `numero`, `barrio`, `ciudad`, `provincia`, `metodo_pago`, `created_at`, `updated_at`) VALUES
	(1, 2, 'confirmado', 52000.00, '2026-06-22 05:31:38', '3600', 'Joaquin de los Santos', 1550, 'Venezuela', 'Formosa Capital', 'Formosa', 'efectivo', '2026-06-22 05:31:38', '2026-06-22 05:31:38'),
	(2, 2, 'confirmado', 52000.00, '2026-06-22 05:41:19', '3600', 'Joaquin de los Santos', 1550, 'Venezuela', 'Formosa Capital', 'Formosa', 'debito', '2026-06-22 05:41:19', '2026-06-22 05:41:19'),
	(3, 3, 'confirmado', 42000.00, '2026-06-22 07:42:03', '3400', 'Remedios de Escalada', 5432, 'Zona Campus', 'Corrientes', 'Corrientes', 'efectivo', '2026-06-22 07:42:03', '2026-06-22 07:42:03'),
	(4, 2, 'confirmado', 146000.00, '2026-06-23 02:36:55', '3600', 'Joaquin de los Santos', 1550, 'Venezuela', 'Formosa Capital', 'Formosa', 'mercadopago', '2026-06-23 02:36:55', '2026-06-23 02:36:55'),
	(5, 3, 'confirmado', 147000.00, '2026-06-23 09:15:01', '3400', 'Remedios de Escalada', 5432, 'Zona Campus', 'Corrientes', 'Corrientes', 'naranjax', '2026-06-23 09:15:01', '2026-06-23 09:15:01');

CREATE TABLE IF NOT EXISTS `venta_detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `venta_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned DEFAULT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `talle` varchar(255) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_detalles_venta_id_foreign` (`venta_id`),
  KEY `venta_detalles_producto_id_foreign` (`producto_id`),
  CONSTRAINT `venta_detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `venta_detalles_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `venta_cabeceras` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `venta_detalles` (`id`, `venta_id`, `producto_id`, `nombre_producto`, `color`, `talle`, `cantidad`, `precio_unitario`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 1, 11, 'Pantalón Africa', 'marrón chocolate', 'S', 1, 52000.00, 52000.00, '2026-06-22 05:31:38', '2026-06-22 05:31:38'),
	(2, 2, 4, 'Blazer Sastrero', 'beige', 'M', 1, 52000.00, 52000.00, '2026-06-22 05:41:19', '2026-06-22 05:41:19'),
	(3, 3, 13, 'Cinto folk', 'marrón', '-', 1, 42000.00, 42000.00, '2026-06-22 07:42:03', '2026-06-22 07:42:03'),
	(4, 4, 5, 'Pantalón Alis', 'negro', '40', 2, 47000.00, 94000.00, '2026-06-23 02:36:55', '2026-06-23 02:36:55'),
	(5, 4, 4, 'Blazer Sastrero', 'blanco', 'S', 1, 52000.00, 52000.00, '2026-06-23 02:36:55', '2026-06-23 02:36:55'),
	(6, 5, 1, 'Sweater Tania', 'bordó', 'S', 3, 49000.00, 147000.00, '2026-06-23 09:15:01', '2026-06-23 09:15:01');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
