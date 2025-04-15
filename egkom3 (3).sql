-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 07:08 AM
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
(96, 'Chrome on Windows', 'Windows', '127.0.0.1', '03:23:13', 'Logged In', '2025-04-14 21:23:13', '2025-04-14 21:23:13');

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
(1, 7, 'Bank', 'fas', 'agrani-bank-plc', '123', 'Savings', 'bank_cheques/rBbYYvW7mpJTEuoWs4g9ZD7xlP5ePU0oyA3Pze4g.jpg', '612', '700', '700', 'submitted', '2025-03-22 01:08:03', '2025-03-22 22:34:40');

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
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
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
  `check_in_window` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `custom_facilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_facilities`)),
  `facility_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nearby_areas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nearby_areas`)),
  `custom_nearby_areas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_nearby_areas`)),
  `nearby_area_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_nearby_area_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_nearby_area_details`)),
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `vendor_id`, `description`, `pets_allowed`, `pets_details`, `events_allowed`, `events_details`, `smoking_allowed`, `smoking_details`, `quiet_hours`, `photography_allowed`, `photography_details`, `check_in_window`, `check_out_time`, `food_laundry`, `check_in_rules`, `custom_check_in_rules`, `property_info`, `custom_property_info`, `age_restriction`, `age_restriction_details`, `vlogging_allowed`, `vlogging_details`, `child_policy`, `extra_bed_policy`, `cooking_policy`, `directions`, `additional_policy`, `check_in_methods`, `custom_check_in_methods`, `cancellation_policies`, `facilities`, `custom_facilities`, `facility_category`, `nearby_areas`, `custom_nearby_areas`, `nearby_area_category`, `custom_nearby_area_details`, `kitchen_photos`, `washroom_photos`, `parking_lot_photos`, `entrance_gate_photos`, `lift_stairs_photos`, `spa_photos`, `bar_photos`, `transport_photos`, `rooftop_photos`, `gym_photos`, `security_photos`, `amenities_photos`, `property_types`, `apartments`, `status`, `created_at`, `updated_at`) VALUES
(7, 7, 'Sea Pearl Beach Resort & Spa Cox\'s Bazar', 'no', NULL, 'yes', 'Repudiandae est duc', 'no', NULL, 'Asperiores id lorem', 'no', NULL, '08:00-10:00', '7:00 PM', 'yes', '[\"Pay in advance\",\"Security money for keys\",\"Rentals\"]', '[]', '[\"Guests must climb stairs\",\"No lift\\/Elevator\",\"Potential noise during stays\",\"Pet(s) live on the property\",\"No parking on the property\",\"Property has shared spaces\",\"Limited essential amenities\",\"Weapon(s) on the property\",\"Commercial shops in the building\",\"Offices in the building\"]', '[]', 'yes', 'Fugit esse sed arch', 'yes', 'Voluptatem culpa d', 'Delectus vero paria', 'Et consectetur est e', 'Tempora atque maiore', 'Ad ea odio eiusmod a', 'Ut veniam sunt fac', '[\"In-person\\/Self check-in\",\"Keypad\",\"Lockbox\"]', NULL, '[\"Non-refundable\",\"Partially refundable\",\"Long-term\\/Monthly staying policy\"]', '[\"Free Wi-Fi\",\"Hill View Or Sea View\",\"On-site restaurant\",\"Buffet Breakfast\",\"Bar\\/lounge\",\"Private Pool\",\"Fitness center & Spa services\",\"24-hour reception\",\"Parking facilities\",\"Airport shuttle service\"]', NULL, 'general', '[\"0.25 km from Navy Jetty, from where Saint Martin bound ship sails\"]', '[]', 'restaurant', NULL, '[\"hotel_photos\\/1ImlA82NkiizxGX1DZAq13WJTDtclDF0Aa38RyVy.jpg\"]', '[\"hotel_photos\\/cuvZk8Dgjc6rknPTuMEx9ST3PbqznHoA85C15Bzb.jpg\",\"hotel_photos\\/irppynQkLpe31yrwejyJiKXH34Mq1krNBLpoXhOX.jpg\",\"hotel_photos\\/oASObr1HdqG1yi7Ev9rOHBYv2ZAWSQmDBp7lVQIM.jpg\"]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', NULL, NULL, 'submitted', '2025-03-24 22:34:57', '2025-03-27 03:14:15'),
(8, 7, 'Shopno Bilash', 'no', NULL, 'no', NULL, 'yes', 'Expedita reprehender', 'Quidem sed et id vel', 'no', NULL, '08:00-10:00', '8:00 PM', 'yes', '[\"Pay in advance\",\"Security money for keys\"]', '[]', '[\"Guests must climb stairs\",\"Pet(s) live on the property\",\"No parking on the property\",\"Property has shared spaces\"]', '[]', 'yes', 'Ut est nulla placeat', 'yes', 'Sunt velit illum e', 'Ut quasi iste volupt', 'Iste ex temporibus a', 'Cillum consectetur d', 'Dolore dolor aperiam', 'Optio laboriosam a', '[\"Bell boy\",\"In-person\\/Self check-in\",\"Smart lock\"]', NULL, '[\"Non-refundable\",\"Partially refundable\",\"Long-term\\/Monthly staying policy\"]', '[\"Free Wi-Fi\",\"Hill View Or Sea View\",\"On-site restaurant\",\"Buffet Breakfast\",\"Bar\\/lounge\",\"Private Pool\",\"Fitness center & Spa services\",\"24-hour reception\",\"Parking facilities\",\"Airport shuttle service\"]', NULL, 'general', '[\"16.5 km from Himchori Waterfall\",\"0.25 km from Navy Jetty, from where Saint Martin bound ship sails\"]', '[]', 'restaurant', NULL, '[\"hotel_photos\\/kCd9ARqL3YUtf1uUot91JAbPYTU0nDfmZom7mwVH.jpg\"]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', NULL, NULL, 'submitted', '2025-03-25 00:22:54', '2025-03-27 02:52:20'),
(9, 7, 'Hotel Sea Palace', 'no', NULL, 'yes', 'Nisi amet qui in of', 'yes', 'Consequuntur adipisi', 'Alias ut inventore l', 'yes', 'Est ut consectetur', '20:00-22:00', '11:00 AM', 'no', '[\"Pay in advance\"]', '[null]', '[\"Potential noise during stays\",\"No parking on the property\",\"Weapon(s) on the property\",\"Offices in the building\"]', '[null]', 'no', NULL, 'yes', 'Beatae debitis cupid', 'Asperiores voluptate', 'Qui doloribus tempor', 'Dolor a inventore no', 'Eum possimus libero', 'Distinctio Magnam o', '[\"Building staff\",\"Housekeeping\",\"Bell boy\",\"Keypad\",\"Lockbox\"]', NULL, '[\"Flexible\",\"Non-refundable\",\"Long-term\\/Monthly staying policy\"]', '[\"Free Wi-Fi\",\"Hill View Or Sea View\",\"On-site restaurant\",\"Buffet Breakfast\",\"Bar\\/lounge\",\"Private Pool\",\"Fitness center & Spa services\",\"24-hour reception\",\"Parking facilities\",\"Airport shuttle service\"]', NULL, 'general', '[\"16.5 km from Himchori Waterfall\",\"0.25 km from Navy Jetty, from where Saint Martin bound ship sails\"]', '[null]', 'restaurant', NULL, '[\"hotel_photos\\/fH5FyGf47XvgErVovJRXnFMnDp1fZvCd98LOsr5i.jpg\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', '2025-03-26 21:59:49', '2025-03-26 21:59:49'),
(12, 7, 'Aut dignissimos temp', 'no', NULL, 'no', NULL, 'no', NULL, 'Laborum Quia reicie', 'no', NULL, '00:00-02:00', '11:00 PM', 'no', '[\"Pay in advance\",\"Security money for keys\"]', '[]', '[\"Guests must climb stairs\",\"Potential noise during stays\",\"No parking on the property\",\"Property has shared spaces\",\"Limited essential amenities\",\"Weapon(s) on the property\",\"Commercial shops in the building\",\"Offices in the building\"]', '[]', 'yes', 'Nisi dolor culpa num', 'yes', 'Incididunt reprehend', 'Reprehenderit enim', 'Voluptas non omnis u', 'Enim quia quia recus', 'Nihil commodi volupt', 'Qui et atque natus N', '[\"Housekeeping\",\"Bell boy\",\"Smart lock\",\"Keypad\"]', '[\"saf sdaf\"]', '[\"Non-refundable\",\"Partially refundable\",\"Long-term\\/Monthly staying policy\"]', '[\"Free Wi-Fi\",\"Hill View Or Sea View\",\"On-site restaurant\",\"Buffet Breakfast\",\"Bar\\/lounge\",\"Private Pool\",\"Fitness center & Spa services\",\"24-hour reception\",\"Parking facilities\",\"Airport shuttle service\"]', NULL, 'room', '[\"16.5 km from Himchori Waterfall\",\"0.25 km from Navy Jetty, from where Saint Martin bound ship sails\"]', '[\"sf\",\"zzzzzzzzzz\"]', 'entertainment', NULL, '[\"hotel_photos\\/MhyGHY5ibdrl7TjUYJD9ozUcXsJ5ijC1zBIEUd5x.jpg\",\"hotel_photos\\/vbkVtmCQs0yOYWwD1LpkiMT1v1W2RCN2VGsZHlkM.jpg\"]', '[\"hotel_photos\\/sw8O6PvfFFAdO17e4pXJSkGkfyL15xmV8BtZmMaH.jpg\",\"hotel_photos\\/wbm8xBr4ZIQBxLK2SYaiWJft6KK967Ui6Va3DkhQ.jpg\"]', '[\"hotel_photos\\/STWN2UdGXTyWOA39SgcEpB83YWOmCHNurDHwTwLM.png\"]', '[\"hotel_photos\\/FcMkUsTTjUw3A0dwOVydsEXA04cmu18e7acWk0cv.jpg\"]', '[\"hotel_photos\\/wJXDyM0z9faI1jsutLQ3vAEGZmi55aGz1WOejRai.png\"]', '[\"hotel_photos\\/HxTXPeZ5wPDeXgQMW5PwACkwI1h4i0zNmBIBhIbw.jpg\"]', '[\"hotel_photos\\/U9YgfpW63E5kNNiqpGZ8fU6V9DgfV0JJPRBWtZHG.jpg\"]', '[\"hotel_photos\\/RLCa3GhPW1EwGnYd6oOrmApXadd2Qw0m78Evy7BW.jpg\"]', '[\"hotel_photos\\/JFruNNWFaCRRcsDIS1GAJTpkMBFkr1QdPb1RxlTO.jpg\"]', '[\"hotel_photos\\/QRYfEVYYLrTgs6FMx4B536aoTgm5z8mscXMvysnz.jpg\",\"hotel_photos\\/AkcXpf0IY4EAdPwBB9idvIi3VYL9cqGxw4A8VYlF.jpg\",\"hotel_photos\\/lilOkEyDp6B6NyBhuQV6u6oosM54GLOv097hkwWY.jpg\",\"hotel_photos\\/ZAX736d1CdLEHHWodHMDncgviRyXijGy0ReypdeO.jpg\",\"hotel_photos\\/OLL6ReASxxayhHhUe4G6z1LZnOGT5Jdm86kiGeCZ.jpg\",\"hotel_photos\\/gzTqyQkRWB8ooRyYambji3UfmUF17jMybom3RnO1.png\",\"hotel_photos\\/LajdmXI7EaG9JakpDwYGoPKCH0YzuzElCAJRXQlU.png\",\"hotel_photos\\/oUkufqRgB5B3IGgTNeGvnNuxY8CsQszgCe0lS4Xk.png\",\"hotel_photos\\/JqmeJYSqrUQmvJ4DZJZX5eRPXzfL3h7TDhGQvpIE.jpg\",\"hotel_photos\\/ZI8IXLzTDvvUecfTIogToNYQYURmwSHmBhEQdIH2.jpg\"]', '[\"hotel_photos\\/faFnwuL6uhOwVuhMkxdO9vAWpRh4OmoDr6sQblv9.png\"]', '[\"hotel_photos\\/Me5Asl4DXK5kjOGn4XCfHdlz54F3rkdLnb4m1P8R.png\"]', NULL, NULL, 'draft', '2025-03-27 00:10:30', '2025-03-27 02:58:25'),
(13, 7, 'Dicta error in solut', 'yes', 'Dolores voluptates m', 'yes', 'Excepteur omnis elit', 'no', NULL, 'Eligendi vel pariatu', 'yes', 'Id incididunt ducim', '16:00-18:00', '7:00 PM', 'no', '[\"Pay in advance\",\"Rentals\"]', '[null]', '[\"Guests must climb stairs\",\"No lift\\/Elevator\",\"Pet(s) live on the property\",\"No parking on the property\",\"Offices in the building\"]', '[null]', 'yes', 'Ratione rerum molest', 'no', NULL, 'Et aspernatur impedi', 'Voluptatibus tenetur', 'Officiis et cupidata', 'Eos consequat Atque', 'Hic a pariatur Occa', '[\"Bell boy\",\"Smart lock\",\"Keypad\"]', NULL, '[\"Flexible\",\"Partially refundable\",\"Long-term\\/Monthly staying policy\"]', NULL, NULL, 'general', '[\"16.5 km from Himchori Waterfall\",\"0.25 km from Navy Jetty, from where Saint Martin bound ship sails\"]', '[null]', 'restaurant', '[\"qweqw\",\"13123\"]', '[\"hotel_photos\\/Q315bOwrYWEmgL4LkHjfX6cG0az6YGBzKuagISMH.jpg\",\"hotel_photos\\/YsZ4JTBufXqbgj36MV6vbqBW3hM5iFpDWphCZe2Z.jpg\",\"hotel_photos\\/mOq0cj1twDJSzhgmGbXMwvztmLTJGuBFVOeeWzlC.png\"]', '[\"hotel_photos\\/Ztie5gERSMdNARsDcdAr8KGQ6lLqJ1tDdEEilAd0.jpg\"]', '[\"hotel_photos\\/zgdcIpbQnGJotCSehOeT5ekS1S6OiGHqOddip6M9.jpg\",\"hotel_photos\\/XiXBvh9OjsUAyQophYh7Snxf7DU6BDYyabWbBI4O.png\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', '2025-03-27 03:12:38', '2025-03-27 03:12:38');

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
(36, '2025_04_07_082752_create_room_photos_table', 14);

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
(6, 'Ariana Stein', 7, '678', 'Commercial', 'qeqw', 'qe', 'qweqwe', '234234', '2005-06-15', '530', 'Sit corporis natus d', 'Autem amet placeat', 'Proprietorship', NULL, NULL, NULL, NULL, NULL, 'https://www.vyxelidafoqujew.tv', 'https://www.vyxelidafoqujew.tv', NULL, NULL, 'submitted', '2025-03-22 22:36:10', '2025-03-23 00:06:55');

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

INSERT INTO `properties` (`id`, `vendor_id`, `property_name`, `property_category`, `property_type`, `room_types`, `country_name`, `district_name`, `city_town_village`, `postcode`, `house_number`, `road_number_name`, `building_age`, `building_size`, `building_stories`, `landmark_details`, `google_map_link`, `company_logo`, `apartment_count`, `apartments`, `total_capacity`, `car_parking`, `has_reception`, `elevators`, `generators`, `fire_exits`, `wheelchair_access`, `male_housekeeping`, `female_housekeeping`, `has_kids_zone`, `kids_zone_count`, `view_type`, `security_guards`, `has_cafe_restaurant`, `cafe_restaurant_count`, `cafe_restaurant_names`, `has_pool`, `pool_count`, `has_bar`, `bar_count`, `has_gym`, `gym_count`, `has_party_center`, `party_center_details`, `has_conference_hall`, `conference_hall_details`, `status`, `created_at`, `updated_at`) VALUES
(15, 7, 'Veronica Berry', 'Hotels', 'hotel', '[\"Single Room\",\"Double Room\",\"Twin Room\",\"Suite\",\"Family Room\",\"Penthouse Suite\",\"Accessible Room\"]', 'Bangladesh', 'Gopalganj', 'Atque assumenda volu', 'Saepe qui incididunt', '712', 'Kalia Davenport', 2008, 18, 10, 'Voluptatem porro vol', 'Quos labore eum quas', 'storage/logos/1742619391_logo.png', 3, '[{\"name\":\"123123\",\"number\":\"123\",\"floor\":\"123\"},{\"name\":\"1233\",\"number\":\"123\",\"floor\":\"123\"},{\"name\":\"123\",\"number\":\"123\",\"floor\":\"123\"}]', 234, 234, 1, 4, 3, 1, 0, 1, 2, 0, NULL, 'sdf sadf', 4, 1, NULL, '[]', 1, 1, 1, 1, 1, 1, 1, 'asdf asdf', 1, 'wer wer', 'submitted', '2025-03-20 02:00:59', '2025-03-23 00:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_number` int(11) NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `weekend_price` decimal(10,2) DEFAULT NULL,
  `holiday_price` decimal(10,2) DEFAULT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_value` decimal(10,2) DEFAULT NULL,
  `total_persons` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) NOT NULL,
  `total_rooms` int(11) NOT NULL,
  `total_washrooms` int(11) NOT NULL,
  `total_beds` int(11) NOT NULL,
  `wifi_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appliances` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`appliances`)),
  `furniture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`furniture`)),
  `amenities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`amenities`)),
  `cancellation_policy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel_id`, `name`, `number`, `floor_number`, `price_per_night`, `weekend_price`, `holiday_price`, `discount_type`, `discount_value`, `total_persons`, `description`, `size`, `total_rooms`, `total_washrooms`, `total_beds`, `wifi_details`, `appliances`, `furniture`, `amenities`, `cancellation_policy`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(13, 7, 'Germane Hopkins', '3833', 515, '676.00', '840.00', '978.00', 'percentage', NULL, 0, 'Ut neque harum volup', 84, 0, 0, 0, 'Labore exercitatione', '\"[\\\"AC\\\",\\\"Fan\\\",\\\"Light\\\",\\\"Water heater\\\\\\/Geyser\\\",\\\"Crockeries\\\",\\\"Room Heater\\\",\\\"Hair Dryer\\\"]\"', '\"[\\\"Dining Table with Chair\\\",\\\"Sofa\\\\\\/Couch\\\",\\\"Tea Table\\\",\\\"Clothing Cabinet\\\",\\\"Iron Stand\\\",\\\"Locker\\\\\\/Safe\\\"]\"', '\"[\\\"Shampoo\\\",\\\"Towel\\\",\\\"Water bottle\\\",\\\"Fruit basket\\\",\\\"Complimentary drinks\\\"]\"', NULL, 1, 'published', '2025-04-08 04:11:47', '2025-04-13 00:54:50'),
(15, 7, 'Lunea Carr', '675', 240, '750.00', '33.00', '225.00', 'percentage', NULL, 0, 'Vel adipisci id qui', 48, 0, 0, 0, 'Nisi vitae est aut e', '\"[\\\"Hair Dryer\\\"]\"', '\"[\\\"Sofa\\\\\\/Couch\\\",\\\"Tea Table\\\",\\\"Bedside Table\\\",\\\"Locker\\\\\\/Safe\\\"]\"', '\"[\\\"Tissue\\\",\\\"Shampoo\\\",\\\"Free laundry\\\",\\\"Complimentary drinks\\\",\\\"Add\\\\\\/type Manually\\\"]\"', NULL, 0, 'published', '2025-04-08 04:51:30', '2025-04-08 04:51:30'),
(16, 7, 'Merrill Williams', '394', 820, '30.00', '227.00', '637.00', 'percentage', NULL, 0, 'Vel illum totam ven', 21, 0, 0, 0, 'Modi qui nisi ea min', '\"[\\\"AC\\\",\\\"TV\\\",\\\"Fridge\\\",\\\"Microwave\\\",\\\"Fan\\\",\\\"Lamp\\\",\\\"Room Heater\\\",\\\"1111\\\",\\\"333\\\"]\"', '\"[\\\"Bed\\\",\\\"Tea Table\\\",\\\"Bedside Table\\\",\\\"Clothes Drying Hanger\\\",\\\"Iron Stand\\\"]\"', '\"[\\\"Soap\\\",\\\"Shampoo\\\",\\\"Toothbrush\\\",\\\"Towel\\\",\\\"Water bottle\\\",\\\"Complimentary drinks\\\",\\\"Buffet breakfast\\\"]\"', NULL, 0, 'drafted', '2025-04-10 00:32:50', '2025-04-10 00:32:50'),
(17, 7, 'Beverly Pratt', '772', 364, '692.00', '975.00', '723.00', 'amount', NULL, 0, 'Est dolor illum ess', 30, 0, 0, 0, 'Provident irure et', '\"[\\\"AC\\\",\\\"TV\\\",\\\"Fridge\\\",\\\"Fan\\\",\\\"Lamp\\\",\\\"Light\\\",\\\"Water heater\\\\\\/Geyser\\\",\\\"WiFi Router\\\",\\\"Gas Stove\\\",\\\"Electric Kettle\\\",\\\"Room Heater\\\",\\\"11\\\",\\\"22\\\"]\"', '\"[\\\"Bed\\\",\\\"Dining Table with Chair\\\",\\\"Tea Table\\\",\\\"Bedside Table\\\",\\\"Shoe Rack\\\",\\\"Iron Stand\\\",\\\"333\\\",\\\"44\\\"]\"', '\"[\\\"Soap\\\",\\\"Tissue\\\",\\\"Toothbrush\\\",\\\"Towel\\\",\\\"Air freshener\\\",\\\"Fruit basket\\\",\\\"Complimentary drinks\\\",\\\"Buffet breakfast\\\"]\"', NULL, 0, 'published', '2025-04-10 01:01:00', '2025-04-10 01:01:00'),
(19, 7, 'Winter Stone', '390', 873, '942.00', '371.00', '437.00', 'amount', NULL, 0, 'Ut occaecat quia eni', 97, 0, 0, 0, 'Dignissimos vel labo', '\"[\\\"AC\\\",\\\"Microwave\\\",\\\"Fan\\\",\\\"Lamp\\\",\\\"Light\\\",\\\"Water heater\\\\\\/Geyser\\\",\\\"WiFi Router\\\",\\\"Crockeries\\\",\\\"Electric Kettle\\\"]\"', '\"[\\\"Sofa\\\\\\/Couch\\\",\\\"Tea Table\\\",\\\"Shoe Rack\\\",\\\"Clothing Cabinet\\\",\\\"Clothes Drying Hanger\\\",\\\"Iron Stand\\\"]\"', '\"[\\\"Soap\\\",\\\"Tissue\\\",\\\"Shampoo\\\",\\\"Toothbrush\\\",\\\"Towel\\\",\\\"Air freshener\\\",\\\"Fruit basket\\\",\\\"Add\\\\\\/type Manually\\\"]\"', NULL, 0, 'published', '2025-04-13 01:37:07', '2025-04-13 01:37:07'),
(20, 7, 'Madeson Fletcher', '639', 975, '79.00', '633.00', '599.00', 'percentage', NULL, 0, 'Est dolorem consequu', 7, 0, 0, 0, 'Excepteur quidem sun', '\"[\\\"AC\\\",\\\"Fan\\\",\\\"Lamp\\\",\\\"WiFi Router\\\",\\\"Crockeries\\\",\\\"Room Heater\\\",\\\"Hair Dryer\\\"]\"', '\"[\\\"Dining Table with Chair\\\",\\\"Sofa\\\\\\/Couch\\\",\\\"Tea Table\\\",\\\"Shoe Rack\\\",\\\"Clothes Drying Hanger\\\"]\"', '\"[\\\"Soap\\\",\\\"Tissue\\\",\\\"Water bottle\\\",\\\"Free laundry\\\",\\\"Air freshener\\\",\\\"Fruit basket\\\"]\"', '[\"partially_refundable\"]', 0, 'published', '2025-04-13 02:23:16', '2025-04-13 02:23:16'),
(21, 7, 'Kevyn Mcbride', '966', 202, '623.00', '938.00', '56.00', 'amount', NULL, 0, 'Sint est duis delec', 14, 0, 0, 0, 'Aute cupidatat ratio', '\"[\\\"AC\\\",\\\"TV\\\",\\\"Fridge\\\",\\\"Lamp\\\",\\\"Crockeries\\\",\\\"Gas Stove\\\"]\"', '\"[\\\"Bed\\\",\\\"Dining Table with Chair\\\",\\\"Sofa\\\\\\/Couch\\\",\\\"Tea Table\\\",\\\"Bedside Table\\\",\\\"Shoe Rack\\\",\\\"Clothes Drying Hanger\\\",\\\"Iron Stand\\\"]\"', '\"[\\\"Tissue\\\",\\\"Shampoo\\\",\\\"Water bottle\\\",\\\"Air freshener\\\",\\\"Fruit basket\\\",\\\"Complimentary drinks\\\",\\\"Buffet breakfast\\\"]\"', '[\"non_refundable\",\"partially_refundable\"]', 1, 'published', '2025-04-13 03:54:22', '2025-04-13 03:54:22'),
(22, 7, 'Nash Stephenson', '573', 919, '150.00', '604.00', '950.00', 'percentage', NULL, 0, 'Beatae cillum nostru', 2, 0, 0, 0, 'Vel et suscipit eum', '\"[\\\"AC\\\",\\\"TV\\\",\\\"Lamp\\\",\\\"Light\\\",\\\"Water heater\\\\\\/Geyser\\\",\\\"Crockeries\\\",\\\"Gas Stove\\\",\\\"Electric Kettle\\\"]\"', '\"[\\\"Bed\\\",\\\"Dining Table with Chair\\\",\\\"Bedside Table\\\",\\\"Shoe Rack\\\",\\\"Clothing Cabinet\\\",\\\"Clothes Drying Hanger\\\"]\"', '\"[\\\"Soap\\\",\\\"Shampoo\\\",\\\"Fruit basket\\\",\\\"Buffet breakfast\\\",\\\"Add\\\\\\/type Manually\\\"]\"', '[\"flexible\",\"long_term\"]', 1, 'published', '2025-04-13 03:59:24', '2025-04-13 03:59:24'),
(23, 7, 'Bianca Rosee', '8477', 638, '978.00', '630.00', '661.00', 'percentage', NULL, 0, 'Voluptatem quia vol', 11, 0, 0, 0, 'Fugit numquam maior', '\"[\\\"Fan\\\",\\\"Light\\\",\\\"Crockeries\\\"]\"', '\"[\\\"Dining Table with Chair\\\",\\\"Sofa\\\\\\/Couch\\\",\\\"Shoe Rack\\\"]\"', '\"[\\\"Soap\\\",\\\"Toothbrush\\\",\\\"Water bottle\\\",\\\"Free laundry\\\",\\\"Fruit basket\\\",\\\"Complimentary drinks\\\",\\\"Add\\\\\\/type Manually\\\"]\"', '[\"non_refundable\",\"long_term\"]', 0, 'published', '2025-04-13 04:04:07', '2025-04-14 22:39:14');

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
(6, 13, 'kitchen', 'room_photos/sOPlsjoRpO664LNZtCqeyWxx4AIBzYDUVpYqJX2h.jpg', '2025-04-08 04:11:48', '2025-04-08 04:11:48'),
(7, 13, 'washroom', 'room_photos/aAkLMQmW1SyuqntHtjjkn4mZKm5ULp9oeajMLGam.jpg', '2025-04-08 04:11:48', '2025-04-08 04:11:48'),
(12, 15, 'kitchen', 'room_photos/QVfjMGTz4ajsg6xob6HCqB2lIaYsQRBWBu7nmRCH.jpg', '2025-04-08 04:51:30', '2025-04-08 04:51:30'),
(13, 16, 'kitchen', 'room_photos/g2w7SZGHj58j2zstFGvKOUfmtjsGKoF39I72FKh2.jpg', '2025-04-10 00:32:51', '2025-04-10 00:32:51'),
(14, 16, 'kitchen', 'room_photos/RxMsPAQh71MvGSc3TH3sKFbzFX7AauFoXafGcKhd.jpg', '2025-04-10 00:32:51', '2025-04-10 00:32:51'),
(17, 13, 'parking', 'room_photos/bAKVzElIqleIECpCkGNgLI77vcuwYplMBgCIO0kN.jpg', '2025-04-13 00:54:50', '2025-04-13 00:54:50'),
(18, 13, 'washroom', 'room_photos/IisG6ab9lrJOx5JTAScN1VQIVb6h2FwDZqkzA8Yc.jpg', '2025-04-13 01:13:19', '2025-04-13 01:13:19'),
(19, 13, 'washroom', 'room_photos/XCJyzbPPQjR1n3n5U57SEVLNojdHQJ2KwOrFkyZ7.jpg', '2025-04-13 01:13:19', '2025-04-13 01:13:19'),
(21, 19, 'kitchen', 'room_photos/XzSaJvLYvjFL8xvg0CXW3hT8pNCGcc1Abu4mXVr6.jpg', '2025-04-13 01:37:07', '2025-04-13 01:37:07'),
(22, 20, 'kitchen', 'room_photos/uKaLuUzyndRtT6IHxjwGyiHrsALF11JNnKrumKrC.jpg', '2025-04-13 02:23:16', '2025-04-13 02:23:16'),
(31, 23, 'kitchen', 'room_photos/ABwPLIj8MmqMu0kvbGezdRlvRHgMaXyB0OO8ziuz.jpg', '2025-04-14 22:38:24', '2025-04-14 22:38:24'),
(33, 23, 'kitchen', 'room_photos/w5iubbkCObPkh9N12DRveEq5UHhKiwHhrTz9Qz6B.jpg', '2025-04-14 22:38:24', '2025-04-14 22:38:24');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'super-admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `super_admins`
--

INSERT INTO `super_admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'EGKOM', 'egkom@gmail.com', '$2y$10$63P9aOZqdaOZrVCI14Bz9eJE4NpkorJ0bypOxenn.RGJHZ0.w8PAS', NULL, '2024-11-27 23:00:38', 'super-admin');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'zahid', 'support@esoft.com.bd', NULL, '$2y$10$63P9aOZqdaOZrVCI14Bz9eJE4NpkorJ0bypOxenn.RGJHZ0.w8PAS', NULL, '2024-11-27 23:20:31', '2024-11-27 23:20:31');

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
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendorId`, `hotel_name`, `contact_person_name`, `contact_person_dob`, `contact_person_designation`, `profile_picture`, `phone`, `email`, `logo`, `hotel_pictures`, `address_house`, `address_city`, `address_district`, `address_area`, `address_landmark`, `address_post_code`, `property_type`, `hotel_category`, `about_hotel`, `total_rooms`, `room_types`, `legal_property_name`, `nid`, `trade_license_bin_tin`, `bank_details`, `bank_check_picture`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Ven-7', 'Gray Guerreroo', 'Indira Workmann', '1995-11-20', 'Velit aliqua Accus', 'profile_pictures/GEPdVvmiYuokST8durudEsbt0dVR65RGLr23YAS6.png', '015524455666', 'it@esoft.com.bd', 'hotel_logos/ZaPbXV3XYgWRsqif25OrNfOP0ixYDPXqGofQeozv.png', '[\"hotel_pictures\\/UDhrvYP53YAnkHsqHLPQ7nrpp0JonKLkMhmlD96d.png\",\"hotel_pictures\\/U4e1zD6l7FbIylhec1ZfYPInCUYGNXgeC7GxKJJc.png\",\"hotel_pictures\\/XweFRVm0UNSsCYhXHmZvGLXFSeZRfqCCx0jBGIOy.png\"]', 'Totam sit illum tot', 'Quod similique sit', 'A cumque voluptatum', 'Dolore aut elit non', 'Consectetur id maio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Quia debitis officia', 'Laudantium alias al', 'Tenetur error quasi', 'bank_check_pictures/xealVRnBQpdewMUQVhXxbgGJ25zcNQ5J1EvOuT2p.png', '$2y$10$8VFJetMGnncZbB32xqFduOzjaUJ0BozzHhOgFNgBne0q1NJiS/ioC', NULL, NULL, '2024-12-05 02:28:12', '2025-03-16 22:25:01');

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hotel_settings`
--
ALTER TABLE `hotel_settings`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `room_photos`
--
ALTER TABLE `room_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
