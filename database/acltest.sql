-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2022 at 10:17 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acltest`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2021_11_18_203103_create_roles_table', 1),
(12, '2021_11_18_203701_create_permissions_table', 1),
(13, '2021_12_21_013538_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions3`
--

DROP TABLE IF EXISTS `model_has_permissions3`;
CREATE TABLE IF NOT EXISTS `model_has_permissions3` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles3`
--

DROP TABLE IF EXISTS `model_has_roles3`;
CREATE TABLE IF NOT EXISTS `model_has_roles3` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles3`
--

INSERT INTO `model_has_roles3` (`role_id`, `model_type`, `model_id`) VALUES
(8, 'App\\Models\\User3', 18),
(9, 'App\\Models\\User3', 18),
(1, 'App\\Models\\User3', 20),
(8, 'App\\Models\\User3', 20),
(9, 'App\\Models\\User3', 20),
(1, 'App\\Models\\User3', 28),
(2, 'App\\Models\\User3', 28),
(3, 'App\\Models\\User3', 28),
(8, 'App\\Models\\User3', 28),
(1, 'App\\Models\\User3', 29),
(8, 'App\\Models\\User3', 29);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'Danh sach user', NULL, NULL),
(2, 'user-add', 'them user', NULL, NULL),
(3, 'user-edit', 'Sua user', NULL, NULL),
(4, 'user-delete', 'Xoa User', NULL, NULL),
(5, 'role-list', 'Danh sach Role', NULL, NULL),
(6, 'role-add', 'Them role', NULL, NULL),
(7, 'role-edit', 'Sua Role', NULL, NULL),
(8, 'role-delete', 'Xoa Role', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions3`
--

DROP TABLE IF EXISTS `permissions3`;
CREATE TABLE IF NOT EXISTS `permissions3` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions3_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions3`
--

INSERT INTO `permissions3` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'edit articles', 'web', '2021-12-21 23:30:40', '2021-12-21 23:30:40'),
(2, 'delete articles', 'web', '2021-12-21 23:30:40', '2021-12-21 23:30:40'),
(3, 'publish articles', 'web', '2021-12-21 23:30:40', '2021-12-21 23:30:40'),
(4, 'unpublish articles', 'web', '2021-12-21 23:30:40', '2021-12-21 23:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Amin', NULL, '2021-11-24 22:41:45'),
(2, 'content', 'Content', NULL, '2021-11-28 01:40:52'),
(3, 'writer', 'Nguoi Viet Bai', NULL, '2021-11-27 02:22:30'),
(16, 'userManager', 'quan ly user', '2021-12-14 03:27:30', '2021-12-14 03:27:30'),
(17, 'RoleManager', 'quan ly role', '2021-12-14 03:27:50', '2021-12-14 03:27:50'),
(18, 'RoleView', 'chi duoc xem role', '2021-12-15 04:33:08', '2021-12-15 04:33:08'),
(19, 'UserViewer', 'chi xem user thui', '2021-12-15 05:36:17', '2022-01-04 03:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `roles3`
--

DROP TABLE IF EXISTS `roles3`;
CREATE TABLE IF NOT EXISTS `roles3` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles3_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles3`
--

INSERT INTO `roles3` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'writer', 'web', '2021-12-21 23:30:40', '2021-12-21 23:30:40'),
(2, 'admin', 'web', '2021-12-21 23:30:40', '2021-12-21 23:30:40'),
(3, 'super-admin', 'web', '2021-12-21 23:30:40', '2021-12-21 23:30:40'),
(8, 'RoleView', 'web', '2021-12-22 23:35:10', '2021-12-22 23:35:10'),
(9, 'roleEdit', 'web', '2021-12-22 23:41:05', '2021-12-22 23:41:05'),
(10, 'role public', 'web', '2022-01-03 22:44:43', '2022-01-03 22:44:43'),
(11, 'Role Article', 'web', '2022-01-03 22:59:59', '2022-01-03 22:59:59'),
(13, 'RoleFull', 'web', '2022-01-03 23:14:13', '2022-01-03 23:14:13'),
(14, 'full', 'web', '2022-01-03 23:16:44', '2022-01-03 23:16:44'),
(15, 'love', 'web', '2022-01-03 23:21:21', '2022-01-03 23:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions3`
--

DROP TABLE IF EXISTS `role_has_permissions3`;
CREATE TABLE IF NOT EXISTS `role_has_permissions3` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions3_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions3`
--

INSERT INTO `role_has_permissions3` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(1, 8),
(3, 8),
(4, 8),
(1, 9),
(2, 9),
(3, 10),
(4, 10),
(1, 11),
(2, 11),
(1, 13),
(2, 13),
(3, 13),
(4, 13),
(1, 14),
(2, 14),
(1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(19, 1, 1, NULL, NULL),
(20, 1, 2, NULL, NULL),
(21, 1, 3, NULL, NULL),
(22, 1, 4, NULL, NULL),
(23, 1, 5, NULL, NULL),
(24, 1, 6, NULL, NULL),
(25, 1, 7, NULL, NULL),
(26, 1, 8, NULL, NULL),
(28, 3, 5, NULL, NULL),
(29, 3, 6, NULL, NULL),
(30, 3, 7, NULL, NULL),
(31, 3, 8, NULL, NULL),
(38, 2, 5, NULL, NULL),
(39, 2, 6, NULL, NULL),
(40, 16, 1, NULL, NULL),
(41, 16, 2, NULL, NULL),
(42, 16, 3, NULL, NULL),
(43, 16, 4, NULL, NULL),
(44, 17, 5, NULL, NULL),
(45, 17, 6, NULL, NULL),
(46, 17, 7, NULL, NULL),
(47, 17, 8, NULL, NULL),
(48, 18, 5, NULL, NULL),
(114, 19, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, NULL, NULL),
(4, 1, 2, NULL, NULL),
(5, 1, 3, NULL, NULL),
(9, 11, 1, NULL, NULL),
(18, 12, 2, NULL, NULL),
(24, 18, 1, NULL, NULL),
(25, 19, 2, NULL, NULL),
(30, 30, 1, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$sUfpY8U3kBN.MMRuFGTwAOJIhamCakm77T3itImdNvTOIlUBvXvlq', 'qIqGhLiYAH7R2J98VFhWpEA96hxLQigHuVbeyPcGHpLIWcA4FaA12WiXirRI', '2021-11-18 14:04:13', '2021-11-20 18:43:17'),
(11, 'Trần Tiến Đức', 'ducadmin@gmail.com', NULL, '$2y$10$eOZ/8iD5JFrX7mrNz9rxxuoCuw2WDREhHdkkLAOiiAhMrj2bQltju', 'hFauWSP9WVh8klVxsnRaSw1577X8Qa5LMdTb5WVIPKz35hs6kbdsZ9FaX83e', '2021-11-20 16:18:26', '2021-11-20 16:18:26'),
(12, 'hang', 'hang@gmail.com', NULL, '$2y$10$fV5VoXlgNtLcIF3dd5PcRukw61QO14hFl9Mp3CXeL3Osz35bMW/Vm', 'uqsdHjcjeS1xHaQdvNq2YHUDLsVl4OItHDIUem7AnF7dvLSWoGAUZuFP3hP7', '2021-11-20 18:46:34', '2021-11-28 01:41:37'),
(18, 'Example User', 'test@example.com', NULL, '6512bd43d9caa6e02c990b0a82652dca', NULL, '2021-12-21 23:30:40', '2021-12-26 01:37:16'),
(19, 'Example Admin User', 'admin@example.com', NULL, '6512bd43d9caa6e02c990b0a82652dca', NULL, '2021-12-21 23:30:40', '2021-12-21 23:30:40'),
(20, 'Example Super-Admin User', 'superadmin@example.com', NULL, '6512bd43d9caa6e02c990b0a82652dca', NULL, '2021-12-21 23:30:40', '2021-12-26 03:43:05'),
(28, 'tuan', 'tuan@gmail.com', NULL, 'accc9105df5383111407fd5b41255e23', NULL, '2022-01-03 21:58:05', '2022-01-03 21:58:05'),
(29, 'giang', 'giang@gmail.com', NULL, '73c18c59a39b18382081ec00bb456d43', NULL, '2022-01-03 22:15:33', '2022-01-03 22:15:33'),
(30, 'duc', 'duc@gmail.com', NULL, '1aabac6d068eef6a7bad3fdf50a05cc8', NULL, '2022-01-03 23:56:18', '2022-01-03 23:56:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions3`
--
ALTER TABLE `model_has_permissions3`
  ADD CONSTRAINT `model_has_permissions3_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions3` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles3`
--
ALTER TABLE `model_has_roles3`
  ADD CONSTRAINT `model_has_roles3_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles3` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions3`
--
ALTER TABLE `role_has_permissions3`
  ADD CONSTRAINT `role_has_permissions3_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions3` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions3_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles3` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
