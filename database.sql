-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tati_app
CREATE DATABASE IF NOT EXISTS `tati_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tati_app`;

-- Dumping structure for table tati_app.log_harian
CREATE TABLE IF NOT EXISTS `log_harian` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `aktivitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Disetujui','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `catatan_verifikasi` text COLLATE utf8mb4_unicode_ci,
  `verified_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_harian_user_id_foreign` (`user_id`),
  KEY `log_harian_verified_by_foreign` (`verified_by`),
  CONSTRAINT `log_harian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `log_harian_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tati_app.log_harian: ~0 rows (approximately)
INSERT INTO `log_harian` (`id`, `user_id`, `tanggal`, `aktivitas`, `status`, `catatan_verifikasi`, `verified_by`, `created_at`, `updated_at`) VALUES
	(5, 13, '2025-02-10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Disetujui', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nu', 11, '2025-02-10 07:03:09', '2025-02-10 07:08:03'),
	(6, 13, '2025-02-09', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Ditolak', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt', 11, '2025-02-10 07:03:38', '2025-02-10 07:08:49'),
	(7, 13, '2025-02-08', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.', 'Pending', NULL, NULL, '2025-02-10 07:04:01', '2025-02-10 07:04:01'),
	(8, 14, '2025-02-10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Disetujui', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 12, '2025-02-10 07:05:23', '2025-02-10 07:13:34'),
	(9, 14, '2025-02-09', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.', 'Ditolak', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et', 12, '2025-02-10 07:05:31', '2025-02-10 07:13:48'),
	(11, 14, '2025-02-08', 'Lorem ipsum dolor sit amet, magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Pending', NULL, NULL, '2025-02-10 07:06:16', '2025-02-10 07:06:26'),
	(12, 11, '2025-02-08', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Disetujui', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', 10, '2025-02-10 07:07:02', '2025-02-10 07:17:25'),
	(13, 11, '2025-02-09', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,', 'Pending', NULL, NULL, '2025-02-10 07:07:14', '2025-02-10 07:07:14'),
	(14, 11, '2025-02-10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Pending', NULL, NULL, '2025-02-10 07:07:23', '2025-02-10 07:07:23'),
	(15, 12, '2025-02-08', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Pending', NULL, NULL, '2025-02-10 07:12:58', '2025-02-10 07:12:58'),
	(16, 12, '2025-02-09', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non pr', 'Pending', NULL, NULL, '2025-02-10 07:13:11', '2025-02-10 07:13:11'),
	(17, 12, '2025-02-10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Ditolak', 'exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis au', 10, '2025-02-10 07:13:18', '2025-02-10 07:17:38');

-- Dumping structure for table tati_app.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tati_app.migrations: ~5 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2025_02_07_134336_create_users_table', 1),
	(3, '2025_02_07_134337_create_roles_table', 1),
	(4, '2025_02_07_134338_create_user_roles_table', 1),
	(5, '2025_02_07_134339_create_log_harian_table', 1);

-- Dumping structure for table tati_app.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tati_app.personal_access_tokens: ~9 rows (approximately)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(2, 'App\\Models\\User', 3, 'auth_token', '5a3d1942320d13a82a9190c81146da52a8fe5079647d04ae92dd2898964fb335', '["*"]', NULL, NULL, '2025-02-08 23:36:50', '2025-02-08 23:36:50'),
	(3, 'App\\Models\\User', 4, 'auth_token', '610e5b88d7dde9e3bf61c9a92bd4b26f5e6530a1e2b59ce1ef5fec702f52c75f', '["*"]', NULL, NULL, '2025-02-08 23:57:51', '2025-02-08 23:57:51'),
	(8, 'App\\Models\\User', 5, 'auth_token', 'f9ee489a2af1c1abc26c35e8b6c40a676baa0c1773d8ff5b8ca36190330aa690', '["*"]', NULL, NULL, '2025-02-09 02:39:38', '2025-02-09 02:39:38'),
	(9, 'App\\Models\\User', 6, 'auth_token', 'ee688e369639a78ebceac7cf1ae36ce0af52e3408896cacf0b844c83406217a5', '["*"]', NULL, NULL, '2025-02-09 02:41:33', '2025-02-09 02:41:33'),
	(10, 'App\\Models\\User', 10, 'auth_token', '7353d48b07a5b721bfacda0b0a04ffa67b2d88ba39a2ba1256fbef6b503b3392', '["*"]', NULL, NULL, '2025-02-09 03:43:35', '2025-02-09 03:43:35'),
	(11, 'App\\Models\\User', 11, 'auth_token', 'c1e34f635ae5da2612adb58be4878e9cc675ff4973b90997ec32185b3aa03300', '["*"]', NULL, NULL, '2025-02-09 03:47:35', '2025-02-09 03:47:35'),
	(12, 'App\\Models\\User', 12, 'auth_token', '6b950f94efb6314c0186b8e69bd98c34ea06b24f7ccb4f5609a6a38383320e97', '["*"]', NULL, NULL, '2025-02-09 04:24:37', '2025-02-09 04:24:37'),
	(13, 'App\\Models\\User', 13, 'auth_token', '591cbae987e0a7b8c9ff17f4adc449c7466c0c065c96195aa00e3a8ddb0f0655', '["*"]', NULL, NULL, '2025-02-09 04:25:31', '2025-02-09 04:25:31'),
	(14, 'App\\Models\\User', 14, 'auth_token', 'aa85dc23e4e4dc7f698ddf5f0e3f221c156aa8a86dd5d31b350eb30969fc464e', '["*"]', NULL, NULL, '2025-02-09 04:25:58', '2025-02-09 04:25:58');

-- Dumping structure for table tati_app.provinsi
CREATE TABLE IF NOT EXISTS `provinsi` (
  `code` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tati_app.provinsi: ~37 rows (approximately)
INSERT INTO `provinsi` (`code`, `name`) VALUES
	(11, 'Aceh'),
	(12, 'Sumatera Utara'),
	(13, 'Sumatera Barat'),
	(14, 'Riau'),
	(15, 'Jambi'),
	(16, 'Sumatera Selatan'),
	(17, 'Bengkulu'),
	(18, 'Lampung'),
	(19, 'Kepulauan Bangka Belitung'),
	(21, 'Kepulauan Riau'),
	(31, 'DKI Jakarta'),
	(32, 'Jawa Barat'),
	(33, 'Jawa Tengah'),
	(34, 'Daerah Istimewa Yogyakarta'),
	(35, 'Jawa Timur'),
	(36, 'Banten'),
	(51, 'Bali'),
	(52, 'Nusa Tenggara Barat'),
	(53, 'Nusa Tenggara Timur'),
	(61, 'Kalimantan Barat'),
	(62, 'Kalimantan Tengah'),
	(63, 'Kalimantan Selatan'),
	(64, 'Kalimantan Timur'),
	(65, 'Kalimantan Utara'),
	(71, 'Sulawesi Utara'),
	(72, 'Sulawesi Tengah'),
	(73, 'Sulawesi Selatan'),
	(74, 'Sulawesi Tenggara'),
	(75, 'Gorontalo'),
	(76, 'Sulawesi Barat'),
	(81, 'Maluku'),
	(82, 'Maluku Utara'),
	(91, 'Papua'),
	(92, 'Papua Barat'),
	(93, 'Papua Selatan'),
	(94, 'Papua Tengah'),
	(95, 'Papua Pegunungan');

-- Dumping structure for table tati_app.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_role_name_unique` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tati_app.roles: ~4 rows (approximately)
INSERT INTO `roles` (`id`, `role_name`) VALUES
	(7, 'Developer'),
	(2, 'Kepala Bidang'),
	(1, 'Kepala Dinas'),
	(3, 'Staff');

-- Dumping structure for table tati_app.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atasan_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_atasan_id_foreign` (`atasan_id`),
  CONSTRAINT `users_atasan_id_foreign` FOREIGN KEY (`atasan_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tati_app.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `nama`, `email`, `password`, `atasan_id`, `created_at`, `updated_at`) VALUES
	(2, 'Developer', 'developer@gmail.com', '$2y$12$8caO5A8wOSN5DBXPlo0bbuqRneov/si4lC87Tg8mLTs517MPr92zm', NULL, '2025-02-08 23:26:36', '2025-02-09 04:15:03'),
	(10, 'Kepala Dinas 1', 'kepaladinas1@gmail.com', '$2y$12$PWSdzYCeGmQ/4vei7JWkQOJgtNRT5SVNQ11WO7MBECfAdXee1EU2G', NULL, '2025-02-09 03:43:35', '2025-02-09 04:17:10'),
	(11, 'Kepala Bidang 1', 'kepalabidang1@gmail.com', '$2y$12$S3rIL1/9eJmHBUNIF9cc/ODAx5.K6HWQlrNevu28cxUE6sML6WjxC', 10, '2025-02-09 03:47:35', '2025-02-09 04:23:53'),
	(12, 'Kepala Bidang 2', 'kepalabidang2@gmail.com', '$2y$12$hBcqRcmOeE0rpHg3ZANW8.5vk5fO18DZRmrK25FmxkM8U9ZXQq2ke', 10, '2025-02-09 04:24:37', '2025-02-09 04:24:37'),
	(13, 'Staff 1', 'staff1@gmail.com', '$2y$12$KiXJsko6VjuqzssiNzuQC.0KelVG7QUNZOWaFfXNcABkohIJAIZum', 11, '2025-02-09 04:25:31', '2025-02-09 04:25:31'),
	(14, 'Staff 2', 'staff2@gmail.com', '$2y$12$JnkkfzhPGGWsdtBMrHLDM.6BvZ6ZHfbSk.onavfkCAHtfvGfQFi1G', 12, '2025-02-09 04:25:58', '2025-02-09 04:25:58');

-- Dumping structure for table tati_app.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tati_app.user_roles: ~6 rows (approximately)
INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
	(10, 1),
	(11, 2),
	(12, 2),
	(13, 3),
	(14, 3),
	(2, 7);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
