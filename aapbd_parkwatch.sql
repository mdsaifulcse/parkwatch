-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2021 at 05:05 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aapbd_parkwatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_preferences`
--

CREATE TABLE `app_preferences` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `sound_voice` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `guidance_volume` tinyint(3) UNSIGNED NOT NULL DEFAULT '5' COMMENT 'max:1-10',
  `avoid_highway` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `avoid_toll` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `avoid_ferrie` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `color_schema` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Day',
  `automatic_day_night` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Day',
  `distance_unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Miles',
  `show_traffic_map` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `show_speed_limit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `save_parking_location` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_preferences`
--

INSERT INTO `app_preferences` (`id`, `client_id`, `sound_voice`, `guidance_volume`, `avoid_highway`, `avoid_toll`, `avoid_ferrie`, `color_schema`, `automatic_day_night`, `distance_unit`, `show_traffic_map`, `show_speed_limit`, `save_parking_location`, `created_at`, `updated_at`) VALUES
(3, 24, '1', 5, '0', '0', '0', 'Light', 'Day', 'Miles', '0', '0', '0', '2021-08-21 10:04:18', '2021-08-21 10:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `biggapons`
--

CREATE TABLE `biggapons` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `show_on_page` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Home Page',
  `place` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Top',
  `active_till` datetime DEFAULT '2021-08-30 19:27:33',
  `serial_num` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biggapons`
--

INSERT INTO `biggapons` (`id`, `image`, `target_url`, `status`, `show_on_page`, `place`, `active_till`, `serial_num`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'images/biggapon//2021/09/06/301060921043829.jpg', '#', 'Active', 'Home Page', 'Top', '2021-08-30 19:27:33', 1, NULL, NULL, '2021-09-06 10:38:29', '2021-09-06 10:38:29'),
(2, 'images/biggapon//2021/09/06/760060921060726.jpg', '#', 'Active', 'Home Page', 'Middle', '2021-08-30 19:27:33', 2, NULL, NULL, '2021-09-06 12:07:26', '2021-09-06 12:07:26'),
(3, 'images/biggapon//2021/09/06/811060921060748.jpg', '#', 'Active', 'Home Page', 'Bottom', '2021-08-30 19:27:33', 3, NULL, NULL, '2021-09-06 12:07:48', '2021-09-06 12:07:48'),
(4, 'images/biggapon//2021/09/06/325060921060756.png', '#', 'Active', 'Home Page', 'Top', '2021-08-30 19:27:33', 4, NULL, NULL, '2021-09-06 12:07:56', '2021-09-06 12:07:56'),
(5, 'images/biggapon//2021/09/06/513060921060807.jpg', '#', 'Active', 'Home Page', 'Top', '2021-08-30 19:27:33', 5, NULL, NULL, '2021-09-06 12:08:07', '2021-09-06 12:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_no` varchar(30) NOT NULL,
  `client_id_no` varchar(30) NOT NULL,
  `vehicle_licence` varchar(50) DEFAULT NULL,
  `place_id` int(11) NOT NULL,
  `price_id` int(11) DEFAULT NULL,
  `promocode_id` int(11) DEFAULT NULL,
  `promocode` varchar(100) DEFAULT NULL,
  `space` varchar(100) DEFAULT NULL,
  `arrival_time` datetime NOT NULL,
  `departure_time` datetime NOT NULL,
  `release_time` datetime DEFAULT NULL,
  `booking_period` varchar(100) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `unit_price` float(8,1) NOT NULL DEFAULT '0.0',
  `net_price` float(8,1) DEFAULT '0.0',
  `discount` float(8,1) DEFAULT '0.0',
  `vat` float(8,1) NOT NULL DEFAULT '0.0',
  `fine` float(8,1) NOT NULL DEFAULT '0.0',
  `total_price` float(8,1) NOT NULL DEFAULT '0.0',
  `note` varchar(512) DEFAULT NULL,
  `release_note` varchar(512) DEFAULT NULL,
  `payment_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0->not paid, 1->paid',
  `booking_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=BookRequest,1=Booked, 3=Release',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `id_no`, `client_id_no`, `vehicle_licence`, `place_id`, `price_id`, `promocode_id`, `promocode`, `space`, `arrival_time`, `departure_time`, `release_time`, `booking_period`, `unit`, `unit_price`, `net_price`, `discount`, `vat`, `fine`, `total_price`, `note`, `release_note`, `payment_at`, `created_by`, `payment_type`, `booking_status`, `created_at`, `updated_at`) VALUES
(1, 'A000001', 'A0001', NULL, 1, 24, 3, '123456', '1', '2019-09-22 08:00:00', '2019-09-22 12:00:00', NULL, '5 Hours = 30.0৳', NULL, 0.0, 2.0, 5.0, 285.2, 5.0, 3.0, 'test', NULL, '2019-07-28 20:34:06', 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'A000002', 'A0001', NULL, 1, 23, 3, '123456', '2', '2019-07-28 16:46:00', '2019-08-17 16:22:07', NULL, '2 Hours = 15.0৳', NULL, 0.0, 3.0, 5.0, 359.7, 5.0, 3.0, NULL, NULL, '2019-07-28 20:48:36', 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'A000003', 'A0001', NULL, 6, 22, NULL, NULL, '3', '2019-08-17 13:39:00', '2019-08-17 16:19:44', NULL, '1 Hours = 10.0৳', NULL, 0.0, 26.7, 0.0, 2.7, 5.0, 34.4, NULL, NULL, '2019-08-17 15:49:55', 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'A000004', 'A0021', 'Ad3x', 6, 27, NULL, '12345', '4', '2019-08-26 15:08:00', '2019-08-27 15:08:00', NULL, '1 Days = 50.0৳', NULL, 0.0, 50.0, 0.0, 5.0, 0.0, 55.0, 'Test', NULL, '2019-08-26 15:32:18', 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'A000005', 'A0021', 'Ad3x', 6, 22, NULL, '12345', '8', '2019-08-26 16:25:00', '2019-08-26 17:25:00', NULL, '1 Hours = 10.0৳', NULL, 0.0, 10.0, 0.0, 1.0, 0.0, 11.0, 'Test', NULL, '2019-08-26 16:27:38', 3, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'A000006', 'A0022', '211', 6, 25, NULL, NULL, '5', '2019-09-22 08:00:00', '2019-09-22 12:00:00', NULL, '12 Hours = 30.0৳', NULL, 0.0, 30.0, 0.0, 3.0, 0.0, 33.0, 'Test', NULL, '2019-08-26 16:28:42', 3, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'A000007', 'A0023', 'DHAKA 2', 6, 24, 1, '12345', '1', '2019-09-24 11:08:00', '2019-09-24 16:08:00', NULL, ' = 30.0৳', NULL, 0.0, 30.0, 10.0, 3.0, 0.0, 23.0, 'Test', NULL, '2019-09-24 11:10:45', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'A000008', 'A0023', 'DHAKA 2', 6, 24, 1, '12345', '1', '2019-09-24 11:08:00', '2019-09-24 16:08:00', NULL, ' = 30.0৳', NULL, 0.0, 30.0, 10.0, 3.0, 0.0, 23.0, 'Test', NULL, '2019-09-24 11:11:14', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'A000009', 'A0023', 'DHAKA 2', 6, 24, 1, '12345', '1', '2019-09-24 11:08:00', '2019-09-24 16:08:00', NULL, ' = 30.0৳', NULL, 0.0, 30.0, 10.0, 3.0, 0.0, 23.0, 'Test', NULL, '2019-09-24 11:12:00', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'A000010', 'A0023', '211 Test', 6, 24, 1, '12345', '2', '2019-09-24 11:12:00', '2019-09-24 16:12:00', NULL, ' = 30.0৳', NULL, 0.0, 30.0, 10.0, 3.0, 0.0, 23.0, 'Test', NULL, '2019-09-24 11:13:12', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'A000011', 'A0023', 'DHAKA 2', 6, 27, NULL, NULL, '3', '2019-09-24 11:13:00', '2019-09-25 11:13:00', NULL, ' = 50.0৳', NULL, 0.0, 50.0, 0.0, 5.0, 0.0, 55.0, '123', NULL, '2019-09-24 11:14:58', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'A000012', 'A0023', '211 Test', 6, 22, 1, '12345', '2', '2019-09-29 11:18:00', '2019-09-29 12:18:00', NULL, ' = 10.0৳', NULL, 0.0, 10.0, 10.0, 1.0, 0.0, 1.0, 'Test', NULL, '2019-09-29 11:19:06', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'A000013', 'A0023', 'VH 404', 6, 24, 1, '12345', '1', '2019-09-29 12:03:00', '2019-09-29 17:03:00', NULL, ' = 30.0৳', NULL, 0.0, 30.0, 10.0, 3.0, 0.0, 23.0, 'New Booking', NULL, '2019-09-29 12:04:34', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'A000014', 'A0023', 'DHAKA 2', 6, 23, NULL, NULL, '1', '2019-10-14 10:36:00', '2019-10-14 12:36:00', NULL, ' = 15.0৳', NULL, 0.0, 15.0, 0.0, 1.5, 0.0, 16.5, NULL, NULL, '2019-10-14 11:22:23', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'A000015', 'A0023', 'admin2@coderstrust.com', 6, 22, 1, '12345', '2', '2019-10-14 12:45:00', '2019-10-14 13:45:00', NULL, ' = 10.0৳', NULL, 0.0, 10.0, 10.0, 1.0, 0.0, 1.0, 'Test', NULL, '2019-10-14 11:54:18', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'A000016', 'A0023', 'DHAKA 2', 6, 24, NULL, NULL, '3', '2019-10-14 11:56:00', '2019-10-14 16:56:00', NULL, ' = 30.0৳', NULL, 0.0, 30.0, 0.0, 3.0, 0.0, 33.0, NULL, NULL, '2019-10-14 11:56:38', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'A000017', 'A0023', '211 Test', 6, 21, NULL, NULL, '1', '2019-10-14 15:17:00', '2019-10-14 15:47:00', NULL, ' = 5.0৳', NULL, 0.0, 5.0, 0.0, 0.5, 0.0, 5.5, NULL, NULL, '2019-10-14 15:17:52', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'A000018', 'A0023', 'DHAKA 2', 6, 24, 1, '12345', '1', '2019-10-16 15:47:00', '2019-10-16 20:47:00', '2019-10-16 16:30:00', ' = 30.0৳', NULL, 0.0, 30.0, 10.0, 3.0, 0.0, 23.0, NULL, NULL, '2019-10-16 15:48:03', 0, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'A000019', 'A0023', '211 Test', 6, 22, NULL, NULL, '2', '2019-10-17 11:39:00', '2019-10-17 12:39:00', NULL, ' = 10.0৳', NULL, 0.0, 10.0, 0.0, 1.0, 0.0, 11.0, 'Test', NULL, '2019-10-17 11:39:16', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'A000020', 'A0023', 'DHAKA 2', 6, 22, NULL, NULL, '1', '2019-10-24 11:57:00', '2019-10-24 12:57:00', NULL, ' = 10.0৳', NULL, 0.0, 10.0, 0.0, 1.0, 0.0, 11.0, 'Test', NULL, '2019-10-24 11:58:05', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'A000021', '123456', '123456', 7, 53, NULL, NULL, '1', '2021-09-12 03:50:00', '2021-09-12 03:53:00', NULL, '3', 'minute', 0.0, 0.0, NULL, 0.0, 0.0, 0.0, NULL, NULL, '0000-00-00 00:00:00', 28, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'A000022', '123456', '123456', 7, 53, NULL, NULL, '1', '2021-09-12 03:50:00', '2021-09-12 03:53:00', NULL, '3', 'minute', 0.0, 0.0, NULL, 0.0, 0.0, 0.0, NULL, NULL, '0000-00-00 00:00:00', 28, 1, 1, '2021-09-13 08:23:47', '2021-09-13 08:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `booking_history`
--

CREATE TABLE `booking_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `booking_id` int(10) DEFAULT NULL,
  `booking_id_no` varchar(20) DEFAULT NULL,
  `client_id_no` varchar(20) DEFAULT NULL,
  `payment_gateway` varchar(150) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `data` text,
  `created_at` datetime DEFAULT NULL,
  `payment_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking_history`
--

INSERT INTO `booking_history` (`id`, `transaction_id`, `booking_id`, `booking_id_no`, `client_id_no`, `payment_gateway`, `amount`, `data`, `created_at`, `payment_status`) VALUES
(28, 'PAYID-LWTOOVQ7P727667DM255440P', 0, 'A000018', 'A0023', NULL, 23, '{\"id_no\":\"A000018\",\"client_id_no\":\"A0023\",\"vehicle_licence\":\"DHAKA 2\",\"place_id\":\"6\",\"price_id\":\"24\",\"promocode_id\":\"1\",\"promocode\":\"12345\",\"space\":\"1\",\"arrival_time\":\"2019-10-16 15:47:00\",\"departure_time\":\"2019-10-16 20:47:00\",\"release_time\":null,\"booking_period\":\" = 30.0\\u09f3\",\"net_price\":\"30.0\",\"discount\":\"10.0\",\"vat\":\"3.0\",\"fine\":\"0.0\",\"total_price\":\"23.0\",\"note\":null,\"release_note\":null,\"created_at\":\"2019-10-16 15:48:03\",\"created_by\":0,\"payment_type\":1,\"booking_status\":0}', '2019-10-16 15:48:06', '1'),
(29, 'PAYID-LWT75BY42L37461CM6021746', 0, 'A000019', 'A0023', NULL, 11, '{\"id_no\":\"A000019\",\"client_id_no\":\"A0023\",\"vehicle_licence\":\"211 Test\",\"place_id\":\"6\",\"price_id\":\"22\",\"promocode_id\":null,\"promocode\":null,\"space\":\"2\",\"arrival_time\":\"2019-10-17 11:39:00\",\"departure_time\":\"2019-10-17 12:39:00\",\"release_time\":null,\"booking_period\":\" = 10.0\\u09f3\",\"net_price\":\"10.0\",\"discount\":\"0.0\",\"vat\":\"1.0\",\"fine\":\"0.0\",\"total_price\":\"11.0\",\"note\":\"Test\",\"release_note\":null,\"created_at\":\"2019-10-17 11:39:16\",\"created_by\":0,\"payment_type\":1,\"booking_status\":0}', '2019-10-17 11:39:21', '1'),
(30, 'PAYID-LWYT22I8CH33314WG0973237', 0, 'A000020', 'A0023', NULL, 11, '{\"id_no\":\"A000020\",\"client_id_no\":\"A0023\",\"vehicle_licence\":\"DHAKA 2\",\"place_id\":\"6\",\"price_id\":\"22\",\"promocode_id\":null,\"promocode\":null,\"space\":\"1\",\"arrival_time\":\"2019-10-24 11:57:00\",\"departure_time\":\"2019-10-24 12:57:00\",\"release_time\":null,\"booking_period\":\" = 10.0\\u09f3\",\"net_price\":\"10.0\",\"discount\":\"0.0\",\"vat\":\"1.0\",\"fine\":\"0.0\",\"total_price\":\"11.0\",\"note\":\"Test\",\"release_note\":null,\"created_at\":\"2019-10-24 11:58:05\",\"created_by\":0,\"payment_type\":1,\"booking_status\":0}', '2019-10-24 11:58:09', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `city_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Published',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `city_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'New City 0', 'Published', '2021-06-13 09:15:31', '2021-06-13 08:48:18', '2021-06-13 09:15:31'),
(2, 1, 'New City', 'Published', NULL, '2021-06-13 09:15:23', '2021-06-13 09:47:49'),
(3, 1, 'New City for New State 0', 'Published', NULL, '2021-06-13 12:19:40', '2021-06-14 07:55:17'),
(4, 1, 'New City 0', 'Published', NULL, '2021-06-13 13:47:53', '2021-06-13 13:47:53'),
(5, 2, 'City of New Work', 'Published', NULL, '2021-06-22 05:51:09', '2021-06-22 05:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parking_start_date` timestamp NULL DEFAULT NULL,
  `parking_end_date` timestamp NULL DEFAULT NULL,
  `single_parking_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parking_buddy_radius` int(11) NOT NULL DEFAULT '0' COMMENT 'Mile',
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent_out_from_other` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=Agree to Rent out from other user, 0= Not Agree to Rent out from other user',
  `swap_parking_spot` tinyint(1) DEFAULT '0' COMMENT '1=Agree to Swap Parking Spot, 0= Not Agree to Swap Parking Spot',
  `rent_out_my_space` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1=Agree to Rent out my space, 0= Not Agree to Rent out my space',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `password_reset_otp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_validity` timestamp NULL DEFAULT NULL,
  `otp_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not_Verified',
  `my_point` int(10) NOT NULL DEFAULT '0',
  `terms_condition` tinyint(1) NOT NULL DEFAULT '1',
  `privacy_policy` tinyint(1) NOT NULL DEFAULT '1',
  `parking_buddy_laws` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `id_no`, `first_name`, `last_name`, `username`, `email`, `mobile`, `password`, `working_address`, `home_address`, `parking_start_date`, `parking_end_date`, `single_parking_id`, `parking_buddy_radius`, `profile_photo`, `rent_out_from_other`, `swap_parking_spot`, `rent_out_my_space`, `note`, `created_at`, `updated_at`, `status`, `password_reset_otp`, `otp_validity`, `otp_status`, `my_point`, `terms_condition`, `privacy_policy`, `parking_buddy_laws`) VALUES
(28, 'A0001', 'Saiful', 'Islam', 'Islam0', 'client@parkwatch.com', '214856232', '$2y$10$HhR/eI6BKJVio.40ooKg9OXwXx62hanQ.EX4/YbU2N6y.WlwBXDNa', 'Dhaka', 'Dhaka', '2021-08-11 18:00:00', '2021-08-17 18:00:00', NULL, 2, 'Islam', 0, 0, 1, NULL, '2021-08-23 11:59:36', '2021-09-21 09:10:15', 1, '514424', '2021-09-21 09:20:15', 'Not_Verified', 25, 1, 1, 1),
(32, 'A0002', 'Jahid', 'Islam', 'jahid', 'jahid@parkwatch.com', '214856233', '$2y$10$yPfVZ1rVOjyr/5f7auQHAeVU46EnLbo/RjY8BG.Y4Mg3YmFLNuVZe', 'Dhaka', 'Dhaka', '2021-08-11 18:00:00', '2021-08-17 18:00:00', NULL, 0, 'Islam', 1, 0, 1, NULL, '2021-09-02 09:22:40', '2021-09-02 09:22:40', 1, NULL, NULL, 'Not_Verified', 15, 1, 1, 1),
(33, 'A0003', 'Jahid', 'Islam', 'sajid', 'sajid@parkwatch.com', '214856234', '$2y$10$.ENfWm3z9wSU5ZP4NkM7a.tJDi3pYsCZBu1VQqtQvvdPRD3zT6BY6', 'Dhaka', 'Dhaka', '2021-08-11 18:00:00', '2021-08-17 18:00:00', NULL, 0, 'Islam', 1, 0, 1, NULL, '2021-09-02 09:23:05', '2021-09-02 09:23:05', 1, NULL, NULL, 'Not_Verified', 20, 1, 1, 1),
(34, 'A0004', 'Rafid', 'Islam', 'rafid', 'rafid@parkwatch.com', '214856235', '$2y$10$0uw/E2936N6tNS2Hbpwh3OrzLGVW/flXPNZxBHbeV2NURLFs.ww/O', 'Dhaka', 'Dhaka', '2021-08-11 18:00:00', '2021-08-17 18:00:00', NULL, 0, 'Islam', 1, 0, 1, NULL, '2021-09-02 09:23:34', '2021-09-02 09:23:34', 1, NULL, NULL, 'Not_Verified', 10, 1, 1, 1),
(35, 'A0005', 'Salim', 'Ahmed', 'salim', 'salim@parkwatch.com', '214856236', '$2y$10$yg99NQN1v.An7zH6XS1B6OBqOK6oEWNGcJcwgXF43sXpmX7cS7TGa', 'Dhaka', 'Dhaka', '2021-08-11 18:00:00', '2021-08-17 18:00:00', NULL, 0, 'Islam', 1, 0, 1, NULL, '2021-09-02 09:24:13', '2021-09-02 09:24:13', 1, NULL, NULL, 'Not_Verified', 40, 1, 1, 1),
(36, 'A0006', 'Akber', 'Islam', 'akber', 'akber@parkwatch.com', '214856238', '$2y$10$FKUMfb9HThf2zuY/YlJpg.A0/Mkst4.AyygQhVlFdfslkA.tEpAjC', 'Dhaka', 'Dhaka', '2021-08-11 18:00:00', '2021-08-17 18:00:00', NULL, 0, 'Islam', 1, 0, 1, NULL, '2021-09-02 09:40:21', '2021-09-02 09:40:21', 1, NULL, NULL, 'Not_Verified', 10, 1, 1, 1),
(37, 'A0007', 'Mushfiq', 'Mashok', 'mushfiq', 'mushfiq@parkwatch.com', '214856239', '$2y$10$KNv6U0o5.tjfBlXT7fxujeIW1RjNTsh6hMlP6z6/PySHlbO7f7Mkm', 'Dhaka', 'Dhaka', '2021-08-11 18:00:00', '2021-08-17 18:00:00', NULL, 0, 'Islam', 1, 0, 1, NULL, '2021-09-06 13:05:42', '2021-09-06 13:05:42', 1, NULL, NULL, 'Not_Verified', 0, 1, 1, 1),
(39, 'A0008', 'Jaber', 'Hossain', 'jaber', 'jaber@parkwatch.com', '214856240', '$2y$10$gZilNcbNXokjwcw2fSOS3ukxBw.eGs1LYSuIRRbDiWtu7sCyAkdFS', 'Dhaka', 'Dhaka', '2021-08-11 18:00:00', '2021-08-17 18:00:00', NULL, 0, 'Islam', 1, 0, 1, NULL, '2021-09-14 11:46:08', '2021-09-19 13:00:47', 1, NULL, NULL, 'Not_Verified', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `client0`
--

CREATE TABLE `client0` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client0`
--

INSERT INTO `client0` (`id`, `id_no`, `name`, `mobile`, `email`, `password`, `address`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(17, 'A0009', 'John Doe', '1234656789', 'john@demo.com', NULL, NULL, NULL, '2018-04-24 13:51:58', '2018-04-24 13:51:58', 0),
(18, 'A0006', 'Jennifer Lowrence', '0123456789', NULL, NULL, NULL, 3, '2018-04-24 19:22:46', '2018-04-24 19:22:46', 0),
(19, 'A0001', 'Jahed Abdullah', '0123456789', 'jahed@example.com', NULL, NULL, 3, '2018-04-24 19:25:18', '2018-04-24 19:25:18', 0),
(20, 'A0002', 'Test', '0123456789', 'test@gmail.com', NULL, 'Teest', 3, '2018-04-24 19:27:34', '2018-04-24 19:27:34', 1),
(22, 'A0016', 'Wiliam Smith', '0123567897', NULL, NULL, NULL, NULL, '2018-04-24 19:50:41', '2018-04-24 19:50:41', 1),
(23, 'A0017', 'Hannan', '01837689150', 'hannandiu42@gmail.com', NULL, 'Feni Sadar, Feni -3900', NULL, '2018-04-27 09:03:36', '2018-04-27 09:03:36', 1),
(24, 'A0018', 'Samuel', '01821742285', 'samuel@gmail.com', NULL, 'Kathalbagan, Dhaka - 1205', NULL, '2018-04-27 09:29:13', '2018-04-27 09:29:13', 1),
(25, 'A0019', 'Istiaq', '0123456789', NULL, NULL, NULL, 3, '2018-04-29 16:30:33', '2018-04-29 16:30:33', 1),
(27, 'A0020', 'Label 1', '', 'estcy@example.com', NULL, NULL, 3, '2018-04-29 20:06:57', '2018-04-29 20:09:16', 2),
(76, 'A0021', 'help.codekernel@gmail.com', '01234567888', 'sourav.diubd@gmail.com', NULL, NULL, NULL, '2019-08-26 17:34:55', '2019-08-26 17:34:55', 2),
(80, 'A0022', 'Alan', '1858884515', 'alan@example.com', NULL, NULL, NULL, '2019-08-26 17:44:49', '2019-08-26 17:44:49', 2),
(84, 'A0023', 'Demo User', '1858884515', 'client@codekernel.net', '$2y$10$oLcW8Kr.jSc7/wkQUgcMjOzgIZ4vpK1RPqEuRtdWHFZXp1WGXSRMS', 'Dhaka', NULL, '2019-08-27 11:34:32', '2019-09-29 12:13:11', 1),
(85, 'A0024', 'Demo User 2', '1858884515', 'demo@codekernel.net', '$2y$10$oLcW8Kr.jSc7/wkQUgcMjOzgIZ4vpK1RPqEuRtdWHFZXp1WGXSRMS', 'House# 82, Road# 19/A, Block# E, Banani', NULL, '2019-08-27 12:19:54', '2019-08-27 12:22:32', 1),
(86, 'A0025', 'Peyton Manning', '3035678910', 'sxn@coderstrust.com', '$2y$10$Rgovi1qu/oQkTc1y1G/OB.7a/eY8lKsW5mHn8NxzWXZZu9SSIwKmK', '1234 Main Street', 1, '2019-08-27 12:24:36', '2019-10-16 16:23:27', 1),
(87, 'A0026', 'Test', '01858884515', 'admin@test.com', '$2y$10$oLcW8Kr.jSc7/wkQUgcMjOzgIZ4vpK1RPqEuRtdWHFZXp1WGXSRMS', 'House# 82, Road# 19/A, Block# E, Banani', NULL, '2019-10-16 16:24:36', '2019-10-16 16:31:15', 1),
(88, 'A0027', 'Md Nayeem Hossain', '+8801924161357', 'user@smartparking.com', '$2y$10$gyIVwiNwGS8tu5jOKNspZ.JN0Egitw0E1X0xO8VNPOnz4tVlXTZuu', 'House#626 Road#09  Avenue#03 Mirpur DOHS Dhaka 1216, Bangladesh', 2, '2021-04-27 03:23:48', '2021-04-27 03:23:48', 1),
(89, 'A0028', 'Demo Name', '01687835849', 'demo@gmail.com', '$2y$10$38BBJaBwq6pciO87w.gOhu1LmzZOrpdSLNgcNdX5JiXLyxWQRFaLC', NULL, NULL, '2021-05-10 22:40:15', '2021-05-10 23:00:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_parking_interests`
--

CREATE TABLE `client_parking_interests` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `parking_interest` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_parking_interests`
--

INSERT INTO `client_parking_interests` (`id`, `client_id`, `parking_interest`, `created_at`, `updated_at`) VALUES
(51, 28, 'Free Street Parking', '2021-08-23 11:59:36', '2021-08-23 11:59:36'),
(52, 28, 'Meter Street Parking', '2021-08-23 11:59:36', '2021-08-23 11:59:36'),
(59, 32, 'Free Street Parking', '2021-09-02 09:22:40', '2021-09-02 09:22:40'),
(60, 32, 'Meter Street Parking', '2021-09-02 09:22:40', '2021-09-02 09:22:40'),
(61, 33, 'Free Street Parking', '2021-09-02 09:23:05', '2021-09-02 09:23:05'),
(62, 33, 'Meter Street Parking', '2021-09-02 09:23:05', '2021-09-02 09:23:05'),
(63, 34, 'Free Street Parking', '2021-09-02 09:23:34', '2021-09-02 09:23:34'),
(64, 34, 'Meter Street Parking', '2021-09-02 09:23:34', '2021-09-02 09:23:34'),
(65, 35, 'Free Street Parking', '2021-09-02 09:24:13', '2021-09-02 09:24:13'),
(66, 35, 'Meter Street Parking', '2021-09-02 09:24:13', '2021-09-02 09:24:13'),
(67, 36, 'Free Street Parking', '2021-09-02 09:40:23', '2021-09-02 09:40:23'),
(68, 36, 'Meter Street Parking', '2021-09-02 09:40:23', '2021-09-02 09:40:23'),
(69, 37, 'Free Street Parking', '2021-09-06 13:05:42', '2021-09-06 13:05:42'),
(70, 37, 'Meter Street Parking', '2021-09-06 13:05:42', '2021-09-06 13:05:42'),
(73, 39, 'Free Street Parking', '2021-09-14 11:46:08', '2021-09-14 11:46:08'),
(74, 39, 'Meter Street Parking', '2021-09-14 11:46:08', '2021-09-14 11:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `client_vehicle`
--

CREATE TABLE `client_vehicle` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `vehicle_type_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Vehicle Size',
  `vehicle_type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `licence` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Published',
  `is_primary` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_vehicle`
--

INSERT INTO `client_vehicle` (`id`, `client_id`, `vehicle_type_id`, `vehicle_type`, `vehicle_photo`, `make`, `model`, `color`, `licence`, `status`, `is_primary`, `created_at`, `updated_at`) VALUES
(27, 28, 1, 'Senda', '', 'Islam', 'Islam', 'red', '123456', 'Published', 'Yes', '2021-08-23 11:59:36', '2021-08-23 11:59:36'),
(31, 32, 1, 'Senda', '', 'Islam', 'Islam', 'red', '123456', 'Published', 'Yes', '2021-09-02 09:22:40', '2021-09-02 09:22:40'),
(32, 33, 1, 'Senda', '', 'Islam', 'Islam', 'red', '123456', 'Published', 'Yes', '2021-09-02 09:23:05', '2021-09-02 09:23:05'),
(33, 34, 1, 'Senda', '', 'Islam', 'Islam', 'red', '123456', 'Published', 'Yes', '2021-09-02 09:23:34', '2021-09-02 09:23:34'),
(34, 35, 1, 'Senda', '', 'Islam', 'Islam', 'red', '123456', 'Published', 'Yes', '2021-09-02 09:24:13', '2021-09-02 09:24:13'),
(35, 36, 1, 'Senda', '', 'Islam', 'Islam', 'red', '123456', 'Published', 'Yes', '2021-09-02 09:40:21', '2021-09-02 09:40:21'),
(36, 37, 1, 'Senda', '', 'Islam', 'Islam', 'red', '123456', 'Published', 'Yes', '2021-09-06 13:05:42', '2021-09-06 13:05:42'),
(38, 39, 1, 'Senda', '', 'Islam', 'Islam', 'red', '123456', 'Published', 'Yes', '2021-09-14 11:46:08', '2021-09-14 11:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Published',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'pakistan', 'Published', NULL, '2021-06-10 09:44:32', '2021-06-10 09:44:32'),
(3, 'India', 'Published', NULL, '2021-06-10 09:51:14', '2021-06-13 06:42:50'),
(5, 'Bangladesh', 'Published', NULL, '2021-06-10 12:23:06', '2021-06-13 06:43:01'),
(6, 'USA', 'Published', NULL, '2021-06-16 09:58:32', '2021-06-16 09:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `email_history`
--

CREATE TABLE `email_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_setting_id` int(11) DEFAULT NULL,
  `client_id_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `schedule_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-pending, 1-sent, 2-quick-send'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_history`
--

INSERT INTO `email_history` (`id`, `email_setting_id`, `client_id_no`, `email`, `subject`, `message`, `schedule_at`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(3, 3, NULL, 'sourav.diubd@gmail.com', 'Test', 'Test', NULL, '2019-08-27 10:38:44', NULL, 1, 1),
(4, 3, NULL, 'sourav.diubd@gmail.com', 'Email Testing', 'Send, receive, and track emails with Mailgun’s free email API. You can quickly integrate with our RESTful APIs to get reliable email delivery of your important messages. ... For companies that need to send frequent marketing and transactional emails to their audiences,', NULL, '2019-08-27 10:41:12', NULL, 1, 1),
(5, 3, NULL, 'sourav.diubd@gmail.com', 'Email Testing', 'Send, receive, and track emails with Mailgun’s free email API. You can quickly integrate with our RESTful APIs to get reliable email delivery of your important messages. ... For companies that need to send frequent marketing and transactional emails to their audiences,', NULL, '2019-08-27 11:02:51', NULL, 1, 1),
(6, 3, NULL, 'admin@coderstrust.com', 'Email Testing', 'Ts', NULL, '2019-08-28 12:07:16', NULL, 1, 1),
(7, 3, NULL, 'shohrab@coderstrust.com', 'Email Testing', 'Ts', NULL, '2019-08-28 12:07:39', NULL, 1, 1),
(8, NULL, NULL, 'admin@coderstrust.com', 'admin@coderstrust.com', 'Test', NULL, '2019-09-17 15:52:39', NULL, NULL, 1),
(9, NULL, NULL, 'shohrab@coderstrust.com', 'Test', 'Test', NULL, '2019-09-17 15:53:27', NULL, NULL, 1),
(10, NULL, NULL, 'shohrab@coderstrust.com', 'Test 3', 'Teszfs', NULL, '2019-09-17 15:54:22', NULL, NULL, 1),
(11, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">24 Sep, 2019 11:12 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000009\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>24 Sep, 2019 11:12 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 11:08 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 04:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Not Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">23.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-24 11:12:01', NULL, 0, 0),
(12, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">24 Sep, 2019 11:13 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000010\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (211 Test)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 2 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>24 Sep, 2019 11:13 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 11:12 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 04:12 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">23.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-24 11:13:12', NULL, 0, 0),
(13, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">24 Sep, 2019 11:14 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000011\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 3 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 50.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>24 Sep, 2019 11:14 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 24 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">50.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>24 Sep, 2019 11:13 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>25 Sep, 2019 11:13 AM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">5.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">55.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-24 11:14:58', NULL, 0, 0),
(14, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">29 Sep, 2019 11:19 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000012\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (211 Test)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 2 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 10.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>29 Sep, 2019 11:19 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 1 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>29 Sep, 2019 11:18 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>29 Sep, 2019 12:18 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-29 11:19:07', NULL, 0, 0),
(15, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">29 Sep, 2019 12:04 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000013\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (VH 404)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>29 Sep, 2019 12:04 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>29 Sep, 2019 12:03 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>29 Sep, 2019 05:03 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">23.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-09-29 12:04:34', NULL, 0, 0),
(16, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">14 Oct, 2019 11:22 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000014\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 15.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>14 Oct, 2019 11:22 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 2 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">15.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 10:36 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 12:36 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.5৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">16.5৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-14 11:22:24', NULL, 0, 0),
(17, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">14 Oct, 2019 11:54 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000015\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (admin2@coderstrust.com)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 2 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 10.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>14 Oct, 2019 11:54 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 1 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 12:45 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 01:45 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-14 11:54:18', NULL, 0, 0),
(18, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">14 Oct, 2019 11:56 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000016\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 3 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>14 Oct, 2019 11:56 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 11:56 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 04:56 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-14 11:56:38', NULL, 0, 0),
(19, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">14 Oct, 2019 03:17 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000017\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (211 Test)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 5.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>14 Oct, 2019 03:17 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 30 Minutes</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">5.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 03:17 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>14 Oct, 2019 03:47 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.5৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">5.5৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-14 15:17:53', NULL, 0, 0),
(20, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 11:20 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000018\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (admin@coderstrust.com)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 10.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 11:20 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 1 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 11:19 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 12:19 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">11.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 11:20:16', NULL, 0, 0),
(21, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 11:28 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000019\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (admin@coderstrust.com)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 10.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 11:28 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 1 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 11:28 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 12:28 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">11.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 11:28:46', NULL, 0, 0),
(22, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 05:33 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000020\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 05:28 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 05:26 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 10:26 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 17:33:14', NULL, 0, 0);
INSERT INTO `email_history` (`id`, `email_setting_id`, `client_id_no`, `email`, `subject`, `message`, `schedule_at`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(23, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 05:38 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000020\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 05:28 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 05:26 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 10:26 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 17:38:12', NULL, 0, 0),
(24, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 05:38 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000020\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 05:28 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 05:26 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 10:26 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 17:38:39', NULL, 0, 0),
(25, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">15 Oct, 2019 05:39 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000020\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>15 Oct, 2019 05:28 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 05:26 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>15 Oct, 2019 10:26 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-15 17:39:41', NULL, 0, 0),
(26, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 11:15 AM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000021\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 15.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 11:14 AM</td>\r\n                    <td style=\"text-align:right\">Net Price 2 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">15.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 11:14 AM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 01:14 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">1.5৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">16.5৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 11:15:35', NULL, 0, 0),
(27, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:10 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:10:04', NULL, 0, 0),
(28, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:10 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:10:52', NULL, 0, 0),
(29, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:12 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:12:42', NULL, 0, 0),
(30, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:12 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:12:58', NULL, 0, 0),
(31, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:13 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:13:22', NULL, 0, 0),
(32, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:14 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000022\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: </td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:08 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:08 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Release</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">33.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:14:18', NULL, 0, 0),
(34, 3, 'A0023', 'admin@coderstrust.com', 'New Booking', '<table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:65%;text-align:left;border-bottom:1px dashed gray;padding-bottom:5px;text-transform:uppercase\">\r\n                        Smart Parking Lot :: City Parking - Class A<br/>\r\n                        197/A, Free school street, Dhaka - 1205<br/><br/>\r\n                    </td>\r\n                    <td style=\"width:35%;text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        <font style=\"text-transform:uppercase\">16 Oct, 2019 03:48 PM</font><br>\r\n                        Phone: +33658255205<br/>\r\n                        Email: application@example.com\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"text-align:left;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        Booking ID: A000018\r\n                    </td>\r\n                    <td style=\"text-align:right;padding:5px 0;border-bottom:1px dashed gray;text-transform:uppercase\">\r\n                        CodersTrust Bangladesh - A0023 (DHAKA 2)\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n\r\n        <table style=\"width:100%;font-size:15px\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"width:15%\">Space: 1 </td>\r\n                    <td style=\"width:2%\">,</td>\r\n                    <td style=\"width:25%\">Promo Code: 12345</td>\r\n                    <td colspan=\"3\" style=\"text-align:right;border-bottom:1px dashed gray\">Booking Period/Price  = 30.0৳ \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Booking Time </td>\r\n                    <td>:</td> \r\n                    <td>16 Oct, 2019 03:48 PM</td>\r\n                    <td style=\"text-align:right\">Net Price 5 Hours </td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"width:50px;text-align:right\">30.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Arrival Time</td>\r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 03:47 PM</td>\r\n                    <td style=\"text-align:right\">Discount</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">10.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Departure Time</td> \r\n                    <td>:</td>\r\n                    <td>16 Oct, 2019 08:47 PM</td>\r\n                    <td style=\"text-align:right\">Vat (10%  of Net Price)</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">3.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Release Time</td>\r\n                    <td>:</td>\r\n                    <td></td>\r\n                    <td style=\"text-align:right;border-bottom:1px dashed gray;padding-bottom:5px;\">\r\n                        Fine (5৳)</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;\">&nbsp;=&nbsp;</td>\r\n                    <td style=\"border-bottom:1px dashed gray;padding-bottom:5px;text-align:right\">0.0৳</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>Status</td>\r\n                    <td>:</td>\r\n                    <td>Paid & Active</td>\r\n                    <td style=\"text-align:right\">Grand Total</td>\r\n                    <td>&nbsp;=&nbsp;</td>\r\n                    <td style=\"text-align:right\">23.0৳</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>', NULL, '2019-10-16 15:48:33', NULL, 0, 0),
(35, 3, NULL, 'sharower@coderstrust.com', 'Email Testing', 'Test', NULL, '2019-10-21 17:31:36', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_setting`
--

CREATE TABLE `email_setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `driver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'smtp' COMMENT 'smtp, mailgun, mailtrap',
  `host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mailtrap.io',
  `port` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2525',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'tls' COMMENT 'tls',
  `sendmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'usr/sbin/sendmail -bs',
  `pretend` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_setting`
--

INSERT INTO `email_setting` (`id`, `driver`, `host`, `port`, `username`, `password`, `encryption`, `sendmail`, `pretend`) VALUES
(3, 'smtp', 'smtp.gmail.com', '465', 'saiful.aapbd@gmail.com', 'jtvbsscdqgmijdcm', 'tls', 'usr/sbin/sendmail -bs', '1');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'sdf 000', 'sdf 00', 'Published', 'Faq', NULL, '2021-06-16 06:23:52', '2021-09-02 06:55:22'),
(2, 'dd', 'dd', 'Published', 'Term_condition', NULL, '2021-09-02 07:00:39', '2021-09-02 07:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(10) UNSIGNED NOT NULL,
  `setting` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'english',
  `default` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bangla` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `setting`, `default`, `bangla`) VALUES
(2, 'default', 'Log in to start your session', 'আপনার সেশন শুরু করতে লগ ইন করুন'),
(3, 'default', 'Email', 'ইমেল'),
(4, 'default', 'Password', 'পাসওয়ার্ড'),
(5, 'default', 'Remember Me', 'মনে রাখবেন'),
(6, 'default', 'Forgot Your Password?', 'আপনার পাসওয়ার্ড ভুলে গেছেন?'),
(7, 'default', 'Send Password Reset Link', 'পাসওয়ার্ড পুনরায় সেট করুন লিঙ্ক'),
(8, 'default', 'Login', 'লগইন'),
(9, 'default', 'Label Here!', 'লেবেল এখানে!'),
(10, 'default', 'Label', 'লেবেল'),
(11, 'default', 'Reset Password?', 'রিসেট পাসওয়ার্ড?'),
(12, 'default', 'Home', 'হোম'),
(13, 'default', 'Client', 'ক্লায়েন্ট'),
(14, 'default', 'New Client', 'নতুন ক্লায়েন্ট'),
(15, 'default', 'Clients', 'ক্লায়েন্ট তালিকা'),
(16, 'default', 'Parking Spot', 'পার্কিং জোন'),
(17, 'default', 'New Parking Spot', 'নতুন পার্কিং জোন'),
(18, 'default', 'Parking Zone', 'পার্কিং জোন'),
(19, 'default', 'Add New Label', 'নতুন লেবেল যোগ করুন'),
(20, 'default', 'English', 'ইংরেজী'),
(21, 'default', 'Parking Zones', 'পার্কিং জোন তালিকা'),
(22, 'default', 'Price', 'মূল্য'),
(23, 'default', 'New Price', 'নতুন মূল্য'),
(24, 'default', 'Prices', 'মূল্য তালিকা'),
(25, 'default', 'Promo Code', 'প্রোমো কোড'),
(26, 'default', 'New Promo Code', 'নতুন প্রোোমো কোড'),
(27, 'default', 'Promo Codes', 'প্রোমো কোড তালিকা'),
(28, 'default', 'New Email', 'নতুন ইমেইল'),
(29, 'default', 'Email List', 'ইমেল তালিকা'),
(30, 'default', 'Setting', 'সেটিং'),
(31, 'default', 'Booking', 'বুকিং'),
(32, 'default', 'New Booking', 'নতুন বুকিং'),
(33, 'default', 'Bookings', 'বুকিং লিস্ট'),
(34, 'default', 'Application', 'অ্যাপ্লিকেশন'),
(35, 'default', 'Message', 'বার্তা'),
(36, 'default', 'New Message', 'নতুন বার্তা'),
(37, 'default', 'Inbox Message', 'ইনবক্স বার্তা'),
(38, 'default', 'Sent Message', 'প্রেরিত বার্তা'),
(39, 'default', 'Language', 'ভাষা'),
(40, 'default', 'Admin', 'অ্যাডমিন'),
(41, 'default', 'New User', 'নতুন ব্যবহারকারী'),
(42, 'default', 'User List', 'ব্যবহারকারীর তালিকা'),
(43, 'default', 'Profile', 'প্রোফাইল'),
(44, 'default', 'Logout', 'লগআউট'),
(45, 'default', 'Main Navigation', 'প্রধান ন্যাভিগেশন'),
(46, 'default', 'Save', 'সংরক্ষণ'),
(47, 'default', 'Reset', 'রিসেট'),
(48, 'default', 'Update', 'আপডেট'),
(49, 'default', 'Update Label', 'আপডেট লেবেল'),
(50, 'default', 'Delete', 'মুছে ফেলুন'),
(51, 'default', 'Save Successful!', 'সফলভাবে সংরক্ষণ করুন!'),
(52, 'default', 'Add New Language', 'নতুন ভাষা জুড়ুন'),
(53, 'default', 'Enter Language Name', 'ভাষা নাম লিখুন'),
(54, 'default', 'Language List', 'ভাষা তালিকা'),
(55, 'default', 'Action', 'অ্যাকশন'),
(56, 'default', 'Active', 'সক্রিয়'),
(57, 'default', 'Activated', 'সক্রিয়'),
(58, 'default', 'Bangla', 'বাংলা'),
(59, 'default', 'Default Language Activated!', 'ডিফল্ট ভাষা সক্রিয়!'),
(60, 'default', 'Name', 'নাম'),
(61, 'default', 'Enter Name', 'নাম প্রবেশ করান'),
(62, 'default', 'Enter Phone or Mobile No.', 'ফোন বা মোবাইল নম্বর লিখুন'),
(63, 'default', 'Phone / Mobile', 'ফোন / মোবাইল'),
(64, 'default', 'Enter Email Address', 'ইমেল ঠিকানা লিখুন'),
(65, 'default', 'Enter Address', 'ঠিকানা লিখুন'),
(66, 'default', 'Address', 'ঠিকানা'),
(67, 'default', 'Vehicle Licence', 'যানবাহন লাইসেন্স'),
(68, 'default', 'Enter Vehicle Licence No.', 'ভেহিক্যাল লাইসেন্স নম্বর লিখুন'),
(69, 'default', 'Vehicle Photo', 'যানবাহন ছবি'),
(70, 'default', 'Note About Vehicle', 'নোট সম্পর্কে যানবাহন'),
(71, 'default', 'Note', 'নোট'),
(72, 'default', 'Default', 'ডিফল্ট'),
(74, 'default', 'Status', 'স্থিতি'),
(75, 'default', 'SL No.', 'এস এস নং'),
(76, 'default', 'ID No.', 'আইডি নম্বর'),
(77, 'default', 'Update Successful!', 'আপডেট সফল!'),
(78, 'default', 'Please Try Again.', 'অনুগ্রহ করে আবার চেষ্টা করুন।'),
(79, 'default', 'Latitude', 'অক্ষাংশ'),
(80, 'default', 'Space', 'স্পেস'),
(81, 'default', 'Limit', 'সীমিত'),
(82, 'default', 'Longitude', 'দ্রাঘিমাংশ'),
(83, 'default', 'Map Preview', 'ম্যাপ প্রিভিউ'),
(84, 'default', 'Parking Limit', 'পার্কিং লিমিট'),
(85, 'default', 'Use Comma to Separate Input', 'আলাদা আলাদা ইনপুট ব্যবহার করুন'),
(86, 'default', 'Edit Parking Zone', 'পার্কিং জোন সম্পাদনা করুন'),
(87, 'default', 'Latitude & Longitude', 'অক্ষাংশ ও দ্রাঘিমাংশ'),
(88, 'default', 'Time & Price', 'সময় এবং মূল্য'),
(89, 'default', 'Time', 'সময়'),
(90, 'default', 'Net Price', 'মোট মূল্য'),
(91, 'default', 'Select Option', 'নির্বাচন অপশন'),
(92, 'default', 'Every Single Unit', 'প্রত্যেক একক ইউনিট'),
(94, 'default', 'Edit Price', 'মূল্য সম্পাদনা করুন'),
(95, 'default', 'Unit', 'ইউনিট'),
(96, 'default', 'Offer Name', 'অফার নাম'),
(97, 'default', 'Description', 'বর্ণনা'),
(98, 'default', 'Discount', 'ছাড়'),
(99, 'default', 'Start Date', 'শুরু তারিখ'),
(100, 'default', 'End Date', 'শেষ তারিখ'),
(101, 'default', 'Edit Promo Code', 'প্রোডোম কোড সম্পাদনা করুন'),
(102, 'default', 'Phone', 'ফোন'),
(103, 'default', 'Message Sent!', 'বার্তা পাঠানো হয়েছে!'),
(104, 'default', 'Send To', 'প্রেরণ করুন'),
(105, 'default', 'Send', 'পাঠান'),
(106, 'default', 'Message', 'বার্তা'),
(107, 'default', 'Subject', 'বিষয়'),
(108, 'default', 'Sender', 'প্রেরক'),
(109, 'default', 'Date', 'তারিখ'),
(110, 'default', 'Message Details', 'বার্তা বিবরণ'),
(111, 'default', 'Receiver', 'রিসিভার'),
(112, 'default', 'Confirm Password', 'পাসওয়ার্ড নিশ্চিত করুন'),
(113, 'default', 'Photo', 'ফটো'),
(114, 'default', 'Created at', 'তৈরি করা হয়েছে'),
(115, 'default', 'Updated at', 'আপডেট করা হয়েছে'),
(116, 'default', 'User Role', 'ব্যবহারকারীর ভূমিকা'),
(117, 'default', 'Application Setting', 'অ্যাপ্লিকেশন সেটিং'),
(118, 'default', 'Edit Profile', 'প্রোফাইল সম্পাদনা করুন'),
(119, 'default', 'Application Title', 'অ্যাপ্লিকেশন শিরোনাম'),
(120, 'default', 'Short Description / Slogan', 'সংক্ষিপ্ত বিবরণ / স্লোগান'),
(121, 'default', 'Favicon', 'ফেভিকন'),
(122, 'default', 'Logo', 'লোগো'),
(123, 'default', 'Footer Text', 'পাদটী টেক্সট'),
(124, 'default', 'Google Map', 'গুগল ম্যাপ'),
(125, 'default', 'Google Map Api Key', 'গুগল ম্যাপ এপিআই কী'),
(126, 'default', 'Map Zoom Level', 'ম্যাপ জুম লেভেল'),
(127, 'default', 'Price Setting', 'মূল্য নির্ধারণ'),
(128, 'default', 'Currency & Vat', 'মুদ্রা ও ভ্যাট'),
(129, 'default', 'Currency', 'মুদ্রা'),
(130, 'default', 'Vat', 'ভ্যাট'),
(131, 'default', 'Delete Successful!', 'মুছুন সফল!'),
(132, 'default', 'Email History', 'ইমেল ইতিহাস'),
(133, 'default', 'Email Campaign', 'ইমেল প্রচারাভিযান'),
(134, 'default', 'Mail Sent!', 'মেল পাঠানো!'),
(135, 'default', 'Enter Receiver Email Address', 'প্রাপক ইমেল ঠিকানা লিখুন'),
(136, 'default', 'Mail Driver', 'মেইল চালক'),
(137, 'default', 'Mail Host', 'মেইল হোস্ট'),
(138, 'default', 'Mail Port', 'মেল পোর্ট'),
(139, 'default', 'Username', 'ইউজারনেম'),
(140, 'default', 'Encryption', 'এনক্রিপশন'),
(141, 'default', 'Sendmail', 'Sendmail'),
(142, 'default', 'Email Setting', 'ইমেইল সেটিং'),
(143, 'default', 'Paid', 'প্রদত্ত'),
(144, 'default', 'Not Paid', 'প্রদেয় নয়'),
(145, 'default', 'Reports', 'প্রতিবেদন'),
(146, 'default', 'Today\'s Booking', 'আজকের বুকিং'),
(147, 'default', 'Active Booking', 'সক্রিয় বুকিং'),
(148, 'default', 'Released', 'মুক্ত'),
(149, 'default', 'Select Parking Zone', 'পার্কিং জোন নির্বাচন করুন'),
(150, 'default', 'Arrival Time', 'আগমনের সময়'),
(151, 'default', 'Guest will \"Come and Go\"', 'গেস্ট হবে  \"আসুন এবং যান \"'),
(152, 'default', 'Select Space', 'নির্বাচন স্পেস'),
(153, 'default', 'Departure Time', 'প্রস্থান সময়'),
(154, 'default', 'Available', 'উপলব্ধ'),
(155, 'default', 'Occupied', 'দখলযুক্ত'),
(156, 'default', 'Client ID', 'ক্লায়েন্ট আইডি'),
(157, 'default', 'Booking Status', 'বুকিং স্থিতি'),
(158, 'default', 'Payment Status', 'পেমেন্ট স্ট্যাটাস'),
(159, 'default', 'Selected', 'নির্বাচিত'),
(160, 'default', 'Booking Now', 'এখন বুকিং'),
(161, 'default', 'Pretend', 'প্রিটেন্ড'),
(162, 'default', 'Unpaid Booking', 'অনির্বাচিত বুকিং'),
(163, 'default', 'Paid Booking', 'পেড বুকিং'),
(164, 'default', 'Paid Now', 'এখন প্রদেয়'),
(165, 'default', 'Booking ID', 'বুকিং আইডি'),
(166, 'default', 'Total', 'মোট'),
(167, 'default', 'Release', 'রিলিজ'),
(168, 'default', 'Token', 'টোকেন'),
(169, 'default', 'All Booking', 'সব বুকিং'),
(170, 'default', 'Search', 'অনুসন্ধান'),
(171, 'default', 'Filter', 'ফিল্টার'),
(172, 'default', 'Select Filter Type', 'ফিল্টার ধরন নির্বাচন করুন'),
(173, 'default', 'Release Time', 'মুক্তির সময়'),
(174, 'default', 'Total Amount', 'মোট পরিমাণ'),
(175, 'default', 'Grand Total', 'সর্বমোট'),
(176, 'default', 'Total Client', 'মোট ক্লায়েন্ট'),
(177, 'default', 'This Year Booking', 'এই বছর বুকিং'),
(178, 'default', 'From the Beginning ', 'শুরু থেকে শুরু'),
(179, 'default', 'Amount', 'পরিমাণ'),
(180, 'default', 'Total Booking', 'মোট বুকিং'),
(181, 'default', 'Recent Messages', 'সাম্প্রতিক বার্তা'),
(182, 'default', 'View All', 'দেখুন অল'),
(183, 'default', 'Edit Client', 'ক্লায়েন্ট সম্পাদনা করুন'),
(184, 'default', 'Edit User', 'ব্যবহারকারী সম্পাদনা করুন'),
(185, 'default', 'Due', 'দরুন'),
(186, 'default', 'You are not authorized to view this page!', 'আপনি এই পৃষ্ঠাটি দেখার জন্য অনুমোদিত নয়!'),
(187, 'default', 'Super Admin', 'সুপার অ্যাডমিন'),
(188, 'default', 'Operator', 'অপারেটর'),
(189, 'default', 'Net Amount', 'নেট পরিমাণ'),
(190, 'default', 'Vat Type', 'ভ্যাট প্রকার'),
(191, 'default', 'Fine Type', 'ফাইন টাইপ'),
(192, 'default', 'Fine', 'ফাইন'),
(193, 'default', 'Fixed', 'ফিক্সড'),
(194, 'default', 'Percent', 'শতাংশ'),
(195, 'default', 'Notification Setting', 'নোটিফিকেশন সেটিং'),
(196, 'default', 'SMS Notification', 'এসএমএস বিজ্ঞপ্তি'),
(197, 'default', 'Email Notification', 'ই-ইমেল বিজ্ঞপ্তি'),
(198, 'default', 'SMS Alert', 'এসএমএস এলার্ট'),
(199, 'default', 'Minutes', 'মিনিট'),
(200, 'default', 'SMS Setting', 'এসএমএস সেটিং'),
(201, 'default', 'Provider', 'প্রোভাইডার'),
(202, 'default', 'From', 'থেকে'),
(203, 'default', 'Mobile No.', 'মোবাইল নং'),
(204, 'default', 'API Key', 'API কী'),
(205, 'default', 'SMS Campaign', 'এসএমএস ক্যাম্পেইন'),
(206, 'default', 'New SMS', 'নতুন এসএমএস'),
(207, 'default', 'SMS History', 'এসএমএস হিস্ট্রি'),
(208, 'default', 'SMS Sent!', 'এসএমএস পাঠানো হয়েছে!'),
(209, 'default', 'SMS', 'এসএমএস'),
(210, 'default', 'Contact', 'যোগাযোগ'),
(211, 'default', 'Bulk Email', 'বাল্ক ইমেল'),
(212, 'default', 'User', 'ব্যবহারকারী'),
(213, NULL, 'Find Nearest Parking Lot', 'নিকটবর্তী পার্কিং লট খুঁজুন'),
(214, NULL, 'Cron Job Setting', 'ক্রোন জব সেটিং'),
(215, NULL, 'Website', 'ওয়েবসাইট'),
(216, 'default', 'Vehicle Sizes', 'গাড়ির ধরণ'),
(217, 'default', 'Vehicle Type', 'গাড়ির ধরণ'),
(218, 'default', 'Booking Time', 'বুকিং সময়'),
(219, 'default', 'Booking Period', 'বুকিং সময়কাল'),
(220, 'default', 'Extra Time Payment & Fine', 'অতিরিক্ত সময়ের জন্য  প্রদান ও জরিমানা '),
(221, 'default', 'Parking Lots', 'পার্কিং লট '),
(222, 'english', 'ABOUT', 'সম্পর্কে'),
(223, 'english', 'CONTACT US', 'যোগাযোগ করুন'),
(224, 'english', 'Register', 'নিবন্ধন'),
(225, 'english', 'Login successful!', 'সফল লগইন'),
(226, 'english', 'Booking History', 'বুকিংয়ের ইতিহাস'),
(227, 'english', 'Print', 'প্রিন্ট'),
(228, 'english', 'PayPal Setting', 'পেপাল সেটিং'),
(229, 'english', 'Secret Key', 'সিক্রেট কী'),
(230, 'english', 'Slider 1', 'স্লাইডার ১'),
(231, 'english', 'Slider 2', 'স্লাইডার ২'),
(232, 'english', 'Slider 3', 'স্লাইডার ৩'),
(233, 'english', 'Write something', 'কিছু লিখুন'),
(234, 'english', 'Facebook URL', 'ফেসবুক ইউআরএল'),
(235, 'english', 'Twitter URL', 'টুইটার ইউআরএল'),
(236, 'english', 'YouTube URL', 'ইউটিউব ইউআরএল'),
(237, 'english', 'Meta Description', 'মেটা বর্ণনা'),
(238, 'english', 'Meta Keyword', 'মেটা কীওয়ার্ড');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0->Unseen, 1->Seen, 2->Delete',
  `receiver_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0->Unseen, 1->Seen, 2->Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES
(1, 2, 1, 'Test Subject', 'Test Message', '2018-04-04 08:32:25', 0, 1),
(2, 1, 2, 'Test Subject', 'Test Message', '2018-04-04 08:32:25', 0, 0),
(3, 1, 2, 'Test Subject 2', 'Officia velit laboriosam expedita voluptates. Doloremque eli..', '2018-04-12 08:32:25', 0, 0),
(4, 2, 1, 'Test Subject 3', 'Test Message 3', '2018-04-12 08:32:25', 0, 0),
(5, 1, 2, 'Test Subject 4', 'Test Message 4', '2018-04-12 08:32:25', 0, 0),
(6, 1, 2, 'Test Subject 5', 'Test Message 5', '2018-04-12 08:32:25', 0, 0),
(7, 1, 2, 'Test Subject 6', 'Test Message 6', '2018-04-12 08:32:25', 0, 0),
(8, 2, 1, 'Test', 'Test', '2018-04-15 05:14:45', 0, 0),
(9, 2, 3, 'Another Subject', 'Test', '2018-04-25 12:34:11', 0, 0),
(10, 2, 1, 'Test Subject', 'Test', '2018-04-25 12:34:46', 0, 0),
(11, 2, 1, 'Another Subject', 'Test', '2018-04-30 01:14:53', 0, 0),
(12, 1, 2, 'Hello', 'Hello John Doe', '2018-05-04 08:54:27', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_09_20_092905_create_setting_table', 1),
(6, '2017_09_27_175416_create_price_table', 1),
(7, '2017_09_27_175447_create_promocode_table', 1),
(8, '2017_09_27_175524_create_message_table', 1),
(9, '2017_09_27_175540_create_transection_table', 1),
(10, '2017_10_02_135823_create_booking_table', 1),
(11, '2017_10_24_070524_create_email_setting_table', 1),
(12, '2017_10_24_085719_create_email_history_table', 1),
(17, '2021_06_09_185004_create_countries_table', 2),
(18, '2021_06_10_121558_create_states_table', 2),
(19, '2021_06_10_123235_create_cities_table', 2),
(20, '2021_06_10_123552_create_zones_table', 2),
(21, '2021_06_15_125814_create_parking_rules_table', 3),
(22, '2021_06_16_114938_create_faqs_table', 4),
(25, '2021_06_17_194529_create_place_table', 5),
(26, '2021_06_18_175416_create_price_table', 6),
(27, '2021_07_30_090912_create_biggapons_table', 7),
(28, '2017_09_26_161702_create_client_table', 8),
(30, '2021_08_05_183144_create_week_ly_parking_times_table', 9),
(31, '2021_08_04_181433_create_vehicles_table', 10),
(32, '2021_08_16_164441_create_client_parking_interests_table', 11),
(33, '2021_08_21_113112_create_app_preferences_table', 12),
(36, '2021_08_29_121038_create_point_systems_table', 13),
(38, '2021_08_29_173247_create_user_points_table', 14),
(39, '2021_09_09_115151_create_jobs_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `parking_rules`
--

CREATE TABLE `parking_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_legal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `available_date_time` timestamp NULL DEFAULT NULL,
  `vehicle_restriction` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Published',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parking_rules`
--

INSERT INTO `parking_rules` (`id`, `name`, `description`, `is_legal`, `available_date_time`, `vehicle_restriction`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Name', 'Description', 'No', NULL, 'Restriction', 'Published', NULL, '2021-06-15 09:17:02', '2021-06-15 09:17:02'),
(2, 'New Rule Name 0', 'Rule Description', 'Yes', '2021-06-14 18:00:00', 'Rule Restriction', 'Published', NULL, '2021-06-15 09:21:17', '2021-06-15 10:11:08'),
(3, 'sdf', 'sdf', 'Yes', NULL, 'sdf', 'Published', '2021-06-15 09:26:10', '2021-06-15 09:24:38', '2021-06-15 09:26:10'),
(4, 'New Rule Name', 'Rule Description', 'Yes', NULL, 'Rule Restriction', 'Published', NULL, '2021-06-15 09:45:42', '2021-06-15 09:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@example.com', '$2y$10$hEVOID.E0EZbwuOTFFxyQehz2UEGJKx6/O4PswrEQdPZQpIJRkeZu', '2018-05-02 09:52:52'),
('admin@parkwatch.com', '$2y$10$lgs91qpqTfTWmWfcRPpDdeicknaHNmrDC2VKpQd1TJ9.zD9C83p2O', '2021-06-16 10:55:25'),
('demo@parkwatch.com', '$2y$10$rUOQwpNnCYWv3pHAyW4wVu0kKS3XVEwzrYZi4Z1G8piNOcvvloadq', '2021-06-20 06:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ParkingOwner' COMMENT 'Parking Owner from user table and Client as Parking Owner from Client table',
  `client_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `zone_id` int(10) UNSIGNED DEFAULT NULL,
  `parking_rule_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `space` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `available_from` timestamp NULL DEFAULT NULL,
  `available_to` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`id`, `type`, `client_id`, `user_id`, `zone_id`, `parking_rule_id`, `name`, `note`, `address`, `latitude`, `longitude`, `limit`, `space`, `status`, `available_from`, `available_to`, `created_at`, `updated_at`) VALUES
(1, 'ParkingOwner', 0, 6, 2, 4, 'New Spot', 'Note', 'Dhaka', '23.741943954327095', '90.38301944732666', '20', '1,2,3,4,5,6,7,8,9,10', 1, '2021-08-24 10:21:00', '2021-09-24 10:21:00', NULL, NULL),
(2, 'ParkingOwner', 0, 6, 2, 2, 'nepf', NULL, 'Badda', '23.744006313194998', '90.38547533114085', '20', '2', 1, '2021-08-24 11:10:00', '2021-08-30 11:10:00', NULL, NULL),
(3, 'ClientAsParkingOwner', 24, NULL, 2, 2, 'Name', '23.741943954327095', 'Address', '23.741943954327095', '90.38301944732666', '25', '1,2,3,4,5,6,7,8,9,10', 1, '2021-08-26 11:15:00', '2021-08-31 11:20:00', NULL, NULL),
(7, 'ClientAsParkingOwner', 28, NULL, 2, 2, 'Saiful Islam', NULL, 'Dhaka', '23.741943954327095', '23.741943954327095', '10', '1,2,3,4,5', 1, '2021-08-24 10:20:00', '2021-09-25 10:25:00', NULL, NULL),
(8, 'ParkingOwner', 0, 6, 2, 4, 'Name', NULL, 'Dhaka', '23.740902941736124', '90.38032548983226', '10', '1,2,3,4,5,6,7,8,9,10', 1, '2021-08-24 09:20:00', '2021-08-24 09:45:00', NULL, NULL),
(11, 'ClientAsParkingOwner', 28, NULL, NULL, NULL, 'Saiful Islam', NULL, 'Dhaka 00', '20.12345600', '20.0123123', '1', NULL, 1, '2021-08-26 03:00:00', '2023-08-25 23:30:00', '2021-08-26 08:10:25', '2021-08-26 08:10:25'),
(12, 'ClientAsParkingOwner', 32, NULL, NULL, NULL, 'Jahid Islam', NULL, 'Dhaka', '123456', '123123', '1', NULL, 1, '2021-09-02 04:00:00', '2023-09-02 06:00:00', '2021-09-02 09:22:40', '2021-09-02 09:22:40'),
(13, 'ClientAsParkingOwner', 33, NULL, NULL, NULL, 'Jahid Islam', NULL, 'Dhaka', '123456', '123123', '1', NULL, 1, '2021-09-02 04:00:00', '2023-09-02 06:00:00', '2021-09-02 09:23:06', '2021-09-02 09:23:06'),
(14, 'ClientAsParkingOwner', 34, NULL, NULL, NULL, 'Rafid Islam', NULL, 'Dhaka', '123456', '123123', '1', NULL, 1, '2021-09-02 04:00:00', '2023-09-02 06:00:00', '2021-09-02 09:23:34', '2021-09-02 09:23:34'),
(15, 'ClientAsParkingOwner', 35, NULL, NULL, NULL, 'Salim Islam', NULL, 'Dhaka', '123456', '123123', '1', NULL, 1, '2021-09-02 04:00:00', '2023-09-02 06:00:00', '2021-09-02 09:24:13', '2021-09-02 09:24:13'),
(16, 'ClientAsParkingOwner', 36, NULL, NULL, NULL, 'Akber Islam', NULL, 'Dhaka', '123456', '123123', '1', NULL, 1, '2021-09-02 04:00:00', '2023-09-02 06:00:00', '2021-09-02 09:40:23', '2021-09-02 09:40:23'),
(17, 'ClientAsParkingOwner', 37, NULL, NULL, NULL, 'Mushfiq Mashok', NULL, 'Dhaka', '123456', '123123', '1', NULL, 1, '2021-09-06 04:00:00', '2023-09-06 06:00:00', '2021-09-06 13:05:42', '2021-09-06 13:05:42'),
(18, 'ClientAsParkingOwner', 39, 7, NULL, NULL, 'Jaber Hossain', NULL, 'New Work', '23.741943954327095', '90.38301944732666', '1', NULL, 1, '2021-09-14 04:00:00', '2023-09-14 06:00:00', '2021-09-14 11:46:08', '2021-09-23 10:13:00'),
(19, 'ClientAsParkingOwner', 0, 7, NULL, NULL, 'Jabed Ahmad', NULL, 'Dhaka 00', '20.12345600', '20.0123123', '1', NULL, 1, '2021-09-22 03:00:00', '2023-09-21 23:30:00', '2021-09-22 13:58:28', '2021-09-22 13:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `point_systems`
--

CREATE TABLE `point_systems` (
  `id` int(10) UNSIGNED NOT NULL,
  `min_point` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max_point` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `badge_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_systems`
--

INSERT INTO `point_systems` (`id`, `min_point`, `max_point`, `badge_name`, `badge_icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 100000, 'Rookie', 'assets/images/badge-icon/2021/08/30/sea-snail30-08-2021-28-36.jpg', 'Active', '2021-08-30 11:28:37', '2021-08-30 11:28:37'),
(2, 100001, 300000, 'Trail Blazer', 'assets/images/badge-icon/2021/08/30/salmon30-08-2021-31-19.jpg', 'Active', '2021-08-30 11:31:19', '2021-08-30 11:31:19'),
(3, 300001, 500000, 'Star', 'assets/images/badge-icon/2021/08/30/turtle30-08-2021-33-49.jpg', 'Active', '2021-08-30 11:33:50', '2021-08-30 11:33:50'),
(4, 500001, 700000, 'Fearless', 'assets/images/badge-icon/2021/08/30/dolphin30-08-2021-36-04.png', 'Active', '2021-08-30 11:36:05', '2021-08-30 11:36:05'),
(5, 700001, 999999, 'Majestical', 'assets/images/badge-icon/2021/08/30/shark30-08-2021-38-00.jpg', 'Active', '2021-08-30 11:38:01', '2021-08-30 11:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ParkingOwner' COMMENT 'Parking Owner from user table and Client as Parking Owner from Client table',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `place_id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `time` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,1) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `type`, `user_id`, `client_id`, `place_id`, `vehicle_type_id`, `time`, `unit`, `price`, `note`, `status`) VALUES
(49, 'ClientAsParkingOwner', NULL, 24, 2, 2, '1', 'hours', 40.0, NULL, 1),
(50, 'ClientAsParkingOwner', NULL, 24, 2, 1, '24', 'hours', 1200.0, NULL, 1),
(53, 'ClientAsParkingOwner', NULL, 28, 7, 1, '2', 'minute', 0.0, NULL, 1),
(54, 'ParkingOwner', 6, NULL, 1, 1, '1', 'hours', 0.0, NULL, 1),
(55, 'ParkingOwner', 6, NULL, 1, 1, '10', 'hours', 150.0, NULL, 1),
(56, 'ParkingOwner', 6, NULL, 1, 2, '20', 'hours', 500.0, NULL, 1),
(59, 'ClientAsParkingOwner', NULL, 28, 11, 1, '1', 'minute', 1.0, NULL, 1),
(60, 'ClientAsParkingOwner', NULL, 32, 12, 1, '1', 'minute', 1.0, NULL, 1),
(61, 'ClientAsParkingOwner', NULL, 33, 13, 1, '1', 'minute', 1.0, NULL, 1),
(62, 'ClientAsParkingOwner', NULL, 34, 14, 1, '1', 'minute', 1.0, NULL, 1),
(63, 'ClientAsParkingOwner', NULL, 35, 15, 1, '1', 'minute', 1.0, NULL, 1),
(64, 'ClientAsParkingOwner', NULL, 36, 16, 1, '1', 'minute', 1.0, NULL, 1),
(65, 'ClientAsParkingOwner', NULL, 37, 17, 1, '1', 'minute', 1.0, NULL, 1),
(66, 'ClientAsParkingOwner', 7, 39, 18, 1, '1', 'hours', 50.0, NULL, 1),
(67, 'ClientAsParkingOwner', 7, NULL, 19, 1, '1', 'minute', 1.0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promocode` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `limit` int(11) NOT NULL,
  `used` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`id`, `name`, `description`, `promocode`, `discount`, `limit`, `used`, `start_date`, `end_date`, `status`) VALUES
(1, 'Winter Offer', NULL, '12345', 10.00, 100, 19, '2018-01-17', '2020-03-31', 1),
(3, 'Summer offer', 'Test', '123456', 5.00, 20, 7, '2018-04-15', '2019-08-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scheduler`
--

CREATE TABLE `scheduler` (
  `id` int(10) UNSIGNED NOT NULL,
  `command` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_parameters` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arguments` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `expression` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_execution` datetime DEFAULT NULL,
  `without_overlapping` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scheduler`
--

INSERT INTO `scheduler` (`id`, `command`, `default_parameters`, `arguments`, `options`, `is_active`, `expression`, `description`, `last_execution`, `without_overlapping`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'inspire', NULL, NULL, NULL, 1, '0 0 1 1 * *', '', NULL, 1, '2018-04-25 19:38:43', '2018-04-25 19:49:40', '2018-04-25 19:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `solution` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_1` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_1_text` text COLLATE utf8mb4_unicode_ci,
  `slider_2` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_2_text` text COLLATE utf8mb4_unicode_ci,
  `slider_3` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_3_text` text COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_enable` tinyint(1) NOT NULL DEFAULT '0',
  `footer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_api_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_zoom` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '7',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `vat` float(8,1) NOT NULL DEFAULT '0.0',
  `vat_type` tinyint(1) NOT NULL DEFAULT '1',
  `fine` float(8,1) NOT NULL DEFAULT '0.0',
  `fine_type` tinyint(1) NOT NULL DEFAULT '1',
  `sms_notification` tinyint(1) NOT NULL DEFAULT '0',
  `email_notification` tinyint(1) NOT NULL DEFAULT '0',
  `sms_alert` int(11) DEFAULT NULL,
  `paypal_client_id` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_secret_key` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `about`, `solution`, `meta_keyword`, `meta_description`, `email`, `phone`, `address`, `favicon`, `logo`, `slider_1`, `slider_1_text`, `slider_2`, `slider_2_text`, `slider_3`, `slider_3_text`, `facebook`, `twitter`, `youtube`, `website_enable`, `footer`, `map_api_key`, `latitude`, `longitude`, `map_zoom`, `currency`, `vat`, `vat_type`, `fine`, `fine_type`, `sms_notification`, `email_notification`, `sms_alert`, `paypal_client_id`, `paypal_secret_key`) VALUES
(1, 'Park Watch', 'Parking is the act of stopping and disengaging a vehicle and leaving it unoccupied. Parking on one or both sides of a road is often permitted, though sometimes', 'The Solution is the act of stopping and disengaging a vehicle and leaving it unoccupied. Parking on one or both sides of a road is often permitted, though sometimes', 'Test', 'Test2', 'contact@parkwatch.com', '01125455151', 'Bangladesh', 'public/assets/images/icons/favicon.png', 'public/assets/images/icons/logo.png', 'public/assets/images/icons/slider_1.png', 'Test  2', 'public/assets/images/icons/slider_2.png', NULL, 'public/assets/images/icons/slider_3.png', 'Test 3b', 'Facebook.com', 'twitter.com', 'linked.in', 1, '© 2021 Park Watch', 'AIzaSyDDXkzEIj9sB3J_ohqT0woVWqAJQiyRmAE', '23.74820949588443', '90.38370507319102', '15', '৳', 10.0, 1, 5.0, 0, 0, 0, NULL, 'EBWKjlELKMYqRNQ6sYvFo64FtaRLRR5BdHEESmha49TM', 'EO422dn3gQLgDbuwqTjzrFgFtaRLRR5BdHEESmha49TM');

-- --------------------------------------------------------

--
-- Table structure for table `sms_history`
--

CREATE TABLE `sms_history` (
  `id` int(11) NOT NULL,
  `sms_setting_id` int(11) NOT NULL,
  `client_id_no` varchar(20) DEFAULT NULL,
  `from` varchar(20) DEFAULT NULL,
  `to` varchar(20) DEFAULT NULL,
  `message` varchar(512) DEFAULT NULL,
  `response` varchar(512) DEFAULT NULL,
  `schedule_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-pending, 1-done, 2-high-priority'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_history`
--

INSERT INTO `sms_history` (`id`, `sms_setting_id`, `client_id_no`, `from`, `to`, `message`, `response`, `schedule_at`, `created_at`, `updated_at`, `created_by`, `status`) VALUES
(29, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000001, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-06 23:19:54', NULL, 1, 0),
(30, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000002, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-06 23:54:32', NULL, 1, 0),
(31, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000003, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:02:33', NULL, 1, 0),
(32, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000004, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:05:35', NULL, 1, 0),
(33, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000005, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:09:04', NULL, 1, 0),
(34, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000006, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:21:20', NULL, 1, 0),
(35, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000007, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:23:48', NULL, 1, 0),
(36, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000008, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:24:42', NULL, 1, 0),
(37, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000009, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:27:08', NULL, 1, 0),
(38, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000010, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:32:14', NULL, 1, 0),
(39, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000011, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:50:13', NULL, 1, 0),
(40, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000012, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 00:50:38', NULL, 1, 0),
(41, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000013, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 01:01:59', NULL, 1, 0),
(42, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000014, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-07 01:09:28', NULL, 1, 0),
(43, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000015, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-19 22:57:44', NULL, 1, 0),
(44, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000016, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-19 23:58:28', NULL, 1, 0),
(45, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000017, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-20 00:02:02', NULL, 1, 0),
(46, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000018, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-25 21:59:31', NULL, 1, 0),
(47, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000001, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-27 17:45:00', NULL, 1, 0),
(48, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000001, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-27 17:45:00', NULL, 1, 0),
(49, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000001, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-28 20:34:07', NULL, 1, 0),
(50, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000002, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-07-28 20:48:37', NULL, 1, 0),
(51, 1, NULL, 'Smart Parking Lot', '0123456789', 'Test', '{\"status\":true,\"message\":\"success: {\\n    \\\"message-count\\\": \\\"1\\\",\\n    \\\"messages\\\": [{\\n        \\\"status\\\": \\\"4\\\",\\n        \\\"error-text\\\": \\\"Bad Credentials\\\"\\n    }]\\n}\"}', NULL, '2019-07-28 23:42:45', NULL, 3, 1),
(52, 1, 'A0001', 'Smart Parking Lot', '0123456789', 'Smart Parking Lot. \nYour Booking ID: A000003, Client ID: A0001 and Booking Time: ', NULL, NULL, '2019-08-17 15:49:55', NULL, 1, 0),
(53, 1, 'A0021', 'Smart Parking Lot', '3035678910', 'Smart Parking Lot. \nYour Booking ID: A000004, Client ID: A0021 and Booking Time: ', NULL, NULL, '2019-08-26 15:32:18', NULL, 1, 0),
(54, 1, 'A0021', 'Smart Parking Lot', '3035678910', 'Smart Parking Lot. \nYour Booking ID: A000005, Client ID: A0021 and Booking Time: ', NULL, NULL, '2019-08-26 16:27:38', NULL, 3, 0),
(55, 1, 'A0022', 'Smart Parking Lot', '3035678910', 'Smart Parking Lot. \nYour Booking ID: A000006, Client ID: A0022 and Booking Time: ', NULL, NULL, '2019-08-26 16:28:42', NULL, 3, 0),
(56, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000009, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-24 11:12:01', NULL, 0, 0),
(57, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000010, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-24 11:13:12', NULL, 0, 0),
(58, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000011, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-24 11:14:58', NULL, 0, 0),
(59, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000012, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-29 11:19:06', NULL, 0, 0),
(60, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000013, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-09-29 12:04:34', NULL, 0, 0),
(61, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000014, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-14 11:22:24', NULL, 0, 0),
(62, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000015, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-14 11:54:18', NULL, 0, 0),
(63, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000016, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-14 11:56:38', NULL, 0, 0),
(64, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000017, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-14 15:17:53', NULL, 0, 0),
(65, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000018, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-15 11:20:16', NULL, 0, 0),
(66, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000019, Client ID: A0023 and Booking Time: ', NULL, NULL, '2019-10-15 11:28:46', NULL, 0, 0),
(67, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:31:40', NULL, 0, 0),
(68, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:33:14', NULL, 0, 0),
(69, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:38:12', NULL, 0, 0),
(70, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:38:38', NULL, 0, 0),
(71, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000020, Client ID: A0023 and Booking Time: 2019-10-15 17:26:00', NULL, NULL, '2019-10-15 17:39:41', NULL, 0, 0),
(72, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000021, Client ID: A0023 and Booking Time: 2019-10-16 11:14:00', NULL, NULL, '2019-10-16 11:15:35', NULL, 0, 0),
(73, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:09:42', NULL, 0, 0),
(74, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:10:03', NULL, 0, 0),
(75, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:10:52', NULL, 0, 0),
(76, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:12:42', NULL, 0, 0),
(77, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:12:58', NULL, 0, 0),
(78, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:13:21', NULL, 0, 0),
(79, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000022, Client ID: A0023 and Booking Time: 2019-10-16 15:08:00', NULL, NULL, '2019-10-16 15:14:18', NULL, 0, 0),
(81, 1, 'A0023', 'Smart Parking Lot', '1858884515', 'Smart Parking Lot. \nYour Booking ID: A000018, Client ID: A0023 and Booking Time: 2019-10-16 15:47:00', NULL, NULL, '2019-10-16 15:48:33', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sms_setting`
--

CREATE TABLE `sms_setting` (
  `id` int(11) NOT NULL,
  `provider` varchar(20) NOT NULL DEFAULT 'nexmo',
  `api_key` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `from` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-inactive, 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_setting`
--

INSERT INTO `sms_setting` (`id`, `provider`, `api_key`, `username`, `password`, `from`, `status`) VALUES
(1, 'nexmo', 'b39edd600577b6b3bd16cc69aec82f05', 'yungong', '13906', 'Smart Parking Lot', 1);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `state_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Published',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'New State 0', 'Published', NULL, '2021-06-10 12:46:05', '2021-06-14 07:55:38'),
(2, 6, 'New Work', 'Unpublished', NULL, '2021-06-22 05:49:49', '2021-08-29 10:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_role` varchar(20) DEFAULT 'parkingowner',
  `place_id` varchar(128) DEFAULT NULL COMMENT 'multiple_id_of_parking_zone',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `password_reset_otp` varchar(50) DEFAULT NULL,
  `otp_validity` timestamp NULL DEFAULT NULL,
  `otp_status` varchar(50) NOT NULL DEFAULT 'Not_Verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `photo`, `remember_token`, `created_at`, `updated_at`, `user_role`, `place_id`, `status`, `password_reset_otp`, `otp_validity`, `otp_status`) VALUES
(1, 'Administrator', 'superadmin@parkwatch.com', '$2y$10$UVe2VGyQGLxYrrAn.ld2Cu7uyEkVNFK/Ex1jr8hnAM0WLTj7vRZxS', 'public/assets/images/client/0025e0167dbe22baac308640ecf1b805.jpg', 'zSuocH38D6FuGxrUcazn8j8F9TDQilpZAHijxkHmDa3vvgJ2aKGfo2YiSg8B', '2017-10-23 18:20:02', '2021-06-16 09:55:39', 'superadmin', NULL, 1, NULL, NULL, 'Not_Verified'),
(2, 'Park Watch Admin', 'admin@parkwatch.com', '$2y$10$Amt/rLOQ6BCMPBrGANqdlOTAI0lI53/NkbMJ5N7F2jJrXbfw70Gtq', 'public/assets/images/admin/210614042925.jpg', 'SlZbCMZ7qHz0YkwEFdxQjg2WHdtYV7hMVSpiBkPFa7CkH1SSnruFsFZQasSP', '2018-04-12 13:31:11', '2021-06-21 09:32:24', 'admin', '', 1, NULL, NULL, 'Not_Verified'),
(5, 'Demo', 'demo@parkwatch.com', '$2y$10$hN2mHhU7El8Gqst/QrDE8OCn5k2H.dRrQU/JIN44SbkdMnayLENt.', NULL, NULL, '2021-06-14 11:04:36', NULL, 'admin', NULL, 1, NULL, NULL, 'Not_Verified'),
(6, 'Parking Owner', 'client1@parkwatch.com', '$2y$10$UVe2VGyQGLxYrrAn.ld2Cu7uyEkVNFK/Ex1jr8hnAM0WLTj7vRZxS', 'public/assets/images/admin/210728054021.jpg', NULL, '2021-06-22 06:49:28', '2021-07-28 11:40:22', 'parkingowner', '', 1, NULL, NULL, 'Not_Verified'),
(7, 'Jabed Ahmad', 'saiful@aapbd.com', '$2y$10$GzcvhVnH9ay9gc//LSafm.6dXxvV5nPQM.jiyptxRv7bIr/E6noni', 'images/driveway-profile-photo//2021/09/22/348220921044922.png', NULL, '2021-09-14 11:46:08', '2021-09-23 13:22:33', 'parkingowner', NULL, 1, '935603', '2021-09-23 13:32:33', 'Not_Verified');

-- --------------------------------------------------------

--
-- Table structure for table `user_point_notifications`
--

CREATE TABLE `user_point_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `point` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `action_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_date` timestamp NOT NULL DEFAULT '2021-08-31 07:59:20',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_point_notifications`
--

INSERT INTO `user_point_notifications` (`id`, `client_id`, `point`, `action_name`, `action_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 28, 20, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-08-31 08:19:43', '2021-08-31 08:19:43'),
(3, 28, 5, 'Notify_Available_parking_Spot_To_App', '2021-08-31 07:59:20', 'Read', '2021-08-31 08:29:41', '2021-08-31 08:29:41'),
(4, 32, 10, 'Notify_Available_parking_Spot_To_App', '2021-08-31 07:59:20', 'Read', '2021-08-31 08:30:36', '2021-08-31 08:30:36'),
(5, 32, 5, 'Every_Day_App_Use', '2021-08-31 07:59:20', 'Read', '2021-08-31 08:31:05', '2021-08-31 08:31:05'),
(6, 33, 10, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-08-31 08:31:24', '2021-09-01 14:09:48'),
(7, 33, 10, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-09-02 09:45:11', '2021-09-02 09:45:11'),
(8, 34, 5, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-09-02 09:45:13', '2021-09-02 09:45:13'),
(9, 34, 5, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-09-02 09:45:15', '2021-09-02 09:45:15'),
(10, 35, 20, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-09-02 09:45:16', '2021-09-02 09:45:16'),
(11, 35, 20, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-09-02 09:45:17', '2021-09-02 09:45:17'),
(12, 36, 5, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-09-02 09:46:06', '2021-09-02 09:46:06'),
(13, 36, 5, 'Parked_Using_App', '2021-08-31 07:59:20', 'Read', '2021-09-02 09:46:07', '2021-09-02 09:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`id`, `name`, `image`, `description`, `status`) VALUES
(1, 'Car', 'assets/images/vehicle-type/2021/08/18/park-watch-logo-0218-08-2021-46-52.png', NULL, 1),
(2, 'Bus', 'assets/images/vehicle-type/2021/08/19/park-watch-logo-0219-08-2021-30-48.png', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_parking_times`
--

CREATE TABLE `weekly_parking_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `find_parking_by_work_address` tinyint(2) NOT NULL DEFAULT '0',
  `arrived_home_find_parking` tinyint(2) NOT NULL DEFAULT '0',
  `leave_parking_after_work` tinyint(2) NOT NULL DEFAULT '0',
  `home_parking_leaving_time` tinyint(4) NOT NULL,
  `day_time` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mon_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tue_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wed_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thu_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fri_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sat_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sun_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weekly_parking_times`
--

INSERT INTO `weekly_parking_times` (`id`, `client_id`, `find_parking_by_work_address`, `arrived_home_find_parking`, `leave_parking_after_work`, `home_parking_leaving_time`, `day_time`, `mon_day`, `tue_day`, `wed_day`, `thu_day`, `fri_day`, `sat_day`, `sun_day`, `created_at`, `updated_at`) VALUES
(109, 28, 1, 0, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(110, 28, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(111, 28, 0, 0, 1, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(114, 32, 1, 0, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(115, 32, 0, 0, 1, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(116, 32, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(117, 32, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(118, 12, 0, 32, 0, 0, '0', '0', '0', '1', '0', '1', '1', '0', NULL, NULL),
(119, 33, 1, 0, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(120, 33, 0, 0, 1, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(121, 33, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(122, 33, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(123, 12, 0, 33, 0, 0, '0', '0', '0', '1', '0', '1', '1', '0', NULL, NULL),
(124, 34, 1, 0, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(125, 34, 0, 0, 1, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(126, 34, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(127, 34, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(128, 12, 0, 34, 0, 0, '0', '0', '0', '1', '0', '1', '1', '0', NULL, NULL),
(129, 35, 1, 0, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(130, 35, 0, 0, 1, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(131, 35, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(132, 35, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(133, 12, 0, 35, 0, 0, '0', '0', '0', '1', '0', '1', '1', '0', NULL, NULL),
(134, 36, 1, 0, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(135, 36, 0, 0, 1, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(136, 36, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(137, 36, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(138, 12, 0, 36, 0, 0, '0', '0', '0', '1', '0', '1', '1', '0', NULL, NULL),
(139, 37, 1, 0, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(140, 37, 0, 0, 1, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(141, 37, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(142, 37, 0, 1, 0, 0, '12:00pm to 12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(143, 12, 0, 37, 0, 0, '0', '0', '0', '1', '0', '1', '1', '0', NULL, NULL),
(149, 39, 1, 0, 0, 0, '12:00pm_to_12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(150, 39, 0, 0, 1, 0, '12:00pm_to_12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(151, 39, 0, 1, 0, 0, '12:00pm_to_12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(152, 39, 0, 1, 0, 0, '12:00pm_to_12:30pm', '0', '0', '1', '0', '0', '1', '0', NULL, NULL),
(153, 12, 0, 39, 0, 0, '0', '0', '0', '1', '0', '1', '1', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `zone_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Published',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `city_id`, `zone_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'New Zone', 'Published', NULL, '2021-06-13 09:50:04', '2021-06-14 07:56:48'),
(2, 5, 'Zone of City of New Work', 'Published', NULL, '2021-06-22 05:52:03', '2021-06-22 05:52:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_preferences`
--
ALTER TABLE `app_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biggapons`
--
ALTER TABLE `biggapons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biggapons_user_id_foreign` (`user_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_history`
--
ALTER TABLE `booking_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client0`
--
ALTER TABLE `client0`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_parking_interests`
--
ALTER TABLE `client_parking_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_vehicle`
--
ALTER TABLE `client_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_history`
--
ALTER TABLE `email_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_setting`
--
ALTER TABLE `email_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_rules`
--
ALTER TABLE `parking_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_user_id_foreign` (`user_id`),
  ADD KEY `place_zone_id_foreign` (`zone_id`),
  ADD KEY `place_parking_rule_id_foreign` (`parking_rule_id`);

--
-- Indexes for table `point_systems`
--
ALTER TABLE `point_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode`
--
ALTER TABLE `promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scheduler`
--
ALTER TABLE `scheduler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_email_unique` (`email`);

--
-- Indexes for table `sms_history`
--
ALTER TABLE `sms_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_setting`
--
ALTER TABLE `sms_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_point_notifications`
--
ALTER TABLE `user_point_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_parking_times`
--
ALTER TABLE `weekly_parking_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zones_city_id_foreign` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_preferences`
--
ALTER TABLE `app_preferences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `biggapons`
--
ALTER TABLE `biggapons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `booking_history`
--
ALTER TABLE `booking_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `client0`
--
ALTER TABLE `client0`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `client_parking_interests`
--
ALTER TABLE `client_parking_interests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `client_vehicle`
--
ALTER TABLE `client_vehicle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_history`
--
ALTER TABLE `email_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `email_setting`
--
ALTER TABLE `email_setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `parking_rules`
--
ALTER TABLE `parking_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `point_systems`
--
ALTER TABLE `point_systems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scheduler`
--
ALTER TABLE `scheduler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_history`
--
ALTER TABLE `sms_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `sms_setting`
--
ALTER TABLE `sms_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_point_notifications`
--
ALTER TABLE `user_point_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `weekly_parking_times`
--
ALTER TABLE `weekly_parking_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biggapons`
--
ALTER TABLE `biggapons`
  ADD CONSTRAINT `biggapons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `place_parking_rule_id_foreign` FOREIGN KEY (`parking_rule_id`) REFERENCES `parking_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `place_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `place_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `zones`
--
ALTER TABLE `zones`
  ADD CONSTRAINT `zones_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
