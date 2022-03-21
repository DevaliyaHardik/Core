-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 02:50 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_hardik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstName`, `lastName`, `email`, `password`, `status`, `createdDate`, `updatedDate`) VALUES
(67, 'hardik', 'devaliya', 'hardikdevaliya141@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-10 06:17:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `shipingMethod` varchar(30) NOT NULL,
  `shipingCharge` float NOT NULL,
  `paymentMethod` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `subtotal`, `shipingMethod`, `shipingCharge`, `paymentMethod`, `status`, `createdDate`, `updatedDate`) VALUES
(44, 190, 0, '', 0, '', 2, '0000-00-00 00:00:00', NULL),
(45, 178, 0, '1', 100, '2', 2, '0000-00-00 00:00:00', NULL),
(46, 179, 0, '', 0, '', 2, '0000-00-00 00:00:00', NULL),
(47, 197, 0, '', 0, '', 2, '0000-00-00 00:00:00', NULL),
(48, 186, 0, '', 0, '', 2, '0000-00-00 00:00:00', NULL),
(49, 188, 0, '', 0, '', 2, '0000-00-00 00:00:00', NULL),
(50, 192, 0, '', 0, '', 2, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `address_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postalCode` bigint(7) NOT NULL,
  `country` varchar(100) NOT NULL,
  `biling` tinyint(1) NOT NULL DEFAULT 2,
  `shiping` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`address_id`, `cart_id`, `firstName`, `lastName`, `address`, `city`, `state`, `postalCode`, `country`, `biling`, `shiping`) VALUES
(22, 44, 'DEVALIYA', 'LALITBHAI', '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(23, 44, 'DEVALIYA', 'LALITBHAI', '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(24, 45, 'DEVALIYA', 'LALITBHAI', '346', 'Surat', 'Gujarat', 999, 'India', 1, 2),
(25, 45, 'DEVALIYA', 'LALITBHAI', '346', 'Surat', 'Gujarat', 999, 'India', 2, 1),
(26, 46, 'DEVALIYA', 'LALITBHAI', '346', 'rajkot', 'Gujara', 394107, 'India', 1, 2),
(27, 46, 'DEVALIYA', 'LALITBHAI', '346', 'rajkot', 'Gujara', 394107, 'India', 2, 1),
(28, 47, 'DEVALIYA', 'LALITBHAI', '346', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(29, 47, 'DEVALIYA', 'LALITBHAI', '346', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(30, 48, 'DEVALIYA', 'LALITBHAI', '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(31, 48, 'DEVALIYA', 'LALITBHAI', '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(32, 49, 'DEVALIYA', 'LALITBHAI', '346', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(33, 49, 'DEVALIYA', 'LALITBHAI', '344', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(34, 50, 'DEVALIYA', 'LALITBHAI', '', '', '', 0, '', 2, 2),
(35, 50, 'DEVALIYA', 'LALITBHAI', '', '', '', 0, '', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `itemTotal` float NOT NULL,
  `discount` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `path` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `base` int(11) DEFAULT NULL,
  `thumb` int(11) DEFAULT NULL,
  `small` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `name`, `status`, `path`, `createdDate`, `updatedDate`, `base`, `thumb`, `small`) VALUES
(110, NULL, 'Bedroon', 1, '110', '2022-03-09 10:03:27', NULL, 39, 40, 41),
(113, 110, 'Bed', 1, '110/113', '2022-03-09 10:03:07', NULL, NULL, 37, NULL),
(114, 113, 'Panel Bed', 1, '110/113/114', '2022-03-09 10:03:25', NULL, NULL, NULL, 38),
(115, NULL, 'kitchen', 1, '115', '2022-03-09 10:03:33', NULL, NULL, NULL, NULL),
(116, 115, 'stove', 1, '115/116', '2022-03-09 10:03:46', NULL, NULL, NULL, NULL),
(118, 115, 'gas', 1, '115/118', '2022-03-09 10:03:07', '2022-03-09 05:03:24', NULL, NULL, NULL),
(119, 118, 'lpd', 1, '115/118/119', '2022-03-09 10:03:15', NULL, NULL, NULL, NULL),
(120, NULL, 'fashion', 1, '120', '2022-03-09 10:03:45', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `media_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gallery` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`media_id`, `category_id`, `name`, `gallery`) VALUES
(37, 113, 'Black_T-shirt20220314081514.jpeg', 2),
(38, 114, 'BALDOR_Running_Shoes_For_Men20220314081528.jpeg', 1),
(39, 110, '320220316122006.jpg', 2),
(40, 110, 'BALDOR_Running_Shoes_For_Men20220316123411.jpeg', 2),
(41, 110, 'Black_T-shirt20220316123415.jpeg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entity_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entity_id`, `category_id`, `product_id`) VALUES
(122, 113, 41),
(123, 114, 41),
(124, 110, 43),
(125, 113, 43),
(126, 114, 43),
(127, 113, 42);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `salesman_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`, `updatedDate`, `salesman_id`) VALUES
(178, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-08 01:38:55', '2022-03-17 12:28:26', 25),
(179, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-08 09:37:14', '2022-03-15 09:30:59', 25),
(186, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:17', '2022-03-15 10:47:17', 25),
(187, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:21', '2022-03-15 12:57:23', 25),
(188, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:25', '2022-03-15 07:15:05', 25),
(189, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:28', '2022-03-15 12:52:58', NULL),
(190, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:31', '2022-03-15 07:14:41', NULL),
(191, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:34', '2022-03-15 07:12:56', NULL),
(192, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:37', NULL, NULL),
(193, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:41', '2022-03-15 07:14:00', NULL),
(194, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:34:44', '2022-03-15 08:20:34', NULL),
(197, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-15 07:09:35', '2022-03-15 07:12:20', NULL),
(198, 'kartik', 'vasava', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-16 12:18:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postalCode` bigint(6) NOT NULL,
  `country` varchar(70) NOT NULL,
  `biling` tinyint(1) NOT NULL DEFAULT 2,
  `shiping` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `address`, `city`, `state`, `postalCode`, `country`, `biling`, `shiping`) VALUES
(148, 178, '346', 'Surat', 'Gujarat', 999, 'India', 1, 2),
(150, 178, '346', 'Surat', 'Gujarat', 999, 'India', 2, 1),
(151, 179, '346', 'rajkot', 'Gujara', 394107, 'India', 1, 2),
(152, 179, '346', 'rajkot', 'Gujara', 394107, 'India', 2, 1),
(153, 186, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(154, 186, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(155, 189, '346', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(156, 188, '346', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(157, 189, '346', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(158, 187, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(159, 187, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(160, 197, '346', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(161, 197, '346', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(162, 193, '', '', '', 0, 'select', 1, 2),
(163, 193, '', '', '', 0, 'select', 2, 1),
(164, 190, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(165, 190, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(166, 188, '344', 'Surat', 'Gujarat', 394107, 'India', 2, 1),
(167, 198, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 1, 2),
(168, 198, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 394107, 'India', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entity_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`entity_id`, `customer_id`, `product_id`, `price`) VALUES
(178, 178, 41, 100),
(179, 178, 42, 99);

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `address_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postalCode` bigint(6) NOT NULL,
  `biling` tinyint(1) NOT NULL DEFAULT 2,
  `shiping` tinyint(4) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`address_id`, `order_id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `city`, `state`, `country`, `postalCode`, `biling`, `shiping`, `createdDate`) VALUES
(13, 33, 'kartik', 'vasava', 'hardikdevaliya141@gmail.com', 917046027655, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 'India', 394107, 1, 2, '2022-03-21 19:18:36'),
(14, 33, 'kartik', 'vasava', 'hardikdevaliya141@gmail.com', 917046027655, '346 Marutidham SOC amroli', 'Surat', 'Gujarat', 'India', 394107, 2, 1, '2022-03-21 19:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_final`
--

CREATE TABLE `order_final` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `grandTotal` float NOT NULL,
  `shiping_id` int(11) NOT NULL,
  `shipingCharge` float NOT NULL,
  `payment_id` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_final`
--

INSERT INTO `order_final` (`order_id`, `customer_id`, `firstName`, `lastName`, `email`, `mobile`, `grandTotal`, `shiping_id`, `shipingCharge`, `payment_id`, `state`, `status`, `createdDate`) VALUES
(33, 198, 'kartik', 'vasava', 'hardikdevaliya141@gmail.com', 917046027655, 3720, 2, 70, 2, 1, 1, '2022-03-21 19:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`item_id`, `order_id`, `product_id`, `name`, `sku`, `price`, `discount`, `quantity`, `createdDate`) VALUES
(49, 33, 41, 'fee', 'hardik001', 500, NULL, 5, '2022-03-21 19:18:35'),
(50, 33, 42, 'fee', 'hardik004', 500, NULL, 5, '2022-03-21 19:18:35'),
(51, 33, 43, 'bed', 'hardik005', 2000, NULL, 2, '2022-03-21 19:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `name`, `code`, `content`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'hardik1', 'hard1', 'hardik.comn', 1, '2022-03-10 19:30:06', NULL),
(2, 'hardik2', 'hard2', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(3, 'hardik3', 'hard3', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(4, 'hardik4', 'hard4', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(5, 'hardik5', 'hard5', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(6, 'hardik6', 'hard6', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(7, 'hardik7', 'hard7', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(8, 'hardik8', 'hard8', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(9, 'hardik9', 'hard9', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(10, 'hardik10', 'hard10', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(11, 'hardik11', 'hard11', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(12, 'hardik12', 'hard12', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(13, 'hardik13', 'hard13', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(14, 'hardik14', 'hard14', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(15, 'hardik15', 'hard15', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(16, 'hardik16', 'hard16', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(17, 'hardik17', 'hard17', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(18, 'hardik18', 'hard18', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(19, 'hardik19', 'hard19', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(20, 'hardik20', 'hard20', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(21, 'hardik21', 'hard21', 'hardik.com1', 1, '2022-03-10 19:30:06', NULL),
(22, 'hardik22', 'hard22', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(23, 'hardik23', 'hard23', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(24, 'hardik24', 'hard24', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(25, 'hardik25', 'hard25', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(26, 'hardik26', 'hard26', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(27, 'hardik27', 'hard27', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(28, 'hardik28', 'hard28', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(29, 'hardik29', 'hard29', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(30, 'hardik30', 'hard30', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(31, 'hardik31', 'hard31', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(32, 'hardik32', 'hard32', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(33, 'hardik33', 'hard33', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(34, 'hardik34', 'hard34', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(35, 'hardik35', 'hard35', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(36, 'hardik36', 'hard36', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(37, 'hardik37', 'hard37', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(38, 'hardik38', 'hard38', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(39, 'hardik39', 'hard39', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(40, 'hardik40', 'hard40', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(41, 'hardik41', 'hard41', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(42, 'hardik42', 'hard42', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(43, 'hardik43', 'hard43', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(44, 'hardik44', 'hard44', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(45, 'hardik45', 'hard45', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(46, 'hardik46', 'hard46', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(47, 'hardik47', 'hard47', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(48, 'hardik48', 'hard48', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(49, 'hardik49', 'hard49', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(50, 'hardik50', 'hard50', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(51, 'hardik51', 'hard51', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(52, 'hardik52', 'hard52', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(53, 'hardik53', 'hard53', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(54, 'hardik54', 'hard54', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(55, 'hardik55', 'hard55', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(56, 'hardik56', 'hard56', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(57, 'hardik57', 'hard57', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(58, 'hardik58', 'hard58', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(59, 'hardik59', 'hard59', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(60, 'hardik60', 'hard60', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(61, 'hardik61', 'hard61', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(62, 'hardik62', 'hard62', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(63, 'hardik63', 'hard63', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(64, 'hardik64', 'hard64', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(65, 'hardik65', 'hard65', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(66, 'hardik66', 'hard66', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(67, 'hardik67', 'hard67', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(68, 'hardik68', 'hard68', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(69, 'hardik69', 'hard69', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(70, 'hardik70', 'hard70', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(71, 'hardik71', 'hard71', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(72, 'hardik72', 'hard72', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(73, 'hardik73', 'hard73', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(74, 'hardik74', 'hard74', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(75, 'hardik75', 'hard75', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(76, 'hardik76', 'hard76', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(77, 'hardik77', 'hard77', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(78, 'hardik78', 'hard78', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(79, 'hardik79', 'hard79', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(80, 'hardik80', 'hard80', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(81, 'hardik81', 'hard81', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(82, 'hardik82', 'hard82', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(83, 'hardik83', 'hard83', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(84, 'hardik84', 'hard84', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(85, 'hardik85', 'hard85', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(86, 'hardik86', 'hard86', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(87, 'hardik87', 'hard87', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(88, 'hardik88', 'hard88', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(89, 'hardik89', 'hard89', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(90, 'hardik90', 'hard90', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(91, 'hardik91', 'hard91', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(92, 'hardik92', 'hard92', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(93, 'hardik93', 'hard93', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(94, 'hardik94', 'hard94', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(95, 'hardik95', 'hard95', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(96, 'hardik96', 'hard96', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(97, 'hardik97', 'hard97', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(98, 'hardik98', 'hard98', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(99, 'hardik99', 'hard99', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(100, 'hardik100', 'hard100', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(101, 'hardik101', 'hard101', 'hardik.co', 1, '2022-03-10 19:30:06', NULL),
(102, 'hardik102', 'hard102', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(103, 'hardik103', 'hard103', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(104, 'hardik104', 'hard104', 'hardik.com', 1, '2022-03-10 19:30:06', NULL),
(110, 'few', 'cfewd', 'cewdfc', 1, '2022-03-14 08:57:43', NULL),
(111, 'cewsa', 'cvds', 'bng', 1, '2022-03-14 08:58:10', NULL),
(112, 'vnjr', 'nyj', 'mjhg', 1, '2022-03-14 08:59:36', NULL),
(113, 'vrtfcv ', '1', ' arw', 1, '2022-03-14 09:00:44', NULL),
(116, 'vrtfcv ', '12', ' arw2', 1, '2022-03-14 09:02:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`method_id`, `name`) VALUES
(1, 'card payment'),
(2, 'upi'),
(3, 'QR'),
(4, 'case on delivery');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `quntity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `thumb` int(11) DEFAULT NULL,
  `small` int(11) DEFAULT NULL,
  `base` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `sku`, `name`, `price`, `quntity`, `status`, `createdDate`, `updatedDate`, `thumb`, `small`, `base`) VALUES
(41, 'hardik001', 'fee', 100, 6989, 1, '2022-03-09 11:28:25', '2022-03-10 11:14:30', 31, 28, 28),
(42, 'hardik004', 'fee', 100, 10000, 1, '2022-03-09 11:28:47', '2022-03-15 10:21:19', 29, NULL, 29),
(43, 'hardik005', 'bed', 1000, 4999, 1, '2022-03-12 12:42:58', NULL, NULL, NULL, 32),
(45, 'hardik003', 'fee', 100, 1000, 1, '2022-03-12 12:48:40', NULL, NULL, NULL, NULL),
(46, 'hardik007', 'fee', 100, 1000, 1, '2022-03-12 12:51:05', NULL, NULL, NULL, NULL),
(47, 'hardik0010', 'fee', 100, 1000, 1, '2022-03-12 12:54:15', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `media_id` int(16) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gallery` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`media_id`, `product_id`, `name`, `gallery`) VALUES
(28, 41, '320220312120107.jpg', 1),
(29, 42, 'BALDOR_Running_Shoes_For_Men20220315095534.jpeg', 2),
(31, 41, 'BALDOR_Running_Shoes_For_Men20220315020041.jpeg', 2),
(32, 43, 'MICROSOFT_Surface_Go_Pentium_Gold20220321010758.jpeg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `discount` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`, `updatedDate`, `discount`) VALUES
(25, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-09 12:09:39', NULL, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `shiping_method`
--

CREATE TABLE `shiping_method` (
  `method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `charge` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shiping_method`
--

INSERT INTO `shiping_method` (`method_id`, `name`, `charge`) VALUES
(1, 'same day delivery', 100),
(2, 'express delivery', 70),
(3, 'normal delivery', 50);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(11, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-12 10:22:49', '2022-03-15 09:33:48'),
(13, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-15 09:16:37', '2022-03-15 09:33:57'),
(14, 'DEVALIYA', 'LALITBHAI', 'hardikdevaliya141@gmail.com', 917046027655, 1, '2022-03-15 07:21:55', '2022-03-15 07:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postalCode` bigint(6) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `vendor_id`, `address`, `city`, `state`, `postalCode`, `country`) VALUES
(9, 11, '346', 'Surat', 'Gujarat', 394107, 'India'),
(10, 13, '346', 'Surat', 'Gujarat', 394107, 'India'),
(12, 14, '346', 'Surat', 'Gujarat', 394107, 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `cart_item_ibfk_1` (`cart_id`),
  ADD KEY `cart_item_ibfk_2` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category` (`parent_id`),
  ADD KEY `base` (`base`),
  ADD KEY `category_ibfk_2` (`small`),
  ADD KEY `thumb` (`thumb`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `problem_id` (`product_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address` (`customer_id`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `order_address_ibfk_1` (`order_id`);

--
-- Indexes for table `order_final`
--
ALTER TABLE `order_final`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_final_ibfk_1` (`customer_id`),
  ADD KEY `order_final_ibfk_2` (`shiping_id`),
  ADD KEY `order_final_ibfk_3` (`payment_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_item_ibfk_1` (`order_id`),
  ADD KEY `order_item_ibfk_2` (`product_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`method_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `base` (`base`),
  ADD KEY `small` (`small`),
  ADD KEY `thumb` (`thumb`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `shiping_method`
--
ALTER TABLE `shiping_method`
  ADD PRIMARY KEY (`method_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_final`
--
ALTER TABLE `order_final`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `media_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `shiping_method`
--
ALTER TABLE `shiping_method`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category` FOREIGN KEY (`parent_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`base`) REFERENCES `category_media` (`media_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`small`) REFERENCES `category_media` (`media_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_3` FOREIGN KEY (`thumb`) REFERENCES `category_media` (`media_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `category_media_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `address` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customer_price_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_price_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_final` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_final`
--
ALTER TABLE `order_final`
  ADD CONSTRAINT `order_final_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_final_ibfk_2` FOREIGN KEY (`shiping_id`) REFERENCES `shiping_method` (`method_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_final_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment_method` (`method_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_final` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `base` FOREIGN KEY (`base`) REFERENCES `product_media` (`media_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `small` FOREIGN KEY (`small`) REFERENCES `product_media` (`media_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `thumb` FOREIGN KEY (`thumb`) REFERENCES `product_media` (`media_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
