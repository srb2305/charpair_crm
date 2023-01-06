-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2023 at 03:29 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charpair_telecalling`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` bigint(15) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `name`, `contact`, `email`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'test5', 855665455, 'test5@gmail.com', 1, '1', '2023-01-04 07:41:19', '2023-01-05 01:35:25'),
(2, 'test6', 65221566, 'test16@gmail.com', 1, '1', '2023-01-04 07:41:19', '2023-01-04 07:41:19'),
(3, 'test7', 8899999, 'test7@gmail.com', 1, '1', '2023-01-04 07:41:19', '2023-01-04 07:41:19'),
(6, 'test6', 65221566, 'test16@gmail.com', 1, '1', '2023-01-04 07:54:04', '2023-01-04 07:54:04'),
(10, 'test5', 855665455, 'test5@gmail.com', 0, '7', '2023-01-06 02:26:56', '2023-01-06 07:27:15'),
(11, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 02:26:56', '2023-01-06 02:26:56'),
(12, 'test7', 8899999, 'test7@gmail.com', 1, '7', '2023-01-06 02:26:56', '2023-01-06 02:26:56'),
(13, 'test5', 855665455, 'test5@gmail.com', 1, '7', '2023-01-06 03:54:10', '2023-01-06 03:54:10'),
(14, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 03:54:10', '2023-01-06 03:54:10'),
(15, 'test7', 8899999, 'test7@gmail.com', 1, '7', '2023-01-06 03:54:10', '2023-01-06 03:54:10'),
(16, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 03:54:10', '2023-01-06 03:54:10'),
(17, 'test04jan', 985224551, 'test04jan@gmail.com', 1, '7', '2023-01-06 03:54:10', '2023-01-06 03:54:10'),
(18, 'test05jan', 9854224, 'test@05gmai.com', 1, '7', '2023-01-06 03:54:10', '2023-01-06 03:54:10'),
(19, 'test5', 855665455, 'test5@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(20, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(21, 'test7', 8899999, 'test7@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(22, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(23, 'test04jan', 985224551, 'test04jan@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(24, 'test05jan', 9854224, 'test@05gmai.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(25, 'test5', 855665455, 'test5@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(26, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(27, 'test7', 8899999, 'test7@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(28, 'test5', 855665455, 'test5@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(29, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(30, 'test7', 8899999, 'test7@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(31, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(32, 'test04jan', 985224551, 'test04jan@gmail.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(33, 'test05jan', 9854224, 'test@05gmai.com', 1, '7', '2023-01-06 03:55:34', '2023-01-06 03:55:34'),
(34, 'test5', 855665455, 'test5@gmail.com', 1, '7', '2023-01-06 07:42:17', '2023-01-06 07:42:17'),
(35, 'test6', 65221566, 'test16@gmail.com', 1, '7', '2023-01-06 07:42:18', '2023-01-06 07:42:18'),
(36, 'test7', 8899999, 'test7@gmail.com', 1, '7', '2023-01-06 07:42:18', '2023-01-06 07:42:18'),
(37, 'test8', 987456321, 'test@gmail.com', 1, '7', '2023-01-06 07:42:18', '2023-01-06 07:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `lead_comments`
--

CREATE TABLE `lead_comments` (
  `id` int(12) NOT NULL,
  `lead_id` int(12) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `added_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lead_comments`
--

INSERT INTO `lead_comments` (`id`, `lead_id`, `comment`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'hello', 7, '2022-12-30 09:54:41', NULL),
(2, 2, 'hello', 7, '2022-12-30 09:55:56', NULL),
(6, NULL, NULL, 7, '2022-12-30 11:31:35', NULL),
(8, 6, 'yes im in', 7, '2022-12-30 12:08:19', NULL),
(9, 2, 'hay', 7, '2022-12-30 12:20:45', NULL),
(10, 2, 'hey', 7, '2022-12-30 12:21:31', NULL),
(11, 6, 'hey', 7, '2022-12-30 12:23:20', NULL),
(12, 6, 'hello', 7, '2022-12-30 12:26:10', NULL),
(13, 6, 'hey', 7, '2022-12-30 12:26:49', NULL),
(14, 8, 'test', 7, '2022-12-30 12:31:18', NULL),
(47, 5, 'hey', 7, '2022-12-30 12:53:07', NULL),
(48, 5, 'hey', 7, '2022-12-30 12:53:07', NULL),
(84, 5, 'hey', 7, '2022-12-30 12:53:17', NULL),
(85, 7, 'heyy', 7, '2022-12-30 12:53:53', NULL),
(86, 10, 'dlfbgf', 7, '2022-12-30 12:55:37', NULL),
(87, 1, 'ss', 7, '2022-12-30 12:56:07', NULL),
(88, 1, 'hh', 7, '2022-12-30 12:56:18', NULL),
(89, 1, 'gg', 7, '2022-12-30 13:01:01', NULL),
(90, 1, 'hh', 7, '2022-12-30 13:05:26', NULL),
(91, 1, 'jjjj', 7, '2022-12-30 13:05:33', NULL),
(92, 1, 'abc', 7, '2022-12-30 13:30:22', NULL),
(93, 2, 'first', 7, '2022-12-30 13:44:47', NULL),
(94, 6, 'first', 7, '2022-12-30 13:47:47', NULL),
(96, 2, 'How can I make bootstrap table rendered inside modal scrollable with fixed header? Currently my modal-body is scrollable which makes table header disappear on scrolling.', 7, '2022-12-30 13:54:09', NULL),
(97, 8, 'How can I make bootstrap table rendered inside modal scrollable with fixed header? Currently my modal-body is scrollable which makes table header disappear on scrolling.How can I make bootstrap table rendered inside modal scrollable with fixed header? Currently my modal-body is scrollable which makes table header disappear on scrolling.', 7, '2022-12-30 14:13:27', NULL),
(98, 8, 'How can I make bootstrap table rendered inside modal scrollable with fixed header? Currently my modal-body is scrollable which makes table header disappear on scrolling.How can I make bootstrap table rendered inside modal scrollable with fixed header? Currently my modal-body is scrollable which makes table header disappear on scrolling.', 7, '2022-12-30 14:25:54', NULL),
(99, 2, 'hey 04 jan', 1, '2023-01-04 13:43:47', NULL),
(100, 1, 'heyyyyy', 1, '2023-01-04 13:44:20', NULL),
(101, 1, 'hello', 7, '2023-01-05 07:37:06', NULL),
(102, 9, 'heyy', 7, '2023-01-05 08:02:16', NULL),
(103, 6, '5 jan', 7, '2023-01-05 08:02:29', NULL),
(104, 11, 'hello', 49, '2023-01-06 13:18:41', NULL),
(105, 10, 'helllo', 49, '2023-01-06 13:23:03', NULL),
(106, 10, 'heyyy', 49, '2023-01-06 13:23:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lead_task`
--

CREATE TABLE `lead_task` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `lead_from` int(11) DEFAULT NULL,
  `lead_to` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=pending, 1=inprocess, 2=complete, 3=hold',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_start_date` date DEFAULT NULL,
  `task_end_date` date DEFAULT NULL,
  `assign_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead_task`
--

INSERT INTO `lead_task` (`id`, `user_id`, `date_from`, `date_to`, `lead_from`, `lead_to`, `status`, `description`, `task_start_date`, `task_end_date`, `assign_by`, `created_at`, `updated_at`) VALUES
(1, 49, '2023-01-05', '2023-01-07', 10, 20, 0, NULL, NULL, NULL, '7', NULL, '2023-01-06 12:28:50'),
(2, 49, '2023-01-05', '2023-01-10', 25, 30, NULL, NULL, NULL, NULL, '7', '2023-01-06 11:39:01', '2023-01-06 12:25:22'),
(3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', '2023-01-06 11:43:26', '2023-01-06 11:43:53');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2023_01_04_114401_leads', 2),
(6, '2023_01_04_133454_lead_comments', 3),
(7, '2023_01_05_061713_roles', 4),
(8, '2023_01_06_100947_lead_task', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.com', '$2y$10$sAzPv06RKC4Zy8KeWUGHSea.nOh2wExce9PmMYa9BhA54iyQ7L2oy', '2023-01-05 05:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', NULL, NULL),
(2, 'telecaller', 'Telecaller', 'Telecaller', NULL, NULL),
(3, 'salesperson', 'Sales Person', 'Sales Person', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sos` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 6,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `govt_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `about_me` text CHARACTER SET utf8 DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `notification_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_email_public` int(1) NOT NULL DEFAULT 1,
  `is_dob_public` int(1) NOT NULL DEFAULT 1,
  `is_contact_public` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `mobile`, `sos`, `email`, `email_verified_at`, `password`, `remember_token`, `otp`, `gender`, `role_id`, `image`, `govt_id`, `designation`, `department`, `company`, `dob`, `about_me`, `status`, `notification_id`, `api_token`, `google_token`, `fb_token`, `driver_details`, `is_email_public`, `is_dob_public`, `is_contact_public`, `created_at`, `updated_at`) VALUES
(6, 'Anjaan', 'anjaan', '8962134733', NULL, 'anjaan@gmail.com', NULL, NULL, NULL, '198055', NULL, 6, NULL, NULL, 'developer', NULL, NULL, NULL, 'aGVsbG8gaGk=', 0, 'dXuHP35XSzaf4KfEoUj8-M:APA91bEAXJ8Ces_rM6yrPuC59zllCroPS83wxB0N5cn2DQqPv94OHMQ0Qufuz00UyIFnyrPdsmRlxEGchjlLsOELGJUN7Eh-eDQ2T49-w2BeF9apEXcPdKEH-sw588rr_h5nZ6iINVjv', 'knuhwA9Ocw2KR2DZy6ncYVptxncHgwPCRL3WOXVgseNxdvidq3bmNszbonjP', NULL, NULL, NULL, 0, 0, 0, '2022-10-31 09:24:20', '2022-10-31 10:09:31'),
(7, 'admin', 'admin', '9898989858', NULL, 'admin@admin.com', NULL, '$2y$10$r3nBl8xcwYNBvUMwGyuU1.U4cui7qzgwCiLxk6uo5E15zUxze/Lai', 'opjVxI7wfH8yjFiLQj8nAIHQyg2eKVAroDiPZBeeNKDf1O5BdYHJwuhAf4ee', NULL, 'Female', 1, 'default_1672982130.png', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '2023-01-06 13:17:04'),
(10, NULL, NULL, '9755985661', NULL, NULL, NULL, NULL, NULL, '972581', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'e_uNlAnESHihlQ6L_gESlR:APA91bEGxrQcdrpPlm8XJPrsIh12NSOawJQRcRZzDcesCKh58_oDIF52wbxR_zaypLD3BCAaMyIF0_mOGZjhlxTKcGOknGb9kyBDywJws2SO1nCGy0rC1iYBBxlLWa4yCyxmddn_TD1_', '8fkE425ZBQ4Jm0519FW7cXblzPPA3TTwDC5cECqpD9x5qROoRUKXjqL917c4', NULL, NULL, NULL, 1, 1, 1, '2022-11-07 23:54:40', '2022-11-08 22:30:46'),
(37, 'test', 'testuser', '9999999', '888888', 'test12@gmail.com', NULL, '$2y$10$PHjV68GS5GVWIQ2nwYkz8u7aS/0OO8yxip2fE6nDgEx9mi9UMKM9G', NULL, NULL, NULL, 2, 'null', NULL, 'telecaller', 'telecaller', 'char pair', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2023-01-02 12:05:39', '2023-01-06 07:39:52'),
(40, 'ram', 'adminm', '78237238', '873737373', 'ram@gmail.com', NULL, '$2y$10$eqTUnXR70fd0AU9ACd0YXOpz4o88Mstl8v4jxc1lJqXycT0CpAebC', NULL, NULL, 'male', 3, '1672665252.jpg', NULL, 'salesperson', 'marketing', 'char pair', '2023-01-01', NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2023-01-02 13:14:12', '2023-01-05 06:40:31'),
(42, 'test23', '282', '8237233', '727887', 'test232@gmail.com', NULL, '$2y$10$PHjV68GS5GVWIQ2nwYkz8u7aS/0OO8yxip2fE6nDgEx9mi9UMKM9G', NULL, NULL, 'male', 2, '1672667006.jpg', NULL, 'telecaller', 'telecaller', 'char pair', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2023-01-02 13:43:26', '2023-01-05 01:47:11'),
(44, 'test03', 'adm32', '336523', '669985', 'test52@gmail.com', NULL, '$2y$10$LoZwZ.01YRlwGvr66REv/.6Vmt2If2GdewRMsqRx.F7CNWf4moRUG', NULL, NULL, 'female', 2, 'null', NULL, 'telecaller', 'telecaller', 'Char Pair', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2023-01-03 09:18:22', '2023-01-05 01:46:57'),
(45, 'shyam', 'adm66m', '6468465168', '95664641', 'shyam3@gmail.com', NULL, '$2y$10$beIDxMQ6Sfg9vgNFxqyYXuMZZ/HPtixp/MVpGe2FqrJOC2i5ITbfW', NULL, NULL, NULL, 3, '1672740140.jpg', NULL, 'salesperson', 'salesperson', 'Char Pair', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2023-01-03 10:02:20', '2023-01-05 01:29:00'),
(46, 'test33', 'admi8ncom', '6338778', NULL, 'test33@gmail.com', NULL, '$2y$10$Q/FskpZrggYhmiM3sbcf6uy9Xg2SOdyudlkdLu8fNuID/5AeO4p2i', NULL, NULL, NULL, 3, NULL, NULL, 'salesperson', 'salesperson', 'Char Pair', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2023-01-03 10:03:13', '2023-01-05 06:40:39'),
(48, 'telecall', 'adm22om', '36521456', '369852255', 'tele@gmail.com', NULL, '$2y$10$DYUqrvVGLKTFWAL8blg92OcHLj//Mmf2fI/66Hz7R4bqY9RGIgu92', NULL, NULL, 'male', 2, '1672902428.jpg', NULL, 'telecaller', 'telecaller', 'Char Pair', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2023-01-05 07:07:08', '2023-01-05 07:16:12'),
(49, 'employee', 'admi556', '6595656568', NULL, 'emp@gmail.com', NULL, '$2y$10$F/IuMJ4mOyAWRi.9XXa0bO2M7Lh5KasvLYAd6uzkmgT8ZKwf2.16m', NULL, NULL, 'Female', 2, NULL, NULL, 'telecaller', 'telecalling', 'Char Pair', '2023-01-24', NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2023-01-05 09:52:28', '2023-01-05 08:46:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_comments`
--
ALTER TABLE `lead_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_task`
--
ALTER TABLE `lead_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `lead_comments`
--
ALTER TABLE `lead_comments`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `lead_task`
--
ALTER TABLE `lead_task`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
