-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2024 at 01:26 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vet`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','completed','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `pet_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `animal_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_slot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `first_name`, `last_name`, `appointment_date`, `created_at`, `updated_at`, `user_id`, `status`, `branch_id`, `pet_name`, `animal_type`, `breed`, `description`, `service_type`, `appointment_slot`) VALUES
(1, 'Jon Wendell', 'Cabrera', '2024-04-13', '2024-04-13 00:58:27', '2024-04-13 01:07:11', 47, 'completed', 16, 'Chacha', 'Dog', 'Aspin', 'Dog wash', 'Pet Hotel', 'Slot 1'),
(2, 'Jon Wendell', 'Cabrera', '2024-04-20', '2024-04-13 01:04:52', '2024-04-13 07:28:47', 47, 'completed', 16, 'Meow Meow', 'Cat', 'Leopard', 'Meow Meow', 'Grooming', 'Slot 1'),
(3, 'Jon Wendell', 'Cabrera', '2024-04-16', '2024-04-13 01:12:43', '2024-04-13 07:28:49', 47, 'completed', 16, 'Mochi', 'Cat', 'Leopard', 'Hotel', 'Pet Hotel', 'Slot 1'),
(4, 'Jon Wendell', 'Cabrera', '2024-04-30', '2024-04-13 01:17:58', '2024-04-13 01:17:58', 47, 'pending', 18, 'Meow Meow', 'Cat', 'Leopard', 'Makulit', 'Grooming', 'Slot 1'),
(5, 'Jon Wendell', 'Cabrera', '2024-04-14', '2024-04-14 03:33:47', '2024-04-14 03:34:27', 47, 'completed', 16, 'Meow Meow', 'Dog', 'Aspin', 'Pet Groom Lang po', 'Grooming', 'Slot 1');

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` bigint UNSIGNED NOT NULL,
  `inventory_id` bigint UNSIGNED NOT NULL,
  `upc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_quantity` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inbound',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `inventory_id`, `upc`, `name`, `description`, `old_quantity`, `quantity`, `type`, `created_at`, `updated_at`) VALUES
(1, 5, '17102537969873', 'Chains', 'Dog Leash', 101, 21, 'inbound', '2024-03-12 07:50:14', '2024-03-12 07:50:14'),
(2, 5, '17102537969873', 'Chains', 'Dog Leash', 122, 1, 'inbound', '2024-03-12 08:11:05', '2024-03-12 08:11:05'),
(3, 5, '17102537969873', 'Chains', 'Dog Leash', 123, 21, 'inbound', '2024-03-13 05:20:52', '2024-03-13 05:20:52'),
(9, 12, '17103376866', 'MedDog', 'Dog Med', 0, 35, 'inbound', '2024-03-13 05:48:06', '2024-03-13 05:48:06'),
(10, 13, '171034228612', 'Leash', 'Dog Leash', 0, 35, 'inbound', '2024-03-13 07:04:46', '2024-03-13 07:04:46'),
(11, 5, '17102537969873', 'Chains', 'Dog Leash', 144, 200, 'inbound', '2024-04-01 07:55:35', '2024-04-01 07:55:35'),
(12, 5, '17102537969873', 'Chains', 'Dog Leash', 344, 1, 'inbound', '2024-04-03 06:11:31', '2024-04-03 06:11:31'),
(13, 5, '17102537969873', 'Chains', 'Dog Leash', 345, 69, 'inbound', '2024-04-03 06:11:40', '2024-04-03 06:11:40'),
(14, 12, '17103376866', 'MedDog', 'Dog Med', 35, 29, 'sales', '2024-04-07 00:27:13', '2024-04-07 00:27:13'),
(15, 12, '17103376866', 'MedDog', 'Sale marked as delivered', 21, 15, 'sales', '2024-04-07 01:24:28', '2024-04-07 01:24:28'),
(16, 5, '17102537969873', 'Chains', 'Sale marked as delivered', 376, 373, 'sales', '2024-04-07 01:30:56', '2024-04-07 01:30:56'),
(17, 5, '17102537969873', 'Chains', 'Sale marked as delivered', 373, 369, 'sales', '2024-04-07 01:32:35', '2024-04-07 01:32:35'),
(18, 5, '17102537969873', 'Chains', 'Dog Leash', 369, 368, 'sales', '2024-04-07 01:35:22', '2024-04-07 01:35:22'),
(19, 5, '17102537969873', 'Chains', 'Dog Leash', 368, 367, 'sales', '2024-04-07 01:35:59', '2024-04-07 01:35:59'),
(20, 5, '17102537969873', 'Chains', 'Dog Leash', 367, 366, 'sales', '2024-04-07 01:45:32', '2024-04-07 01:45:32'),
(21, 5, '17102537969873', 'Chains', 'Dog Leash', 366, 365, 'sales', '2024-04-07 01:45:41', '2024-04-07 01:45:41'),
(22, 12, '17103376866', 'MedDog', 'Dog Med', 15, 14, 'sales', '2024-04-07 01:45:42', '2024-04-07 01:45:42'),
(23, 5, '17102537969873', 'Chains', 'Dog Leash', 365, 361, 'sales', '2024-04-07 01:45:43', '2024-04-07 01:45:43'),
(24, 5, '17102537969873', 'Chains', 'Dog Leash', 361, 358, 'sales', '2024-04-07 01:45:44', '2024-04-07 01:45:44'),
(25, 12, '17103376866', 'MedDog', 'Dog Med', 14, 8, 'sales', '2024-04-07 01:45:45', '2024-04-07 01:45:45'),
(26, 5, '17102537969873', 'Chains', 'Dog Leash', 358, 353, 'sales', '2024-04-07 01:45:46', '2024-04-07 01:45:46'),
(27, 12, '17103376866', 'MedDog', 'Dog Med', 8, 5, 'sales', '2024-04-07 01:45:47', '2024-04-07 01:45:47'),
(28, 5, '17102537969873', 'Chains', 'Dog Leash', 353, 350, 'sales', '2024-04-07 01:45:49', '2024-04-07 01:45:49'),
(29, 5, '17102537969873', 'Chains', 'Dog Leash', 350, 339, 'sales', '2024-04-07 01:52:31', '2024-04-07 01:52:31'),
(30, 5, '17102537969873', 'Chains', 'Dog Leash', 339, 328, 'sales', '2024-04-07 01:53:35', '2024-04-07 01:53:35'),
(31, 12, '17103376866', 'MedDog', 'Dog Med', 495, 69, 'inbound', '2024-04-07 01:55:12', '2024-04-07 01:55:12'),
(32, 5, '17102537969873', 'Chains', 'Dog Leash', 328, 317, 'sales', '2024-04-07 02:25:08', '2024-04-07 02:25:08'),
(33, 12, '17103376866', 'MedDog', 'Dog Med', 564, 554, 'sales', '2024-04-07 02:25:09', '2024-04-07 02:25:09'),
(34, 5, '17102537969873', 'Chains', 'Dog Leash', 317, 306, 'sales', '2024-04-07 02:30:17', '2024-04-07 02:30:17'),
(35, 12, '17103376866', 'MedDog', 'Dog Med', 554, 544, 'sales', '2024-04-07 02:30:18', '2024-04-07 02:30:18'),
(36, 12, '17103376866', 'MedDog', 'Dog Med', 544, 537, 'sales', '2024-04-07 03:20:21', '2024-04-07 03:20:21'),
(37, 5, '17102537969873', 'Chains', 'Dog Leash', 306, 291, 'sales', '2024-04-07 03:30:15', '2024-04-07 03:30:15'),
(38, 5, '17102537969873', 'Chains', 'Dog Leash', 291, 91, 'sales', '2024-04-07 07:06:15', '2024-04-07 07:06:15'),
(39, 5, '17102537969873', 'Chains', 'Dog Leash', 91, 70, 'sales', '2024-04-07 21:44:26', '2024-04-07 21:44:26'),
(40, 12, '17103376866', 'MedDog', 'Dog Med', 537, 528, 'sales', '2024-04-07 21:44:28', '2024-04-07 21:44:28'),
(41, 5, '17102537969873', 'Chains', 'Dog Leash', 70, 61, 'sales', '2024-04-07 21:44:30', '2024-04-07 21:44:30'),
(42, 5, '17102537969873', 'Chains', 'Dog Leash', 61, 51, 'sales', '2024-04-08 03:46:33', '2024-04-08 03:46:33'),
(43, 5, '17102537969873', 'Chains', 'Dog Leash', 51, 47, 'sales', '2024-04-08 03:46:35', '2024-04-08 03:46:35'),
(44, 5, '17102537969873', 'Chains', 'Dog Leash', 47, 41, 'sales', '2024-04-08 07:57:24', '2024-04-08 07:57:24'),
(45, 12, '17103376866', 'MedDog', 'Dog Med', 528, 516, 'sales', '2024-04-08 07:57:26', '2024-04-08 07:57:26'),
(46, 5, '17102537969873', 'Chains', 'Dog Leash', 41, 34, 'sales', '2024-04-08 07:57:27', '2024-04-08 07:57:27'),
(47, 5, '17102537969873', 'Chains', 'Dog Leash', 34, 26, 'sales', '2024-04-08 08:02:11', '2024-04-08 08:02:11'),
(48, 12, '17103376866', 'MedDog', 'Dog Med', 516, 506, 'sales', '2024-04-08 08:02:13', '2024-04-08 08:02:13'),
(49, 13, '171034228612', 'Leash', 'Dog Leash', 35, 15, 'sales', '2024-04-08 08:21:50', '2024-04-08 08:21:50'),
(50, 5, '17102537969873', 'Chains', 'Dog Leash', 26, 2, 'sales', '2024-04-09 03:15:22', '2024-04-09 03:15:22'),
(51, 14, '171271686913', 'Test', 'Ewan', 0, 200, 'inbound', '2024-04-09 18:41:10', '2024-04-09 18:41:10'),
(52, 12, '17103376866', 'MedDog', 'Dog Med', 506, 496, 'sales', '2024-04-09 20:54:40', '2024-04-09 20:54:40'),
(53, 5, '17102537969873', 'Chains', 'Dog Leash', 2, 0, 'sales', '2024-04-09 20:54:42', '2024-04-09 20:54:42'),
(54, 12, '17103376866', 'MedDog', 'Dog Med', 496, 477, 'sales', '2024-04-09 20:54:44', '2024-04-09 20:54:44'),
(55, 5, '17102537969873', 'Chains', 'Dog Leash', 0, 500, 'inbound', '2024-04-09 20:55:53', '2024-04-09 20:55:53'),
(56, 5, '17102537969873', 'Chains', 'Dog Leash', 500, 492, 'sales', '2024-04-10 00:41:24', '2024-04-10 00:41:24'),
(57, 5, '17102537969873', 'Chains', 'Dog Leash', 492, 481, 'sales', '2024-04-10 02:02:41', '2024-04-10 02:02:41'),
(58, 12, '17103376866', 'MedDog', 'Dog Med', 477, 466, 'sales', '2024-04-10 02:02:57', '2024-04-10 02:02:57'),
(59, 12, '17103376866', 'MedDog', 'Dog Med', 466, 266, 'sales', '2024-04-10 02:02:59', '2024-04-10 02:02:59'),
(60, 5, '17102537969873', 'Chains', 'Dog Leash', 481, 401, 'sales', '2024-04-10 02:04:17', '2024-04-10 02:04:17'),
(61, 12, '17103376866', 'MedDog', 'Dog Med', 266, 246, 'sales', '2024-04-10 02:08:07', '2024-04-10 02:08:07'),
(62, 5, '17102537969873', 'Chains', 'Dog Leash', 401, 381, 'sales', '2024-04-10 02:08:09', '2024-04-10 02:08:09'),
(63, 13, '171034228612', 'Leash', 'Dog Leash', 15, 1, 'sales', '2024-04-10 02:15:44', '2024-04-10 02:15:44'),
(64, 5, '17102537969873', 'Chains', 'Dog Leash', 381, 331, 'sales', '2024-04-10 02:48:53', '2024-04-10 02:48:53'),
(65, 12, '17103376866', 'MedDog', 'Dog Med', 246, 216, 'sales', '2024-04-10 02:48:55', '2024-04-10 02:48:55'),
(66, 5, '17102537969873', 'Chains', 'Dog Leash', 331, 301, 'sales', '2024-04-11 18:34:24', '2024-04-11 18:34:24'),
(67, 14, '171271686913', 'Test', 'Ewan', 200, 150, 'sales', '2024-04-11 18:38:55', '2024-04-11 18:38:55'),
(68, 25, '837717182637', 'Pedigree', 'complete & balanced nutrition with antioxidant to support your dog\'s immune system.', 603, 50, 'addition', '2024-04-12 23:28:45', '2024-04-12 23:28:45'),
(69, 25, '837717182637', 'Pedigree', 'Dog Food', 653, 623, 'sales', '2024-04-12 23:35:01', '2024-04-12 23:35:01'),
(70, 26, '171299841225', 'Ascorbic Acid', 'Vitamin', 0, 500, 'inbound', '2024-04-13 00:53:32', '2024-04-13 00:53:32'),
(71, 26, '171299841225', 'Ascorbic Acid', 'Vitamin', 500, 350, 'sales', '2024-04-13 00:54:49', '2024-04-13 00:54:49'),
(72, 12, '17103376866', 'MedDog', 'Dog Med', 216, 200, 'sales', '2024-04-13 01:08:59', '2024-04-13 01:08:59'),
(73, 5, '17102537969873', 'Chains', 'Dog Leash', 360, 10, 'add', '2024-04-13 05:17:16', '2024-04-13 05:17:16'),
(74, 25, '837717182637', 'Pedigree', 'Dog Food', 454, 431, 'sales', '2024-04-13 07:29:02', '2024-04-13 07:29:02'),
(75, 5, '17102537969873', 'Chainss', 'Dog Leash', 190, 200, 'inbound', '2024-04-13 09:28:43', '2024-04-13 09:28:43'),
(76, 14, '171271686913', 'Test', 'Ewan', 100, 50, 'sales', '2024-04-14 03:08:39', '2024-04-14 03:08:39'),
(77, 12, '17103376866', 'MedDog', 'Dog Med', 200, 150, 'sales', '2024-04-14 03:30:06', '2024-04-14 03:30:06'),
(78, 25, '837717182637', 'Pedigree', 'Dog Food', 350, 300, 'sales', '2024-04-14 03:34:45', '2024-04-14 03:34:45'),
(79, 5, '17102537969873', 'Chainss', 'Dog Leash', 390, 300, 'sales', '2024-04-17 02:27:14', '2024-04-17 02:27:14'),
(80, 12, '17103376866', 'MedDog', 'Dog Med', 490, 10, 'inbound', '2024-04-17 02:28:29', '2024-04-17 02:28:29'),
(81, 5, '17102537969873', 'Chainss', 'Dog Leash', 300, 290, 'sales', '2024-04-17 03:36:58', '2024-04-17 03:36:58'),
(82, 25, '837717182637', 'Pedigree', 'Dog Food', 300, 250, 'sales', '2024-04-17 03:37:01', '2024-04-17 03:37:01'),
(83, 12, '17103376866', 'MedDog', 'Dog Med', 500, 450, 'sales', '2024-04-17 04:43:11', '2024-04-17 04:43:11'),
(84, 25, '837717182637', 'Pedigree', 'Dog Food', 250, 200, 'sales', '2024-04-17 04:43:13', '2024-04-17 04:43:13'),
(85, 25, '837717182637', 'Pedigree', 'Dog Food', 200, 100, 'sales', '2024-04-17 04:45:19', '2024-04-17 04:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `location`, `contact`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(16, 'Rem\'s Petshop Camilmil', 'National Road, JP Rizal St, Camilmil, Calapan City', '09305115251', 'active', '2024-02-19 05:30:54', '2024-04-14 05:11:58', 1),
(18, 'Rem\'s Petshop Roxas', 'MIMAROPA,ROXAS,', '09092133212', 'active', '2024-02-19 06:15:17', '2024-04-14 05:12:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `created_at`, `updated_at`, `branch_id`) VALUES
(123, 47, 5, 10, 310.00, '2024-04-17 04:54:53', '2024-04-17 04:54:53', 16);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `upc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `description`, `quantity`, `image`, `category`, `price`, `upc`, `expiration`, `created_at`, `updated_at`, `branch_id`) VALUES
(5, 'Chainss', 'Dog Leash', 290, '1710253796.jpg', 'Dog', 31.00, '17102537969873', '2024-04-25 16:00:00', '2024-04-11 19:07:00', '2024-04-17 03:36:58', 16),
(12, 'MedDog', 'Dog Med', 450, '1710337686.jpg', 'Liquid', 35.00, '17103376866', '2024-03-12 16:00:00', '2024-03-13 13:48:00', '2024-04-17 04:43:11', 16),
(13, 'Leash', 'Dog Leash', 1, '1710342286.png', '35', 45.00, '171034228612', '2024-03-12 16:00:00', '2024-03-13 15:04:00', '2024-04-10 02:15:44', 18),
(14, 'Test', 'Ewan', 50, '1712716869.jpg', 'Fish', 23.00, '171271686913', '2024-04-09 16:00:00', '2024-04-10 02:40:00', '2024-04-14 03:08:39', 16),
(25, 'Pedigree', 'Dog Food', 100, '1712990882.jpg', 'Dog', 45.00, '837717182637', '2024-08-12 16:00:00', '2024-04-12 22:48:00', '2024-04-17 04:45:19', 16),
(26, 'Ascorbic Acid', 'Vitamin', 300, '1712998412.jpg', 'Dog', 35.00, '171299841225', '2024-04-12 16:00:00', '2024-04-05 08:53:00', '2024-04-13 06:33:12', 16);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_12_24_101436_rename_branches_table_to_clinics', 1),
(3, '2023_12_24_101718_rename_branch_id_to_clinics_id_in_users_table', 2),
(4, '2023_12_24_110225_remove_role_column_from_users', 3),
(5, '2023_12_24_110244_add_modified_role_column_to_users', 4),
(6, '2023_12_26_063230_create_appointments_table', 5),
(7, '2023_12_26_071104_add_status_to_appointments_table', 6),
(8, '2024_02_12_120327_add_super_admin_role_to_users', 7),
(9, '2024_02_18_113423_add_clinic_id_to_appointments_table', 8),
(10, '2024_02_19_132112_add_doctor_name_to_clinics_table', 9),
(11, '2024_03_02_154939_update_status_column_in_appointments_table', 10),
(12, '2024_03_03_134341_add_canceled_status_to_appointments_table', 11),
(13, '2024_03_12_132234_remove_clinic_id_from_inventories_table', 12),
(14, '2024_03_12_144100_create_audits_table', 13),
(15, '2024_03_12_151530_create_audits_table', 14),
(16, '2024_03_12_153646_create_audits_table', 15),
(17, '2024_04_01_144714_create_sales_table', 16),
(18, '2024_04_01_145100_rename_clinics_table_to_branches', 17),
(19, '2024_04_01_145348_update_foreign_keys_to_branch_id', 18),
(20, '2024_04_01_145714_update_user_foreign_key_to_branch_id', 19),
(21, '2024_04_01_160411_remove_doctor_name_from_branches_table', 20),
(22, '2024_04_01_162407_add_branch_id_to_sales_table', 21),
(23, '2024_04_01_172405_rename_product_id_column_in_sales_table', 22),
(24, '2024_04_03_125743_create_sales_table', 23),
(25, '2024_04_04_045217_modify_carts_table', 24),
(26, '2024_04_04_050727_add_branch_id_to_carts_table', 25),
(27, '2024_04_06_064202_add_contact_number_to_users_table', 26),
(28, '2024_04_06_070439_add_status_to_sales_table', 27),
(29, '2024_04_06_152708_add_address_components_to_users_table', 28),
(30, '2024_04_06_154327_add_default_value_to_address_column_in_users_table', 29),
(31, '2024_04_07_104135_add_total_price_to_carts_table', 30),
(32, '2024_04_07_104828_add_total_price_to_sales_table', 31),
(33, '2024_04_11_125241_add_additional_fields_to_appointments_table', 32),
(34, '2024_04_11_130504_update_appointments_table', 33),
(35, '2024_04_11_133903_add_animal_type_to_appointments_table', 34);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `guard`, `token`, `created_at`) VALUES
('admin@gmail.com', 'admin', 'ZFUzak9XY3k5TXlWdkRNSjZ2MExkcG5HNGdDaVg1Q0dIc3BvQWNnYnF4NXZMYXJaM0ZxZjNlMmdaQUZBU21zRA==', '2023-11-20 18:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` int UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `sale_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 89, 91, 4, 'Sana ALl', '2024-04-17 04:43:39', '2024-04-17 04:43:39'),
(2, 90, 91, 5, 'Sarap nito', '2024-04-17 04:43:52', '2024-04-17 04:43:52'),
(3, 88, 47, 1, 'Kasama ng lasa', '2024-04-17 04:45:50', '2024-04-17 04:45:50'),
(4, 91, 47, 1, 'Uu nga', '2024-04-17 04:46:01', '2024-04-17 04:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `branch_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `branch_id`, `created_at`, `updated_at`, `status`) VALUES
(21, 47, 12, 7, 245.00, 16, '2024-04-07 03:13:58', '2024-04-07 03:20:21', 'delivered'),
(22, 47, 5, 15, 480.00, 16, '2024-04-07 03:29:46', '2024-04-07 03:30:15', 'delivered'),
(23, 47, 5, 200, 6400.00, 16, '2024-04-07 07:05:55', '2024-04-07 07:06:15', 'delivered'),
(24, 47, 5, 21, 672.00, 16, '2024-04-07 20:49:37', '2024-04-07 21:44:26', 'delivered'),
(25, 72, 12, 9, 315.00, 16, '2024-04-07 21:43:02', '2024-04-07 21:44:28', 'delivered'),
(26, 72, 5, 9, 288.00, 16, '2024-04-07 21:43:28', '2024-04-07 21:44:29', 'delivered'),
(27, 47, 5, 10, 320.00, 16, '2024-04-08 01:01:00', '2024-04-08 03:46:33', 'delivered'),
(28, 47, 5, 4, 128.00, 16, '2024-04-08 03:46:03', '2024-04-08 03:46:35', 'delivered'),
(29, 47, 5, 6, 192.00, 16, '2024-04-08 04:04:59', '2024-04-08 07:57:24', 'delivered'),
(30, 47, 12, 12, 420.00, 16, '2024-04-08 04:07:09', '2024-04-08 07:57:25', 'delivered'),
(31, 47, 5, 7, 224.00, 16, '2024-04-08 04:07:26', '2024-04-08 07:57:27', 'delivered'),
(32, 47, 5, 8, 256.00, 16, '2024-04-08 08:01:26', '2024-04-08 08:02:10', 'delivered'),
(33, 47, 12, 10, 350.00, 16, '2024-04-08 08:01:34', '2024-04-08 08:02:13', 'delivered'),
(34, 47, 13, 20, 900.00, 18, '2024-04-08 08:21:34', '2024-04-08 08:21:50', 'delivered'),
(35, 47, 5, 24, 768.00, 16, '2024-04-09 03:15:04', '2024-04-09 03:15:22', 'delivered'),
(36, 47, 12, 10, 350.00, 16, '2024-04-09 04:15:57', '2024-04-09 20:54:40', 'delivered'),
(37, 47, 5, 2, 64.00, 16, '2024-04-09 20:53:45', '2024-04-09 20:54:42', 'delivered'),
(38, 47, 12, 19, 665.00, 16, '2024-04-09 20:53:53', '2024-04-09 20:54:44', 'delivered'),
(39, 47, 5, 11, 352.00, 16, '2024-04-09 21:10:29', '2024-04-10 02:02:40', 'delivered'),
(40, 47, 12, 11, 385.00, 16, '2024-04-09 21:10:40', '2024-04-10 02:02:57', 'delivered'),
(41, 47, 13, 14, 630.00, 18, '2024-04-09 22:34:14', '2024-04-10 02:15:44', 'delivered'),
(42, 75, 5, 8, 256.00, 16, '2024-04-10 00:40:36', '2024-04-10 00:41:24', 'delivered'),
(43, 47, 12, 200, 7000.00, 16, '2024-04-10 02:00:18', '2024-04-10 02:02:59', 'delivered'),
(44, 47, 5, 80, 2560.00, 16, '2024-04-10 02:03:33', '2024-04-10 02:04:17', 'delivered'),
(45, 47, 12, 20, 700.00, 16, '2024-04-10 02:07:16', '2024-04-10 02:08:07', 'delivered'),
(46, 47, 5, 20, 640.00, 16, '2024-04-10 02:07:24', '2024-04-10 02:08:09', 'delivered'),
(47, 47, 5, 50, 1600.00, 16, '2024-04-10 02:47:24', '2024-04-10 02:48:53', 'delivered'),
(48, 47, 12, 30, 1050.00, 16, '2024-04-10 02:47:30', '2024-04-10 02:48:55', 'delivered'),
(49, 47, 5, 30, 960.00, 16, '2024-04-11 18:33:49', '2024-04-11 18:34:24', 'delivered'),
(50, 47, 14, 50, 1150.00, 16, '2024-04-11 18:36:09', '2024-04-11 18:38:55', 'delivered'),
(51, 47, 25, 30, 1350.00, 16, '2024-04-12 23:34:39', '2024-04-12 23:35:01', 'delivered'),
(52, 47, 26, 150, 5250.00, 16, '2024-04-13 00:54:33', '2024-04-13 00:54:49', 'delivered'),
(53, 47, 12, 16, 560.00, 16, '2024-04-13 01:06:35', '2024-04-13 01:08:59', 'delivered'),
(54, 4, 26, 50, 1750.00, 16, '2024-04-13 06:33:12', '2024-04-13 06:33:12', 'delivered'),
(55, 4, 5, 5, 155.00, 16, '2024-04-13 06:36:59', '2024-04-13 06:36:59', 'delivered'),
(56, 4, 5, 50, 1550.00, 16, '2024-04-13 06:38:06', '2024-04-13 06:38:06', 'delivered'),
(57, 4, 5, 50, 1550.00, 16, '2024-04-13 06:38:27', '2024-04-13 06:38:27', 'delivered'),
(58, 4, 5, 15, 465.00, 16, '2024-04-13 06:41:55', '2024-04-13 06:41:55', 'delivered'),
(59, 4, 5, 10, 310.00, 16, '2024-04-13 06:43:02', '2024-04-13 06:43:02', 'delivered'),
(60, 4, 5, 10, 310.00, 16, '2024-04-13 06:44:12', '2024-04-13 06:44:12', 'delivered'),
(61, 4, 5, 10, 310.00, 16, '2024-04-13 06:45:55', '2024-04-13 06:45:55', 'delivered'),
(62, 4, 5, 10, 310.00, 16, '2024-04-13 06:47:42', '2024-04-13 06:47:42', 'delivered'),
(63, 4, 5, 10, 310.00, 16, '2024-04-13 06:49:31', '2024-04-13 06:49:31', 'delivered'),
(64, 4, 5, 10, 310.00, 16, '2024-04-13 06:50:17', '2024-04-13 06:50:17', 'delivered'),
(65, 4, 14, 10, 230.00, 16, '2024-04-13 06:51:14', '2024-04-13 06:51:14', 'delivered'),
(66, 4, 25, 100, 4500.00, 16, '2024-04-13 06:51:34', '2024-04-13 06:51:34', 'delivered'),
(67, 4, 25, 23, 1035.00, 16, '2024-04-13 06:54:42', '2024-04-13 06:54:42', 'delivered'),
(68, 4, 25, 23, 1035.00, 16, '2024-04-13 06:55:09', '2024-04-13 06:55:09', 'delivered'),
(69, 4, 25, 23, 1035.00, 16, '2024-04-13 06:55:13', '2024-04-13 06:55:13', 'delivered'),
(70, 47, 25, 23, 1035.00, 16, '2024-04-13 07:28:23', '2024-04-13 07:29:01', 'delivered'),
(71, 4, 25, 31, 1395.00, 16, '2024-04-13 07:29:12', '2024-04-13 07:29:12', 'delivered'),
(72, 4, 25, 50, 2250.00, 16, '2024-04-13 07:29:42', '2024-04-13 07:29:42', 'delivered'),
(73, 47, 14, 40, 920.00, 16, '2024-04-14 02:25:53', '2024-04-14 02:40:51', 'canceled'),
(74, 4, 14, 40, 920.00, 16, '2024-04-14 02:39:19', '2024-04-14 02:39:19', 'delivered'),
(75, 47, 26, 20, 700.00, 16, '2024-04-14 02:40:19', '2024-04-14 02:43:57', 'canceled'),
(76, 47, 25, 50, 2250.00, 16, '2024-04-14 02:44:25', '2024-04-14 02:45:09', 'canceled'),
(77, 47, 25, 50, 2250.00, 16, '2024-04-14 02:54:42', '2024-04-14 02:55:09', 'canceled'),
(78, 47, 26, 50, 1750.00, 16, '2024-04-14 03:05:25', '2024-04-14 03:06:09', 'canceled'),
(79, 47, 14, 50, 1150.00, 16, '2024-04-14 03:08:05', '2024-04-14 03:08:39', 'delivered'),
(80, 47, 25, 50, 2250.00, 16, '2024-04-14 03:09:22', '2024-04-14 03:09:48', 'canceled'),
(81, 47, 26, 50, 1750.00, 16, '2024-04-14 03:16:25', '2024-04-14 03:17:43', 'canceled'),
(82, 47, 5, 50, 1550.00, 16, '2024-04-14 03:22:26', '2024-04-14 03:29:59', 'canceled'),
(83, 47, 12, 50, 1750.00, 16, '2024-04-14 03:27:58', '2024-04-14 03:30:06', 'delivered'),
(84, 47, 25, 50, 2250.00, 16, '2024-04-14 03:31:23', '2024-04-14 03:34:45', 'delivered'),
(85, 47, 5, 90, 2790.00, 16, '2024-04-17 02:26:38', '2024-04-17 02:27:14', 'delivered'),
(86, 47, 12, 160, 5600.00, 16, '2024-04-17 02:26:44', '2024-04-17 02:27:16', 'delivered'),
(87, 47, 5, 10, 310.00, 16, '2024-04-17 03:35:34', '2024-04-17 03:36:58', 'delivered'),
(88, 47, 25, 50, 2250.00, 16, '2024-04-17 03:35:41', '2024-04-17 03:37:01', 'delivered'),
(89, 91, 12, 50, 1750.00, 16, '2024-04-17 04:42:09', '2024-04-17 04:43:11', 'delivered'),
(90, 91, 25, 50, 2250.00, 16, '2024-04-17 04:42:16', '2024-04-17 04:43:13', 'delivered'),
(91, 47, 25, 100, 4500.00, 16, '2024-04-17 04:44:56', '2024-04-17 04:45:19', 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `gender` enum('male','female','other') NOT NULL,
  `age` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_id` int DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'super_admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `middleName`, `region`, `province`, `city`, `barangay`, `address`, `gender`, `age`, `email`, `password`, `created_at`, `updated_at`, `branch_id`, `contact_number`, `role`) VALUES
(1, 'Rem\'s Petshop', 'Raymond', 'Mendoza', 'Arguelles', 'MIMAROPA', 'Oriental Mindoro', 'City Of Calapan (Capital)', 'Putingtubig', 'Region V (Bicol Region), Albay, Bacacay, Baclayon', 'male', 35, 'remspetshop@gmail.com', '$2y$12$2k8M1Dr4znqRowxeg/4LiePrDsTbOftt0NC43FwikNg0jk9IoQUCi', '2024-02-19 05:31:38', '2024-04-13 09:23:22', 16, '09817523253', 'super_admin'),
(4, 'staffcal', 'staffcal', 'staffcal', 'staffcal', 'MIMAROPA', 'Marinduque', 'Santa Cruz', 'Haguimit', 'Putingtubig, City Of Calapan (Capital), Oriental Mindoro, MIMAROPA', 'male', 21, 'staffcal@gmail.com', '$2y$12$6N5KBqTP5kJOEiQHdi7C/..o/fQxGTTyR/9UPm7ERw/jzU5jBaQ2q', '2024-02-19 06:13:07', '2024-04-14 03:37:54', 16, '09305115251', 'staff'),
(6, 'staffroxas', 'staffroxas', 'staffroxas', 'staffroxas', 'MIMAROPA', 'Oriental Mindoro', 'Roxas', 'Libertad', 'Bariw, Bacacay, Albay, Region V (Bicol Region)', 'female', 21, 'staffroxas@gmail.com', '$2y$12$dw.P9tMhF/RIICM7lzlL1ukECeX0rQzvCpWtconFINnoZ2epAW1DS', '2024-02-19 06:15:48', '2024-04-14 03:42:11', 18, '09172321122', 'staff'),
(7, 'admincal', 'admincal', 'admincal', 'admincal', 'MIMAROPA', 'Oriental Mindoro', 'City Of Calapan (Capital)', 'Camilmil', 'Test', 'female', 21, 'admincal@gmail.com', '$2y$12$xgLPf4n42RNZ4Ewog5sC8.uKW/go4WSFYehre9FExL4soV3iI/kFu', '2024-02-19 06:16:39', '2024-04-13 10:03:58', 16, '09302223322', 'admin'),
(47, 'Sett', 'Jon Wendell', 'Cabrera', 'Lontoc', 'MIMAROPA', 'Oriental Mindoro', 'City Of Calapan (Capital)', 'Balite', 'MIMAROPA, Oriental Mindoro, City Of Calapan (Capital), Balite', 'female', 21, 'nopona21@gmail.com', '$2y$12$1aOkHuZOEitZInVq9vBPEOs75ehoNFq3fV0XyqUP2pZcOpVMXJhHO', '2024-04-06 08:46:53', '2024-04-06 08:46:53', NULL, '09305115251', 'patient'),
(76, 'adminroxas', 'Roxas', 'Admin', 'adminroxas', 'MIMAROPA', 'Oriental Mindoro', 'Victoria', 'Pakyas', 'MIMAROPA, Oriental Mindoro, Roxas, San Miguel', 'male', 35, 'adminroxas@gmail.com', '$2y$12$5bGsAuYVL56EYmr4pBYhheZDb98ZCdxDjMC0bGu5jInAoQasT2PC2', '2024-04-10 02:11:15', '2024-04-14 03:42:28', 18, '09817523253', 'admin'),
(91, 'Cydie', 'Cydie', 'Garullo', 'Mae', 'MIMAROPA', 'Oriental Mindoro', 'Naujan', 'Del Pilar', 'MIMAROPA, Oriental Mindoro, Naujan, Del Pilar', 'female', 21, 'cydiegargullo@gmail.com', '$2y$12$Jy.gzXpiyLw8dUqtlto7jOYecDnVbrRrXMN8z2CE/Ii0Cz9eXgRKq', '2024-04-17 03:52:06', '2024-04-17 03:52:06', NULL, '09302223322', 'patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_clinic_id_foreign` (`branch_id`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_clinic_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `audits`
--
ALTER TABLE `audits`
  ADD CONSTRAINT `audits_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
