-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 10:27 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egkom3`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `os` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_time` time NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `browser`, `os`, `ip_address`, `activity_time`, `activity`, `created_at`, `updated_at`) VALUES
(1, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:00:10', 'Logged In', '2024-11-27 23:00:10', '2024-11-27 23:00:10'),
(2, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:19:19', 'Logged In', '2024-11-27 23:19:19', '2024-11-27 23:19:19'),
(3, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:19:24', 'Logged Out', '2024-11-27 23:19:24', '2024-11-27 23:19:24'),
(4, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:21:20', 'Logged In', '2024-11-27 23:21:20', '2024-11-27 23:21:20'),
(5, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:21:25', 'Logged Out', '2024-11-27 23:21:25', '2024-11-27 23:21:25'),
(6, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:21:52', 'Logged In', '2024-11-27 23:21:52', '2024-11-27 23:21:52'),
(7, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:21:56', 'Logged Out', '2024-11-27 23:21:56', '2024-11-27 23:21:56'),
(8, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:40:36', 'Logged In', '2024-11-28 00:40:36', '2024-11-28 00:40:36'),
(9, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:24:02', 'Logged In', '2024-12-05 02:24:02', '2024-12-05 02:24:02'),
(10, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:48:53', 'Logged In', '2025-01-17 21:48:53', '2025-01-17 21:48:53'),
(11, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:50:15', 'Logged Out', '2025-01-17 21:50:15', '2025-01-17 21:50:15'),
(12, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:13:54', 'Logged In', '2025-01-17 22:13:54', '2025-01-17 22:13:54'),
(13, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:38:46', 'Logged In', '2025-01-17 22:38:46', '2025-01-17 22:38:46'),
(14, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:37:26', 'Logged In', '2025-01-18 21:37:26', '2025-01-18 21:37:26'),
(15, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:39:09', 'Logged In', '2025-01-18 21:39:09', '2025-01-18 21:39:09'),
(16, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:39:13', 'Logged In', '2025-01-18 21:39:13', '2025-01-18 21:39:13'),
(17, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:39:55', 'Logged In', '2025-01-18 21:39:55', '2025-01-18 21:39:55'),
(18, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:37:30', 'Logged In', '2025-01-19 03:37:30', '2025-01-19 03:37:30'),
(19, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:41:30', 'Logged In', '2025-03-03 23:41:30', '2025-03-03 23:41:30'),
(20, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:41:42', 'Logged In', '2025-03-03 23:41:42', '2025-03-03 23:41:42'),
(21, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:52:21', 'Logged In', '2025-03-14 22:52:21', '2025-03-14 22:52:21'),
(22, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:53:01', 'Logged In', '2025-03-14 22:53:01', '2025-03-14 22:53:01'),
(23, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:53:38', 'Logged In', '2025-03-14 22:53:38', '2025-03-14 22:53:38'),
(24, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:54:08', 'Logged In', '2025-03-14 22:54:08', '2025-03-14 22:54:08'),
(25, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:54:28', 'Logged In', '2025-03-14 22:54:28', '2025-03-14 22:54:28'),
(26, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:55:20', 'Logged In', '2025-03-14 22:55:20', '2025-03-14 22:55:20'),
(27, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:55:45', 'Logged In', '2025-03-14 22:55:45', '2025-03-14 22:55:45'),
(28, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:56:02', 'Logged In', '2025-03-14 22:56:02', '2025-03-14 22:56:02'),
(29, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:58:59', 'Logged In', '2025-03-14 22:58:59', '2025-03-14 22:58:59'),
(30, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:01:07', 'Logged In', '2025-03-14 23:01:07', '2025-03-14 23:01:07'),
(31, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:02:51', 'Logged In', '2025-03-14 23:02:51', '2025-03-14 23:02:51'),
(32, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:10:29', 'Logged In', '2025-03-14 23:10:29', '2025-03-14 23:10:29'),
(33, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:10:59', 'Logged In', '2025-03-14 23:10:59', '2025-03-14 23:10:59'),
(34, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:12:06', 'Logged In', '2025-03-14 23:12:06', '2025-03-14 23:12:06'),
(35, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:14:06', 'Logged In', '2025-03-14 23:14:06', '2025-03-14 23:14:06'),
(36, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:21:38', 'Logged In', '2025-03-15 00:21:38', '2025-03-15 00:21:38'),
(37, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:22:03', 'Logged In', '2025-03-15 00:22:03', '2025-03-15 00:22:03'),
(38, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:35:01', 'Logged In', '2025-03-15 00:35:01', '2025-03-15 00:35:01'),
(39, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:35:54', 'Logged In', '2025-03-15 00:35:54', '2025-03-15 00:35:54'),
(40, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:41:01', 'Logged In', '2025-03-15 00:41:01', '2025-03-15 00:41:01'),
(41, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:49:13', 'Logged Out', '2025-03-15 00:49:13', '2025-03-15 00:49:13'),
(42, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:49:24', 'Logged In', '2025-03-15 00:49:24', '2025-03-15 00:49:24'),
(43, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:49:29', 'Logged Out', '2025-03-15 00:49:29', '2025-03-15 00:49:29'),
(44, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:40:47', 'Logged In', '2025-03-15 01:40:47', '2025-03-15 01:40:47'),
(45, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:40:52', 'Logged Out', '2025-03-15 01:40:52', '2025-03-15 01:40:52'),
(46, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:58:03', 'Logged In', '2025-03-15 01:58:03', '2025-03-15 01:58:03'),
(47, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:00:05', 'Logged In', '2025-03-15 02:00:05', '2025-03-15 02:00:05'),
(48, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:05:01', 'Logged In', '2025-03-15 02:05:01', '2025-03-15 02:05:01'),
(49, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:23:34', 'Logged In', '2025-03-15 22:23:34', '2025-03-15 22:23:34'),
(50, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:08:48', 'Logged Out', '2025-03-16 01:08:48', '2025-03-16 01:08:48'),
(51, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:27:44', 'Logged In', '2025-03-16 01:27:44', '2025-03-16 01:27:44'),
(52, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:28:18', 'Logged In', '2025-03-16 01:28:18', '2025-03-16 01:28:18'),
(53, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:32:18', 'Logged In', '2025-03-16 01:32:18', '2025-03-16 01:32:18'),
(54, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:32:23', 'Logged Out', '2025-03-16 01:32:23', '2025-03-16 01:32:23'),
(55, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:33:34', 'Logged In', '2025-03-16 01:33:34', '2025-03-16 01:33:34'),
(56, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:33:42', 'Logged Out', '2025-03-16 01:33:42', '2025-03-16 01:33:42'),
(57, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:34:33', 'Logged In', '2025-03-16 01:34:33', '2025-03-16 01:34:33'),
(58, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:42:45', 'Logged Out', '2025-03-16 01:42:45', '2025-03-16 01:42:45'),
(59, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:42:59', 'Logged In', '2025-03-16 01:42:59', '2025-03-16 01:42:59'),
(60, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:54:15', 'Logged In', '2025-03-16 02:54:15', '2025-03-16 02:54:15'),
(61, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:54:33', 'Logged In', '2025-03-16 02:54:33', '2025-03-16 02:54:33'),
(62, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:41:18', 'Logged In', '2025-03-16 21:41:18', '2025-03-16 21:41:18'),
(63, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:41:56', 'Logged In', '2025-03-16 21:41:56', '2025-03-16 21:41:56'),
(64, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:50:47', 'Logged In', '2025-03-16 21:50:47', '2025-03-16 21:50:47'),
(65, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:53:20', 'Logged In', '2025-03-16 21:53:20', '2025-03-16 21:53:20'),
(66, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:57:38', 'Logged In', '2025-03-16 21:57:38', '2025-03-16 21:57:38'),
(67, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:09:58', 'Logged In', '2025-03-16 22:09:58', '2025-03-16 22:09:58'),
(68, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:24:20', 'Logged Out', '2025-03-16 22:24:20', '2025-03-16 22:24:20'),
(69, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:24:38', 'Logged In', '2025-03-16 22:24:38', '2025-03-16 22:24:38'),
(70, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:33:47', 'Logged In', '2025-03-17 00:33:47', '2025-03-17 00:33:47'),
(71, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:44:38', 'Logged In', '2025-03-17 03:44:38', '2025-03-17 03:44:38'),
(72, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:17:11', 'Logged In', '2025-03-17 21:17:11', '2025-03-17 21:17:11'),
(73, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:59:13', 'Logged In', '2025-03-18 01:59:13', '2025-03-18 01:59:13'),
(74, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:59:40', 'Logged Out', '2025-03-18 01:59:40', '2025-03-18 01:59:40'),
(75, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:59:47', 'Logged In', '2025-03-18 01:59:47', '2025-03-18 01:59:47'),
(76, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:19:09', 'Logged In', '2025-03-18 23:19:09', '2025-03-18 23:19:09'),
(77, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:16:17', 'Logged In', '2025-03-19 23:16:17', '2025-03-19 23:16:17'),
(78, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:20:48', 'Logged In', '2025-03-21 21:20:48', '2025-03-21 21:20:48'),
(79, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:14:41', 'Logged In', '2025-03-22 22:14:41', '2025-03-22 22:14:41'),
(80, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:05:30', 'Logged Out', '2025-03-23 00:05:30', '2025-03-23 00:05:30'),
(81, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:05:35', 'Logged In', '2025-03-23 00:05:35', '2025-03-23 00:05:35'),
(82, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:10:33', 'Logged Out', '2025-03-23 00:10:33', '2025-03-23 00:10:33'),
(83, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:10:53', 'Logged In', '2025-03-23 00:10:53', '2025-03-23 00:10:53'),
(84, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:22:21', 'Logged In', '2025-03-23 21:22:21', '2025-03-23 21:22:21'),
(85, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:14:36', 'Logged In', '2025-03-24 21:14:36', '2025-03-24 21:14:36'),
(86, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:32:11', 'Logged In', '2025-03-26 21:32:11', '2025-03-26 21:32:11'),
(87, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:30:36', 'Logged In', '2025-04-05 22:30:36', '2025-04-05 22:30:36'),
(88, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:48:50', 'Logged In', '2025-04-06 21:48:50', '2025-04-06 21:48:50'),
(89, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:15:22', 'Logged In', '2025-04-07 21:15:22', '2025-04-07 21:15:22'),
(90, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:48:05', 'Logged In', '2025-04-09 21:48:05', '2025-04-09 21:48:05'),
(91, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:28:35', 'Logged In', '2025-04-10 00:28:35', '2025-04-10 00:28:35'),
(92, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:40:12', 'Logged In', '2025-04-11 22:40:12', '2025-04-11 22:40:12'),
(93, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:53:01', 'Logged In', '2025-04-12 04:53:01', '2025-04-12 04:53:01'),
(94, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:17:18', 'Logged In', '2025-04-12 21:17:18', '2025-04-12 21:17:18'),
(95, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:57:00', 'Logged In', '2025-04-13 02:57:00', '2025-04-13 02:57:00'),
(96, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:23:13', 'Logged In', '2025-04-14 21:23:13', '2025-04-14 21:23:13'),
(97, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:29:12', 'Logged Out', '2025-04-14 23:29:12', '2025-04-14 23:29:12'),
(98, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:29:54', 'Logged In', '2025-04-14 23:29:54', '2025-04-14 23:29:54'),
(99, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:43:30', 'Logged In', '2025-04-15 02:43:30', '2025-04-15 02:43:30'),
(100, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:44:58', 'Logged In', '2025-04-15 02:44:58', '2025-04-15 02:44:58'),
(101, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:45:43', 'Logged In', '2025-04-15 02:45:43', '2025-04-15 02:45:43'),
(102, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:43:11', 'Logged In', '2025-04-15 21:43:11', '2025-04-15 21:43:11'),
(103, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:10:11', 'Logged In', '2025-04-15 22:10:11', '2025-04-15 22:10:11'),
(104, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:45:54', 'Logged In', '2025-04-15 22:45:54', '2025-04-15 22:45:54'),
(105, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:49:31', 'Logged In', '2025-04-17 01:49:31', '2025-04-17 01:49:31'),
(106, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:29:06', 'Logged In', '2025-04-18 22:29:06', '2025-04-18 22:29:06'),
(107, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:40:03', 'Logged In', '2025-04-19 02:40:03', '2025-04-19 02:40:03'),
(108, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:43:38', 'Logged In', '2025-04-19 22:43:38', '2025-04-19 22:43:38'),
(109, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:08:38', 'Logged In', '2025-04-21 00:08:38', '2025-04-21 00:08:38'),
(110, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:58:49', 'Logged In', '2025-04-21 22:58:49', '2025-04-21 22:58:49'),
(111, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:14:55', 'Logged In', '2025-04-22 03:14:55', '2025-04-22 03:14:55'),
(112, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:36:42', 'Logged In', '2025-04-22 21:36:42', '2025-04-22 21:36:42'),
(113, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:20:43', 'Logged In', '2025-04-23 21:20:43', '2025-04-23 21:20:43'),
(114, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:51:11', 'Logged In', '2025-04-25 21:51:11', '2025-04-25 21:51:11'),
(115, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:02:57', 'Logged In', '2025-04-25 23:02:57', '2025-04-25 23:02:57'),
(116, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:09:55', 'Logged In', '2025-04-25 23:09:55', '2025-04-25 23:09:55'),
(117, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:54:31', 'Logged In', '2025-04-26 00:54:31', '2025-04-26 00:54:31'),
(118, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:57:10', 'Logged In', '2025-04-26 00:57:10', '2025-04-26 00:57:10'),
(119, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:29:13', 'Logged In', '2025-04-26 01:29:13', '2025-04-26 01:29:13'),
(120, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:31:09', 'Logged In', '2025-04-26 01:31:09', '2025-04-26 01:31:09'),
(121, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:25:59', 'Logged In', '2025-04-26 21:25:59', '2025-04-26 21:25:59'),
(122, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:03:48', 'Logged In', '2025-04-26 22:03:48', '2025-04-26 22:03:48'),
(123, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:15:25', 'Logged In', '2025-04-27 22:15:25', '2025-04-27 22:15:25'),
(124, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:07:37', 'Logged In', '2025-04-28 04:07:37', '2025-04-28 04:07:37'),
(125, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:21:01', 'Logged In', '2025-04-28 22:21:01', '2025-04-28 22:21:01'),
(126, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:11:39', 'Logged Out', '2025-04-28 23:11:39', '2025-04-28 23:11:39'),
(127, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:37:32', 'Logged In', '2025-04-28 23:37:32', '2025-04-28 23:37:32'),
(128, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:29:01', 'Logged In', '2025-04-29 21:29:01', '2025-04-29 21:29:01'),
(129, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:01:56', 'Logged In', '2025-05-02 22:01:56', '2025-05-02 22:01:56'),
(130, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:23:21', 'Logged In', '2025-05-03 02:23:21', '2025-05-03 02:23:21'),
(131, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:38:12', 'Logged In', '2025-05-03 21:38:12', '2025-05-03 21:38:12'),
(132, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:17:12', 'Logged In', '2025-05-04 21:17:12', '2025-05-04 21:17:12'),
(133, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:52:47', 'Logged In', '2025-05-04 23:52:47', '2025-05-04 23:52:47'),
(134, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:50:29', 'Logged Out', '2025-05-05 00:50:29', '2025-05-05 00:50:29'),
(135, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:50:45', 'Logged In', '2025-05-05 00:50:45', '2025-05-05 00:50:45'),
(136, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:26:03', 'Logged In', '2025-05-05 03:26:03', '2025-05-05 03:26:03'),
(137, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:46:58', 'Logged In', '2025-05-06 21:46:58', '2025-05-06 21:46:58'),
(138, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:47:15', 'Logged In', '2025-05-06 21:47:15', '2025-05-06 21:47:15'),
(139, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:47:33', 'Logged In', '2025-05-06 21:47:33', '2025-05-06 21:47:33'),
(140, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:32:35', 'Logged In', '2025-05-14 03:32:35', '2025-05-14 03:32:35'),
(141, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:50:59', 'Logged In', '2025-05-14 21:50:59', '2025-05-14 21:50:59'),
(142, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:28:26', 'Logged In', '2025-05-25 04:28:26', '2025-05-25 04:28:26'),
(143, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:16:28', 'Logged In', '2025-05-25 22:16:28', '2025-05-25 22:16:28'),
(144, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:24:22', 'Logged In', '2025-05-25 22:24:22', '2025-05-25 22:24:22'),
(145, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:55:59', 'Logged In', '2025-05-25 22:55:59', '2025-05-25 22:55:59'),
(146, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:59:22', 'Logged In', '2025-05-25 22:59:22', '2025-05-25 22:59:22'),
(147, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:04:29', 'Logged In', '2025-05-25 23:04:29', '2025-05-25 23:04:29'),
(148, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:24:21', 'Logged Out', '2025-05-26 02:24:21', '2025-05-26 02:24:21'),
(149, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:29:39', 'Logged In', '2025-05-26 02:29:39', '2025-05-26 02:29:39'),
(150, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:30:49', 'Logged Out', '2025-05-26 03:30:49', '2025-05-26 03:30:49'),
(151, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:31:10', 'Logged In', '2025-05-26 03:31:10', '2025-05-26 03:31:10'),
(152, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:45:23', 'Logged In', '2025-05-26 21:45:23', '2025-05-26 21:45:23'),
(153, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:43:12', 'Logged In', '2025-05-27 21:43:12', '2025-05-27 21:43:12'),
(154, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:50:46', 'Logged In', '2025-05-28 22:50:46', '2025-05-28 22:50:46'),
(155, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:29:18', 'Logged In', '2025-05-30 21:29:18', '2025-05-30 21:29:18'),
(156, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:30:56', 'Logged In', '2025-05-31 21:30:56', '2025-05-31 21:30:56'),
(157, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:11:33', 'Logged In', '2025-06-01 22:11:33', '2025-06-01 22:11:33'),
(158, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:34:48', 'Logged In', '2025-06-02 02:34:48', '2025-06-02 02:34:48'),
(159, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:12:35', 'Logged In', '2025-06-02 22:12:35', '2025-06-02 22:12:35'),
(160, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:16:21', 'Logged In', '2025-06-02 22:16:21', '2025-06-02 22:16:21'),
(161, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:30:42', 'Logged In', '2025-06-14 04:30:42', '2025-06-14 04:30:42'),
(162, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:46:35', 'Logged In', '2025-07-07 02:46:35', '2025-07-07 02:46:35'),
(163, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:57:29', 'Logged Out', '2025-07-07 02:57:29', '2025-07-07 02:57:29'),
(164, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:57:52', 'Logged In', '2025-07-07 02:57:52', '2025-07-07 02:57:52'),
(165, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:07:33', 'Logged In', '2025-07-07 03:07:33', '2025-07-07 03:07:33'),
(166, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:38:52', 'Logged In', '2025-07-07 22:38:52', '2025-07-07 22:38:52'),
(167, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:39:05', 'Logged In', '2025-07-07 22:39:05', '2025-07-07 22:39:05'),
(168, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:02:59', 'Logged In', '2025-07-08 01:02:59', '2025-07-08 01:02:59'),
(169, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:05:33', 'Logged In', '2025-07-08 02:05:33', '2025-07-08 02:05:33'),
(170, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:20:39', 'Logged In', '2025-07-08 23:20:39', '2025-07-08 23:20:39'),
(171, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:29:15', 'Logged In', '2025-07-09 21:29:15', '2025-07-09 21:29:15'),
(172, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:10:24', 'Logged In', '2025-07-10 01:10:24', '2025-07-10 01:10:24'),
(173, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:51:26', 'Logged In', '2025-07-11 21:51:26', '2025-07-11 21:51:26'),
(174, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:30:57', 'Logged In', '2025-07-11 22:30:57', '2025-07-11 22:30:57'),
(175, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:47:29', 'Logged In', '2025-07-12 03:47:29', '2025-07-12 03:47:29'),
(176, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:51:30', 'Logged In', '2025-07-12 21:51:30', '2025-07-12 21:51:30'),
(177, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:51:36', 'Logged In', '2025-07-12 21:51:36', '2025-07-12 21:51:36'),
(178, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:30:40', 'Logged In', '2025-07-14 23:30:40', '2025-07-14 23:30:40'),
(179, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:31:12', 'Logged In', '2025-07-14 23:31:12', '2025-07-14 23:31:12'),
(180, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:23:49', 'Logged In', '2025-07-15 02:23:49', '2025-07-15 02:23:49'),
(181, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:50:46', 'Logged In', '2025-07-16 00:50:46', '2025-07-16 00:50:46'),
(182, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:51:25', 'Logged In', '2025-07-16 00:51:25', '2025-07-16 00:51:25'),
(183, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:10:20', 'Logged Out', '2025-07-16 01:10:20', '2025-07-16 01:10:20'),
(184, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:10:29', 'Logged In', '2025-07-16 01:10:29', '2025-07-16 01:10:29'),
(185, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:18:07', 'Logged Out', '2025-07-16 01:18:07', '2025-07-16 01:18:07'),
(186, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:18:38', 'Logged In', '2025-07-16 01:18:38', '2025-07-16 01:18:38'),
(187, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:03:16', 'Logged In', '2025-07-16 04:03:16', '2025-07-16 04:03:16'),
(188, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:09:00', 'Logged In', '2025-07-16 22:09:00', '2025-07-16 22:09:00'),
(189, 'Chrome on Windows', 'Windows', '103.145.70.100', '09:16:30', 'Logged In', '2025-07-20 03:16:30', '2025-07-20 03:16:30'),
(190, 'Chrome on Windows', 'Windows', '101.2.166.22', '09:54:14', 'Logged In', '2025-07-22 03:54:14', '2025-07-22 03:54:14'),
(191, 'Chrome on Windows', 'Windows', '101.2.166.22', '05:31:13', 'Logged In', '2025-07-22 23:31:13', '2025-07-22 23:31:13'),
(192, 'Chrome on Windows', 'Windows', '101.2.166.22', '05:31:13', 'Logged In', '2025-07-22 23:31:13', '2025-07-22 23:31:13'),
(193, 'Chrome on Windows', 'Windows', '103.145.70.100', '05:38:28', 'Logged In', '2025-07-22 23:38:28', '2025-07-22 23:38:28'),
(194, 'Chrome on Windows', 'Windows', '103.145.70.100', '05:41:11', 'Logged In', '2025-07-22 23:41:11', '2025-07-22 23:41:11'),
(195, 'Chrome on Windows', 'Windows', '101.2.166.22', '05:43:40', 'Logged In', '2025-07-22 23:43:40', '2025-07-22 23:43:40'),
(196, 'Chrome on Windows', 'Windows', '101.2.166.22', '05:44:00', 'Logged In', '2025-07-22 23:44:00', '2025-07-22 23:44:00'),
(197, 'Chrome on Windows', 'Windows', '103.145.70.100', '05:48:24', 'Logged In', '2025-07-22 23:48:24', '2025-07-22 23:48:24'),
(198, 'Firefox on Windows', 'Windows', '103.145.70.100', '05:50:15', 'Logged In', '2025-07-22 23:50:15', '2025-07-22 23:50:15'),
(199, 'Firefox on Windows', 'Windows', '103.145.70.100', '06:18:17', 'Logged In', '2025-07-23 00:18:17', '2025-07-23 00:18:17'),
(200, 'Chrome on Windows', 'Windows', '101.2.166.22', '11:50:58', 'Logged In', '2025-07-23 05:50:58', '2025-07-23 05:50:58'),
(201, 'Chrome on Windows', 'Windows', '101.2.166.22', '12:08:27', 'Logged In', '2025-07-23 06:08:27', '2025-07-23 06:08:27'),
(202, 'Chrome on Windows', 'Windows', '101.2.166.22', '06:47:56', 'Logged In', '2025-07-24 00:47:56', '2025-07-24 00:47:56'),
(203, 'Chrome on Windows', 'Windows', '101.2.166.22', '10:33:21', 'Logged In', '2025-07-26 04:33:21', '2025-07-26 04:33:21'),
(204, 'Chrome on Windows', 'Windows', '101.2.166.22', '10:43:32', 'Logged In', '2025-07-26 04:43:32', '2025-07-26 04:43:32'),
(205, 'Chrome on Windows', 'Windows', '101.2.166.22', '11:20:48', 'Logged In', '2025-07-26 05:20:48', '2025-07-26 05:20:48'),
(206, 'Chrome on Windows', 'Windows', '101.2.166.22', '11:21:52', 'Logged In', '2025-07-26 05:21:52', '2025-07-26 05:21:52'),
(207, 'Chrome on Windows', 'Windows', '101.2.166.22', '04:58:39', 'Logged In', '2025-07-26 22:58:39', '2025-07-26 22:58:39'),
(208, 'Chrome on Windows', 'Windows', '101.2.166.22', '05:54:23', 'Logged In', '2025-07-26 23:54:23', '2025-07-26 23:54:23'),
(209, 'Chrome on Windows', 'Windows', '101.2.166.22', '05:56:18', 'Logged Out', '2025-07-26 23:56:18', '2025-07-26 23:56:18'),
(210, 'Chrome on Windows', 'Windows', '101.2.166.22', '05:56:26', 'Logged In', '2025-07-26 23:56:26', '2025-07-26 23:56:26'),
(211, 'Chrome on Windows', 'Windows', '101.2.166.22', '07:01:22', 'Logged In', '2025-07-27 01:01:22', '2025-07-27 01:01:22'),
(212, 'Chrome on Windows', 'Windows', '101.2.166.22', '07:34:50', 'Logged In', '2025-07-27 01:34:50', '2025-07-27 01:34:50'),
(213, 'Chrome on Windows', 'Windows', '101.2.166.22', '08:11:19', 'Logged In', '2025-07-27 02:11:19', '2025-07-27 02:11:19'),
(214, 'Chrome on Windows', 'Windows', '101.2.166.22', '08:11:47', 'Logged In', '2025-07-27 02:11:47', '2025-07-27 02:11:47'),
(215, 'Chrome on Windows', 'Windows', '101.2.166.22', '10:42:38', 'Logged In', '2025-07-27 04:42:38', '2025-07-27 04:42:38'),
(216, 'Chrome on Windows', 'Windows', '101.2.166.22', '11:11:27', 'Logged In', '2025-07-27 05:11:27', '2025-07-27 05:11:27'),
(217, 'Chrome on Windows', 'Windows', '101.2.166.22', '11:11:28', 'Logged In', '2025-07-27 05:11:28', '2025-07-27 05:11:28'),
(218, 'Chrome on Windows', 'Windows', '101.2.166.22', '10:39:19', 'Logged In', '2025-07-29 04:39:19', '2025-07-29 04:39:19'),
(219, 'Chrome on Windows', 'Windows', '101.2.166.22', '07:14:24', 'Logged In', '2025-08-11 01:14:24', '2025-08-11 01:14:24'),
(220, 'Chrome on Windows', 'Windows', '101.2.166.22', '10:51:10', 'Logged In', '2025-08-16 04:51:10', '2025-08-16 04:51:10'),
(221, 'Chrome on Windows', 'Windows', '101.2.166.22', '10:34:08', 'Logged In', '2025-08-17 04:34:08', '2025-08-17 04:34:08'),
(222, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:57:10', 'Logged In', '2025-08-19 21:57:10', '2025-08-19 21:57:10'),
(223, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:00:41', 'Logged In', '2025-08-19 22:00:41', '2025-08-19 22:00:41'),
(224, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:53:07', 'Logged In', '2025-08-20 00:53:07', '2025-08-20 00:53:07'),
(225, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:37:18', 'Logged In', '2025-08-20 02:37:18', '2025-08-20 02:37:18'),
(226, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:27:49', 'Logged In', '2025-08-20 23:27:49', '2025-08-20 23:27:49'),
(227, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:28:42', 'Logged In', '2025-08-20 23:28:42', '2025-08-20 23:28:42'),
(228, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:35:26', 'Logged In', '2025-08-22 21:35:26', '2025-08-22 21:35:26'),
(229, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:07:08', 'Logged In', '2025-08-23 01:07:08', '2025-08-23 01:07:08'),
(230, 'Chrome on Windows', 'Windows', '127.0.0.1', '07:51:14', 'Logged In', '2025-08-23 01:51:14', '2025-08-23 01:51:14'),
(231, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:09:27', 'Logged In', '2025-08-23 21:09:27', '2025-08-23 21:09:27'),
(232, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:09:36', 'Logged In', '2025-08-23 21:09:36', '2025-08-23 21:09:36'),
(233, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:10:58', 'Logged In', '2025-08-24 02:10:58', '2025-08-24 02:10:58'),
(234, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:11:21', 'Logged In', '2025-08-24 02:11:21', '2025-08-24 02:11:21'),
(235, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:12:41', 'Logged In', '2025-08-24 04:12:41', '2025-08-24 04:12:41'),
(236, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:47:45', 'Logged In', '2025-08-25 00:47:45', '2025-08-25 00:47:45'),
(237, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:25:40', 'Logged In', '2025-08-25 21:25:40', '2025-08-25 21:25:40'),
(238, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:12:56', 'Logged In', '2025-08-25 22:12:56', '2025-08-25 22:12:56'),
(239, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:30:48', 'Logged In', '2025-08-26 02:30:48', '2025-08-26 02:30:48'),
(240, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:48:26', 'Logged In', '2025-08-26 02:48:26', '2025-08-26 02:48:26'),
(241, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:04:05', 'Logged In', '2025-08-26 23:04:05', '2025-08-26 23:04:05'),
(242, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:18:44', 'Logged In', '2025-08-27 02:18:44', '2025-08-27 02:18:44'),
(243, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:06:19', 'Logged In', '2025-08-27 03:06:19', '2025-08-27 03:06:19'),
(244, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:58:50', 'Logged In', '2025-08-27 23:58:50', '2025-08-27 23:58:50'),
(245, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:05:23', 'Logged In', '2025-08-31 00:05:23', '2025-08-31 00:05:23'),
(246, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:51:31', 'Logged In', '2025-08-31 21:51:31', '2025-08-31 21:51:31'),
(247, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:29:47', 'Logged In', '2025-09-02 00:29:47', '2025-09-02 00:29:47'),
(248, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:40:03', 'Logged In', '2025-09-02 00:40:03', '2025-09-02 00:40:03'),
(249, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:43:23', 'Logged In', '2025-09-02 02:43:23', '2025-09-02 02:43:23'),
(250, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:43:34', 'Logged In', '2025-09-02 21:43:34', '2025-09-02 21:43:34'),
(251, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:54:05', 'Logged In', '2025-09-02 21:54:05', '2025-09-02 21:54:05'),
(252, 'Chrome on Windows', 'Windows', '127.0.0.1', '09:37:41', 'Logged In', '2025-09-03 03:37:41', '2025-09-03 03:37:41'),
(253, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:22:14', 'Logged In', '2025-09-03 21:22:14', '2025-09-03 21:22:14'),
(254, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:22:37', 'Logged In', '2025-09-03 21:22:37', '2025-09-03 21:22:37'),
(255, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:58:16', 'Logged In', '2025-09-04 00:58:16', '2025-09-04 00:58:16'),
(256, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:44:38', 'Logged In', '2025-09-07 00:44:38', '2025-09-07 00:44:38'),
(257, 'Chrome on Windows', 'Windows', '127.0.0.1', '06:56:29', 'Logged In', '2025-09-07 00:56:29', '2025-09-07 00:56:29'),
(258, 'Chrome on Windows', 'Windows', '127.0.0.1', '11:23:06', 'Logged In', '2025-09-07 05:23:06', '2025-09-07 05:23:06'),
(259, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:40:24', 'Logged In', '2025-09-07 22:40:24', '2025-09-07 22:40:24'),
(260, 'Chrome on Windows', 'Windows', '127.0.0.1', '04:46:25', 'Logged In', '2025-09-07 22:46:25', '2025-09-07 22:46:25'),
(261, 'Chrome on Windows', 'Windows', '127.0.0.1', '08:02:17', 'Logged In', '2025-10-08 02:02:17', '2025-10-08 02:02:17'),
(262, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:06:36', 'Logged In', '2025-11-17 04:06:36', '2025-11-17 04:06:36'),
(263, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:12:12', 'Logged In', '2025-11-17 04:12:12', '2025-11-17 04:12:12'),
(264, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:11:28', 'Logged In', '2025-11-17 21:11:28', '2025-11-17 21:11:28'),
(265, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:11:58', 'Logged In', '2025-11-17 21:11:58', '2025-11-17 21:11:58'),
(266, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:55:41', 'Logged In', '2025-11-17 23:55:41', '2025-11-17 23:55:41'),
(267, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:56:06', 'Logged Out', '2025-11-17 23:56:06', '2025-11-17 23:56:06'),
(268, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:55:40', 'Logged In', '2025-12-01 04:55:40', '2025-12-01 04:55:40'),
(269, 'Chrome on Windows', 'Windows', '127.0.0.1', '10:58:12', 'Logged In', '2025-12-01 04:58:12', '2025-12-01 04:58:12'),
(270, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:54:19', 'Logged In', '2025-12-01 23:54:19', '2025-12-01 23:54:19'),
(271, 'Chrome on Windows', 'Windows', '127.0.0.1', '05:57:44', 'Logged In', '2025-12-01 23:57:44', '2025-12-01 23:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `bankings`
--

CREATE TABLE `bankings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_cheque_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bakshe_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nagad_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dutch_bangla_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bankings`
--

INSERT INTO `bankings` (`id`, `vendor_id`, `payment_method`, `account_number`, `bank_name`, `routing_number`, `account_type`, `bank_cheque_image`, `bakshe_number`, `nagad_number`, `dutch_bangla_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'Mobile Banking', '205313186001', 'brac-bank-plc', '060220259', 'Current', 'bank_cheques/boniAyvAaC7AGI36nzAsCInWaNAfxU3zIugzHauX.jpg', '01793100000', '01793100000', NULL, 'submitted', '2025-03-22 01:08:03', '2025-07-27 01:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `big_advertises`
--

CREATE TABLE `big_advertises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `big_advertises`
--

INSERT INTO `big_advertises` (`id`, `title`, `url`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Shopnobilashsdf', '#', 'shopnobilash-2025-01-19-678c9a0a36bfb.jpg', '2025-01-19 00:22:02', '2025-01-19 00:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_status` enum('pending','confirmed','cancelled','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'confirmed',
  `guest_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rooms_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`rooms_data`)),
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `total_nights` int(11) NOT NULL,
  `total_male` int(11) NOT NULL DEFAULT 0,
  `total_female` int(11) NOT NULL DEFAULT 0,
  `total_kids` int(11) NOT NULL DEFAULT 0,
  `total_persons` int(11) NOT NULL DEFAULT 0,
  `other_guests` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`other_guests`)),
  `home_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relationship` enum('family','husband','friends','colleagues','onlyMe') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'onlyMe',
  `additional_requests` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_requests`)),
  `bed_type` enum('large_bed','twin_beds') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_preference` enum('non_smoking','smoking') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non_smoking',
  `room_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citizenship` enum('bangladesh','international') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(10,2) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('unpaid','partial','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `invoice_number`, `booking_status`, `guest_id`, `guest_name`, `guest_email`, `guest_phone`, `rooms_data`, `checkin_date`, `checkout_date`, `total_nights`, `total_male`, `total_female`, `total_kids`, `total_persons`, `other_guests`, `home_address`, `organization`, `organization_address`, `relationship`, `additional_requests`, `bed_type`, `room_preference`, `room_type`, `room_number`, `arrival_time`, `property_note`, `citizenship`, `nid_front`, `nid_back`, `passport`, `visa`, `subtotal`, `discount`, `tax`, `grand_total`, `coupon_code`, `payment_status`, `paid_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'INV-2025-000001', 'confirmed', 2, 'Regan Malone', 'mollika@mollika.com', '+1 (685) 647-8622', '[{\"roomId\":33,\"roomName\":\"Abraham Neal\",\"quantity\":1,\"price\":564.72,\"hotelId\":46,\"hotelName\":\"N\\/A\",\"hotelAddress\":\"Jaliapalong, Inani, Ukhia, Cox\'s Bazar, Bangladesh\"}]', '1978-02-21', '2017-04-11', 14294, 5, 2, 8, 1, '[\"Est eveniet archit\"]', 'Dolor aspernatur sim', 'Manning and Gentry Plc', 'Laudantium et deser', 'colleagues', '[\"Room On Higher Floor\",\"Decorations in Room\"]', 'large_bed', 'smoking', 'Ut expedita ullam id', '837', '11', 'Laudantium et in vo', 'international', NULL, NULL, NULL, NULL, '8072107.68', '0.00', '1210816.15', '9282923.83', NULL, 'unpaid', '0.00', '2025-12-02 02:37:26', '2025-12-02 02:37:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+880',
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `name`, `mobile`, `country_code`, `address`, `email`, `photo`, `password`, `remember_token`, `password_reset_token`, `password_reset_expires_at`, `created_at`, `updated_at`) VALUES
(1, 'Grant Petty', '+1 (899) 383-3467', '+880', 'Sint quo ex et assu', 'arohinondi@gmail.com', 'uploads/guests/photos/1763441415_691bfb07013f9.png', '$2y$10$ppbzalhDiyVRe/PWfFE1AeP8Z7vqlr8YtR67Ww8nnfTEtBQ4f4UAm', NULL, NULL, NULL, '2025-11-17 21:36:35', '2025-11-17 22:50:15'),
(2, 'Mollika', '01552441122', '+880', 'sadf', 'mollika@mollika.com', NULL, '$2y$10$XtSIoFB/WJj6AojS25zrluvV6G9eXV2CNkIjT.Hs/WEnYwVkCU9mO', NULL, NULL, NULL, '2025-12-02 02:00:29', '2025-12-02 02:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_category` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_types` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lati` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pets_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pets_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `events_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `events_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quiet_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photography_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photography_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_window` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `food_laundry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`check_in_rules`)),
  `custom_check_in_rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_check_in_rules`)),
  `property_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`property_info`)),
  `custom_property_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_property_info`)),
  `age_restriction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_restriction_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vlogging_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vlogging_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_bed_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cooking_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_methods` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`check_in_methods`)),
  `custom_check_in_methods` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_check_in_methods`)),
  `cancellation_policies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cancellation_policies`)),
  `facilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`facilities`)),
  `custom_facilities_icon` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `custom_facility_icons` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facility_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_facilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nearby_areas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nearby_areas`)),
  `hotel_facilities` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_nearby_areas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_nearby_areas`)),
  `nearby_area_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_nearby_area_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_nearby_area_details`)),
  `featured_photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kitchen_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kitchen_photos`)),
  `washroom_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`washroom_photos`)),
  `parking_lot_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`parking_lot_photos`)),
  `entrance_gate_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`entrance_gate_photos`)),
  `lift_stairs_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`lift_stairs_photos`)),
  `spa_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`spa_photos`)),
  `bar_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bar_photos`)),
  `transport_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`transport_photos`)),
  `rooftop_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rooftop_photos`)),
  `gym_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gym_photos`)),
  `security_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`security_photos`)),
  `amenities_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`amenities_photos`)),
  `property_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`property_types`)),
  `apartments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`apartments`)),
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `approve` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `vendor_id`, `property_category`, `property_type`, `room_types`, `lati`, `longi`, `details`, `address`, `description`, `pets_allowed`, `pets_details`, `events_allowed`, `events_details`, `smoking_allowed`, `smoking_details`, `quiet_hours`, `photography_allowed`, `photography_details`, `check_in_window`, `check_out_time`, `food_laundry`, `check_in_rules`, `custom_check_in_rules`, `property_info`, `custom_property_info`, `age_restriction`, `age_restriction_details`, `vlogging_allowed`, `vlogging_details`, `child_policy`, `extra_bed_policy`, `cooking_policy`, `directions`, `additional_policy`, `check_in_methods`, `custom_check_in_methods`, `cancellation_policies`, `facilities`, `custom_facilities_icon`, `custom_facility_icons`, `facility_category`, `custom_facilities`, `nearby_areas`, `hotel_facilities`, `custom_nearby_areas`, `nearby_area_category`, `custom_nearby_area_details`, `featured_photo`, `kitchen_photos`, `washroom_photos`, `parking_lot_photos`, `entrance_gate_photos`, `lift_stairs_photos`, `spa_photos`, `bar_photos`, `transport_photos`, `rooftop_photos`, `gym_photos`, `security_photos`, `amenities_photos`, `property_types`, `apartments`, `status`, `approve`, `created_at`, `updated_at`) VALUES
(46, 7, 'Hotels', 'Hotels', '[\"Single Room\",\"Double Room\"]', NULL, NULL, '<p><strong>Number of Rooms: 493</strong> <strong>Number of Floors: 9</strong> <strong>Year of construction: 2016</strong></p><p>Jaliapalong, Inani, Ukhia, Cox\'s Bazar, Bangladesh &amp; Spa is located on Inani beach, Cox\'s Bazar with lush green hills rise from the east and endless sea stretching on the west, the resort offers panoramic visuals of Bay of Bengal. Nestled in the heart of nature along the world’s longest natural sandy beach, the resort is spread over 15 acres, located 40 minutes away from the hustle of the Cox\'s Bazar city with easy accessibility to all the major tourist. Apart from luxurious rooms &amp; suites and two swimming pools (one exclusively for ladies) the resort boasts of a plethora of indoor &amp; outdoor activities for both adults and kids which include an internationally acclaimed water park, tennis &amp; badminton courts, billiards, amphitheater, a luxurious spa and a well-appointed gym. test tes test</p>', 'Jaliapalong, Inani, Ukhia, Cox\'s Bazar, Bangladesh', 'Shopno Bilash Holiday Suites', 'yes', NULL, 'yes', NULL, 'yes', 'Maiores vel est occa', 'Quisquam aut quis en', 'no', NULL, '04:00-06:00', '9:00 AM', 'no', '\"[\\\"Pay in advance\\\",\\\"Security money for keys\\\",\\\"Rentals\\\",\\\"Et quos incidunt es\\\"]\"', '[\"Et quos incidunt es\"]', '[\"Guests must climb stairs\",\"Pet(s) live on the property\",\"No parking on the property\",\"Property has shared spaces\",\"Weapon(s) on the property\",\"Commercial shops in the building\",\"Offices in the building\"]', '[\"Corporis sit sunt do\",null]', 'no', NULL, 'no', NULL, '<p>Quasi praesentium au</p>', '<p>Porro qui voluptatib</p>', 'Distinctio Est offi', '<p>A sint et rerum aut</p>', '<p>Sed commodi cum prov</p>', '[\"Building staff\",\"Housekeeping\",\"Bell boy\"]', NULL, '[\"Flexible\"]', '[\"Buffet Breakfast\",\"Bar\\/lounge\",\"Private Pool\"]', '\"[\\\"hotel_photos\\\\\\/hyksIyaYklDWarqyMCkoYKT7k3ZBbi4HrlZsYAAq.jpg\\\",\\\"hotel_photos\\\\\\/fhnCXAzOMCY2KReQQM63iXqNh1stmpljCKeuw01s.jpg\\\",\\\"hotel_photos\\\\\\/4NiKS34PRpjAl2jXxdZcaMKj0iRy5dsSuj5nWdMJ.jpg\\\",\\\"hotel_photos\\\\\\/aGTMSdJtykK8eHewuCiE1vpVo8E1AnVSPQg0xzix.jpg\\\",\\\"hotel_photos\\\\\\/ktAIXqdOSxiVOgbHAqt0xIO6h9imponiL6HuKbWE.jpg\\\",\\\"hotel_photos\\\\\\/3xIopQqYSuPBn2Ze1IqxYNjlcTH7FWdYJvfXibM7.jpg\\\",\\\"hotel_photos\\\\\\/jje5ImrdERlZ3vx8jK5Ak9rVvLY4f6FhWEmr5IP3.jpg\\\"]\"', NULL, NULL, '[\"bb\",\"test\"]', '{\"hospital___police_station\":{\"name\":[\"Cox bazar thana\",\"234\",\"234\"],\"distance\":[\"1KM Distance\",\"234\",\"234\"]}}', '\"[{\\\"category\\\":\\\"activities___entertainment\\\",\\\"name\\\":\\\"aaaa\\\"},{\\\"category\\\":\\\"activities___entertainment\\\",\\\"name\\\":\\\"bbb\\\"},{\\\"category\\\":\\\"safety___security\\\",\\\"name\\\":\\\"ffff\\\"},{\\\"category\\\":\\\"technology__media___wi_fi\\\",\\\"name\\\":\\\"asdfasfd\\\"}]\"', '\"[\\\"400 kilometers away\\\",\\\"200 kilometers away from Inani\\\",\\\"third\\\"]\"', NULL, NULL, '[\"uploads\\/hotel_photos\\/1748318283_6835384bb346a.jpg\"]', '\"[\\\"hotel_photos\\\\\\/1746438057_2.jpg\\\"]\"', '\"[\\\"hotel_photos\\\\\\/1746438677_4.png\\\",\\\"hotel_photos\\\\\\/1746438677_3.jpg\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, NULL, 'submitted', 1, '2025-04-25 23:10:47', '2025-11-17 04:36:20'),
(47, 7, NULL, 'Hotels', NULL, '23.74196205206313', '90.39241111927555', '<p><strong>Number of Rooms: 493</strong> <strong>Number of Floors: 9</strong> <strong>Year of construction: 2015</strong></p><p>Jaliapalong, Inani, Ukhia, Cox\'s Bazar, Bangladesh &amp; Spa is located on Inani beach, Cox\'s Bazar with lush green hills rise from the east and endless sea stretching on the west, the resort offers panoramic visuals of Bay of Bengal. Nestled in the heart of nature along the world’s longest natural sandy beach, the resort is spread over 15 acres, located 40 minutes away from the hustle of the Cox\'s Bazar city with easy accessibility to all the major tourist. Apart from luxurious rooms &amp; suites and two swimming pools (one exclusively for ladies) the resort boasts of a plethora of indoor &amp; outdoor activities for both adults and kids which include an internationally acclaimed water park, tennis &amp; badminton courts, billiards, amphitheater, a luxurious spa and a well-appointed gym.</p>', 'Jaliapalong, Inani, Ukhia, Cox\'s Bazar, Bangladesh....', 'Jaliapalong Hotel', 'yes', '<p>Here will be pet Details here</p>', 'yes', 'Accusantium aliqua', 'no', NULL, 'Quia aut sapiente as', 'yes', 'Impedit nulla omnis', '6:00 AM - 8:00 AM', '4:00 PM', 'no', '\"[\\\"Quia facere doloremq\\\",\\\"Test Check in Rules if Any\\\"]\"', '[\"Quia facere doloremq\",\"Test Check in Rules if Any\"]', '[\"Guests must climb stairs\",\"No lift\\/Elevator\",\"Pet(s) live on the property\",\"No parking on the property\",\"Property has shared spaces\",\"Limited essential amenities\",\"Weapon(s) on the property\",\"Offices in the building\"]', '[\"Minus velit voluptat\",null,\"test\"]', 'no', NULL, 'no', NULL, '<p>Allowed</p><p>&gt; Children below 5 Years can stay in the same room &amp; enjoy complimentary breakfast. &gt;Children above 5 years to 10 years will be charged BDT 1000/- for buffet breakfast, BDT 1200/- for buffet lunch &amp; BDT 1450/- for buffet dinner. &gt;For an extra bed need to pay BDT 3,000/- and breakfast is included with this price. &gt;Children above 10 years are considered adults and an extra bed shall be required. &gt;Adult breakfast charge BDT 1,999/-</p>', '<p>Front desk staff will greet guests on arrival..</p>', 'Autem voluptatum pos', '<ul><li>Extra-person charges may apply and vary depending on property policy</li><li>Government-issued photo identification and a credit card, debit card, or cash deposit may be required at check-in for incidental charges</li><li>Special requests are subject to availability upon check-in and may incur additional charges; special requests cannot be guaranteed</li><li>This property accepts credit cards, debit cards, and cash</li></ul>', '<ul><li>*BREAKFAST AT APPAYAN* Set menu breakfast from 6 years and above BDT 650 per person *Complimentary Airport Shuttle Service* &gt; Lounge Address: Kolatoli Road (On the right side towards the Beach from Dolphin Circle, in front of “99 Convention Hall”), Cox’s Bazar City &gt; Opening Time: 07:30 am to 06:00 pm &gt; Lounge Cell Number: +8801844-016017 &gt; Seating Capacity of shuttle: 20 Person &gt; For Airport pick-up, the vehicle will report 5 minutes prior to arrival time of the Flights but the vehicle would leave each hour as scheduled above. &gt; The paging will be done outside the Arrival Gate of the Airport. &gt; Route: Resort-Lounge-Airport-Lounge-Resort &gt; All guests’ departing by any airlines will be dropped at the departure gate &gt; Facilities: Shuttle Services are complimentary as per availability; Complimentary Wifi (Lounge); &gt; Individual Service: 5000/- per way (Private Car/ Sedan), 6000/- per way (Hi Ace) &amp; 12500/- per way (Individual Bus) &gt;Food cost per person: Buffet Lunch @ BDT 2399/-, Buffet Dinner @ BDT 2899/- &amp; Buffet Breakfast @ BDT 1999/-. &gt;During Blackout/Long Holidays period Cancellation policy will not be applicable. &gt;Each guest must present a copy of their valid NID/other identification documents during check-in. Guests should carry their vaccination certificates during check-in. &gt;Couples might have to show proof of marriage (marriage certificate/photographs) on demand. &gt;The extra bed with breakfast charge is BDT 3000/- for one additional adult. &gt;Early check-in and late check-out are not guaranteed, it is subject to availability and at the property\'s discretion. It might be chargeable, please contact the hotel for further details during check-in. &gt; Guests will get 15% discount on Sea pearl water park after check-in.</li></ul>', '[\"In-person\\/Self check-in\",\"Keypad\"]', NULL, '[\"Partially refundable\",\"Long-term\\/Monthly staying policy\"]', '[\"Bar\\/lounge\",\"Private Pool\",\"Fitness center & Spa services\",\"24-hour reception\",\"Parking facilities\"]', NULL, NULL, NULL, NULL, '{\"restaurant___cafe\":{\"name\":[\"Dera\",\"Sara\"],\"distance\":[\"3km Distance\",\"5km Distance\"]},\"shopping___atm\":{\"name\":[\"kawranzbadfs\"],\"distance\":[\"16 km\"]}}', '\"[{\\\"category\\\":\\\"activities___entertainment\\\",\\\"name\\\":\\\"aaaa\\\"},{\\\"category\\\":\\\"activities___entertainment\\\",\\\"name\\\":\\\"bbb\\\"},{\\\"category\\\":\\\"safety___security\\\",\\\"name\\\":\\\"ffff\\\"},{\\\"category\\\":\\\"general_services\\\",\\\"name\\\":\\\"general\\\"}]\"', '\"[\\\"400 kilometers away\\\",\\\"200 kilometers away from Inani\\\",\\\"3.2 km from Cox\'s Bazar Airport\\\"]\"', NULL, NULL, '[\"storage\\/uploads\\/hotel_photos\\/hf8JBo6F7XqjlDyO5LNbbCeGJgnTMVlYki4Q3a1q.webp\"]', '\"[\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412117_6836a6d5e4910.jpg\\\"]\"', '\"[\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412150_6836a6f61d4c4.jpg\\\",\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412150_6836a6f61d7b1.jpg\\\"]\"', '\"[\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412150_6836a6f61dc52.png\\\",\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412150_6836a6f61de9e.jpg\\\"]\"', '\"[\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412150_6836a6f61e123.jpg\\\",\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412150_6836a6f61e34c.jpg\\\"]\"', '\"[\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412186_6836a71a87d75.jpg\\\",\\\"uploads\\\\\\/hotel_photos\\\\\\/1748412186_6836a71a883b2.png\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, NULL, 'submitted', 1, '2025-04-25 23:12:19', '2025-07-15 03:53:50'),
(49, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ab fugiat quis conse', 'yes', 'Quas ut modi fugiat', 'yes', 'Reprehenderit modi', 'yes', 'Nostrud et iusto ull', 'Id accusantium prov', 'yes', 'Fugiat voluptas sit', '06:00-08:00', '9:00 PM', 'yes', '\"[\\\"Pay in advance\\\",\\\"Security money for keys\\\",\\\"Rentals\\\",\\\"Adipisci reiciendis\\\"]\"', '[\"Adipisci reiciendis\"]', '[\"Potential noise during stays\",\"No parking on the property\",\"Limited essential amenities\",\"Weapon(s) on the property\"]', '[\"Dolor et sit dolore\"]', 'no', NULL, 'yes', 'Sit et quaerat sunt', 'Et debitis esse Nam', 'Consequatur lorem a', 'Libero est ipsum ve', 'Excepturi velit vol', 'Quam tempor quaerat', '[\"Building staff\",\"Housekeeping\",\"Bell boy\",\"In-person\\/Self check-in\",\"Smart lock\",\"Keypad\",\"Lockbox\"]', NULL, '[\"Long-term\\/Monthly staying policy\"]', '[\"Free Wi-Fi\",\"Hill View Or Sea View\"]', '\"[\\\"hotel_photos\\\\\\/u8a9yGS5eIhKuyvO7z222Im3mvBm6qfuA1s28geh.png\\\",\\\"hotel_photos\\\\\\/3mDhRiFPbhCluQWntDEb6MIK9NmtfUf6lntEI77E.png\\\",\\\"hotel_photos\\\\\\/aC0jwrjGGBI5RWbeg06dywQYfCh8Ote12ykiUQCB.png\\\",\\\"hotel_photos\\\\\\/wQDiim86s1yOvFrfRluDMIjH9VgXvl6xgvYX8wM1.png\\\"]\"', NULL, NULL, '[\"one\",\"two\",\"three\"]', NULL, NULL, NULL, NULL, NULL, NULL, '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, NULL, 'submitted', 0, '2025-05-03 23:24:24', '2025-05-03 23:42:04'),
(50, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Culpa atque dicta vo', 'yes', 'Laborum Officia qui', 'yes', 'Suscipit id consecte', 'no', NULL, 'Eum in ut voluptatem', 'no', NULL, '16:00-18:00', '8:00 PM', 'no', '\"[\\\"Security money for keys\\\",\\\"Rentals\\\",\\\"Laborum Inventore a\\\"]\"', '[\"Laborum Inventore a\"]', '[\"Guests must climb stairs\",\"Pet(s) live on the property\",\"Limited essential amenities\",\"Commercial shops in the building\"]', '[\"Excepteur enim aut l\",null]', 'yes', 'Dicta et officia lab', 'yes', 'Sequi voluptatem qui', 'Tenetur eaque do pra', 'At molestias ut et e', 'Consequuntur impedit', 'Quam laborum Modi e', 'Beatae soluta tempor', '[\"Housekeeping\",\"Smart lock\",\"Keypad\"]', NULL, '[\"Non-refundable\",\"Partially refundable\"]', '[\"Free Wi-Fi\",\"Hill View Or Sea View\"]', NULL, NULL, NULL, NULL, NULL, NULL, '\"[\\\"one\\\",\\\"two\\\",\\\"threeeeee\\\"]\"', NULL, NULL, NULL, '\"[\\\"hotel_photos\\\\\\/xAZAINhjmHsc7kIXte2pP35XPYQrFkzMOJwNTeFJ.png\\\",\\\"hotel_photos\\\\\\/1746438004_3.jpg\\\",\\\"hotel_photos\\\\\\/1746438004_2.jpg\\\"]\"', '\"[\\\"hotel_photos\\\\\\/RShfajmoJ7kR47DshnkN19ChijxAqUqLFV4WFm6e.png\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, NULL, 'submitted', 0, '2025-05-04 00:38:14', '2025-05-05 03:40:04'),
(51, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Aut unde voluptates', 'yes', 'Ea perferendis volup', 'no', NULL, 'yes', 'Molestiae consequatu', 'Earum suscipit ullam', 'yes', 'Illum blanditiis nu', '00:00-02:00', '9:00 PM', 'yes', '\"[\\\"Pay in advance\\\",\\\"Security money for keys\\\",\\\"Rentals\\\",\\\"Sit excepturi repreh\\\"]\"', '[\"Sit excepturi repreh\"]', '[\"Guests must climb stairs\",\"Limited essential amenities\"]', '[\"Fugiat dolorem labo\"]', 'no', NULL, 'yes', 'Dolore nemo possimus', 'Hic eligendi omnis e', 'Eos at esse rerum d', 'Quis veritatis rem u', 'Quasi vel reprehende', 'Voluptatem Qui veli', '[\"Building staff\",\"Housekeeping\"]', NULL, '[\"Flexible\",\"Non-refundable\"]', '[\"Fitness center & Spa services\",\"24-hour reception\",\"Parking facilities\",\"Airport shuttle service\"]', '\"[\\\"hotel_photos\\\\\\/L5ogD6h3tBjSW8bTgyt9p9QX2L3numMQi0pzh233.jpg\\\"]\"', NULL, NULL, '[\"sf\"]', NULL, NULL, '[null]', NULL, NULL, NULL, '\"[\\\"hotel_photos\\\\\\/1746350177_Background.png\\\",\\\"hotel_photos\\\\\\/1746350177_Entry Pass-01.jpg\\\"]\"', '\"[\\\"hotel_photos\\\\\\/1746350392_home.jpg\\\",\\\"hotel_photos\\\\\\/1746350392_transcript.jpeg\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, NULL, 'submitted', 0, '2025-05-04 03:16:17', '2025-05-04 03:40:30'),
(57, 7, NULL, 'Hotels', NULL, NULL, NULL, '<p>Nestled in the heart of Kolatoli, Cox’s Bazar, <strong>Saikatabas Hotel</strong> offers the perfect blend of comfort, convenience, and modern living. Just a 10-minute walk from the iconic Cox’s Bazar beach, our hotel provides easy access to the sea while offering a peaceful retreat away from the crowd.</p><p>Saikatabas features <strong>105 fully furnished serviced apartments</strong>, each thoughtfully designed for both short and long stays. Whether you\'re traveling for leisure or business, our spacious units are equipped with <strong>modern facilities</strong> to ensure a relaxing and productive stay.</p><p>Guests can enjoy <strong>secure parking</strong>, 24/7 <strong>security and safety measures</strong>, and a welcoming environment ideal for families, solo travelers, and corporate guests alike. Discover a new level of comfort and flexibility at Saikatabas Hotel—your home away from home in Cox’s Bazar.</p>', NULL, 'Nestled in the heart of Kolatoli, Cox’s Bazar', 'no', NULL, 'no', NULL, 'yes', 'in the smoking zone & Balcony inside the room', '10:00 PM to 9:00 PM', 'no', NULL, '10:00-12:00', '11:00 AM', 'no', '\"[\\\"Pyament during the check-in\\\",\\\"Provide Govt. - ID\\\"]\"', '[\"Pyament during the check-in\",\"Provide Govt. - ID\"]', '[\"Potential noise during stays\"]', '[null]', 'no', NULL, 'no', NULL, '<p>Children above 7 years will be considered as adults and may require additional payment.&nbsp;</p>', '<p>N/A</p>', 'To avail of Cooking facilities, if available in the apartment, an additional BDT 1000 will Be Charged for gas and crockery.', '<p>Google Map link -&nbsp;</p><figure class=\"media\"><oembed url=\"https://maps.app.goo.gl/BHYXser3hFbFFYEc8\"></oembed></figure>', NULL, '[\"Housekeeping\"]', NULL, '[\"Flexible\",\"Non-refundable\",\"Partially refundable\"]', '[\"Free Wi-Fi\",\"Hill View Or Sea View\",\"Parking facilities\",\"Airport shuttle service\"]', NULL, NULL, NULL, NULL, NULL, NULL, '\"[\\\"Shugandha Beach\\\",\\\"Homchori Beach\\\",\\\"Dorianagar Beach\\\"]\"', NULL, NULL, NULL, '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, NULL, 'submitted', 1, '2025-07-26 04:42:45', '2025-07-26 04:53:32'),
(58, 7, NULL, 'Hotels', NULL, NULL, NULL, '<p><strong>Shopno Bilash Holiday Suites – The Ideal Getaway for Friends &amp; Family in Cox’s Bazar</strong></p><p>Welcome to <strong>Shopno Bilash Holiday Suites</strong>, one of Cox’s Bazar’s most trusted choices for families and groups of friends. Perfectly located between <strong>Sugondha</strong> and <strong>Laboni Beach</strong>, our suites offer easy access to both, making it a great spot for beach lovers.</p><p>Our spacious <strong>family-friendly suites</strong> with <strong>connecting flats</strong> are ideal for large families or groups of friends. Each unit includes a <strong>fully equipped kitchen</strong>, giving you the comfort and freedom to enjoy your stay just the way you like.</p><p>Whether you\'re planning a short break or a longer holiday, Shopno Bilash offers a <strong>comfortable, clean, and secure environment</strong>, with everything you need to feel at home.</p>', NULL, 'Shopno Bilash Holiday Suites', 'no', NULL, 'no', NULL, 'no', NULL, '12AM to 9AM', 'yes', NULL, '10:00-12:00', '11:00 AM', 'no', '\"[\\\"Security money for keys\\\"]\"', '[null]', NULL, '[null]', 'no', NULL, 'no', NULL, NULL, NULL, NULL, NULL, NULL, '[\"Building staff\",\"Housekeeping\"]', NULL, '[\"Flexible\",\"Long-term\\/Monthly staying policy\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[null]', NULL, NULL, '[]', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, NULL, 'submitted', 1, '2025-07-27 04:52:44', '2025-11-17 04:37:40'),
(59, 7, NULL, 'Hotels', NULL, 'Opposit of Hotel Long Beach, KFC Road', NULL, '<p>&lt;p&gt;&lt;strong&gt;Shopno Bilash Holiday Suites – The Ideal Getaway for Friends &amp; Family in Cox’s Bazar&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;Welcome to &lt;strong&gt;Shopno Bilash Holiday Suites&lt;/strong&gt;, one of Cox’s Bazar’s most trusted choices for families and groups of friends. Perfectly located between &lt;strong&gt;Sugondha&lt;/strong&gt; and &lt;strong&gt;Laboni Beach&lt;/strong&gt;, our suites offer easy access to both, making it a great spot for beach lovers.&lt;/p&gt;&lt;p&gt;Our spacious &lt;strong&gt;family-friendly suites&lt;/strong&gt; with &lt;strong&gt;connecting flats&lt;/strong&gt; are ideal for large families or groups of friends. Each unit includes a &lt;strong&gt;fully equipped kitchen&lt;/strong&gt;, giving you the comfort and freedom to enjoy your stay just the way you like.&lt;/p&gt;&lt;p&gt;Whether you\'re planning a short break or a longer holiday, Shopno Bilash offers a &lt;strong&gt;comfortable, clean, and secure environment&lt;/strong&gt;, with everything you need to feel at home.&lt;/p&gt;</p>', 'Block #A, Plot# 28, Kolatoli R/A, Cox\'s Bazar', 'Shopno Bilash Holiday Suites', 'no', NULL, 'no', NULL, 'no', NULL, '12 AM to 9 AM', 'no', NULL, '10:00-12:00', '11:00 AM', 'no', '\"[\\\"Pay in advance\\\",\\\"Security money for keys\\\"]\"', '[null]', NULL, '[null]', 'no', NULL, 'no', NULL, NULL, NULL, NULL, NULL, NULL, '[\"Building staff\",\"Housekeeping\"]', NULL, '[\"Flexible\",\"Partially refundable\",\"Long-term\\/Monthly staying policy\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, NULL, 'submitted', 0, '2025-07-27 04:56:55', '2025-07-27 05:21:06'),
(61, 7, NULL, 'Hotels', NULL, NULL, NULL, '<p>detailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails detailsdetailsdetails details</p>', NULL, 'Propertyname 1', NULL, NULL, NULL, NULL, NULL, NULL, 'sadf', NULL, NULL, NULL, NULL, NULL, NULL, '[null]', NULL, '[null]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'submitted', 0, '2025-08-20 00:10:22', '2025-08-20 00:10:22'),
(72, 7, 'Hotels', 'Hotels', '[\"Single Room\",\"Double Room\"]', NULL, NULL, 'new hotel', NULL, 'another hotel', 'no', NULL, 'no', NULL, 'no', NULL, '324', NULL, NULL, NULL, NULL, NULL, NULL, '[null]', NULL, '[null]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"[]\"', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', NULL, '[{\"name\":\"test1\",\"number\":\"1\",\"floor\":\"101\"},{\"name\":\"test2\",\"number\":\"2\",\"floor\":\"201\"}]', 'submitted', 1, '2025-09-01 00:34:42', '2025-09-01 00:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_settings`
--

CREATE TABLE `hotel_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_settings`
--

INSERT INTO `hotel_settings` (`id`, `hotel_name`, `hotel_logo`, `hotel_address`, `email`, `phone`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 'EGKOM', 'hotel_logos/1732770154_logo (2).png', '29 Land St, Lorem City, CA', 'info@starhotel.com', '01779666611', 'Copyright © 2024 Egkom. All Rights Reserved.', '2024-11-27 23:02:34', '2024-11-27 23:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_wishlists`
--

CREATE TABLE `hotel_wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_wishlists`
--

INSERT INTO `hotel_wishlists` (`id`, `guest_id`, `hotel_id`, `created_at`, `updated_at`) VALUES
(1, 2, 46, '2025-12-02 03:26:20', '2025-12-02 03:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `root_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sroot_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `troot_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer3` int(11) DEFAULT NULL,
  `footer4` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `slug`, `page_type`, `external_link`, `target`, `root_id`, `sroot_id`, `troot_id`, `sequence`, `display`, `footer1`, `footer2`, `footer3`, `footer4`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'About Us', NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '1', '1', 1, 1, '2024-01-20 00:12:48', '2025-01-18 22:30:56'),
(3, 'Facilities', 'facilities', 'page', NULL, NULL, NULL, NULL, NULL, '0', '1', '1', '1', NULL, NULL, '2024-01-20 00:13:15', '2024-09-16 00:47:17'),
(6, 'Contact', 'contact', 'url', 'http://localhost:8080/contact', NULL, NULL, NULL, NULL, '10', '1', NULL, NULL, NULL, NULL, '2024-01-20 00:14:16', '2024-09-15 22:31:14'),
(7, 'HEAT TRANSFER LABELS', 'heat-transfer-labels', 'page', NULL, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, NULL, NULL, '2024-01-23 23:50:52', '2024-09-16 00:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2014_10_12_100000_create_password_resets_table', 1),
(15, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(17, '2024_11_20_054903_create_super_admins_table', 1),
(18, '2024_11_20_060821_add_role_to_super_admins_table', 1),
(19, '2024_11_25_082716_create_activity_logs_table', 2),
(20, '2024_11_26_071109_create_hotel_settings_table', 2),
(21, '2024_11_28_055140_create_ventords_table', 3),
(22, '2024_11_28_062658_create_vendors_table', 4),
(23, '2025_01_19_055055_create_big_advertises_table', 5),
(24, '2025_01_19_055552_create_small_advertises_table', 6),
(25, '2025_03_18_034226_create_create_properties_tables_table', 7),
(29, '2025_03_18_052403_create_properties_table', 8),
(30, '2025_03_22_034315_create_owners_table', 9),
(32, '2025_03_22_064013_create_bankings_table', 10),
(33, '2025_03_23_084227_create_hotels_table', 11),
(34, '2025_03_25_040931_add_missing_columns_to_hotels_table', 12),
(35, '2025_04_07_062342_create_rooms_table', 13),
(36, '2025_04_07_082752_create_room_photos_table', 14),
(37, '2025_04_23_063659_create_nearby_areas_table', 15),
(38, '2025_11_18_033052_create_guests_table', 16),
(39, '2025_11_18_044657_add_photo_to_guests_table', 17),
(40, '2025_11_18_045137_add_password_reset_to_guests_table', 18),
(41, '2025_11_18_054052_add_password_reset_to_vendors_table', 19),
(42, '2025_11_18_054115_add_password_reset_to_users_table', 19),
(43, '2025_11_18_055419_add_password_reset_to_super_admins_table', 20),
(44, '2025_12_02_061848_add_discount_and_status_columns_to_rooms_table', 21),
(45, '2025_12_02_080841_create_bookings_table', 22),
(46, '2025_12_02_090616_create_wishlists_table', 23),
(47, '2025_12_02_091802_create_hotel_wishlists_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `nearby_areas`
--

CREATE TABLE `nearby_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ownership_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_ownership` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_start_date` date DEFAULT NULL,
  `lease_end_date` date DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_front_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_back_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `name`, `vendor_id`, `phone_number`, `ownership_type`, `trade_license`, `bin`, `tin`, `nid_number`, `date_of_birth`, `passport_number`, `present_address`, `permanent_address`, `property_ownership`, `partner_name`, `partner_contact`, `partner_details`, `lease_start_date`, `lease_end_date`, `facebook_link`, `website_link`, `nid_front_image`, `nid_back_image`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Arifur Rahman', 7, '8801787300000', 'Private', '123456789', '123456789', '123456789', '00114477000', '1987-04-16', '123456789', 'Block G, Basundhara R/A, Dhaka.', 'House #2206, Nisa Vila, Chandrima road, Kolatoli, Coxs bazar.', 'Proprietorship', NULL, NULL, NULL, NULL, NULL, 'https://www.facebook.com/shopnobilash/', 'https://www.shopnobilash.com', 'nid_images/l7wmIHJSCpHVPIcMf8Iur3Tlo8l48CSIVbMZOvH1.png', 'nid_images/elqgh5tlWiykMC2h3w3vwlD4r9dwBmrsOY1cVmEL.png', 'submitted', '2025-03-22 22:36:10', '2025-07-27 01:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_uri` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `sub_title`, `title_uri`, `short`, `description`, `image`, `created_at`, `updated_at`) VALUES
(6, 'About', 'Sub Title', 'About Us', NULL, '<p>About Us Details</p>', '', '2025-01-18 22:38:49', '2025-01-18 22:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `property_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_car_parking` int(11) DEFAULT NULL,
  `property_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`room_types`)),
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_town_village` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `road_number_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_age` int(11) DEFAULT NULL,
  `building_size` int(11) DEFAULT NULL,
  `building_stories` int(11) DEFAULT NULL,
  `landmark_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_map_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `apartment_count` int(11) DEFAULT NULL,
  `apartments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`apartments`)),
  `total_capacity` int(11) DEFAULT NULL,
  `car_parking` int(11) DEFAULT NULL,
  `has_reception` tinyint(1) NOT NULL DEFAULT 0,
  `elevators` int(11) DEFAULT NULL,
  `generators` int(11) DEFAULT NULL,
  `fire_exits` int(11) DEFAULT NULL,
  `wheelchair_access` tinyint(1) NOT NULL DEFAULT 0,
  `male_housekeeping` int(11) DEFAULT NULL,
  `female_housekeeping` int(11) DEFAULT NULL,
  `has_kids_zone` tinyint(1) NOT NULL DEFAULT 0,
  `kids_zone_count` int(11) DEFAULT NULL,
  `view_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_guards` int(11) DEFAULT NULL,
  `has_cafe_restaurant` tinyint(1) NOT NULL DEFAULT 0,
  `cafe_restaurant_count` int(11) DEFAULT NULL,
  `cafe_restaurant_names` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cafe_restaurant_names`)),
  `has_pool` tinyint(1) NOT NULL DEFAULT 0,
  `pool_count` int(11) DEFAULT NULL,
  `has_bar` tinyint(1) NOT NULL DEFAULT 0,
  `bar_count` int(11) DEFAULT NULL,
  `has_gym` tinyint(1) NOT NULL DEFAULT 0,
  `gym_count` int(11) DEFAULT NULL,
  `has_party_center` tinyint(1) NOT NULL DEFAULT 0,
  `party_center_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_conference_hall` tinyint(1) NOT NULL DEFAULT 0,
  `conference_hall_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `vendor_id`, `property_name`, `total_car_parking`, `property_category`, `property_type`, `room_types`, `country_name`, `district_name`, `city_town_village`, `postcode`, `house_number`, `road_number_name`, `building_age`, `building_size`, `building_stories`, `landmark_details`, `google_map_link`, `company_logo`, `apartment_count`, `apartments`, `total_capacity`, `car_parking`, `has_reception`, `elevators`, `generators`, `fire_exits`, `wheelchair_access`, `male_housekeeping`, `female_housekeeping`, `has_kids_zone`, `kids_zone_count`, `view_type`, `security_guards`, `has_cafe_restaurant`, `cafe_restaurant_count`, `cafe_restaurant_names`, `has_pool`, `pool_count`, `has_bar`, `bar_count`, `has_gym`, `gym_count`, `has_party_center`, `party_center_details`, `has_conference_hall`, `conference_hall_details`, `status`, `created_at`, `updated_at`) VALUES
(15, 7, 'Shopno Bilash Holiday Suites', NULL, 'Hotels', 'Luxury Hotels', '[\"Single Room\",\"Double Room\",\"Suite\",\"Family Room\"]', 'Bangladesh', 'Cox\'sBazar', 'Kolatoli R/A', '4500', '90-97', 'Saikatabas Road', 2008, 100000, 9, 'Opposite of Long Beach hotel end of Mohammodia Guest house Goli', 'https://maps.app.goo.gl/Z33jgoDoBNfYzMGg7', 'storage/logos/1756880718_2-2025-05-25-6832e2d1b27cf.jpg', 3, '[]', 140, 10, 1, 1, 1, 1, 1, 5, 4, 0, NULL, 'Hill View & City View', 2, 0, NULL, '[]', 0, 1, 0, 1, 0, 1, 0, 'asdf asdf', 0, 'wer wer', 'submitted', '2025-03-20 02:00:59', '2025-09-03 00:25:18'),
(18, 13, 'wqer', NULL, 'Hotels', '', '\"[]\"', 'Bangladesh', 'Bandarban', '234', '234', '234', '234', 0, 0, 0, '', '', 'storage/logos/1756890332_admin.png', 0, '\"[]\"', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '234', 0, 0, 0, '\"[]\"', 0, 0, 0, 0, 0, 0, 0, '', 0, '', 'submitted', '2025-09-03 03:05:32', '2025-09-03 03:05:32'),
(20, 15, 'estt', 0, 'Hotels', '', '[]', 'Bangladesh', 'Bandarban', '234', '234', '234', '234', 0, 0, 0, '', '', 'storage/logos/1756891699_admin.png', 0, '[]', 234, 234, 0, 0, 0, 0, 0, 1, 1, 0, 0, '', 0, 0, 0, '[]', 0, 0, 0, 0, 0, 0, 0, '', 0, '', 'submitted', '2025-09-03 03:28:27', '2025-09-04 00:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_photos` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_per_night` decimal(10,2) DEFAULT NULL,
  `weekend_price` decimal(10,2) DEFAULT NULL,
  `holiday_price` decimal(10,2) DEFAULT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `discount_percentage` decimal(10,2) DEFAULT NULL,
  `discount_value` decimal(10,2) DEFAULT NULL,
  `total_persons` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `total_rooms` int(11) DEFAULT NULL,
  `total_washrooms` int(11) DEFAULT NULL,
  `total_beds` int(11) DEFAULT NULL,
  `wifi_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appliances` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`appliances`)),
  `furniture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`furniture`)),
  `amenities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`amenities`)),
  `cancellation_policy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel_id`, `name`, `feature_photos`, `number`, `floor_number`, `price_per_night`, `weekend_price`, `holiday_price`, `discount_type`, `discount_amount`, `discount_percentage`, `discount_value`, `total_persons`, `description`, `size`, `total_rooms`, `total_washrooms`, `total_beds`, `wifi_details`, `appliances`, `furniture`, `amenities`, `cancellation_policy`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(28, 46, 'Twin Room', NULL, 'Twin 1002', '1', '5000.00', '5500.00', '6000.00', NULL, NULL, NULL, NULL, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 10, 3, 1, 1, '5555', '\"[]\"', '\"[\\\"Bed\\\",\\\"Dining Table with Chair\\\",\\\"Sofa\\\\\\/Couch\\\",\\\"Tea Table\\\",\\\"Bedside Table\\\",\\\"Shoe Rack\\\",\\\"Clothing Cabinet\\\",\\\"Clothes Drying Hanger\\\",\\\"Iron Stand\\\",\\\"Locker\\\\\\/Safe\\\",\\\"123\\\"]\"', '\"[\\\"Toothbrush\\\",\\\"Towel\\\",\\\"Water bottle\\\"]\"', '[\"flexible\",\"non_refundable\"]', 1, 'published', '2025-05-05 03:27:12', '2025-12-02 00:24:02'),
(31, 72, 'test1', NULL, '1', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-01 00:34:43', '2025-09-01 00:34:43'),
(32, 72, 'test2', NULL, '2', '201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-01 00:34:43', '2025-09-01 00:34:43'),
(33, 46, 'Abraham Neal', NULL, '61', '976', '724.00', '654.00', '320.00', 'percentage', NULL, '22.00', NULL, 1, 'Fuga Commodo et ea', 56, 1, 1, 2, 'Qui in eveniet dese', '\"[\\\"Fridge\\\",\\\"Light\\\",\\\"Gas Stove\\\",\\\"Room Heater\\\",\\\"Hair Dryer\\\"]\"', '\"[\\\"Bed\\\",\\\"Dining Table with Chair\\\",\\\"Tea Table\\\",\\\"Bedside Table\\\",\\\"Shoe Rack\\\",\\\"Clothing Cabinet\\\",\\\"Clothes Drying Hanger\\\"]\"', '\"[\\\"Soap\\\",\\\"Toothbrush\\\",\\\"Towel\\\",\\\"Air freshener\\\",\\\"Fruit basket\\\",\\\"Complimentary drinks\\\",\\\"Buffet breakfast\\\",\\\"Add\\\\\\/type Manually\\\"]\"', '[]', 1, 'published', '2025-12-02 00:37:26', '2025-12-02 00:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `room_photos`
--

CREATE TABLE `room_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_photos`
--

INSERT INTO `room_photos` (`id`, `room_id`, `category`, `photo_path`, `created_at`, `updated_at`) VALUES
(58, 28, 'feature', 'room_photos/1748772701_683c275d66d90.png', '2025-06-01 04:11:41', '2025-06-01 04:11:41'),
(59, 28, 'feature', 'room_photos/1748772701_683c275d78f5e.jpg', '2025-06-01 04:11:41', '2025-06-01 04:11:41'),
(60, 28, 'feature', 'room_photos/1748772802_683c27c28f931.jpeg', '2025-06-01 04:13:22', '2025-06-01 04:13:22'),
(61, 28, 'feature', 'room_photos/1748772802_683c27c2a48fe.jpeg', '2025-06-01 04:13:22', '2025-06-01 04:13:22'),
(62, 28, 'feature', 'room_photos/1748772802_683c27c2b8624.png', '2025-06-01 04:13:22', '2025-06-01 04:13:22'),
(63, 28, 'kitchen', 'room_photos/1748773456_683c2a50cfc9e.png', '2025-06-01 04:24:16', '2025-06-01 04:24:16'),
(64, 28, 'kitchen', 'room_photos/1748773456_683c2a50d8bc0.jpg', '2025-06-01 04:24:16', '2025-06-01 04:24:16'),
(65, 28, 'kitchen', 'room_photos/1748773456_683c2a50e0cbe.jpg', '2025-06-01 04:24:16', '2025-06-01 04:24:16'),
(66, 33, 'feature', 'room_photos/1764657446_692e8926ba9c6.png', '2025-12-02 00:37:26', '2025-12-02 00:37:26'),
(67, 33, 'kitchen', 'room_photos/1764657446_692e8926ce60b.png', '2025-12-02 00:37:26', '2025-12-02 00:37:26'),
(68, 33, 'kitchen', 'room_photos/1764657446_692e8926d7e04.png', '2025-12-02 00:37:26', '2025-12-02 00:37:26'),
(69, 33, 'kitchen', 'room_photos/1764657446_692e8926eda5c.png', '2025-12-02 00:37:26', '2025-12-02 00:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `small_advertises`
--

CREATE TABLE `small_advertises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `small_advertises`
--

INSERT INTO `small_advertises` (`id`, `title`, `url`, `image`, `created_at`, `updated_at`) VALUES
(1, 'sdf', '##', 'sdf-2025-01-19-678c9fc1bd739.jpg', '2025-01-19 00:46:25', '2025-01-19 00:46:55'),
(2, 'asdf', 'f', 'asdf-2025-01-19-678ca1394d089.jpg', '2025-01-19 00:52:41', '2025-01-19 00:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `super_admins`
--

CREATE TABLE `super_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'super-admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `super_admins`
--

INSERT INTO `super_admins` (`id`, `name`, `email`, `password`, `password_reset_token`, `password_reset_expires_at`, `created_at`, `updated_at`, `role`) VALUES
(1, 'EGKOM', 'egkom@gmail.com', '$2y$10$63P9aOZqdaOZrVCI14Bz9eJE4NpkorJ0bypOxenn.RGJHZ0.w8PAS', NULL, NULL, NULL, '2024-11-27 23:00:38', 'super-admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `password_reset_token`, `password_reset_expires_at`, `created_at`, `updated_at`) VALUES
(2, 'zahid', 'support@esoft.com.bd', NULL, '$2y$10$63P9aOZqdaOZrVCI14Bz9eJE4NpkorJ0bypOxenn.RGJHZ0.w8PAS', NULL, NULL, NULL, '2024-11-27 23:20:31', '2024-11-27 23:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendorId` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_dob` date DEFAULT NULL,
  `contact_person_designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel_pictures` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`hotel_pictures`)),
  `address_house` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel_category` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_hotel` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_rooms` int(11) DEFAULT NULL,
  `room_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`room_types`)),
  `legal_property_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license_bin_tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_check_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_expires_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendorId`, `hotel_name`, `contact_person_name`, `contact_person_dob`, `contact_person_designation`, `profile_picture`, `phone`, `email`, `logo`, `hotel_pictures`, `address_house`, `address_city`, `address_district`, `address_area`, `address_landmark`, `address_post_code`, `property_type`, `hotel_category`, `about_hotel`, `total_rooms`, `room_types`, `legal_property_name`, `nid`, `trade_license_bin_tin`, `bank_details`, `bank_check_picture`, `password`, `password_reset_token`, `password_reset_expires_at`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Ven-7', 'Gray Guerreroo000', 'Indira Workmann000', '1995-11-20', 'Velit aliqua Accus000', 'profile_pictures/77GOcxVDowXLRxwWrFi53RFp16afsPmlA3z5oSrU.jpg', '015524455666', 'it@esoft.com.bd', 'hotel_logos/1748406076_slider-1-2025-05-15-682572cf1f554.jpg', '[\"hotel_pictures\\/UDhrvYP53YAnkHsqHLPQ7nrpp0JonKLkMhmlD96d.png\",\"hotel_pictures\\/U4e1zD6l7FbIylhec1ZfYPInCUYGNXgeC7GxKJJc.png\",\"hotel_pictures\\/XweFRVm0UNSsCYhXHmZvGLXFSeZRfqCCx0jBGIOy.png\"]', 'Totam sit illum tot00', 'Quod similique sit', 'Dhaka', 'Dolore aut elit non', 'Consectetur id maio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Quia debitis officia', 'Laudantium alias al', 'Tenetur error quasi', 'bank_check_pictures/xealVRnBQpdewMUQVhXxbgGJ25zcNQ5J1EvOuT2p.png', '$2y$10$t2ES1eQLFcGfM1KL5AVdZu9cvnKIFtf2q.w.D7qKQ5.Fvk1mir3iq', NULL, NULL, NULL, NULL, '2024-12-05 02:28:12', '2025-05-27 22:21:16'),
(10, 'Ven-10', 'Kiara Olson', 'Xavier Simmons', '1987-04-12', 'Dolor nobis dolor il', 'profile_pictures/1eYXM2QXxoVZ0p7EsnyrnyNaaqevLiJ4sAbODeTi.jpg', '01552445566', 'jihune@mailinator.com', NULL, '[]', 'In sit velit obcaeca', 'Aliquam explicabo L', 'Dhaka', 'Vero quos sed ad nis', 'Molestiae aliquip Na', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Omnis dolor quis eaq', 'Necessitatibus in au', 'Nisi quam tempore i', NULL, '$2y$10$ENU5.b95ewDUpPgWhUsvkOIBtsnztrSmCF6JiL9y4ODXZOJCAn9c2', NULL, NULL, NULL, NULL, '2025-05-05 00:51:45', '2025-05-05 00:52:37'),
(11, 'Ven-11', 'Garrett Garrett', 'Basil Joseph', NULL, 'Sit esse sit explic', NULL, '01225447788', 'fojenemow@mailinator.com', 'hotel_logos/NyuSIG4NhaL7ztxxLj3PFifRcXEr3TdKabIGH0hd.jpg', '[]', 'Commodo ullamco anim', 'Consequat Sequi sun', 'Faridpur', NULL, 'Nulla porro natus om', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Architecto maiores e', NULL, NULL, NULL, '$2y$10$POvKAMgmep/UN83pH38UFuRGmUqX3LfZMhuvkLSwDjCdQTgyNLaJu', NULL, NULL, NULL, NULL, '2025-05-14 22:05:56', '2025-05-14 22:05:56'),
(12, 'Ven-12', 'Alvin Rojas', 'Mariko Serrano', NULL, 'Itaque fugiat minim', NULL, '01552447788', 'duhumykohe@mailinator.com', 'hotel_logos/1748405531_Gardening1--1- (1).jpg', '[]', 'Odit est repudianda', 'Culpa ut dignissimos', 'Jashore', NULL, 'Est nesciunt modi e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Aut est et ea qui ve', NULL, NULL, NULL, '$2y$10$j5IR.AaIbQyxohr8uQXsuuLZQMOUH5g22OrkE5VjxWP7cx6nccrOC', NULL, NULL, NULL, NULL, '2025-05-27 22:12:11', '2025-05-27 22:12:13'),
(13, 'Ven-13', 'wqer', '', NULL, '', '', '', 'test@test.com', '', NULL, '', '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '$2y$10$4rb3n8K0z8qxIW9NEeZinOM4jg5pyzFfOd/QLUOjcpIbXwxUNDYnq', NULL, NULL, NULL, NULL, '2025-09-03 03:05:32', '2025-09-03 03:05:32'),
(15, 'Ven-15', 'rrrr', '', NULL, '', '', '', 'tt@tt.com', '', NULL, '', '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '$2y$10$KTks6pAcxEDo5xKZAFJiSuYbL5PTYIhMHkWFkB8qpIdfGoNDOToSa', NULL, NULL, NULL, NULL, '2025-09-03 03:28:19', '2025-09-04 00:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `guest_id`, `room_id`, `created_at`, `updated_at`) VALUES
(1, 2, 28, '2025-12-02 03:16:35', '2025-12-02 03:16:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankings`
--
ALTER TABLE `bankings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `big_advertises`
--
ALTER TABLE `big_advertises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_invoice_number_unique` (`invoice_number`),
  ADD KEY `bookings_guest_id_foreign` (`guest_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guests_email_unique` (`email`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotels_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `hotel_settings`
--
ALTER TABLE `hotel_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_wishlists`
--
ALTER TABLE `hotel_wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hotel_wishlists_guest_id_hotel_id_unique` (`guest_id`,`hotel_id`),
  ADD KEY `hotel_wishlists_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nearby_areas`
--
ALTER TABLE `nearby_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `room_photos`
--
ALTER TABLE `room_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_photos_room_id_foreign` (`room_id`);

--
-- Indexes for table `small_advertises`
--
ALTER TABLE `small_advertises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admins`
--
ALTER TABLE `super_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `super_admins_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_guest_id_room_id_unique` (`guest_id`,`room_id`),
  ADD KEY `wishlists_room_id_foreign` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `bankings`
--
ALTER TABLE `bankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `big_advertises`
--
ALTER TABLE `big_advertises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `hotel_settings`
--
ALTER TABLE `hotel_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hotel_wishlists`
--
ALTER TABLE `hotel_wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `nearby_areas`
--
ALTER TABLE `nearby_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `room_photos`
--
ALTER TABLE `room_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `small_advertises`
--
ALTER TABLE `small_advertises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hotel_wishlists`
--
ALTER TABLE `hotel_wishlists`
  ADD CONSTRAINT `hotel_wishlists_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hotel_wishlists_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_photos`
--
ALTER TABLE `room_photos`
  ADD CONSTRAINT `room_photos_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
