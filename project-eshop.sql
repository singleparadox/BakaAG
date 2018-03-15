-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 02:00 AM
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
(1, 'email@test.com', 'pass', 'Store', 'Manager', 2),
(2, 'user@test.com', 'pass', 'Alejandre', 'Papina', 1),
(3, 'email2@test.com', 'pass', 'Warehouse', 'Manager', 3),
(4, 'email3@test.com', 'pass', 'Account', 'Manager', 4),
(5, 'master@email.com', 'pass', 'Master', 'Account', 5);

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
(1, 1, 'Test Province', 'Test Country', 'Test City', '1111', 'Test Address1', 'Test Address2'),
(2, 2, 'Albay', 'Philippines', 'Legazpi', '4503', 'Legazpi,Albay', 'Legazpi,Albay'),
(3, 5, 'Albay', 'Philippines', 'Legazpi', '4503', 'Maguiron Guinobatan Albay', 'Maguiron Guinobatan Albay');

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
(1, 1, 'Test B. Province', 'Test B. Country', 'Test B. City', '091111111', 'Test B. CompAdd'),
(2, 2, 'Albay', 'Philippines', 'Legazpu', '09363712548', 'Maguiron Guinobatan Albay');

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
(1, 1, 'Trans', '2017-12-17', '0976542321'),
(2, 2, 'Male', '1997-10-22', '09363712548'),
(3, 4, 'male', '2018-03-12', '09363712548'),
(4, 5, 'male', '2018-03-16', '09363712548');

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
(2, 'Admin-Store Manger'),
(3, 'Warehouse-Manager'),
(4, 'Account-Manager'),
(5, 'Master Admin');

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
(1, 60, 2, 0, 34, 0, 20),
(7, 300, 11, 0, 70, 0, 10),
(8, 10, 100, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0, 0),
(10, 200, 222, 0, 127, 0, 50),
(11, 50, 777, 0, 16, 0, 40),
(12, 100, 5, 0, 32, 0, 30),
(13, 150, 3, 0, 5, 0, 75);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `order_total_amt` int(9) NOT NULL,
  `order_product_list` varchar(700) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `acc_id`, `order_total_amt`, `order_product_list`, `order_date`, `order_status_id`) VALUES
(2, 2, 300, '8;', '2018-03-13 13:35:18', 1),
(3, 2, 100, '8;', '2018-03-14 13:50:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `order_status_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_status_name`) VALUES
(1, 'Proccessing'),
(2, 'Shipped'),
(3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_codeid` varchar(767) NOT NULL DEFAULT 'Empty',
  `prod_name` varchar(32) NOT NULL,
  `prod_desc` longtext NOT NULL,
  `prod_picture_link` varchar(700) NOT NULL DEFAULT 'data/Products/default.jpg',
  `prod_dateadd` date NOT NULL,
  `prod_featured` varchar(3) NOT NULL DEFAULT 'No',
  `prod_genre_id` int(11) NOT NULL,
  `prod_type_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_codeid`, `prod_name`, `prod_desc`, `prod_picture_link`, `prod_dateadd`, `prod_featured`, `prod_genre_id`, `prod_type_id`, `inv_id`) VALUES
(1, 'Empty', 'God Eater 2', 'n comparison to Gods Eater Burst there are new features and additions such as the four new weapons, the Boost Hammer, Charge Spear, the Variant Scythe and the Shotgun, each has its own function and abilities for the player to use. The Boost Hammer is a large hammer fitted with a rocket booster, which can be used to inflict heavy damage on an enemy. The Charge Spear is a large spear that can be "charged" to form a sharpened organic blade that can be used to stab foes.', 'data/Products/God Eater 2-18-03-04-37567/image.jpg', '2018-03-21', 'Yes', 2, 3, 1),
(3, 'Empty', 'To Love Ru', 'The story of To Love-Ru revolves around Rito YÅ«ki, a shy and clumsy high-school student who cannot confess his love to the girl of his dreams, Haruna Sairenji. One day when sulking in the bathtub, a mysterious, naked devil-tailed girl appears out of nowhere. Her name is Lala, the runaway crown princess of the planet Deviluke. ', 'data/Products/To Love Ru-18-03-04-46309/image.jpg', '2018-03-12', 'Yes', 2, 2, 7),
(6, 'Empty', 'Kakumeiki Valvrave', 'The story takes place in an unspecified future date, referred to as the 71st year of the True Era (çœŸæš¦ Shinreki). Seventy percent of all human beings have migrated from Earth to other planets of the Solar System and a Dyson sphere, constructed around an artificial Sun. ', 'data/Products/Test Image-17-12-28-42295/image.jpg', '2018-03-20', 'Yes', 2, 2, 10),
(7, 'Empty', 'Gundam Breaker', 'Gundam Breaker is a video game for the Playstation 3 and PS Vita. It was first released for PS3 on June 27, 2013, and then for Vita on October 31, 2013. Both versions now have an online cross play component to share save data. Unlike most games in the Gundam series, Gundam Breaker focuses exclusively on gunplay rather than a specific story based on Gunpla Love and all Gundam universes. A sequel, titled Gundam Breaker 2, was released on December 18, 2014.', 'data/Products/Gundam Breaker-18-08-10-93874/image.jpg', '2018-03-20', 'Yes', 7, 3, 11),
(8, 'Empty', 'Steins;Gate', 'Steins;Gate[a] is a visual novel video game developed by 5pb. and Nitroplus. It is the second game in the Science Adventure series, following Chaos;Head. The story follows a group of students as they discover and develop technology that gives them the means to change the past. The gameplay in Steins;Gate follows non-linear plot lines which offer branching scenarios with courses of interaction.', 'data/Products/Steins;Gate-18-01-10-16257/Steins;Gate-18-01-10-16257', '2018-03-13', 'Yes', 3, 2, 12),
(9, 'Empty', 'Mob Psycho', 'Shigeo Kageyama is an average middle school boy, nicknamed Mob (ãƒ¢ãƒ– Mobu) (meaning â€œbackground characterâ€) for lacking a sense of presence. Although he looks like an inconspicuous person, he is in fact a powerful esper. As he grows older, Mob realizes that his psychic powers are strengthening and becoming more dangerous. To avoid his power getting out of control, he constantly lives a life under an emotional shackle. Mob wants to live a normal life just like the others, but a barrage of trouble keeps coming after him. With the suppressed emotions growing inside Mob little by little, his power threatens to break through its limits.', 'data/Products/Mob Psycho-18-01-10-69665/Mob Psycho-18-01-10-69665', '2018-03-20', 'Yes', 2, 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `product_genre`
--

CREATE TABLE `product_genre` (
  `prod_genre_id` int(11) NOT NULL,
  `prod_genre_name` varchar(100) NOT NULL,
  `prod_genre_desc` longtext NOT NULL,
  `prod_genre_link` varchar(700) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_genre`
--

INSERT INTO `product_genre` (`prod_genre_id`, `prod_genre_name`, `prod_genre_desc`, `prod_genre_link`) VALUES
(1, 'Adventure', '', NULL),
(2, 'Action', 'Khalifa', NULL),
(3, 'Hentai', '', NULL),
(4, 'Ecchi', '', NULL),
(5, 'Harem', '', NULL),
(6, 'Demons', '', NULL),
(7, 'Mecha', '', NULL),
(8, 'Fantasy', '', NULL),
(9, 'Magic', '', NULL),
(10, 'Supernatural', '', NULL),
(11, 'Shoujo', '', NULL),
(12, 'Shounen', '', NULL),
(13, 'Erotic', 'The Erotica', 'data/Category/Erotic-18-02-18-12157/Erotic-18-02-18-12157');

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
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `rate_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `inv_id`, `acc_id`, `rate_num`) VALUES
(1, 1, 3, 3),
(2, 10, 3, 5),
(3, 10, 4, 3),
(4, 10, 5, 3),
(5, 10, 6, 3),
(6, 10, 7, 5),
(7, 10, 8, 5),
(8, 12, 3, 5),
(9, 11, 3, 2),
(10, 7, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE `search` (
  `search_id` int(11) NOT NULL,
  `search_query` longtext NOT NULL,
  `user_searches` bigint(20) NOT NULL COMMENT 'Number of people who have searched the query'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `search`
--

INSERT INTO `search` (`search_id`, `search_query`, `user_searches`) VALUES
(1, 'psycho test', 1),
(2, 'test psycho', 1),
(3, 'test', 1),
(4, 'test mob', 1),
(5, 'test mob gate', 2),
(6, 'mob gate', 3),
(7, 'alejandre papina dakikamura', 1),
(8, 'test papina', 1);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

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
ALTER TABLE `product` ADD FULLTEXT KEY `prod_name` (`prod_name`);

--
-- Indexes for table `product_genre`
--
ALTER TABLE `product_genre`
  ADD PRIMARY KEY (`prod_genre_id`);
ALTER TABLE `product_genre` ADD FULLTEXT KEY `prod_genre_name` (`prod_genre_name`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`prod_type_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`search_id`);
ALTER TABLE `search` ADD FULLTEXT KEY `search_query` (`search_query`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `account_address`
--
ALTER TABLE `account_address`
  MODIFY `acc_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `account_billing`
--
ALTER TABLE `account_billing`
  MODIFY `acc_billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `acc_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `acc_type_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `product_genre`
--
ALTER TABLE `product_genre`
  MODIFY `prod_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `prod_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `search`
--
ALTER TABLE `search`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
