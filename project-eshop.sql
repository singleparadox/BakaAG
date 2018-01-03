-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2018 at 11:36 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(9) NOT NULL,
  `acc_email` varchar(700) NOT NULL,
  `acc_pass` varchar(700) NOT NULL,
  `acc_fname` varchar(32) NOT NULL,
  `acc_lname` varchar(32) NOT NULL,
  `acc_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_email`, `acc_pass`, `acc_fname`, `acc_lname`, `acc_type_id`) VALUES
(1, 'email@test.com', 'pass', 'Glenn', 'Yanzon', 2);

-- --------------------------------------------------------

--
-- Table structure for table `account_address`
--

CREATE TABLE `account_address` (
  `acc_address_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `address_province` varchar(100) NOT NULL,
  `address_country` varchar(100) NOT NULL DEFAULT 'Not Assigned',
  `address_city` varchar(100) NOT NULL DEFAULT 'Not Assigned',
  `address_zipcode` varchar(6) NOT NULL DEFAULT '0',
  `address_line1` text NOT NULL,
  `address_line2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_address`
--

INSERT INTO `account_address` (`acc_address_id`, `acc_id`, `address_province`, `address_country`, `address_city`, `address_zipcode`, `address_line1`, `address_line2`) VALUES
(1, 1, 'Test Province', 'Test Country', 'Test City', '1111', 'Test Address1', 'Test Address2');

-- --------------------------------------------------------

--
-- Table structure for table `account_billing`
--

CREATE TABLE `account_billing` (
  `acc_billing_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `billing_province` varchar(100) NOT NULL,
  `billing_country` varchar(100) NOT NULL DEFAULT 'Not Assigned',
  `billing_city` varchar(100) NOT NULL DEFAULT 'Not Assigned',
  `billing_phonenum` varchar(32) NOT NULL DEFAULT 'Not Assigned',
  `billing_compaddress` varchar(400) NOT NULL DEFAULT 'Not Assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_billing`
--

INSERT INTO `account_billing` (`acc_billing_id`, `acc_id`, `billing_province`, `billing_country`, `billing_city`, `billing_phonenum`, `billing_compaddress`) VALUES
(1, 1, 'Test B. Province', 'Test B. Country', 'Test B. City', '091111111', 'Test B. CompAdd');

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `acc_details_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `acc_details_gender` varchar(32) NOT NULL DEFAULT 'Not Assigned',
  `acc_details_bday` date NOT NULL,
  `acc_details_pnum` varchar(32) NOT NULL DEFAULT 'Not Assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`acc_details_id`, `acc_id`, `acc_details_gender`, `acc_details_bday`, `acc_details_pnum`) VALUES
(1, 1, 'Trans', '2017-12-17', '0976542321');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `acc_type_id` int(2) NOT NULL,
  `acc_type_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`acc_type_id`, `acc_type_name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `acc_id` int(11) NOT NULL,
  `prod_list` varchar(700) NOT NULL,
  `cart_total_amt` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inv_id` int(11) NOT NULL,
  `inv_price` int(9) NOT NULL,
  `inv_stock` int(32) NOT NULL,
  `inv_no_of_sold` int(9) NOT NULL DEFAULT '0',
  `inv_views` int(9) NOT NULL DEFAULT '0',
  `inv_rate` int(9) NOT NULL DEFAULT '0',
  `inv_discount` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inv_id`, `inv_price`, `inv_stock`, `inv_no_of_sold`, `inv_views`, `inv_rate`, `inv_discount`) VALUES
(1, 1001, 2, 0, 0, 0, 0),
(7, 111, 11, 0, 0, 0, 0),
(8, 10, 100, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0, 0),
(10, 10000, 222, 0, 0, 0, 0),
(11, 111, 777, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `order_total_amt` int(9) NOT NULL,
  `order_product_list` varchar(700) NOT NULL,
  `order_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `order_status_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(32) NOT NULL,
  `prod_desc` longtext NOT NULL,
  `prod_picture_link` varchar(700) NOT NULL DEFAULT 'data/Products/default.jpg',
  `prod_genre_id` int(11) NOT NULL,
  `prod_type_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_desc`, `prod_picture_link`, `prod_genre_id`, `prod_type_id`, `inv_id`) VALUES
(1, 'Laptop', 'Test Desc', 'data/Products/default.jpg', 2, 3, 1),
(3, 'joe', 'show', 'data/Products/default.jpg', 2, 2, 7),
(6, 'Test Image', 'Test Image', 'data/Products/Test Image-17-12-28-42295/Test Image-17-12-28-42295', 2, 2, 10),
(7, 'Test Image(No Image)', 'No image', 'data/Products/default.jpg', 2, 3, 11);

-- --------------------------------------------------------

--
-- Table structure for table `product_genre`
--

CREATE TABLE `product_genre` (
  `prod_genre_id` int(11) NOT NULL,
  `prod_genre_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_genre`
--

INSERT INTO `product_genre` (`prod_genre_id`, `prod_genre_name`) VALUES
(1, 'Adventure'),
(2, 'Action');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `prod_type_id` int(11) NOT NULL,
  `prod_type_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`prod_type_id`, `prod_type_name`) VALUES
(2, 'Anime'),
(3, 'Game');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `acc_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`),
  ADD UNIQUE KEY `acc_email` (`acc_email`);

--
-- Indexes for table `account_address`
--
ALTER TABLE `account_address`
  ADD PRIMARY KEY (`acc_address_id`);

--
-- Indexes for table `account_billing`
--
ALTER TABLE `account_billing`
  ADD PRIMARY KEY (`acc_billing_id`);

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`acc_details_id`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`acc_type_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `product_genre`
--
ALTER TABLE `product_genre`
  ADD PRIMARY KEY (`prod_genre_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`prod_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `account_address`
--
ALTER TABLE `account_address`
  MODIFY `acc_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `account_billing`
--
ALTER TABLE `account_billing`
  MODIFY `acc_billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `acc_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `acc_type_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_genre`
--
ALTER TABLE `product_genre`
  MODIFY `prod_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `prod_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
