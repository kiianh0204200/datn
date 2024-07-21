-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2024 at 03:43 PM
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
-- Database: `ecommerce_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `header_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'top-banner',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `header_title`, `title`, `sub_title`, `description`, `image`, `link`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(3, 'Elit ipsa omnis es', 'Sit in dignissimos', 'Dignissimos et fugia', '<p>Dignissimos et fugia</p>', '180629cf1f07940fffde0fab789ad853.png', NULL, 1, 'header', '2024-01-14 04:33:50', '2024-01-14 04:33:50'),
(5, 'Ưu đãi sắp tới', 'Ưu đãi lớn từ', 'Nhà sản xuất', '<p>Quần &aacute;o, Gi&agrave;y d&eacute;p, T&uacute;i x&aacute;ch, V&iacute;...</p>', 'eba28f17fae1be73cfc6cf2189098d25.png', NULL, 1, 'header', '2024-01-15 23:37:28', '2024-01-15 23:37:28'),
(6, 'Khuyến mãi công nghệ', 'Ưu đãi lớn từ', 'Thật tuyệt vời', '<p>Giảm gi&aacute; l&ecirc;n đến 70%</p>', '70de9582894cf4355ca47ca336ab3816.png', NULL, 1, 'header', '2024-01-16 00:24:04', '2024-01-16 00:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Elisa Durgan MD', 'Fugit necessitatibus deserunt ab soluta deleniti laborum doloremque ipsam. Deleniti ab aspernatur vel eligendi asperiores quis repudiandae odio. Voluptas eveniet et quas ut deserunt aliquid vero.', 'prof-elisa-durgan-md', 1, '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(2, 'Janice Denesik', 'Sit debitis minima ut fugiat ipsam odit assumenda. Fugit adipisci magnam officiis assumenda perspiciatis.', 'janice-denesik', 1, '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(3, 'Frederic Medhurst', 'Rerum qui illum rerum. Et id ab et quia sit. Hic aut atque qui rerum commodi voluptas dignissimos deleniti.', 'frederic-medhurst', 1, '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(4, 'Dr. Rozella Schowalter', 'Nihil vel quam et maxime aut aut delectus. Aut labore dolor nesciunt at delectus aut ex.', 'dr-rozella-schowalter', 1, '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(5, 'Dulce Thompson', 'Ratione harum ducimus rerum quia. Itaque laborum aperiam excepturi similique. Ullam et ipsam et commodi est rerum. A nobis voluptas rerum inventore est et.', 'dulce-thompson', 1, '2024-01-12 07:31:26', '2024-01-12 07:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Acton Turner', 'jawex@mailinator.com', '+1 (563) 618-1913', 'Sed consequat Cum a', 'Mollitia commodi eli', '2024-01-15 21:33:42', '2024-01-15 21:33:42'),
(2, 'Elizabeth Rivas', 'elizabeth@bwebpros.com', '31-63-42-39', 'Enhancing Your Site With AI Chatbots', 'Are you familiar with the growing trend of AI-powered chatbots for websites? These intelligent helpers provide 24/7, personalized customer service, answer common questions instantly, and streamline user journeys. But are they right for you?\r\n\r\nConsider these benefits:\r\n\r\n* 24/7 Availability: Never miss a lead or inquiry, even after hours. Offer instant support, reducing customer frustration and wait times.\r\n* Personalized Assistance: Guide users to relevant information and product recommendations, fostering a positive experience and boosting engagement.\r\n* Valuable Insights: Collect data on customer behavior and preferences, allowing you to continuously optimize your website and offerings.\r\n\r\nBusiness Web Pro ( https://businesswebpros.com/service/ai-chatbot-integration/ )  specializes in crafting custom AI chatbot solutions tailored to your unique business needs and goals. We\'d love to learn more about your current challenges and explore how our chatbots can revolutionize your website experience.\r\n\r\nReady to see if AI chatbots are the missing piece in your puzzle?\r\n\r\n➡️ Schedule a free consultation at https://businesswebpros.com/service/ai-chatbot-integration/ to discuss your specific needs.', '2024-02-10 01:35:18', '2024-02-10 01:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2023_12_28_040710_create_message_table', 2),
(43, '2014_10_12_000000_create_users_table', 3),
(44, '2014_10_12_100000_create_password_reset_tokens_table', 3),
(45, '2019_08_19_000000_create_failed_jobs_table', 3),
(46, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(47, '2023_11_29_122118_create_permission_tables', 3),
(48, '2023_11_29_122230_create_product_categories_table', 3),
(49, '2023_11_29_122233_create_brands_table', 3),
(50, '2023_11_29_130122_create_products_table', 3),
(51, '2023_11_29_130142_create_banners_table', 3),
(52, '2023_11_29_130247_create_orders_table', 3),
(53, '2023_11_29_130251_create_order_details_table', 3),
(54, '2023_11_29_130303_create_product_options_table', 3),
(55, '2023_11_29_132544_create_post_categories_table', 3),
(56, '2023_11_29_132553_create_posts_table', 3),
(57, '2023_11_29_134541_create_product_option_values_table', 3),
(58, '2023_12_03_075753_create_product_images_table', 3),
(59, '2023_12_14_135147_create_product_comments_table', 3),
(60, '2024_01_04_032206_create_contacts_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double NOT NULL DEFAULT '0',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `address_2` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `total`, `payment_method`, `payment_status`, `order_status`, `payment_id`, `user_name`, `user_phone`, `address`, `address_2`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Order-65a27d6f3f7f2', 125730, 'VnPay', 'paid', 'completed', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', 'zzzzz', '2024-01-13 05:09:19', '2024-01-14 04:31:40'),
(2, NULL, 'Order-65a27dee684ec', 1383030, 'Ship cod', 'paid', 'completed', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', 'zzz', '2024-01-13 05:11:26', '2024-01-14 04:31:55'),
(3, NULL, 'Order-65a280c0c39ea', 502920, 'Ship cod', 'paid', 'completed', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', 'zzz', '2024-01-13 05:23:28', '2024-01-14 04:31:15'),
(4, 5, 'Order-65a3db536de46', 436500, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, 'Vân Đình', 'Hà Nội', 'test', '2024-01-14 06:02:11', '2024-01-14 06:02:11'),
(5, NULL, 'Order-65a3dd86537aa', 106666.56, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', 'Nisi ab do235 Hoang Quoc Vietloribus di', '2024-01-14 06:11:34', '2024-01-14 06:11:34'),
(6, NULL, 'Order-65a3e7242b9d0', 106666.56, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '111 hqv', '111 hqv', '111 hqv', '2024-01-14 06:52:36', '2024-01-14 06:52:36'),
(7, NULL, 'Order-65a3e73a0f058', 106666.56, 'VnPay', 'paid', 'completed', NULL, NULL, NULL, '111 hqv', '111 hqv', '111 hqv', '2024-01-14 06:52:58', '2024-01-15 21:47:24'),
(8, NULL, 'Order-65a3e822c024f', 106666.56, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '111 hqv', '111hqv', 'no', '2024-01-14 06:56:50', '2024-01-14 06:56:50'),
(9, NULL, 'Order-65a3e857c9b4b', 106666.56, 'VnPay', 'paid', 'completed', NULL, NULL, NULL, '111 hqv', '111hqv', 'no', '2024-01-14 06:57:43', '2024-01-15 21:46:58'),
(10, NULL, 'Order-65a4db0771a49', 436500, 'VnPay', 'paid', 'confirmed', '14281566', NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '2024-01-15 00:13:11', '2024-01-15 00:13:43'),
(11, NULL, 'Order-65a60cd700d4a', 190932.48, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '2024-01-15 21:57:59', '2024-01-15 21:57:59'),
(12, NULL, 'Order-65a60cfec1e23', 190932.48, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', 'NO', '2024-01-15 21:58:38', '2024-01-15 21:58:38'),
(13, NULL, 'Order-65a60d30c3d76', 190932.48, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '2024-01-15 21:59:28', '2024-01-15 21:59:28'),
(14, NULL, 'Order-65a60d7165362', 190932.48, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', 'no', '2024-01-15 22:00:33', '2024-01-15 22:00:33'),
(20, NULL, 'Order-65a61e6bee1e9', 109948.839, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, 'Non sed sint cumque', 'Ipsa eos eligendi', 'Quaerat natus corpor', '2024-01-15 23:12:59', '2024-01-15 23:12:59'),
(21, NULL, 'Order-65a61ee383cbe', 109948.839, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, 'Odio similique est e', 'Dicta voluptatem pos', 'Deleniti eiusmod quo', '2024-01-15 23:14:59', '2024-01-15 23:14:59'),
(22, NULL, 'Order-65a61f4013832', 109839, 'VnPay', 'paid', 'confirmed', '14282792', NULL, NULL, 'Neque quia ut obcaec', 'Voluptas alias corpo', 'Ut corrupti illum', '2024-01-15 23:16:32', '2024-01-15 23:16:55'),
(23, NULL, 'Order-65a620286c6cb', 180576, 'VnPay', 'paid', 'confirmed', '14282797', NULL, NULL, 'Est numquam accusant', 'Dolor ea culpa nihi', 'Sunt omnis aliqua', '2024-01-15 23:20:24', '2024-01-15 23:20:48'),
(24, NULL, 'Order-65aafcf969238', 305691, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '2024-01-19 15:51:37', '2024-01-19 15:51:37'),
(25, NULL, 'Order-65aafd05104e2', 305691, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', '2024-01-19 15:51:49', '2024-01-19 15:51:49'),
(26, NULL, 'Order-65ab268dd842d', 1300911, 'VnPay', 'paid', 'confirmed', '14288033', NULL, NULL, '235 Hoang Quoc Viet', '235 Hoang Quoc Viet', 'zzz', '2024-01-19 18:49:01', '2024-01-19 18:49:30'),
(27, NULL, 'Order-65ab47e322c8e', 180576, 'VnPay', 'paid', 'confirmed', '14288149', NULL, NULL, '235 Hoang Quoc Viet', '235 hoang quoc viet', 'zzzz', '2024-01-19 21:11:15', '2024-01-19 21:12:05'),
(28, 1, 'Order-669294a6be625', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '4', 'ưqeweq', 'sdfsdafsdsd', '2024-07-13 07:52:22', '2024-07-13 07:52:22'),
(29, 1, 'Order-669384d7d90ef', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '4', 'ưqeweq', 'dsfdsafdafdsa', '2024-07-14 00:57:11', '2024-07-14 00:57:11'),
(30, 1, 'Order-6693878b04ed4', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, 'sfdsfds', 'ưqeweq', 'sđfadsfsd', '2024-07-14 01:08:43', '2024-07-14 01:08:43'),
(31, 1, 'Order-669388fed61fd', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '4', 'ưqeweq', 'dffsdfsd', '2024-07-14 01:14:54', '2024-07-14 01:14:54'),
(32, 1, 'Order-669389c42e4bd', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '4', 'ưqeweq', 'dffsdfsd', '2024-07-14 01:18:12', '2024-07-14 01:18:12'),
(33, 1, 'Order-66938a8375df8', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '4', 'ưqeweq', 'dffsdfsd', '2024-07-14 01:21:23', '2024-07-14 01:21:23'),
(34, 1, 'Order-66938a969a8a1', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, '4', 'ưqeweq', 'dffsdfsd', '2024-07-14 01:21:42', '2024-07-14 01:21:42'),
(35, 1, 'Order-66938b101e6fc', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, 'dssdf', 'ưqeweq', 'sdfdsddsf', '2024-07-14 01:23:44', '2024-07-14 01:23:44'),
(36, 1, 'Order-66938bac5cc80', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, 'asdas', 'asdas', 'assdasds', '2024-07-14 01:26:20', '2024-07-14 01:26:20'),
(37, 1, 'Order-66938be884265', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, 'asdas', 'asdas', 'assdasds', '2024-07-14 01:27:20', '2024-07-14 01:27:20'),
(38, 1, 'Order-66938e0614eac', 380160, 'VnPay', 'pending', 'pending', NULL, NULL, NULL, 'fddf', 'dffddfdf', 'dffddfdf', '2024-07-14 01:36:22', '2024-07-14 01:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(16,2) NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `total` double(16,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `name`, `price`, `color`, `size`, `image`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Lars Sweeney', 125730.00, 'Yellow', 'XXL', '1ac6f65ccf7044cfa85e44373d7d204e.jpg', 1, 125730.00, '2024-01-13 05:09:19', '2024-01-13 05:09:19'),
(2, 2, NULL, 'Lars Sweeney', 125730.00, 'Yellow', 'XXL', '1ac6f65ccf7044cfa85e44373d7d204e.jpg', 11, 1383030.00, '2024-01-13 05:11:26', '2024-01-13 05:11:26'),
(3, 3, NULL, 'Lars Sweeney', 125730.00, 'Yellow', 'XXL', '1ac6f65ccf7044cfa85e44373d7d204e.jpg', 4, 502920.00, '2024-01-13 05:23:28', '2024-01-13 05:23:28'),
(4, 4, 8, 'Pillowcase', 436500.00, 'Green', 'L', '3b48e2b0fd4cf5a4c3b34fc8e8f45f80.jpg', 1, 436500.00, '2024-01-14 06:02:11', '2024-01-14 06:02:11'),
(5, 5, 11, 'Daisy Floral Print Straps Jumpsuit', 106666.56, 'Yellow', 'M', '520fe9635f305d3785b4e5d967ba14b3.jpg', 1, 106666.56, '2024-01-14 06:11:34', '2024-01-14 06:11:34'),
(6, 6, 11, 'Daisy Floral Print Straps Jumpsuit', 106666.56, 'Yellow', 'M', '520fe9635f305d3785b4e5d967ba14b3.jpg', 1, 106666.56, '2024-01-14 06:52:36', '2024-01-14 06:52:36'),
(7, 7, 11, 'Daisy Floral Print Straps Jumpsuit', 106666.56, 'Yellow', 'M', '520fe9635f305d3785b4e5d967ba14b3.jpg', 1, 106666.56, '2024-01-14 06:52:58', '2024-01-14 06:52:58'),
(8, 8, 11, 'Daisy Floral Print Straps Jumpsuit', 106666.56, 'Yellow', 'M', '520fe9635f305d3785b4e5d967ba14b3.jpg', 1, 106666.56, '2024-01-14 06:56:50', '2024-01-14 06:56:50'),
(9, 9, 11, 'Daisy Floral Print Straps Jumpsuit', 106666.56, 'Yellow', 'M', '520fe9635f305d3785b4e5d967ba14b3.jpg', 1, 106666.56, '2024-01-14 06:57:43', '2024-01-14 06:57:43'),
(10, 10, 8, 'Pillowcase', 436500.00, 'Green', 'L', '3b48e2b0fd4cf5a4c3b34fc8e8f45f80.jpg', 1, 436500.00, '2024-01-15 00:13:11', '2024-01-15 00:13:11'),
(11, 11, 26, 'September Cobb', 190932.48, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190932.48, '2024-01-15 21:57:59', '2024-01-15 21:57:59'),
(12, 12, 26, 'September Cobb', 190932.48, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190932.48, '2024-01-15 21:58:38', '2024-01-15 21:58:38'),
(13, 13, 26, 'September Cobb', 190932.48, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190932.48, '2024-01-15 21:59:28', '2024-01-15 21:59:28'),
(14, 14, 26, 'September Cobb', 190932.48, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190932.48, '2024-01-15 22:00:33', '2024-01-15 22:00:33'),
(20, 20, 22, 'Sandan Green Colorful', 115735.62, 'Green', 'M', 'fc9ac021e6562c509035860e4487b724.jpg', 1, 115735.62, '2024-01-15 23:12:59', '2024-01-15 23:12:59'),
(21, 21, 22, 'Sandan Green Colorful', 115735.62, 'Green', 'M', 'fc9ac021e6562c509035860e4487b724.jpg', 1, 115735.62, '2024-01-15 23:14:59', '2024-01-15 23:14:59'),
(22, 22, 22, 'Sandan Green Colorful', 115620.00, 'Green', 'M', 'fc9ac021e6562c509035860e4487b724.jpg', 1, 115620.00, '2024-01-15 23:16:32', '2024-01-15 23:16:32'),
(23, 23, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-01-15 23:20:24', '2024-01-15 23:20:24'),
(24, 24, 7, 'Mens Porcelain Shirt', 321780.00, 'Red', 'L', 'd8d5da9689a05eb486950b6e86c86940.jpg', 1, 321780.00, '2024-01-19 15:51:37', '2024-01-19 15:51:37'),
(25, 25, 7, 'Mens Porcelain Shirt', 321780.00, 'Red', 'L', 'd8d5da9689a05eb486950b6e86c86940.jpg', 1, 321780.00, '2024-01-19 15:51:49', '2024-01-19 15:51:49'),
(26, 26, 7, 'Mens Porcelain Shirt', 321780.00, 'Red', 'L', 'd8d5da9689a05eb486950b6e86c86940.jpg', 1, 321780.00, '2024-01-19 18:49:01', '2024-01-19 18:49:01'),
(27, 26, 25, 'Shoes AC', 523800.00, 'Brown', 'M', '1f01e4fdb95f43b4bad010c69a2c08f0.jpg', 2, 1047600.00, '2024-01-19 18:49:01', '2024-01-19 18:49:01'),
(28, 27, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-01-19 21:11:15', '2024-01-19 21:11:15'),
(29, 28, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-13 07:52:22', '2024-07-13 07:52:22'),
(30, 28, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-13 07:52:22', '2024-07-13 07:52:22'),
(31, 29, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 00:57:11', '2024-07-14 00:57:11'),
(32, 29, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 00:57:11', '2024-07-14 00:57:11'),
(33, 30, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:08:43', '2024-07-14 01:08:43'),
(34, 30, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:08:43', '2024-07-14 01:08:43'),
(35, 31, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:14:54', '2024-07-14 01:14:54'),
(36, 31, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:14:54', '2024-07-14 01:14:54'),
(37, 32, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:18:12', '2024-07-14 01:18:12'),
(38, 32, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:18:12', '2024-07-14 01:18:12'),
(39, 33, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:21:23', '2024-07-14 01:21:23'),
(40, 33, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:21:23', '2024-07-14 01:21:23'),
(41, 34, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:21:42', '2024-07-14 01:21:42'),
(42, 34, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:21:42', '2024-07-14 01:21:42'),
(43, 35, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:23:44', '2024-07-14 01:23:44'),
(44, 35, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:23:44', '2024-07-14 01:23:44'),
(45, 36, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:26:20', '2024-07-14 01:26:20'),
(46, 36, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:26:20', '2024-07-14 01:26:20'),
(47, 37, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:27:20', '2024-07-14 01:27:20'),
(48, 37, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:27:20', '2024-07-14 01:27:20'),
(49, 38, 26, 'September Cobb', 190080.00, 'Pink', 'XS', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:36:22', '2024-07-14 01:36:22'),
(50, 38, 26, 'September Cobb', 190080.00, 'White', 'L', '6832c7bfce2209621562a6bfd80838cb.jpg', 1, 190080.00, '2024-07-14 01:36:22', '2024-07-14 01:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'read user management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(2, 'create user management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(3, 'update user management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(4, 'delete user management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(5, 'read product management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(6, 'create product management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(7, 'update product management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(8, 'delete product management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(9, 'read category management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(10, 'create category management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(11, 'update category management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(12, 'delete category management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(13, 'read brand management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(14, 'create brand management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(15, 'update brand management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(16, 'delete brand management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(17, 'read blog management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(18, 'create blog management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(19, 'update blog management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(20, 'delete blog management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(21, 'read banner management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(22, 'create banner management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(23, 'update banner management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(24, 'delete banner management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(25, 'read role management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(26, 'create role management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(27, 'update role management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(28, 'delete role management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(29, 'read permission management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(30, 'create permission management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(31, 'update permission management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(32, 'delete permission management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(33, 'read order management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(34, 'create order management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(35, 'update order management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(36, 'delete order management', 'web', '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(49, 'read product option management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(50, 'create product option management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(51, 'update product option management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(52, 'delete product option management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(65, 'read report management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(66, 'create report management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(67, 'update report management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(68, 'delete report management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(73, 'read contact management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(74, 'create contact management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(75, 'update contact management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(76, 'delete contact management', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `views` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `views` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `excerpt`, `content`, `thumbnail`, `is_published`, `views`, `slug`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'Best smartwatch 2024: the top wearables you can buy today', '<p>Best smartwatch 2024: the top wearables you can buy today</p>', '<p>Best smartwatch 2024: the top wearables you can buy today</p>', '6a5b5ba96cbde96bdd7b3619fcac06bc.jpg', 1, 13, 'best-smartwatch-2024-the-top-wearables-you-can-buy-today', '2024-01-15 21:30:04', '2024-04-07 11:35:41'),
(3, 1, 1, 'The litigants on the screen are not actors', '<p>The litigants on the screen are not actors</p>', '<p>The litigants on the screen are not actors</p>', 'ca320d7d42164000aedd901b74bcfbcb.jpg', 1, 7, 'the-litigants-on-the-screen-are-not-actors', '2024-01-15 21:31:14', '2024-05-01 05:14:40'),
(4, 1, 1, 'We got a right to pick a little fight, Bonanza', '<p>We got a right to pick a little fight, Bonanza</p>', '<p>We got a right to pick a little fight, Bonanza</p>', '00a8bcd2b7023df019a3020622bcf5ab.jpg', 1, 19, 'we-got-a-right-to-pick-a-little-fight-bonanza-65a6096d929a4', '2024-01-15 21:31:29', '2024-06-11 05:52:17'),
(5, 1, 1, 'My entrance exam was on a book of matches', '<p>My entrance exam was on a book of matches</p>', '<p>My entrance exam was on a book of matches</p>', '35c4b2222fa516901c107e63cacf85ba.jpg', 1, 11, 'my-entrance-exam-was-on-a-book-of-matches', '2024-01-15 21:31:46', '2024-06-11 05:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'nihil', 'Laudantium consequatur et repellendus. Consequatur et consectetur molestiae et. Officiis cupiditate necessitatibus eius illum voluptates numquam. Impedit aut magnam et.', 'nihil', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(2, 'illum', 'Suscipit similique animi sit. Sit facere molestias voluptatem quibusdam.', 'illum', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(3, 'ipsa', 'Vero sit quam aliquam praesentium fugiat eveniet corporis. Quia deleniti necessitatibus reiciendis quis quia. Enim ea vel odio nam repellendus fuga magni.', 'ipsa', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(4, 'commodi', 'Laudantium minus minima molestiae. Et excepturi ut animi deleniti vitae ad. Illum ut quam quos voluptatibus quis.', 'commodi', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(5, 'quia', 'Eum velit aut et expedita. Maxime aut et consequatur animi non reiciendis explicabo. Consequatur sunt dicta dolorem sed quod vero aliquid. Sunt aut eligendi atque praesentium eum sapiente.', 'quia', '2024-01-12 07:31:26', '2024-01-12 07:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `product_category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(16,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `product_category_id`, `name`, `sku`, `subtitle`, `description`, `thumbnail`, `slug`, `price`, `discount`, `condition`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 1, 16, 'Sandan Colorful AB', 'SCV1', '<p>Sandan Colorful AB</p>', '<p>Sandan Colorful AB</p>', '641ea8fee6a97e31f80989fa7918b3d5.jpg', 'sandan-colorful-ab-65a61ec477379', 117000.00, '3.00', 'new', 1, '2024-01-14 03:43:35', '2024-01-15 23:14:28'),
(7, 1, 11, 'Mens Porcelain Shirt', '111AB', '<p>Mens Porcelain Shirt</p>', '<p>Mens Porcelain Shirt</p>', 'd8d5da9689a05eb486950b6e86c86940.jpg', 'mens-porcelain-shirt', 346000.00, '7.00', 'new', 1, '2024-01-14 03:45:29', '2024-01-14 03:45:29'),
(8, 1, 13, 'Pillowcase', 'PLL1', '<p>Pillocase</p>', '<p>Pillocase</p>', '3b48e2b0fd4cf5a4c3b34fc8e8f45f80.jpg', 'pillowcase', 450000.00, '3.00', 'new', 1, '2024-01-14 03:47:26', '2024-01-14 03:47:26'),
(9, 1, 11, 'Ethnic Dun Shirts', '111ABC', '<p>Ethnic Floral Casual Shirts</p>', '<p>Ethnic Floral Casual Shirts</p>', '06e29be213b5e09a0aa2480a4f079170.jpg', 'ethnic-dun-shirts', 117000.00, '3.00', 'hot', 1, '2024-01-14 03:49:24', '2024-01-16 02:26:09'),
(10, 2, 11, 'Colorful Hawaiian Shirts', '3', '<p>Colorful Hawaiian Shirts</p>', '<p>Colorful Hawaiian Shirts</p>', 'af39645247b3f3fc6577a1c95f10eb3f.jpg', 'colorful-hawaiian-shirts-65a4f600e0f26', 234000.00, '3.00', 'best_sale', 1, '2024-01-14 03:52:07', '2024-01-15 02:08:16'),
(11, 1, 11, 'Daisy Floral Print Straps', 'SCS', '<p>Daisy Floral Print Straps Jumpsuit</p>', '<p>Daisy Floral Print Straps Jumpsuit</p>', '520fe9635f305d3785b4e5d967ba14b3.jpg', 'daisy-floral-print-straps-65a61faf649be', 111000.00, '4.00', 'new', 1, '2024-01-14 03:54:18', '2024-01-15 23:18:23'),
(12, 2, 15, 'Jumpsuits Susan', '111AX', '<p>Jumpsuits Susan</p>', '<p>Jumpsuits Susan</p>', 'f3f4aae6fae97f3778c156f6161ce8ec.jpg', 'jumpsuits-susan', 234000.00, '5.00', 'hot', 1, '2024-01-14 03:57:27', '2024-01-14 03:57:27'),
(13, 1, 17, 'T-Shirts Gray AZZ', 'ADAX', '<p>T-Shirts Gray AZZ</p>', '<p>T-Shirts Gray AZZ</p>', '45646dc6689b6dd27d618423ecffcf34.jpg', 't-shirts-gray-azz', 123000.00, '4.00', 'hot', 1, '2024-01-15 00:24:05', '2024-01-15 00:24:05'),
(14, 4, 17, 'T-Shirts Ira Dalton', 'Quae sunt aut sint', '<p>T-Shirts Ira Dalton</p>', '<p>T-Shirts Ira Dalton</p>', '11c9c4f4dd47bf827a341ef18b746077.jpg', 't-shirts-ira-dalton-65a4dea0a7da5', 487000.00, '6.00', 'best_sale', 1, '2024-01-15 00:28:22', '2024-01-15 00:28:32'),
(15, 1, 17, 'Sonia Gilliam T-Shirts', 'In commodi laboris a', '<p>Sonia Gilliam T-Shirts</p>', '<p>Sonia Gilliam T-Shirts</p>', '22641071a959359c85f030da41557993.jpg', 'sonia-gilliam-t-shirts', 647000.00, '7.00', 'best_sale', 1, '2024-01-15 00:29:49', '2024-01-15 00:29:49'),
(16, 3, 15, 'Jumpsuits Susan AC', 'Jum12', '<p>Jumpsuits Susan AC</p>', '<p>Jumpsuits Susan AC</p>', '38e032129b746e657eca387501f23012.jpg', 'jumpsuits-susan-ac-65a61f9db7a5c', 344000.00, '4.00', 'new', 1, '2024-01-15 01:57:03', '2024-01-15 23:18:05'),
(17, 1, 14, 'Ruffled Solid Long', 'bag11', '<p>Ruffled Solid Long Sleeve Blouse</p>', '<p>Ruffled Solid Long Sleeve Blouse</p>', '36600d5e5ff49803a9f91c3f0bdcb380.jpg', 'ruffled-solid-long', 710000.00, '3.00', 'new', 1, '2024-01-15 02:03:38', '2024-01-15 21:45:48'),
(18, 3, 15, 'Jumpsuits Sheet', '33B', '<p>Jumpsuits Sheet</p>', '<p>Jumpsuits Sheet</p>', '6f005da9dba4324f895a67c6279f4220.jpg', 'jumpsuits-sheet', 117000.00, '4.00', 'new', 1, '2024-01-15 02:06:02', '2024-01-15 02:06:02'),
(19, 2, 11, 'Hawaiian Sky Shirts', 'AAAAA', '<p>Hawaiian Sky Shirts</p>', '<p>Hawaiian Sky Shirts</p>', 'ec5ad2939ffd34cfef4fd88da4b15350.jpg', 'hawaiian-sky-shirts', 231000.00, '4.00', 'best_sale', 1, '2024-01-15 02:07:43', '2024-01-15 23:19:30'),
(20, 2, 11, 'Ethnic Floral Shirts', 'dddA', '<p>Ethnic Floral Casual Shirts</p>', '<p>Ethnic Floral Casual Shirts</p>', 'f1b0e00f4f29d90e6f8efae5337acb84.jpg', 'ethnic-floral-shirts', 231000.00, '4.00', 'hot', 1, '2024-01-15 02:14:57', '2024-01-16 02:25:53'),
(21, 1, 11, 'Greeen Sleeve Lapel Shirt', '133AB', '<p>Greeen Sleeve Lapel Shirt</p>', '<p>Greeen Sleeve Lapel Shirt</p>', 'c381d28a4dfa4e1ad894827bfd166c4e.jpg', 'greeen-sleeve-lapel-shirt-65a61fe18e8c3', 344000.00, '3.00', 'best_sale', 1, '2024-01-15 02:17:49', '2024-01-15 23:19:13'),
(22, 3, 16, 'Sandan Green Colorful', 'Sa11', '<p>Sandan Green Colorful&nbsp;</p>', '<p>Sandan Green Colorful&nbsp;</p>', 'fc9ac021e6562c509035860e4487b724.jpg', 'sandan-green-colorful', 123000.00, '6.00', 'hot', 1, '2024-01-15 02:19:55', '2024-01-15 23:16:07'),
(23, 3, 11, 'Blue Hawaiian Shirts', '1C1AB', '<p>Blue Hawaiian Shirts</p>', '<p>Blue Hawaiian Shirts</p>', 'a3ec8581b61c04d90e111bc8490207eb.jpg', 'blue-hawaiian-shirts-65a61fbf8232b', 123000.00, '3.00', 'best_sale', 1, '2024-01-15 02:22:33', '2024-01-15 23:18:39'),
(24, 3, 17, 'T-Shirts Ira ACX', 'ACFF', '<p>T-Shirts Ira ACX</p>', '<p>T-Shirts Ira ACX</p>', 'b8116aff72e613c60b8e25fc24e5329d.jpg', 't-shirts-ira-acx-65a61f8a5854e', 231000.00, '4.00', 'new', 1, '2024-01-15 02:24:27', '2024-01-15 23:17:46'),
(25, 3, 12, 'Shoes AC', 'Sho111', '<p>Shoes AC</p>', '<p>Shoes AC</p>', '1f01e4fdb95f43b4bad010c69a2c08f0.jpg', 'shoes-ac', 540000.00, '3.00', 'new', 1, '2024-01-15 02:26:54', '2024-01-15 02:26:54'),
(26, 5, 11, 'September Cobb', 'Qui sint aliquip et', '<p>September Cobb</p>', '<p>September Cobb</p>', '6832c7bfce2209621562a6bfd80838cb.jpg', 'september-cobb-65a61f7bab910', 198000.00, '4.00', 'new', 1, '2024-01-15 02:51:34', '2024-01-15 23:17:31'),
(27, 1, 12, 'Shoes BCX21', 'SHRR', '<p>Shoes BCX21</p>', '<p>Shoes BCX21</p>', 'b600cddb9249c98d903287b6e5939b83.jpg', 'shoes-bcx21', 760000.00, '4.00', 'best_sale', 1, '2024-01-19 08:13:51', '2024-01-19 08:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`, `image`, `slug`, `is_active`, `parent_id`, `created_at`, `updated_at`) VALUES
(11, 'Shirts', '<p>Shirts</p>', 'dd1cf332365aa4e6e8c038d2d96b592a.jpg', 'shirts', 1, NULL, '2024-01-14 03:39:47', '2024-01-14 03:39:47'),
(12, 'Shoes', '<p>Shoes</p>', '96e9283d6e1e305b00660b50bb394872.jpg', 'shoes', 1, NULL, '2024-01-14 03:40:28', '2024-01-14 03:40:28'),
(13, 'Pillowcase', '<p>Pillowcase</p>', 'd8a23113e4c95597f53f355ccf33342e.jpg', 'pillowcase', 1, NULL, '2024-01-14 03:40:58', '2024-01-14 03:40:58'),
(14, 'Bags', '<p>Bags</p>', '1a023eb73acdbd813a7f49ddda5c0716.jpg', 'bags', 1, NULL, '2024-01-14 03:41:23', '2024-01-14 03:41:23'),
(15, 'Jumpsuits', '<p>Jumpsuits</p>', '2093ab2fc0b3de2113643673e6b38dde.jpg', 'jumpsuits', 1, NULL, '2024-01-14 03:41:49', '2024-01-14 03:41:49'),
(16, 'Sandan', '<p>Sandan</p>', 'e0a838eefae5cab56332e1481f5b4d60.jpg', 'sandan', 1, NULL, '2024-01-14 03:42:18', '2024-01-14 03:42:18'),
(17, 'T-Shirts', '<p>T-Shirts</p>', '3575dd6061b4317e26dedb005e9e994f.jpg', 't-shirts', 1, NULL, '2024-01-15 00:20:59', '2024-01-15 00:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messages` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_comments`
--

INSERT INTO `product_comments` (`id`, `product_id`, `user_id`, `email`, `name`, `messages`, `rating`, `is_active`, `created_at`, `updated_at`) VALUES
(105, 8, 5, 'datxomcity2@gmail.com', 'Nguyễn Thành Đạt', 'oke', 3, 1, '2024-01-14 06:01:26', '2024-01-14 06:01:26'),
(109, 26, 1, 'admin@example.com', 'Giày Nam', 'demo', 5, 1, '2024-05-25 21:04:53', '2024-05-25 21:04:53'),
(110, 26, 1, 'admin@example.com', 'Giày Nam', 'dasdsa', 4, 1, '2024-05-25 21:05:19', '2024-05-25 21:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(5, 6, '5a32aad1162de9e6229321e7f9984402.jpg', '2024-01-14 03:43:35', '2024-01-14 03:43:35'),
(6, 6, 'eeb3d14f00e819ba93afb42e65a9edfb.jpg', '2024-01-14 03:43:35', '2024-01-14 03:43:35'),
(7, 7, '49b6878495a64863a23fcdff60f99338.jpg', '2024-01-14 03:45:29', '2024-01-14 03:45:29'),
(8, 7, '7cacf1e72d59409bdd40030b1b2b13b1.jpg', '2024-01-14 03:45:29', '2024-01-14 03:45:29'),
(9, 8, '9b699de6fe1c64c435b88215ea846fe2.jpg', '2024-01-14 03:47:26', '2024-01-14 03:47:26'),
(10, 9, 'eb497ff31878a6388ced9302b403fe9f.jpg', '2024-01-14 03:49:24', '2024-01-14 03:49:24'),
(11, 9, '9840c04b6c97199496b2fce0cd6255e0.jpg', '2024-01-14 03:49:24', '2024-01-14 03:49:24'),
(12, 9, '1d09e24c03192779325af15100390a86.jpg', '2024-01-14 03:49:24', '2024-01-14 03:49:24'),
(13, 10, '21bb97b0b3eceb54c4a7603617af014a.jpg', '2024-01-14 03:52:07', '2024-01-14 03:52:07'),
(14, 10, 'b2ccbb3eb1cc1204dcaae11699913020.jpg', '2024-01-14 03:52:07', '2024-01-14 03:52:07'),
(15, 11, '1d2d2d779208fbde6a76bd4ab49dfb28.jpg', '2024-01-14 03:54:18', '2024-01-14 03:54:18'),
(16, 11, 'ad55279be824ed48d95a4620a669c9d3.jpg', '2024-01-14 03:54:18', '2024-01-14 03:54:18'),
(17, 12, 'f1545bd8220ce9a9baa3da88b61c73da.jpg', '2024-01-14 03:57:27', '2024-01-14 03:57:27'),
(18, 12, 'ef0c7198395b7fc75d8790df8b541b5b.jpg', '2024-01-14 03:57:27', '2024-01-14 03:57:27'),
(19, 13, '3cbc8b0b74a52165c0cee569f903398a.jpg', '2024-01-15 00:24:05', '2024-01-15 00:24:05'),
(20, 13, 'fb693f49d04e0aca97303b600b0718cf.jpg', '2024-01-15 00:24:05', '2024-01-15 00:24:05'),
(21, 14, 'f0a22a05517a7363dffbb722337c4afa.jpg', '2024-01-15 00:28:22', '2024-01-15 00:28:22'),
(22, 14, 'afbcbe1733e844b8fa3b36d8fc1aa218.jpg', '2024-01-15 00:28:22', '2024-01-15 00:28:22'),
(23, 15, '7dfe539b3a5f3c99557222d7fcd85b6a.jpg', '2024-01-15 00:29:49', '2024-01-15 00:29:49'),
(24, 15, '6b5c54187cd45a560c1791d550e9b8af.jpg', '2024-01-15 00:29:49', '2024-01-15 00:29:49'),
(25, 16, 'c073c4b9d59447dd5fbbdeefc858de9a.jpg', '2024-01-15 01:57:03', '2024-01-15 01:57:03'),
(26, 16, '56695bf9f953f68175f960d3d0c0d74b.jpg', '2024-01-15 01:57:03', '2024-01-15 01:57:03'),
(27, 17, 'cd4a2c7f72a5494031dfdd4708edeac7.jpg', '2024-01-15 02:03:38', '2024-01-15 02:03:38'),
(28, 17, '348cdb5f9e802d52a31adfa9cdf2389d.jpg', '2024-01-15 02:03:38', '2024-01-15 02:03:38'),
(29, 18, '9eab0ca8bc26f6086183f0df5d470cd2.jpg', '2024-01-15 02:06:02', '2024-01-15 02:06:02'),
(30, 18, '1ff9ec0a9e171e8d6bb0275df6d2dbd0.jpg', '2024-01-15 02:06:02', '2024-01-15 02:06:02'),
(31, 19, '829e707f3e060d4b62f297675fd8a6e2.jpg', '2024-01-15 02:07:43', '2024-01-15 02:07:43'),
(32, 19, '26f2f09cc4088944ca12ecdc0025c3aa.jpg', '2024-01-15 02:07:43', '2024-01-15 02:07:43'),
(33, 20, '2e1c88bd77c7976ae485f79e408119f6.jpg', '2024-01-15 02:14:57', '2024-01-15 02:14:57'),
(34, 20, 'bad20948406642cd8cb8bcb0ebf93e4f.jpg', '2024-01-15 02:14:57', '2024-01-15 02:14:57'),
(35, 21, '229b31871ffa06e7ad60a9c9e61e4882.jpg', '2024-01-15 02:17:49', '2024-01-15 02:17:49'),
(36, 21, 'da3410ff97ce5428ed826e920152607a.jpg', '2024-01-15 02:17:49', '2024-01-15 02:17:49'),
(37, 22, '7f4e72863d6efcc3b5066b29e47f7ab3.jpg', '2024-01-15 02:19:55', '2024-01-15 02:19:55'),
(38, 22, 'ee0c9fdd23cf63da8161716116dc99fe.jpg', '2024-01-15 02:19:55', '2024-01-15 02:19:55'),
(39, 23, '041a303725eede10ff9f725488e38a85.jpg', '2024-01-15 02:22:33', '2024-01-15 02:22:33'),
(40, 23, '834b41645d8f4bf66c4afe4a9250d530.jpg', '2024-01-15 02:22:33', '2024-01-15 02:22:33'),
(41, 24, 'e6f41fb73e4a6c40afd1e284db9d9d10.jpg', '2024-01-15 02:24:27', '2024-01-15 02:24:27'),
(42, 24, '2712c222e2d3d871077819cb5116f5bd.jpg', '2024-01-15 02:24:27', '2024-01-15 02:24:27'),
(43, 25, 'd3d74ae61e00745686a59eb9a845f863.jpg', '2024-01-15 02:26:54', '2024-01-15 02:26:54'),
(44, 25, '4c0525a8134f0a50cc0fd8af98f50e51.jpg', '2024-01-15 02:26:54', '2024-01-15 02:26:54'),
(45, 26, 'd49179ead3c7de2dedd8616e76c075d7.jpg', '2024-01-15 02:51:34', '2024-01-15 02:51:34'),
(46, 26, '3485dd34f3075fd36e03bda14378bcb9.jpg', '2024-01-15 02:51:34', '2024-01-15 02:51:34'),
(47, 27, '91f095e475cfa8f83f483ae05e9f2ed9.jpg', '2024-01-19 08:13:51', '2024-01-19 08:13:51'),
(48, 27, '320484188463573f17f1dfd6e52d8291.jpg', '2024-01-19 08:13:51', '2024-01-19 08:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`id`, `name`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Blue', 'color', 'blue', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(2, 'Red', 'color', 'red', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(3, 'Green', 'color', 'green', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(4, 'Yellow', 'color', 'yellow', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(5, 'Black', 'color', 'black', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(6, 'White', 'color', 'white', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(7, 'Pink', 'color', 'pink', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(8, 'Purple', 'color', 'purple', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(9, 'Orange', 'color', 'orange', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(10, 'Brown', 'color', 'brown', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(11, 'Gray', 'color', 'gray', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(12, 'XS', 'size', 'xs', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(13, 'S', 'size', 's', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(14, 'M', 'size', 'm', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(15, 'L', 'size', 'l', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(16, 'XL', 'size', 'xl', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(17, 'XXL', 'size', 'xxl', '2024-01-12 07:31:26', '2024-01-12 07:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_option_values`
--

CREATE TABLE `product_option_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `color_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `price` double(16,2) NOT NULL,
  `in_stock` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_option_values`
--

INSERT INTO `product_option_values` (`id`, `product_id`, `color_id`, `size_id`, `price`, `in_stock`, `created_at`, `updated_at`) VALUES
(7, 7, 2, 15, 346000.00, 11, '2024-01-14 03:45:29', '2024-01-14 03:45:29'),
(8, 7, 1, 15, 346000.00, 22, '2024-01-14 03:45:29', '2024-01-14 03:45:29'),
(9, 7, 9, 16, 346000.00, 11, '2024-01-14 03:45:29', '2024-01-14 03:45:29'),
(10, 8, 3, 15, 450000.00, 11, '2024-01-14 03:47:26', '2024-01-14 03:47:26'),
(24, 12, 11, 14, 234000.00, 22, '2024-01-14 03:57:27', '2024-01-14 03:57:27'),
(25, 12, 11, 15, 234000.00, 11, '2024-01-14 03:57:27', '2024-01-14 03:57:27'),
(26, 13, 1, 14, 123000.00, 10, '2024-01-15 00:24:05', '2024-01-15 00:24:05'),
(27, 13, 1, 15, 123000.00, 11, '2024-01-15 00:24:05', '2024-01-15 00:24:05'),
(28, 13, 2, 15, 123000.00, 11, '2024-01-15 00:24:05', '2024-01-15 00:24:05'),
(29, 13, 3, 14, 123000.00, 13, '2024-01-15 00:24:05', '2024-01-15 00:24:05'),
(32, 14, 5, 15, 487000.00, 25, '2024-01-15 00:28:32', '2024-01-15 00:28:32'),
(33, 14, 2, 14, 487000.00, 22, '2024-01-15 00:28:32', '2024-01-15 00:28:32'),
(34, 15, 11, 14, 647000.00, 47, '2024-01-15 00:29:49', '2024-01-15 00:29:49'),
(35, 15, 10, 14, 647000.00, 33, '2024-01-15 00:29:49', '2024-01-15 00:29:49'),
(39, 18, 8, 15, 117000.00, 11, '2024-01-15 02:06:02', '2024-01-15 02:06:02'),
(40, 18, 8, 14, 117000.00, 23, '2024-01-15 02:06:02', '2024-01-15 02:06:02'),
(43, 10, 4, 12, 234000.00, 22, '2024-01-15 02:08:16', '2024-01-15 02:08:16'),
(44, 10, 4, 13, 234000.00, 33, '2024-01-15 02:08:16', '2024-01-15 02:08:16'),
(45, 10, 4, 15, 234000.00, 22, '2024-01-15 02:08:16', '2024-01-15 02:08:16'),
(58, 25, 10, 14, 540000.00, 11, '2024-01-15 02:26:54', '2024-01-15 02:26:54'),
(59, 25, 10, 15, 540000.00, 22, '2024-01-15 02:26:54', '2024-01-15 02:26:54'),
(60, 25, 8, 13, 540000.00, 13, '2024-01-15 02:26:54', '2024-01-15 02:26:54'),
(66, 17, 3, 16, 710000.00, 11, '2024-01-15 21:45:48', '2024-01-15 21:45:48'),
(69, 6, 1, 15, 117000.00, 11, '2024-01-15 23:14:28', '2024-01-15 23:14:28'),
(70, 6, 1, 16, 117000.00, 33, '2024-01-15 23:14:28', '2024-01-15 23:14:28'),
(71, 22, 3, 14, 123000.00, 11, '2024-01-15 23:16:07', '2024-01-15 23:16:07'),
(72, 22, 3, 15, 123000.00, 33, '2024-01-15 23:16:07', '2024-01-15 23:16:07'),
(73, 26, 7, 12, 198000.00, 8, '2024-01-15 23:17:31', '2024-01-15 23:17:31'),
(74, 26, 6, 15, 198000.00, 32, '2024-01-15 23:17:31', '2024-01-15 23:17:31'),
(75, 24, 10, 14, 231000.00, 33, '2024-01-15 23:17:46', '2024-01-15 23:17:46'),
(76, 24, 10, 15, 231000.00, 33, '2024-01-15 23:17:46', '2024-01-15 23:17:46'),
(77, 16, 10, 14, 344000.00, 11, '2024-01-15 23:18:05', '2024-01-15 23:18:05'),
(78, 16, 10, 15, 344000.00, 16, '2024-01-15 23:18:05', '2024-01-15 23:18:05'),
(79, 11, 4, 14, 111000.00, 22, '2024-01-15 23:18:23', '2024-01-15 23:18:23'),
(80, 11, 4, 15, 111000.00, 33, '2024-01-15 23:18:23', '2024-01-15 23:18:23'),
(81, 23, 1, 14, 123000.00, 33, '2024-01-15 23:18:39', '2024-01-15 23:18:39'),
(82, 23, 1, 15, 123000.00, 44, '2024-01-15 23:18:39', '2024-01-15 23:18:39'),
(85, 21, 3, 14, 344000.00, 33, '2024-01-15 23:19:13', '2024-01-15 23:19:13'),
(86, 21, 3, 15, 344000.00, 11, '2024-01-15 23:19:13', '2024-01-15 23:19:13'),
(87, 19, 9, 14, 231000.00, 11, '2024-01-15 23:19:30', '2024-01-15 23:19:30'),
(88, 19, 9, 15, 231000.00, 44, '2024-01-15 23:19:30', '2024-01-15 23:19:30'),
(89, 20, 8, 14, 231000.00, 11, '2024-01-16 02:25:53', '2024-01-16 02:25:53'),
(90, 20, 8, 15, 231000.00, 33, '2024-01-16 02:25:53', '2024-01-16 02:25:53'),
(91, 9, 1, 12, 117000.00, 11, '2024-01-16 02:26:09', '2024-01-16 02:26:09'),
(92, 9, 1, 15, 117000.00, 22, '2024-01-16 02:26:09', '2024-01-16 02:26:09'),
(93, 9, 1, 16, 117000.00, 9, '2024-01-16 02:26:09', '2024-01-16 02:26:09'),
(94, 9, 10, 12, 117000.00, 22, '2024-01-16 02:26:09', '2024-01-16 02:26:09'),
(95, 27, 11, 15, 760000.00, 11, '2024-01-19 08:13:51', '2024-01-19 08:13:51'),
(96, 27, 11, 16, 760000.00, 32, '2024-01-19 08:13:51', '2024-01-19 08:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26'),
(2, 'employee', 'web', '2024-01-12 07:31:26', '2024-01-12 07:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(5, 2),
(9, 2),
(13, 2),
(17, 2),
(21, 2),
(33, 2),
(49, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `address_2` text COLLATE utf8mb4_unicode_ci,
  `total_buy` double NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_active`, `phone`, `address`, `address_2`, `total_buy`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@example.com', '2024-07-13 14:51:56', '$2y$12$Hs3siQXIfJflCxZOhx1aouUyPxRAKdnAFmk1yN1UfT2NaXlfdNBGe', 1, NULL, NULL, NULL, 0, NULL, '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(2, 'Employee', 'employee@example.com', NULL, '$2y$12$orfhzmtSHHHKHxXmYe/v2eStBF5tIIFGiMbpuuWCc8htxXPuanzw6', 1, NULL, NULL, NULL, 0, NULL, '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(3, 'Customer', 'client@example.com', NULL, '$2y$12$B0g5/9BuITmhqATPFHUrguE2zu.QyIIfAzLUz2Hpo9cZZ5QIQjDRm', 1, NULL, NULL, NULL, 0, NULL, '2024-01-12 07:31:25', '2024-01-12 07:31:25'),
(5, 'nguyenthanhdat1010', 'datxomcity2@gmail.com', '2024-01-14 06:00:30', '$2y$12$1zrlLXRdpGYL7VpuJLldJ.2pQEfXIkIAT5o3e2ZuVD0Wv1as663yW', 1, NULL, NULL, NULL, 0, NULL, '2024-01-14 05:59:55', '2024-01-14 06:00:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_id_unique` (`order_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_author_id_foreign` (`author_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_author_id_foreign` (`author_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_product_category_id_foreign` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_comments_product_id_foreign` (`product_id`),
  ADD KEY `product_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_option_values`
--
ALTER TABLE `product_option_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_option_values_product_id_foreign` (`product_id`),
  ADD KEY `product_option_values_color_id_foreign` (`color_id`),
  ADD KEY `product_option_values_size_id_foreign` (`size_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_option_values`
--
ALTER TABLE `product_option_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD CONSTRAINT `product_comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_option_values`
--
ALTER TABLE `product_option_values`
  ADD CONSTRAINT `product_option_values_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `product_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_option_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_option_values_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `product_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
