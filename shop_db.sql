-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2016 at 06:18 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting_balance`
--

CREATE TABLE `accounting_balance` (
  `user_id` int(11) NOT NULL,
  `balance` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `accounting_balance`
--

INSERT INTO `accounting_balance` (`user_id`, `balance`) VALUES
(1, -2000),
(2, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_document`
--

CREATE TABLE `accounting_document` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `accounting_document`
--

INSERT INTO `accounting_document` (`id`, `description`, `time`) VALUES
(1, '0', '2016-07-05 16:12:11'),
(2, 'Test', '2016-07-05 16:13:16'),
(3, 'Test', '2016-07-05 16:13:48'),
(4, 'Test', '2016-07-05 16:13:58'),
(5, 'Test', '2016-07-05 16:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_transaction`
--

CREATE TABLE `accounting_transaction` (
  `id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `debtor_id` int(11) NOT NULL,
  `creditor_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `debtor_balance` bigint(20) NOT NULL,
  `creditor_balance` bigint(20) NOT NULL,
  `debtor_description` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `creditor_description` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `refrence_type` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `refrence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `accounting_transaction`
--

INSERT INTO `accounting_transaction` (`id`, `document_id`, `debtor_id`, `creditor_id`, `amount`, `debtor_balance`, `creditor_balance`, `debtor_description`, `creditor_description`, `refrence_type`, `refrence_id`) VALUES
(2, 4, 1, 2, 1000, -1000, -1000, 'test 1', 'Test 2', 'online-payment', 0),
(3, 5, 1, 2, 1000, -2000, 2000, 'test 1', 'Test 2', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('waiting','confirmed','preparing','posted') COLLATE utf8_persian_ci NOT NULL,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `create_at`, `status`, `doc_id`) VALUES
(1, 12, '2016-07-05 15:49:32', 'waiting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `returned` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `count`, `price`, `returned`) VALUES
(1, 1, 1, 6, 6, 0),
(2, 1, 10, 5, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `status` enum('visible','invisible') NOT NULL,
  `visit_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `quantity`, `sku`, `status`, `visit_count`) VALUES
(1, 'racket', 'best racket in 2016', 999, 9, 'asd1458', 'visible', 1),
(2, 'asdasdsad', 'sadsad', 1232, 213123, 'q213213', '', 0),
(3, 'sadsa', 'asd', 213, 213, 'asdasd', '', 0),
(4, 'sad', 'sadasd', 123, 12321, '213213', 'visible', 1),
(8, '123', '213', 21321, 213, '21312', '', 0),
(10, 'bbbb', 'bdffadf asd adadas\\  hdhh we', 1233, 123213, '21ssa', 'visible', 1),
(12, 'product', 'slm chetori khoobi', 12345, 123, '241scd', 'visible', 7),
(13, 'testia', 'this s the test', 123, 12314, 'sasd2', 'visible', 5);

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`product_id`, `category_id`) VALUES
(0, 1),
(0, 4),
(0, 5),
(12, 1),
(12, 4),
(13, 1),
(13, 4),
(13, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `parent_id`) VALUES
(1, 'sport', 0),
(2, 'tech', 0),
(3, 'book', 0),
(4, 'tennis', 1),
(5, 'footbal', 1),
(6, 'wordpress', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_comment`
--

CREATE TABLE `product_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commnet` text NOT NULL,
  `status` enum('waiting','approved','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_picture`
--

CREATE TABLE `product_picture` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_pin`
--

CREATE TABLE `product_pin` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `areate_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `firstname`, `lastname`, `roles`) VALUES
(12, 'ali@gmail.com', '781d5b4a8df0c0d7ddd86584704662e4bd5e7e8b', 'ali', 'ahmadi', 'a:0:{}'),
(13, 'reza@gmail.com', '781d5b4a8df0c0d7ddd86584704662e4bd5e7e8b', 'reza', 'kazemi', 'a:0:{}'),
(14, 'iman@gmail.com', '781d5b4a8df0c0d7ddd86584704662e4bd5e7e8b', 'iman', 'gh', 'a:1:{i:0;s:5:"ADMIN";}');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `user_id` int(11) NOT NULL,
  `token` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_balance`
--
ALTER TABLE `accounting_balance`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `accounting_document`
--
ALTER TABLE `accounting_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_transaction`
--
ALTER TABLE `accounting_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_comment`
--
ALTER TABLE `product_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_picture`
--
ALTER TABLE `product_picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_pin`
--
ALTER TABLE `product_pin`
  ADD PRIMARY KEY (`product_id`,`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_balance`
--
ALTER TABLE `accounting_balance`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `accounting_document`
--
ALTER TABLE `accounting_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `accounting_transaction`
--
ALTER TABLE `accounting_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product_comment`
--
ALTER TABLE `product_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_picture`
--
ALTER TABLE `product_picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
