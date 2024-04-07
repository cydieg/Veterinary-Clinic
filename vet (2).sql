-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2024 at 01:30 PM
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
  `appointment_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','completed','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `branch_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `first_name`, `last_name`, `appointment_date`, `appointment_time`, `created_at`, `updated_at`, `user_id`, `status`, `branch_id`) VALUES
(1, 'Jon Wendell', 'Cabrera', '2024-04-07', '08:00:00', '2024-04-07 05:29:26', '2024-04-07 05:29:52', 47, 'completed', 16);

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
(37, 5, '17102537969873', 'Chains', 'Dog Leash', 306, 291, 'sales', '2024-04-07 03:30:15', '2024-04-07 03:30:15');

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
(16, 'Gwenchana Dentist', 'Santo Ninos', '09305115251', 'Active', '2024-02-19 05:30:54', '2024-04-01 08:08:06', 1),
(18, 'Janzel Clinic', 'Cebu', '09092133212', 'Active', '2024-02-19 06:15:17', '2024-02-19 06:15:17', 1);

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
(5, 'Chains', 'Dog Leash', 291, '1710253796.jpg', 'Solid', 32.00, '17102537969873', '2024-03-11 16:00:00', '2024-03-12 14:29:00', '2024-04-07 03:30:15', 16),
(12, 'MedDog', 'Dog Med', 537, '1710337686.jpg', 'Liquid', 35.00, '17103376866', '2024-03-12 16:00:00', '2024-03-13 13:48:00', '2024-04-07 03:20:21', 16),
(13, 'Leash', 'Dog Leash', 35, '1710342286.png', '35', 45.00, '171034228612', '2024-03-12 16:00:00', '2024-03-13 15:04:00', '2024-03-13 07:04:46', 18);

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
(32, '2024_04_07_104828_add_total_price_to_sales_table', 31);

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
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `branch_id`, `created_at`, `updated_at`, `status`) VALUES
(21, 47, 12, 7, 245.00, 16, '2024-04-07 03:13:58', '2024-04-07 03:20:21', 'delivered'),
(22, 47, 5, 15, 480.00, 16, '2024-04-07 03:29:46', '2024-04-07 03:30:15', 'delivered');

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
(1, 'Setts', 'Jon Wendell', 'Cabrera', 'Lontoc', 'MIMAROPA', 'Oriental Mindoro', 'City Of Calapan (Capital)', 'Santo Niño', 'Nacoco Santo Nino', 'male', 22, 'corvecc1@gmail.com', '$2y$12$2k8M1Dr4znqRowxeg/4LiePrDsTbOftt0NC43FwikNg0jk9IoQUCi', '2024-02-19 05:31:38', '2024-04-06 21:38:46', 16, '09817523253', 'super_admin'),
(4, 'staffcal', 'staffcal', 'staffcal', 'staffcal', NULL, NULL, NULL, NULL, 'Test', 'female', 21, 'staffcal@gmail.com', '$2y$12$1xIoG7fECmJyaCvzk9hB7uMn6lh0Yt4k04a5LkaVMwlxe97cW98z6', '2024-02-19 06:13:07', '2024-02-19 06:13:07', 16, NULL, 'staff'),
(6, 'staffvic', 'staffvic', 'staffvic', 'staffvic', NULL, NULL, NULL, NULL, 'Test', 'female', 21, 'staffvic@gmail.com', '$2y$12$PW0q/y1f8t7Lu61MSqdSeOcDvKU1t66xeoMDh3ImIFpKDKsI91av2', '2024-02-19 06:15:48', '2024-02-19 06:15:48', 18, NULL, 'staff'),
(7, 'admincal', 'admincal', 'admincal', 'admincal', NULL, NULL, NULL, NULL, 'Test', 'female', 21, 'admincal@gmail.com', '$2y$12$xgLPf4n42RNZ4Ewog5sC8.uKW/go4WSFYehre9FExL4soV3iI/kFu', '2024-02-19 06:16:39', '2024-02-19 06:16:39', 16, NULL, 'admin'),
(10, 'patienteses', 'patient', 'patient', 'patient', NULL, NULL, NULL, NULL, 'Test', 'male', 21, 'patient@gmail.com', '$2y$12$g1HHkQYSA9RngbJG4h5twukLX3qJf8sS2u0SDk.twPhMnZ1xH3JB2', '2024-02-19 06:50:01', '2024-04-04 20:57:11', NULL, NULL, 'patient'),
(11, 'clientcal', 'clientcal', 'clientcal', 'clientcal', NULL, NULL, NULL, NULL, 'Test', 'female', 21, 'clientcal@gmail.com', '$2y$12$MXJHFcL5KU0JqA/aaLGVbuZ5L0i9tMzNvdjbc6kL1KONuSqkWfa52', '2024-02-19 06:56:07', '2024-02-19 06:56:07', NULL, NULL, 'patient'),
(13, 'adminvic', 'adminvic', 'adminvic', 'adminvic', NULL, NULL, NULL, NULL, 'test', 'female', 32, 'adminvic@gmail.com', '$2y$12$ln9eWedJqdIjAMTWjHJeKeVa1kDyI.stctmp/7OAzJtSK0oXazt9e', '2024-03-13 06:38:37', '2024-03-13 06:38:37', 18, NULL, 'admin'),
(47, 'Sett', 'Jon Wendell', 'Cabrera', 'Lontoc', 'MIMAROPA', 'Oriental Mindoro', 'City Of Calapan (Capital)', 'Balite', 'MIMAROPA, Oriental Mindoro, City Of Calapan (Capital), Balite', 'female', 21, 'nopona21@gmail.com', '$2y$12$1aOkHuZOEitZInVq9vBPEOs75ehoNFq3fV0XyqUP2pZcOpVMXJhHO', '2024-04-06 08:46:53', '2024-04-06 08:46:53', NULL, '09305115251', 'patient'),
(52, 'namonamo', 'namonamo', 'namonamo', 'namonamo', 'Region X (Northern Mindanao)', 'Lanao Del Norte', 'Salvador', 'Panaliwad-on', 'MIMAROPA, Oriental Mindoro, City Of Calapan (Capital), Biga', 'male', 21, 'namonamo@gmail.com', '$2y$12$jshD96Tkx6a4rISM.nPYP.dAiGPZawy0x.6S7PapABVqjXuoLoy3K', '2024-04-06 21:20:17', '2024-04-06 21:25:11', 16, '09305115251', 'patient'),
(53, 'Erzie', 'Janzel', 'Bongo', 'Managaze', 'Region VII (Central Visayas)', 'Cebu', 'Cebu City (Capital)', 'Sawang Calero (Pob.)', 'Region VII (Central Visayas), Cebu, Cebu City (Capital), Sawang Calero (Pob.)', 'female', 20, 'janzkiemalditz@gmail.com', '$2y$12$UZkKZcVvyYzI.ymCRMr21uVLC8K1kHzPAf..C4/PBNg6ZgAQUkiAi', '2024-04-06 23:58:23', '2024-04-06 23:58:23', NULL, '09652577632', 'patient'),
(62, 'furparent', 'furparent', 'furparent', 'furparent', '02', '0209', '020901', '020901005', '02, 0209, 020901, 020901005', 'female', 21, 'furparent@gmail.com', '$2y$12$QfsZTCNxkae6i2GWWVzg5OvV3J./f3zPHtzZBRaJ1xA2qQIgyR/GG', '2024-04-07 05:21:59', '2024-04-07 05:21:59', NULL, '09302223322', 'patient');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
