-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 09:40 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `byteshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `builds`
--

CREATE TABLE `builds` (
  `build_id` bigint(20) UNSIGNED NOT NULL,
  `build_name` varchar(255) NOT NULL,
  `build_date` text NOT NULL,
  `processor` int(11) DEFAULT NULL,
  `motherboard` int(11) DEFAULT NULL,
  `memory` int(11) DEFAULT NULL,
  `harddrive` int(11) DEFAULT NULL,
  `soliddrive` int(11) DEFAULT NULL,
  `headphone` int(11) DEFAULT NULL,
  `operatingsystem` int(11) DEFAULT NULL,
  `videocard` int(11) DEFAULT NULL,
  `casing` int(11) DEFAULT NULL,
  `powersupply` int(11) DEFAULT NULL,
  `keyboard` int(11) DEFAULT NULL,
  `mouse` int(11) DEFAULT NULL,
  `monitor` int(11) DEFAULT NULL,
  `printer` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `powerconsumption` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `casings`
--

CREATE TABLE `casings` (
  `casing_id` bigint(20) UNSIGNED NOT NULL,
  `case_type` varchar(255) NOT NULL,
  `steel_thickness` varchar(255) DEFAULT NULL,
  `case_motherboards` varchar(255) NOT NULL,
  `case_width` varchar(255) NOT NULL,
  `case_height` varchar(255) NOT NULL,
  `case_depth` varchar(255) NOT NULL,
  `drivebay_5point25` varchar(255) NOT NULL,
  `drivebay_3point5` varchar(255) NOT NULL,
  `drivebay_2point5` varchar(255) NOT NULL,
  `expansion_slot` varchar(255) DEFAULT NULL,
  `max_pcislots` varchar(255) DEFAULT NULL,
  `io_ports` varchar(255) DEFAULT NULL,
  `height_coolers` varchar(255) DEFAULT NULL,
  `aircooling_system` varchar(255) DEFAULT NULL,
  `net_weight` varchar(255) DEFAULT NULL,
  `casing_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'keyboard'),
(2, 'harddrive'),
(3, 'motherboard'),
(4, 'operatingsystem'),
(5, 'videocard'),
(6, 'memory'),
(7, 'monitor'),
(8, 'printer'),
(9, 'mouse'),
(10, 'headphone'),
(11, 'casing'),
(14, 'soliddrive'),
(15, 'processor'),
(16, 'powersupply');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `addressline` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `lname`, `fname`, `addressline`, `city`, `zipcode`, `phone`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'as', 'asd', 'asd', 'asd', 'dasd', 'asd', 1, NULL, NULL),
(2, 'qqqqqqq', 'qqqqqqq', 'qqqqqqq', 'Bayugan', '121', '0912345678', 5, '2021-07-16 21:40:55', '2021-07-16 21:40:55'),
(3, 'qqqqqqq', 'qqqqqqq', 'qqqqqqq', 'Bayugan', '121', '0912345678', 6, '2021-07-16 21:42:36', '2021-07-16 21:42:36'),
(4, 'Castaneda', 'Justine', 'Phase 2', 'Taguig', '1630', '0912345678', 7, '2021-07-16 21:48:25', '2021-07-16 21:48:25'),
(5, 'justine', 'Justine', 'Phase 2', 'Taguig', '1630', '0912345678', 8, '2021-07-16 21:49:34', '2021-07-16 21:49:34'),
(6, 'Castaneda', 'Justine', 'Phase 2', 'Taguig', '1630', '0912345678', 9, '2021-07-16 21:50:27', '2021-07-16 21:50:27'),
(7, 'Castaneda', 'Justine', 'Phase 2', 'Taguig', '1630', '0912345678', 10, '2021-07-16 22:00:14', '2021-07-16 22:00:14'),
(8, 'Castaneda', 'Justine', 'Phase 2', 'Valenzuela', '1630', '0912345678', 11, '2021-07-16 22:29:33', '2021-08-14 00:54:05'),
(9, 'Castaneda', 'Justine', 'wqwqwq', 'Caloocan', '1212', '12312312', 12, '2021-07-18 17:41:26', '2021-07-18 17:41:26'),
(10, 'dsf', 'fds', 'sfsd', 'Makati', '2343', '3232432', 13, '2021-08-03 07:39:34', '2021-08-03 07:39:34'),
(11, 'QWEWQ', 'SADSA', 'ASD', 'Valenzuela', '213', '12321312', 14, '2021-08-03 07:41:13', '2021-08-03 07:41:13'),
(12, 'QWEWQ', 'SADSA', 'ASD', 'Valenzuela', '213', '12321312', 15, '2021-08-03 07:41:54', '2021-08-03 07:41:54'),
(13, 'qwe', 'qwe', 'wqe', 'Taguig', 'qweqw', '32233232', 16, '2021-08-03 07:43:06', '2021-08-03 07:43:06'),
(14, 'LastRider', 'IamRider', 'rere', 'Taguig', '324', '32432432', 17, '2021-08-04 06:37:16', '2021-08-14 00:58:35'),
(15, 'Justine1', 'Castaneda1', 'Phase 2', 'Valenzuela', '1630', '0912345678', 18, '2021-08-13 03:12:47', '2021-08-17 23:55:03'),
(16, 'Doding', 'Daga', 'Phase 21', 'Malabon', '163011', '09123342311', 19, '2021-08-13 21:38:29', '2021-08-14 00:30:50'),
(17, 'sampleApelyedo', 'sampleName', 'Phase 2', 'Taguig', '1630', '0912345678', 20, '2021-08-20 18:23:44', '2021-08-20 18:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `locked_at` timestamp NULL DEFAULT NULL,
  `pinned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_group`
--

CREATE TABLE `discussion_group` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `discussion_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_user`
--

CREATE TABLE `discussion_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `discussion_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `harddrives`
--

CREATE TABLE `harddrives` (
  `harddrive_id` bigint(20) UNSIGNED NOT NULL,
  `storage_type` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `rotational_speed` varchar(255) DEFAULT NULL,
  `connectivity_type` varchar(255) DEFAULT NULL,
  `transfer_rate` varchar(255) DEFAULT NULL,
  `cache_size` varchar(255) DEFAULT NULL,
  `power` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `harddrive_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `headphones`
--

CREATE TABLE `headphones` (
  `headphone_id` bigint(20) UNSIGNED NOT NULL,
  `frequency_response` varchar(255) DEFAULT NULL,
  `transducer_principle` varchar(255) DEFAULT NULL,
  `driver_size` varchar(255) DEFAULT NULL,
  `nominal_impedance` varchar(255) DEFAULT NULL,
  `headphone_sensivity` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `headphones_desciption` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` bigint(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '0',
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keyboards`
--

CREATE TABLE `keyboards` (
  `keyboard_id` bigint(20) UNSIGNED NOT NULL,
  `keyboard_width` varchar(255) NOT NULL,
  `keyboard_length` varchar(255) NOT NULL,
  `keyboard_depth` varchar(255) NOT NULL,
  `keyboard_weight` varchar(255) DEFAULT NULL,
  `keyboard_wired` varchar(255) NOT NULL,
  `style_keys` varchar(255) DEFAULT NULL,
  `full_keyboard` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `battery` varchar(255) DEFAULT NULL,
  `extra_features` varchar(255) DEFAULT NULL,
  `keyboard_layout` varchar(255) DEFAULT NULL,
  `keyboard_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memories`
--

CREATE TABLE `memories` (
  `memory_id` bigint(20) UNSIGNED NOT NULL,
  `memory_size` varchar(255) NOT NULL,
  `memory_type` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `cas_latency` varchar(255) DEFAULT NULL,
  `memory_bandwidth` varchar(255) DEFAULT NULL,
  `overclocking_support` varchar(255) DEFAULT NULL,
  `heat_spreader` varchar(255) DEFAULT NULL,
  `rgb_support` varchar(255) NOT NULL,
  `memory_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` bigint(20) UNSIGNED NOT NULL,
  `message_title` varchar(255) DEFAULT NULL,
  `message_content` varchar(255) NOT NULL,
  `message_date` varchar(255) NOT NULL,
  `message_label` varchar(255) DEFAULT NULL,
  `is_seen` int(11) DEFAULT NULL,
  `orderinfo_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `to_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_09_22_203000_create_groups_table', 1),
(2, '2018_09_22_203001_create_discussions_table', 1),
(3, '2018_09_22_203002_create_posts_table', 1),
(4, '2018_09_22_203003_create_discussion_group_table', 1),
(5, '2021_05_26_100000_create_discussion_user_table', 1),
(6, '2021_06_03_100000_alter_posts_add_formatting', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monitors`
--

CREATE TABLE `monitors` (
  `monitor_id` bigint(20) UNSIGNED NOT NULL,
  `monitor_resolution` varchar(25) NOT NULL,
  `minitor_size` varchar(255) NOT NULL,
  `monitor_aspect` varchar(255) DEFAULT NULL,
  `panel_type` varchar(255) DEFAULT NULL,
  `refresh_rate` varchar(255) NOT NULL,
  `response_time` varchar(255) DEFAULT NULL,
  `synchronisation_technology` varchar(255) DEFAULT NULL,
  `viewing_angle` varchar(255) DEFAULT NULL,
  `input_connectors` varchar(255) DEFAULT NULL,
  `monitor_curvature` varchar(255) DEFAULT NULL,
  `monitor_brightness` varchar(255) DEFAULT NULL,
  `monitor_hdr` varchar(255) DEFAULT NULL,
  `monitor_contrast` varchar(255) DEFAULT NULL,
  `monitor_colorspace` varchar(255) DEFAULT NULL,
  `monitor_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motherboards`
--

CREATE TABLE `motherboards` (
  `motherboard_id` bigint(20) UNSIGNED NOT NULL,
  `form_factor` varchar(255) NOT NULL,
  `cpu_socket` varchar(255) NOT NULL,
  `usb_ports` varchar(255) DEFAULT NULL,
  `ram_slot` varchar(255) NOT NULL,
  `video_connectors` varchar(255) DEFAULT NULL,
  `pcie_slots` varchar(255) DEFAULT NULL,
  `inbuilt_wifi` varchar(255) DEFAULT NULL,
  `sata` varchar(255) DEFAULT NULL,
  `nvme_support` varchar(255) DEFAULT NULL,
  `rgb_header` varchar(255) DEFAULT NULL,
  `motherboard_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mouses`
--

CREATE TABLE `mouses` (
  `mouse_id` bigint(20) UNSIGNED NOT NULL,
  `sensor` varchar(255) DEFAULT NULL,
  `dpi` varchar(255) DEFAULT NULL,
  `poll_rate` varchar(255) DEFAULT NULL,
  `tracking_speed` varchar(255) DEFAULT NULL,
  `build_type` varchar(255) DEFAULT NULL,
  `mouse_wired` varchar(255) DEFAULT NULL,
  `programmable_button` varchar(255) DEFAULT NULL,
  `weight_customization` varchar(255) DEFAULT NULL,
  `liftoff_distance` varchar(255) DEFAULT NULL,
  `angle_snapping` varchar(255) DEFAULT NULL,
  `mouse_description` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operatingsystems`
--

CREATE TABLE `operatingsystems` (
  `operatingsystem_id` bigint(20) UNSIGNED NOT NULL,
  `processor_speed` varchar(255) NOT NULL,
  `memory_requirement` varchar(255) NOT NULL,
  `space_requirement` varchar(255) NOT NULL,
  `graphiccard_requirement` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderinfo`
--

CREATE TABLE `orderinfo` (
  `orderinfo_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_placed` varchar(255) NOT NULL,
  `date_shipped` varchar(255) DEFAULT NULL,
  `delivery_id` bigint(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `orderinfo_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_reviewed` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `discussion_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `formatting` varchar(255) NOT NULL DEFAULT 'plain',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `powersupplies`
--

CREATE TABLE `powersupplies` (
  `powersupply_id` bigint(20) UNSIGNED NOT NULL,
  `form_factor` varchar(255) DEFAULT NULL,
  `wattage` varchar(255) NOT NULL,
  `efficiency_rating` varchar(255) DEFAULT NULL,
  `rails` varchar(255) DEFAULT NULL,
  `protection` varchar(255) DEFAULT NULL,
  `modularity` varchar(255) DEFAULT NULL,
  `variable_rpmfan` varchar(255) DEFAULT NULL,
  `fan_size` varchar(255) DEFAULT NULL,
  `powersupplies_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE `printers` (
  `printer_id` bigint(20) UNSIGNED NOT NULL,
  `printer_type` varchar(255) NOT NULL,
  `ink_type` varchar(255) DEFAULT NULL,
  `all_inOne` varchar(255) DEFAULT NULL,
  `print_speed` varchar(255) NOT NULL,
  `duplex_support` varchar(255) DEFAULT NULL,
  `automatic_feed` varchar(255) DEFAULT NULL,
  `dpi` varchar(255) DEFAULT NULL,
  `paper_capacity` varchar(255) NOT NULL,
  `duty_cycle` varchar(255) DEFAULT NULL,
  `catridge_capacity` varchar(255) NOT NULL,
  `connection_interface` varchar(255) DEFAULT NULL,
  `scanner_resolution` varchar(255) DEFAULT NULL,
  `copy_speed` varchar(255) DEFAULT NULL,
  `printer_memory` varchar(255) DEFAULT NULL,
  `encryption_support` varchar(255) DEFAULT NULL,
  `printer_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `processors`
--

CREATE TABLE `processors` (
  `processor_id` bigint(20) UNSIGNED NOT NULL,
  `base_speed` varchar(255) NOT NULL,
  `max_speed` varchar(255) NOT NULL,
  `overclocking` varchar(255) DEFAULT NULL,
  `core_count` varchar(255) NOT NULL,
  `multi_threading` varchar(255) DEFAULT NULL,
  `cache` varchar(255) NOT NULL,
  `memory_type` varchar(255) NOT NULL,
  `socket_type` varchar(255) NOT NULL,
  `tdp_rating` varchar(255) DEFAULT NULL,
  `fabrication` varchar(255) DEFAULT NULL,
  `ingrated_graphics` varchar(255) DEFAULT NULL,
  `processor_wattage` int(11) NOT NULL,
  `processor_score` int(11) DEFAULT NULL,
  `processor_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `review_content` varchar(255) NOT NULL,
  `review_rating` int(11) NOT NULL,
  `review_date` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soliddrives`
--

CREATE TABLE `soliddrives` (
  `soliddrive_id` bigint(20) UNSIGNED NOT NULL,
  `form_factor` varchar(255) DEFAULT NULL,
  `interface` varchar(255) DEFAULT NULL,
  `read_speed` varchar(255) DEFAULT NULL,
  `write_speed` varchar(255) DEFAULT NULL,
  `endurance_rating` varchar(255) DEFAULT NULL,
  `iops` varchar(255) DEFAULT NULL,
  `capacity` varchar(255) NOT NULL,
  `cell_type` varchar(255) DEFAULT NULL,
  `soliddrive_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `user_id`) VALUES
(5, 'ddd ddd', 'caaasSA@gmail.com', '$2y$10$FxkaBYZKj07cl5RkBNLZT.gREIFBIABnR/SwM2dXvDC1GyoN6ZouW', '1626500455.jpg', 1, NULL, '2021-07-16 21:40:55', '2021-08-03 00:05:27', 5),
(6, 'eeee eee', 'caaasSAsa@gmail.com', '$2y$10$Kg/w3TSu7jzP3Vvt9xhdpecUyqJ2dBuOzuXgAKx10TxCBBJ/BCpuS', NULL, 2, NULL, '2021-07-16 21:42:36', '2021-08-04 07:49:54', 6),
(7, 'ccc ccc', 'casds@gmail.com', '$2y$10$gi7D7ksjYknQC4gF3WLWoOkS50otCXfWMSjbpMqvYv6qwp6.VQdRi', '1626500905.jpg', 2, NULL, '2021-07-16 21:48:25', '2021-08-04 07:49:52', 7),
(8, 'bbb bbb', 'dfgcas@gmail.com', '$2y$10$PnJicDC/pLmq5QuNehkjG.VbNoViZ6yjJOyqFHDC5jmW7KdQwarVC', NULL, 0, NULL, '2021-07-16 21:49:34', '2021-08-03 00:05:37', 8),
(9, 'aa aaa', 'cawwws@gmail.com', '$2y$10$SiJTNhqNWxLUwnKeiWvGo.aj8YZYC4cLsuTyKr07sYaaHOBIm4x4C', '1626501027.jpg', 0, NULL, '2021-07-16 21:50:27', '2021-08-02 22:54:22', 9),
(11, 'Justine Castaneda', 'justine@shop.ph', '$2y$10$xrfrc748buRNWpoH073.Y.eO74M0ap9eP3cD1R1dmvMCtFxJBSUGG', '1629028943.jpg', 1, NULL, '2021-07-16 22:29:33', '2021-08-15 04:02:23', 11),
(12, 'Justine Castaneda', 'cas@gmail.com', '$2y$10$QULxt6FDn9NOo2uY77uXXu8zThlV.NN1uEIhJl4/Tblam2Mn0nKTe', '1626658886.png', 0, NULL, '2021-07-18 17:41:26', '2021-07-18 17:41:26', 12),
(13, 'fds dsf', 'wwq@er.dsf', '$2y$10$19c.HMaTfppIyKsod4mFW.e4Swikyx455bdRyXWQZTH85xZaJdQ4K', '1628005174.jpg', 0, NULL, '2021-08-03 07:39:34', '2021-08-03 07:39:34', 13),
(15, 'SADSA QWEWQ', 'ssadsad@sadsa', '$2y$10$dAPkpTxJ2j0agzhXdyj9UevUoEYTtmZKTvQudtOkSbIYVBaYpFq3q', '1628005314.jpg', 0, NULL, '2021-08-03 07:41:54', '2021-08-03 07:41:54', 15),
(16, 'qwe qwe', 'ssawedsad@sadsa', '$2y$10$745749S6yzyYFKU3W0eLqurABbM8PC4MyfQ9TzJE9C8RLPoS6x3C2', '1628005386.jpg', 0, NULL, '2021-08-03 07:43:06', '2021-08-03 07:43:06', 16),
(17, 'IamRider LastRider', 'rider@shop.ph', '$2y$10$n3gWPzL1qCDlJWHod6h5SOlXZvnQZSG5urrzy0QFvXVPSfGws..GW', '1628087836.jpg', 2, NULL, '2021-08-04 06:37:16', '2021-08-14 00:58:35', 17),
(18, 'Castaneda1 Justine1', 'used1@gmail.com', '$2y$10$0hL97ReD23/6Msnv7PKhCOrVzItNh2dExIkVLYtENnLXJq8oLt76y', '1629026566.jpg', 0, NULL, '2021-08-13 03:12:47', '2021-08-17 23:55:03', 18),
(19, 'Daga Doding', 'daga@gmail.com', '$2y$10$P3WZ3vwweWGwgbgK/HEVouSVuQ4wd30VgXuyhtkJa9T7/.Eu3m8Qy', '1628929841.jpg', 0, NULL, '2021-08-13 21:38:29', '2021-08-14 00:30:50', 19),
(20, 'sampleName sampleApelyedo', 'sample@gmail.com', '$2y$10$eEnu7VUxmG/BxD/9GlHaFea/F0dZl/IuYysLJzIiEXtfpa9wu2pj6', '1629512624.jpg', 0, NULL, '2021-08-20 18:23:44', '2021-08-20 18:23:44', 20);

-- --------------------------------------------------------

--
-- Table structure for table `videocards`
--

CREATE TABLE `videocards` (
  `videocard_id` bigint(20) UNSIGNED NOT NULL,
  `gpu_brand` varchar(255) NOT NULL,
  `core_count` varchar(255) NOT NULL,
  `clock_speed` varchar(255) NOT NULL,
  `memory_type` varchar(255) NOT NULL,
  `memory_size` varchar(255) NOT NULL,
  `memory_bandwidth` varchar(255) DEFAULT NULL,
  `thermal_designpower` varchar(255) DEFAULT NULL,
  `power_connectors` varchar(255) DEFAULT NULL,
  `video_outputports` varchar(255) DEFAULT NULL,
  `api_support` varchar(255) DEFAULT NULL,
  `computer_performance` varchar(255) DEFAULT NULL,
  `gpu_wattage` int(11) NOT NULL,
  `gpu_score` varchar(255) DEFAULT NULL,
  `gpu_description` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `builds`
--
ALTER TABLE `builds`
  ADD PRIMARY KEY (`build_id`);

--
-- Indexes for table `casings`
--
ALTER TABLE `casings`
  ADD PRIMARY KEY (`casing_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussions_user_id_foreign` (`user_id`);

--
-- Indexes for table `discussion_group`
--
ALTER TABLE `discussion_group`
  ADD KEY `discussion_group_group_id_foreign` (`group_id`),
  ADD KEY `discussion_group_discussion_id_foreign` (`discussion_id`);

--
-- Indexes for table `discussion_user`
--
ALTER TABLE `discussion_user`
  ADD KEY `discussion_user_user_id_foreign` (`user_id`),
  ADD KEY `discussion_user_discussion_id_foreign` (`discussion_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harddrives`
--
ALTER TABLE `harddrives`
  ADD PRIMARY KEY (`harddrive_id`);

--
-- Indexes for table `headphones`
--
ALTER TABLE `headphones`
  ADD PRIMARY KEY (`headphone_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `keyboards`
--
ALTER TABLE `keyboards`
  ADD PRIMARY KEY (`keyboard_id`);

--
-- Indexes for table `memories`
--
ALTER TABLE `memories`
  ADD PRIMARY KEY (`memory_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitors`
--
ALTER TABLE `monitors`
  ADD PRIMARY KEY (`monitor_id`);

--
-- Indexes for table `motherboards`
--
ALTER TABLE `motherboards`
  ADD PRIMARY KEY (`motherboard_id`);

--
-- Indexes for table `mouses`
--
ALTER TABLE `mouses`
  ADD PRIMARY KEY (`mouse_id`);

--
-- Indexes for table `operatingsystems`
--
ALTER TABLE `operatingsystems`
  ADD PRIMARY KEY (`operatingsystem_id`);

--
-- Indexes for table `orderinfo`
--
ALTER TABLE `orderinfo`
  ADD PRIMARY KEY (`orderinfo_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_discussion_id_foreign` (`discussion_id`);

--
-- Indexes for table `powersupplies`
--
ALTER TABLE `powersupplies`
  ADD PRIMARY KEY (`powersupply_id`);

--
-- Indexes for table `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`printer_id`);

--
-- Indexes for table `processors`
--
ALTER TABLE `processors`
  ADD PRIMARY KEY (`processor_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `soliddrives`
--
ALTER TABLE `soliddrives`
  ADD PRIMARY KEY (`soliddrive_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videocards`
--
ALTER TABLE `videocards`
  ADD PRIMARY KEY (`videocard_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `builds`
--
ALTER TABLE `builds`
  MODIFY `build_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `casings`
--
ALTER TABLE `casings`
  MODIFY `casing_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `harddrives`
--
ALTER TABLE `harddrives`
  MODIFY `harddrive_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `headphones`
--
ALTER TABLE `headphones`
  MODIFY `headphone_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `keyboards`
--
ALTER TABLE `keyboards`
  MODIFY `keyboard_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `memories`
--
ALTER TABLE `memories`
  MODIFY `memory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `monitors`
--
ALTER TABLE `monitors`
  MODIFY `monitor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `motherboards`
--
ALTER TABLE `motherboards`
  MODIFY `motherboard_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mouses`
--
ALTER TABLE `mouses`
  MODIFY `mouse_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `operatingsystems`
--
ALTER TABLE `operatingsystems`
  MODIFY `operatingsystem_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderinfo`
--
ALTER TABLE `orderinfo`
  MODIFY `orderinfo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `powersupplies`
--
ALTER TABLE `powersupplies`
  MODIFY `powersupply_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `printers`
--
ALTER TABLE `printers`
  MODIFY `printer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `processors`
--
ALTER TABLE `processors`
  MODIFY `processor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `soliddrives`
--
ALTER TABLE `soliddrives`
  MODIFY `soliddrive_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `videocards`
--
ALTER TABLE `videocards`
  MODIFY `videocard_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `discussions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `discussion_group`
--
ALTER TABLE `discussion_group`
  ADD CONSTRAINT `discussion_group_discussion_id_foreign` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`),
  ADD CONSTRAINT `discussion_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `discussion_user`
--
ALTER TABLE `discussion_user`
  ADD CONSTRAINT `discussion_user_discussion_id_foreign` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`),
  ADD CONSTRAINT `discussion_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_discussion_id_foreign` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
